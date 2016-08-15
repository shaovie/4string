<?php
/**
 * @Author shaowei
 * @Date   2016-05-10
 */

namespace src\m\controller;

use \src\common\BaseController;
use \src\m\model\EventModel;
use \src\m\model\VideoModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->module = 'm';
    }

    public function index()
    {
        $videoList = VideoModel::fetchSomeVideo(
            array('state'), array(1),
            false,
            1, 4
        );
        foreach ($videoList as &$video) {
            $video['video_url'] = explode('|', $video['video_url']);
            $video['image_url'] = explode('|', $video['image_url']);
        }
        $data = array(
            'eventList' => $videoList,
        );
        $this->display('video', $data);
    }

    public function event()
    {
        $eventList = EventModel::fetchSomeEvent(
            array('state'), array(EventModel::EVENT_ST_VALID),
            false,
            1, 4
        );

        foreach ($eventList as &$event) {
            $event['image_urls'] = explode('|', $event['image_urls']);
        }
        $data = array(
            'eventList' => $eventList,
        );
        $this->display('event', $data);
    }
}
