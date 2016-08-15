<?php
/**
 * @Author shaowei
 * @Date   2015-12-27
 */

namespace src\m\model;

use \src\common\Cache;
use \src\common\Util;
use \src\common\Log;
use \src\common\DB;

class VideoModel
{
    public static function newOne(
        $imageUrl,
        $videoUrl,
        $remark,
        $sort,
        $state
    ) {
        $data = array(
            'image_url' => $imageUrl,
            'video_url' => $videoUrl,
            'remark' => $remark,
            'sort' => $sort,
            'state' => $state,
            'ctime' => CURRENT_TIME,
        );
        $ret = DB::getDB('w')->insertOne('video', $data);
        if ($ret === false || (int)$ret <= 0) {
            return false;
        }
        return true;
    }

    public static function findVideoById($videoId)
    {
        if (empty($videoId)) {
            return array();
        }
        $ret = DB::getDB('r')->fetchOne(
            'video',
            '*',
            array('id'), array($videoId)
        );
        return $ret === false ? array() : $ret;
    }
    public static function fetchAllValidVideo($now)
    {
        $sql = "select * from video where state=1 order by sort desc";
        $ret = DB::getDB()->rawQuery($sql);
        return $ret === false ? array() : $ret;
    }

    public static function update($videoId, $data)
    {
        if (empty($data)) {
            return true;
        }
        $ret = DB::getDB('w')->update(
            'video',
            $data,
            array('id'), array($videoId),
            false,
            1
        );
        return $ret !== false;
    }

    public static function delVideo($videoId)
    {
        $ret = DB::getDB('w')->delete(
            'video',
            array('id'), array($videoId),
            false,
            1
        );
        return $ret === false ? false : true;
    }
    public static function fetchSomeVideo($conds, $vals, $rel, $page, $pageSize)
    {
        $page = $page > 0 ? $page - 1 : $page;

        $ret = DB::getDB('r')->fetchSome(
            'video',
            '*',
            $conds, $vals,
            $rel,
            array('sort'), array('desc'),
            array($page * $pageSize, $pageSize)
        );

        return $ret === false ? array() : $ret;
    }

    public static function fetchSomeVideo2($conds, $vals, $rel, $page, $pageSize)
    {
        $page = $page > 0 ? $page - 1 : $page;

        $ret = DB::getDB('r')->fetchSome(
            'video',
            '*',
            $conds, $vals,
            $rel,
            array('id'), array('desc'),
            array($page * $pageSize, $pageSize)
        );

        return $ret === false ? array() : $ret;
    }

    public static function fetchVideoCount($cond, $vals, $rel)
    {
        $ret = DB::getDB('r')->fetchCount(
            'video',
            $cond, $vals,
            $rel
        );
        return $ret === false ? 0 : $ret;
    }
    public static function getStateDesc($state)
    {
        if ($state == 0) {
            return '无效';
        }
        if ($state == 1) {
            return '有效';
        }
        return 'null';
    }
}
