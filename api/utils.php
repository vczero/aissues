<?php

class Utils
{
    /*
     * 封装json处理函数
     * $status: 状态码
     * $info: 描述信息
     * $data: 结果
     * e.g
     * $arr = array(
     *  'name' => 'vczero',
     *  'password' => 'xxxx'
     * );
     * require_once('./utils.php');
     * Response::json(1, 'ok', $arr);
     *
     * */

    public static function json($status, $info = '', $data = array())
    {
        $result = array(
            'status' => $status,
            'info' => $info,
            'data' => $data
        );
        echo json_encode($result);
        exit;

    }

    /*
     * 防止xss攻击
     *
     *
     * */
    public static function xss($array)
    {
        if (is_array($array)) {
            foreach ($array AS $k => $v) {
                $array[$k] = self::xss($v);
            }
        } else {
            $array = self::xstr($array);
        }
        return $array;
    }

    /*
     * 转义特殊字符串
     *
     * */
    private static function xstr($str)
    {
        $farr = array(
            "/\\s+/",
            "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
            "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
        );
        $str = preg_replace($farr, "", $str);
        return addslashes($str);
    }

    public static function guid()
    {
        if (function_exists('com_create_guid')) {
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    /*
     *
     *
     *
     * */
    public static function getIP()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');

        } elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /*
     * 邮箱加密
     *
     *
     * */
    public static function encodeEmail($email, $key = 0)
    {
        $chars = str_split($email);
        $string = '';
        $key = $key ? $key : rand(10, 99);
        foreach ($chars as $value) {
            $string .= sprintf("%02s", dechex(ord($value) ^ $key));
        }
        return dechex($key) . $string;
    }

    /*
     * 邮箱解密
     *
     *
     * */
    public static function decodeEmail($encode)
    {
        $k = hexdec(substr($encode, 0, 2));
        for ($i = 2, $m = ''; $i < strlen($encode) - 1; $i += 2) {
            $m .= chr(hexdec(substr($encode, $i, 2)) ^ $k);
        }
        return $m;
    }

    public static function encodePassword($email, $password)
    {
        return md5(md5($password . 'hhr$##%#3229' . $email, FALSE));
    }

    /*
     * PHP stdClass Object转array
     *
     * */
    public static function object_array($array)
    {
        if (is_object($array)) {
            $array = (array)$array;
        }
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = Utils::object_array($value);
            }
        }
        return $array;
    }

}


class DBHelp
{
    private $_host = '127.0.0.1'; /*根据数据库地址*/
    private $_username = 'root'; /*线上环境重新设定*/
    private $_port = 3306; /*线上环境重新设定*/
    private $_password = 'root'; /*线上环境重新设定*/
    private $_db_name = 'aissues_xiaoshu';/*线上环境重新设定*/
    static private $_instance;
    static private $_pdo;

    private function _construct()
    {
    }

    /*
     * 获取连接
     *
     * */
    static public function getInstance()
    {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    /*
     * 连接数据库
     *
     * */
    public function connect()
    {
        if (!(self::$_pdo)) {
            $dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_db_name . ';port=' . $this->_port;
            self::$_pdo = new PDO($dsn, $this->_username, $this->_password);
            if (!self::$_pdo) {
                throw new PDOException('数据连接异常');
            }
            self::$_pdo->exec("set names utf8");
        }
        return self::$_pdo;
    }
}


?>