<?php
/**
 * @Author shaowei
 * @Date   2015-12-24
 */

namespace src\m\model;

use \src\common\Cache;
use \src\common\Util;
use \src\common\Log;
use \src\common\DB;

class EventModel
{
    const EVENT_ST_INVALID         = 0;  // 无效
    const EVENT_ST_VALID           = 1;  // 有效

    public static function newOne(
        $topic,
        $sort,
        $state,
        $imageUrls
    ) {
        $wdb = DB::getDB('w');
        $data = array(
            'topic' => $topic,
            'image_urls' => $imageUrls,
            'sort' => $sort,
            'state' => $state,
            'ctime' => CURRENT_TIME,
        );
        $ret = $wdb->insertOne('event', $data);
        if ($ret === false || (int)$ret <= 0) {
            return false;
        }
        return true;
    }
    public static function updateEventInfo($eventId, $data)
    {
        if (empty($data)) {
            return true;
        }
        $ret = DB::getDB('w')->update(
            'event',
            $data,
            array('id'), array($eventId),
            false,
            1
        );
        self::onUpdateData($eventId);
        return $ret !== false;
    }
    // 商品(外部判断状态)
    public static function findEventById($eventId, $fromDb = 'w')
    {
        if (empty($eventId)) {
            return array();
        }
        $ck = Cache::CK_EVENT_INFO . $eventId;
        $ret = Cache::get($ck);
        if ($ret !== false) {
            $ret = json_decode($ret, true);
        } else {
            $ret = DB::getDB($fromDb)->fetchOne(
                'event',
                '*',
                array('id'), array($eventId)
            );
            if (!empty($ret)) {
                Cache::setEx($ck, Cache::CK_EVENT_INFO_EXPIRE, json_encode($ret));
            }
        }
        return $ret === false ? array() : $ret;
    }

    public static function getStateDesc($state)
    {
        if ($state == self::EVENT_ST_INVALID) {
            return '无效';
        }
        if ($state == self::EVENT_ST_VALID) {
            return '有效';
        }
        return 'null';
    }

    public static function fetchSomeEvent($conds, $vals, $rel, $page, $pageSize)
    {
        $page = $page > 0 ? $page - 1 : $page;

        $ret = DB::getDB('r')->fetchSome(
            'event',
            '*',
            $conds, $vals,
            $rel,
            array('sort', 'id'), array('desc', 'desc'),
            array($page * $pageSize, $pageSize)
        );

        return $ret === false ? array() : $ret;
    }

    public static function fetchEventCount($cond, $vals, $rel)
    {
        $ret = DB::getDB('r')->fetchCount(
            'event',
            $cond, $vals,
            $rel
        );
        return $ret === false ? 0 : $ret;
    }

    private static function onUpdateData($eventId)
    {
        Cache::del(Cache::CK_EVENT_INFO . $eventId);
        self::findEventById($eventId, 'w');
    }
}

