<?php
/**
 * @Author shaowei
 * @Date   2015-12-03
 */

namespace src\admin\controller;

use \src\common\Util;
use \src\common\Check;
use \src\common\Upload;
use \src\m\model\VideoModel;

class VideoController extends AdminController
{
    const ONE_PAGE_SIZE = 10;

    public function listPage()
    {
        $page = $this->getParam('page', 1);

        $totalNum = VideoModel::fetchVideoCount([], [], []);
        $videoList = VideoModel::fetchSomeVideo2([], [], [], $page, self::ONE_PAGE_SIZE);
        foreach ($videoList as &$video) {
            $video['state'] =  VideoModel::getStateDesc($video['state']);
            $video['image_url'] = explode('|', $video['image_url']);
        }

        $searchParams = [];
        $error = '';
        $pageHtml = $this->pagination(
            $totalNum,
            $page,
            self::ONE_PAGE_SIZE,
            '/admin/Video/listPage',
            $searchParams
        );

        $data = array(
            'videoList' => $videoList,
            'totalNum' => $totalNum,
            'pageHtml' => $pageHtml,
            'search' => $searchParams,
            'error' => $error
        );
        $this->display("video_list", $data);
    }

    public function addPage()
    {
        $data = array(
            'title' => '新增',
            'video' => array(),
            'action' => '/admin/Video/add',
        );
        $this->display('video_info', $data);
    }
    public function add()
    {
        $error = '';
        $videoInfo = array();
        $ret = $this->fetchFormParams($videoInfo, $error);
        if ($ret === false) {
            $this->ajaxReturn(ERR_PARAMS_ERROR, $error, '');
            return ;
        }

        $videoId = VideoModel::newOne(
            $videoInfo['image_url'],
            $videoInfo['video_url'],
            $videoInfo['remark'],
            $videoInfo['sort'],
            $videoInfo['state']
        );
        if ($videoId === false || (int)$videoId <= 0) {
            $this->ajaxReturn(ERR_SYSTEM_ERROR, '保存失败');
            return ;
        }
        $this->ajaxReturn(0, '保存成功，请确认信息无误', '/admin/Video/listPage');
    }
    public function editPage()
    {
        $videoId = intval($this->getParam('videoId', 0));

        $videoInfo = VideoModel::findVideoById($videoId);
        if (!empty($videoInfo)) {
            $videoInfo['video_url'] = explode('|', $videoInfo['video_url']);
            $videoInfo['image_url'] = explode("|", $videoInfo['image_url']);
        }
        $data = array(
            'title' => '编辑',
            'video' => $videoInfo,
            'action' => '/admin/Video/edit',
        );
        $this->display('video_info', $data);
    }
    public function edit()
    {
        $error = '';
        $videoInfo = array();
        $ret = $this->fetchFormParams($videoInfo, $error);
        if ($ret === false) {
            $this->ajaxReturn(ERR_PARAMS_ERROR, $error, '');
            return ;
        }

        $updateData = array();
        $updateData['remark'] = $videoInfo['remark'];
        $updateData['sort'] = $videoInfo['sort'];
        $updateData['state'] = $videoInfo['state'];
        $updateData['video_url'] = $videoInfo['video_url'];
        $updateData['image_url'] = $videoInfo['image_url'];
        $ret = VideoModel::update($videoInfo['id'], $updateData);
        if ($ret === false) {
            $this->ajaxReturn(ERR_SYSTEM_ERROR, '保存失败');
            return ;
        }
        $this->ajaxReturn(0, '保存成功，请确认信息无误', '/admin/Video/listPage');
    }
    public function del()
    {
        $videoId = $this->getParam('videoId', 0);
        if ($videoId == 0) {
            header('Location: /admin/Video/listPage');
            return ;
        }
        VideoModel::delVideo($videoId);
        header('Location: /admin/Video/listPage');
    }
    private function fetchFormParams(&$videoInfo, &$error)
    {
        $videoInfo['id'] = intval($this->postParam('videoId', 0));
        $videoInfo['remark'] = trim($this->postParam('remark', ''));
        $videoInfo['sort'] = intval($this->postParam('sort', 0));
        $videoInfo['state'] = intval($this->postParam('state', 0));
        $videoInfo['image_url'] = trim($this->postParam('imageUrl', ''));
        $videoInfo['image_url'] = trim($videoInfo['image_url'], '|');
        $gs = explode('|', $videoInfo['image_url']);
        if (count($gs) > 9) {
            $error = '预览图不能超过5张';
            return false;
        }
        $videoInfo['video_url'] = '';
        $videoUrls = array();
        $videoUrls[] = trim($this->postParam('videoUrl1', ''));
        $videoUrls[] = trim($this->postParam('videoUrl2', ''));
        $videoUrls[] = trim($this->postParam('videoUrl3', ''));
        $videoUrls[] = trim($this->postParam('videoUrl4', ''));
        $videoUrls[] = trim($this->postParam('videoUrl5', ''));
        foreach ($videoUrls as $url) {
            if (strlen($url) > 1)
                $videoInfo['video_url'] = $videoInfo['video_url'] . '|' . $url;
        }
        $videoInfo['video_url'] = trim($videoInfo['video_url'], '|');

        if (strlen($videoInfo['remark']) > 120) {
            $error = '备注不能超过40个字符';
            return false;
        }
        return true;
    }

}
