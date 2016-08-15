<?php
/**
 * @Author shaowei
 * @Date   2015-07-18
 */

namespace src\common;

class Cache
{
    private static $cache = false;

    //= define keys
    // format   name1:[name2:]
    // 缓存KEY的前缀已经在Redis中配置过了，这里就不需要加了

    const CK_EVENT_INFO              = 'event_info:';   const CK_EVENT_INFO_EXPIRE = 86400;
    const CK_ADMIN_SESSOIN           = 'admin_session:';   const CK_ADMIN_SESSOIN_EXPIRE = 2592000;

    //= for employee
    const CK_EMPLOYEE_INFO_FOR_AC    = 'employee_info_for_ac:';
    const CK_DELIVERYMAN_INFO_FOR_ID = 'deliveryman_info_for_id:';
    const CK_ALL_DELIVERYMAN         = 'all_deliveryman:';

    //= public static methods
    //
    private static function getCache()
    {
        if (self::$cache == false) {
            self::$cache = new Redis(REDIS_CACHE_HOST, REDIS_CACHE_PORT, CACHE_PREFIX . ':');
        }
        return self::$cache;
    }
    public static function get($key)
    {
        return self::getCache()->get($key);
    }
    public static function mGet($key)
    {
        return self::getCache()->mGet($key);
    }
    public static function set($key, $v)
    {
        return self::getCache()->set($key, $v);
    }
    public static function setEx($key, $expire/*sec*/, $v)
    {
        return self::getCache()->setEx($key, $expire, $v);
    }
    public static function expire($key, $expire/*sec*/)
    {
        return self::getCache()->expire($key, $expire);
    }
    public static function setTimeout($key, $timeout/*sec*/)
    {
        return self::getCache()->setTimeout($key, $timeout);
    }
    public static function del($key)
    {
        return self::getCache()->del($key);
    }
    public static function incr($key)
    {
        return self::getCache()->incr($key);
    }
    public static function lPush($key, $v)
    {
        return self::getCache()->lPush($key, $v);
    }
    public static function rPush($key, $v)
    {
        return self::getCache()->rPush($key, $v);
    }
    public static function lPop($key)
    {
        return self::getCache()->lPop($key);
    }
    public static function lRange($key, $start, $end)
    {
        return $ret;
    }
    public static function lSize($key)
    {
        return self::getCache()->lSize($key);
    }
    public static function lTrim($key, $start, $stop)
    {
        return self::getCache()->lTrim($key, $start, $stop);
    }
}
