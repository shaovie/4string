<?php
/**
 * @Author shaowei
 * @Date   2015-12-03
 */

namespace src\admin\controller;

use \src\common\Util;
use \src\common\Check;
use \src\common\Log;
use \src\m\model\EventModel;

class EventController extends AdminController
{
    const ONE_PAGE_SIZE = 10;

    public function listPage()
    {
        $page = $this->getParam('page', 1);

        $totalNum = EventModel::fetchEventCount([], [], []);
        $eventList = EventModel::fetchSomeEvent([], [], [], $page, self::ONE_PAGE_SIZE);
        foreach ($eventList as &$event) {
            $event['state'] =  EventModel::getStateDesc($event['state']);
            $event['image_urls'] = explode('|', $event['image_urls']);
        }


        $searchParams = [];
        $error = '';
        $pageHtml = $this->pagination(
            $totalNum,
            $page,
            self::ONE_PAGE_SIZE,
            '/admin/Event/listPage',
            $searchParams
        );
        $data = array(
            'eventList' => $eventList,
            'totalEventNum' => $totalNum,
            'pageHtml' => $pageHtml,
            'search' => $searchParams,
            'error' => $error
        );
        $this->display("event_list", $data);
    }

    public function addPage()
    {
        $defaultAttr = '默认';
        $data = array(
            'title' => '新增事件',
            'event' => array(),
            'action' => '/admin/Event/add',
        );
        $this->display('event_info', $data);
    }
    public function add()
    {
        $error = '';
        $eventInfo = array();
        $ret = $this->fetchFormParams($eventInfo, $error);
        if ($ret === false) {
            $this->ajaxReturn(ERR_PARAMS_ERROR, $error, '');
            return ;
        }

        $eventId = EventModel::newOne(
            $eventInfo['topic'],
            $eventInfo['sort'],
            $eventInfo['state'],
            $eventInfo['image_urls']
        );
        if ($eventId === false || (int)$eventId <= 0) {
            $this->ajaxReturn(ERR_SYSTEM_ERROR, '保存失败');
            return ;
        }
        $this->ajaxReturn(0, '保存成功，请确认信息无误', '/admin/Event/listPage');
    }

    public function editPage()
    {
        $eventId = intval($this->getParam('eventId', 0));

        $eventInfo = EventModel::findEventById($eventId, 'w');
        if (!empty($eventInfo)) {
            $eventInfo['image_urls'] = explode("|", $eventInfo['image_urls']);
        }
        $data = array(
            'title' => '编辑事件',
            'event' => $eventInfo,
            'action' => '/admin/Event/edit',
        );
        $this->display('event_info', $data);
    }
    public function edit()
    {
        $error = '';
        $eventInfo = array();
        $ret = $this->fetchFormParams($eventInfo, $error);
        if ($ret === false) {
            $this->ajaxReturn(ERR_PARAMS_ERROR, $error, '');
            return ;
        }

        $updateData = array();
        $updateData['topic'] = $eventInfo['topic'];
        $updateData['state'] = $eventInfo['state'];
        $updateData['sort'] = $eventInfo['sort'];
        $updateData['image_urls'] = $eventInfo['image_urls'];
        $ret = EventModel::updateEventInfo($eventInfo['id'], $updateData);
        if ($ret === false) {
            $this->ajaxReturn(ERR_SYSTEM_ERROR, '保存失败');
            return ;
        }
        $this->ajaxReturn(0, '保存成功，请确认信息无误', '/admin/Event/editPage?eventId=' . $eventInfo['id']);
    }
    private function fetchFormParams(&$eventInfo, &$error)
    {
        $eventInfo['id'] = intval($this->postParam('eventId', 0));
        $eventInfo['topic'] = trim($this->postParam('topic', ''));
        $eventInfo['state'] = intval($this->postParam('state', -1));
        $eventInfo['sort'] = intval($this->postParam('sort', 0));
        $eventInfo['image_urls'] = trim($this->postParam('imageUrls', ''));

        if (empty($eventInfo['topic'])) {
            $error = '主题不能为空';
            return false;
        }
        if (strlen($eventInfo['topic']) > 120) {
            $error = '主题超过40个字符';
            return false;
        }
        if ($eventInfo['state'] != EventModel::EVENT_ST_INVALID
            && $eventInfo['state'] != EventModel::EVENT_ST_VALID
        ) {
            $error = '状态无效';
            return false;
        }
        $eventInfo['image_urls'] = trim($eventInfo['image_urls'], '|');
        $gs = explode('|', $eventInfo['image_urls']);
        if (count($gs) > 9) {
            $error = '轮播图不能超过9张';
            return false;
        }
        return true;
    }

}
