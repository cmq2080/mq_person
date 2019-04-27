<?php
/**
 * tc函数标准库
 * Created By Temple Chan
 * <cmq2080@gmail.com>
 */

// tc_gdt 函数常量集合
const TC_DATE_TIME = 1;
const TC_DATE      = 2;
const TC_TIME      = 3;

/************自定义常量开始************/
/************自定义常量结束************/

/**
 * 功能：在ajax请求中返回固定格式的json数据
 * Created at 2019/3/24 14:50 by mq
 * @param int $stat
 * @param string $msg
 * @param array $data
 * @param bool $return_json
 * @return false|string
 */
function ajax_return($stat = 0, $msg = 'ok', $data = [], $return_json = false)
{
    $info = [
        'stat' => $stat,
        'msg'  => $msg
    ];
    if ($data) {
        $info['data'] = $data;
    }
    $info = json_encode($info, JSON_UNESCAPED_UNICODE);

    if ($return_json === true) {
        return json_encode($info);
    } else {
        echo $info;
        die;
    }
}

/**
 * 功能：http_build_query函数的逆函数
 * Created at 2018/10/1 10:21 by 陈庙琴
 * @param $query
 * @return array
 */
function http_break_query($query)
{
    $result = [];
    foreach (explode('&', $query) as $value) {
        $value = explode('=', $value);
        if (count($value) < 2) {
            continue;
        }
        $result[$value[0]] = $value[1];
    }
    return $result;
}

/**
 * 功能：删除数组中有特定值的元素
 * Created By mq at 下午6:35 2018/12/25
 * @param $array
 * @param $del_value
 * @param int $count 最多删除次数，0为无限制
 */
function tc_array_del(&$array, $del_value, $count = 0)
{
    $i = 0;
    foreach ($array as $key => $value) {
        if ($value == $del_value) {
            unset($array[$key]);
            $i++;
            if ($count > 0 && $count === $i) {
                break;
            }
        }
    }
}

/**
 * 功能：按白/黑名单过滤数组
 * 描述：白名单优先于黑名单
 * Created at 2018/10/1 15:17 by 陈庙琴
 * @param       $array
 * @param array $while_list
 * @param array $black_list
 * @return array
 */
function tc_array_select($array, $while_list = [], $black_list = [])
{
    $result = [];
    if ($while_list) {
        foreach ($while_list as $key) {
            if (isset($array[$key])) {
                $result[$key] = $array[$key];
            }
        }
    } else {
        $result = $array;
        foreach ($black_list as $key) {
            if (isset($array[$key])) {
                unset($array[$key]);
            }
        }
    }
    return $result;
}

/**
 * 功能：去除数组中值为空字符串或NULL的元素（和array_filter唯一的区别就是保留0数字值）
 * Created at 2018/10/1 10:20 by 陈庙琴
 * @param $array
 * @return mixed
 */
function tc_array_trim($array)
{
    foreach ($array as $key => $value) {
        if ($value === '' || $value === null) {
            unset($array[$key]);
        }
    }
    return $array;
}

/**
 * 功能：获取数组元素中的某一键所对应的值
 * 描述：可自动识别二维数组、对象数组以及它们json化后的格式
 * Created at 2019/3/24 14:52 by mq
 * @param $arrays
 * @param $key
 * @return array
 */
function tc_array_vls($arrays, $key)
{
    if (!is_array($arrays)) {
        $arrays = json_decode($arrays);
    }
    $result = [];
    foreach ($arrays as $array) {
        if (isset($array[$key])) {
            $result[] = $array[$key];
        } else if (isset($array->$key)) {
            $result[] = $array->$key;
        }
    }
    return $result;
}

/**
 * 功能：字符串由gb2312转成utf-8
 * Created at 2018/10/1 14:54 by 陈庙琴
 * @param $string
 * @return string
 */
function tc_g2u($string)
{
    return iconv('gb2312//IGNORE', 'utf-8', $string);
}

/**
 * 功能：获取目标类的最终类名
 * Created at 2019/3/24 14:52 by mq
 * @param $obj
 * @return mixed
 */
function tc_gcn($obj)
{
    $classNames = explode('\\', get_class($obj));
    $className  = $classNames[count($classNames) - 1];
    return $className;
}

/**
 * 功能：获取当前日期&时间
 * Created at 2018/10/1 10:04 by 陈庙琴
 * @param int $mode 模式:0（默认）-获取日期和时间；1-仅获取日期;2-仅获取时间
 * @return false|null|string
 */
function tc_gdt($mode = TC_DATE_TIME)
{
    $date = null;
    switch ($mode) {
        case TC_DATE_TIME:
            $date = date('Y-m-d H:i:s');
            break;
        case TC_DATE:
            $date = date('Y-m-d');
            break;//因为0和null是同值，所以从1开始
        case TC_TIME:
            $date = date('H:i:s');
            break;
        default:
            die('模式错误[$mode 模式:0（默认）-获取日期和时间；1-仅获取日期;2-仅获取时间]');
    }
    return $date;
}

/**
 * 功能：获取IP地址
 * Created at 2018/10/1 9:59 by 陈庙琴
 * @return string
 */
function tc_gip()
{
    $ip = '';
    //  print_r($_SERVER);
    if (!isset($_SERVER['HTTP_X_FORWARDED_FOR']) || $_SERVER['HTTP_X_FORWARDED_FOR'] === '' || strpos($_SERVER['HTTP_X_FORWARDED_FOR'], 'unknown') !== false) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip_str = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $ip_str = str_replace(';', '|', str_replace(',', '|', $ip));
        $ip_str = explode('|', $ip_str);
        $ip     = $ip_str[0];
    }

    $ip = trim($ip);
    return $ip;
}

/**
 * 功能：获取当前地址
 * Created at 2018/10/1 10:33 by 陈庙琴
 * @param bool $full_url 是否全路由（加上uri的部分）
 * @return string
 */
function tc_gurl($full_url = true)
{
    // 获取访问协议
    $protocol = 'http://';
    if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on') {
        $protocol = 'https://';
    }

    // 拼接基本url
    $url = $protocol . $_SERVER['SERVER_NAME'];
    if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {// 特殊端口，加端口号
        $url .= ':' . $_SERVER['SERVER_PORT'];
    }

    if ($full_url) {
        // 拼接全url
        $url .= $_SERVER['REQUEST_URI'];
    }
    return $url;
}

/**
 * 功能：判断是否是移动端访问
 * Created at 2018/10/1 10:15 by 陈庙琴
 * @return bool
 */
function tc_mreq()
{
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser      = '0';
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
    }
    if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false)) {
        $mobile_browser++;
    }
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        $mobile_browser++;
    }
    if (isset($_SERVER['HTTP_PROFILE'])) {
        $mobile_browser++;
    }
    $mobile_ua     = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc',
        'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d',
        'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki',
        'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-',
        'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
        'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw',
        'xda', 'xda-'
    );
    if (in_array($mobile_ua, $mobile_agents)) {
        $mobile_browser++;
    }
    if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false) {
        $mobile_browser++;
    }
    // Pre-final check to reset everything if the user is on Windows
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false) {
        $mobile_browser = 0;
    }
    // But WP7 is also Windows, with a slightly different characteristic
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false) {
        $mobile_browser++;
    }
    if ($mobile_browser > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * 功能：如果session没启用，则启用session
 * Created at 2018/10/1 10:29 by 陈庙琴
 */
function tc_session_start()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}

/**
 * 功能：字符串限制
 * Created at 2018/10/1 14:47 by 陈庙琴
 * @param        $string
 * @param        $length
 * @param string $sign
 * @return string
 */
function tc_str_limit($string, $length, $sign = '...')
{
    if (mb_strlen($string) <= $length) {
        return $string;
    } else {
        $string = mb_substr($string, 0, $length) . $sign;
        return $string;
    }
}

/**
 * 功能：生成随机字符串
 * Created at 2018/10/1 14:47 by 陈庙琴
 * @param int $length
 * @param bool $only_number
 * @param bool $insensitive
 * @return string
 */
function tc_str_rand($length = 4, $only_number = false, $insensitive = false)
{
    $number_text = '1234567890';
    $lower_text  = 'abcdefghijklmnopqrstuvwxyz';
    $upper_text  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($only_number === true) {
        $text = $number_text;
    } else if ($insensitive === true) {
        $text = $number_text . $lower_text;
    } else {
        $text = $number_text . $lower_text . $upper_text;
    }
    $str   = '';
    $chars = str_split($text);// 做成随机字符数组可以提升性能，比以往的截取字符串可提升15-25%的性能（split函数已经废弃）
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, count($chars) - 1)];
    }
    return $str;
}

/**
 * 功能：字符串多路替换
 * Created at 2018/10/1 15:22 by 陈庙琴
 * @param $string
 * @param $replace_array
 * @return mixed
 */
function tc_str_rp($string, $replace_array)
{
    foreach ($replace_array as $search => $replace) {
        $string = str_replace($search, $replace, $string);
    }
    return $string;
}

/**
 * 功能：字符串切片
 * Created By mq at 下午7:13 2018/12/25
 * @param $string
 * @param $length
 * @param string $sign
 * @return array
 */
function tc_str_slice($string, $length, $sign = '', $encoding = 'utf-8')
{
    $str_length = mb_strlen($string, $encoding);
    $result     = [];
    for ($i = 0; $i < $str_length; $i += $length) {
        $len = $length;
        if ($i + $len > $str_length) {
            $len = $str_length - $i + 1;
        }
        $result[] = $sign . mb_substr($string, $i, $len, $encoding) . $sign;
    }
    return $result;
}

/**
 * 功能：字符串由utf-8转成gb2312
 * Created at 2018/10/1 14:54 by 陈庙琴
 * @param $string
 * @return string
 */
function tc_u2g($string)
{
    return iconv('utf-8', 'gb2312//IGNORE', $string);
}

/**
 * 功能：使用js弹出消息并重定向到上一级
 * Created at 2018/10/1 10:49 by 陈庙琴
 * @param      $message
 * @param null $redirect_url
 */
function url_back($message, $redirect_url = null)
{
    $text = '<script>alert("' . $message . '");';
    switch ($redirect_url) {
        case null:// 没有重定向的url，则返回上一页
            $text .= 'window.history.go(-1);';
            break;
        default:
            $text .= 'location.href="' . $redirect_url . '";';
    }
    $text .= '</script>';
    echo $text;
    die;
}