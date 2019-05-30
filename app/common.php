<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 随机产生安全码
 * @param $len int 长度
 * @param $type int 类型 1全部字母数字  2数字  3小写字母  4大写字母
 * @return string
 */
function getCode($len, $type = 1)
{
    $code = '';
    switch ($type) {
        case 1:
            $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 2:
            $str = '0123456789';
            break;
        case 3:
            $str = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 4:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 5:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            break;
        default:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    }
    for ($i = 0; $i < $len; $i++) {
        $code .= $str[mt_rand(0, mb_strlen($str, 'utf-8') - 1)];
    }
    return $code;
}

/**
 * 随机产生安全码
 * @param $i int
 * @return string
 */
function Safe_code($i){
    $str = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $finalStr = '';
    for ($j = 0; $j < $i; $j++) {
        $finalStr .= substr($str, rand(0, 35), 1);
    }
    return $finalStr;
}

/**
 * 随机产生数字验证码
 * @param $i int
 * @return string
 */
function getNum($length=4){
    $min = pow(10 , ($length - 1));
    $max = pow(10, $length) - 1;
    return rand($min, $max);
}

/**
 * 密码加密算法
 * @author lixiaoming
 * @time 2017/11/16
 * @param string $pwd 明文密码
 * @param string $username 用户名
 * @param string $encrypt 随机安全码
 * @return string 32位加密字符串
 */
function getMd5($pwd, $username, $encrypt)
{
    $username = strtolower($username);
    return md5(md5($pwd) . $username . $encrypt);
}

/**
 * 获取真实IP
 * @return array|false|string
 */
function get_ip()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else
        if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else
            if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                $ip = getenv("REMOTE_ADDR");
            else
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                    $ip = $_SERVER['REMOTE_ADDR'];
                else
                    $ip = "unknown";
    return ($ip);
}

/**
 * 获取文件扩展名
 * @param string $file 文件路径
 * @return string txt/jpg
 * */
function getExtension($file = '')
{
    if ($file) {
        return pathinfo($file, PATHINFO_EXTENSION);
    }
}


/**
 * 转换单位 支持 TB/GB/MB/KB/B  不限大小写 转换为字节
 * @param string $size 文件大小 例：100MB
 * @return int 1024000
 */
function tfFilesize($size = '')
{
    if (empty($size)) {
        return 0;
    }

    //1、获取大小数值
    $sizenum = floatval($size);
    if (empty($sizenum)) {
        return 0;
    }

    //2、根据大小数值获取后面单位
    $cm = explode($sizenum, $size);
    $cm = !empty($cm[1]) ? strtolower(trim($cm[1])) : '';
    $res = 0;
    $base = 1024;
    switch ($cm) {
        case 'tb':
            $res = $sizenum * $base * $base * $base * $base;
            break;
        case 'gb':
            $res = $sizenum * $base * $base * $base;
            break;
        case 'mb':
            $res = $sizenum * $base * $base;
            break;
        case 'kb':
            $res = $sizenum * $base;
            break;
        case 'b':
            $res = $sizenum;
            break;
        default:
            break;
    }

    return ceil($res);
}


/**
 * 数组去重
 * @param $arr
 * @return mixed
 */
function array_filter_full($arr)
{
    foreach ($arr as $key => $value) {
        if ($value === '') {
            unset($arr[$key]);
        }
    }
    return $arr;
}



/**
 * 小数位截取格式化金额  例如 100000.00 -> 100,000.00
 * @param int $num
 * @param int $dist
 * @param bool $zeroComplete
 * @return int|string
 */
function numberFormat($num = 0, $dist =2, $zeroComplete = TRUE) {

    if (!preg_match('/^(-?\d+)(\.\d+)?$/', $num)) {
        return $num;
    }
    if ($dist > 4) {
        $dist = 4;
    }else if ($dist <= 0) {
        $dist = 0;
    }
    if (!is_bool($zeroComplete)) {
        $zeroComplete = TRUE;
    }
    $newNum = floor($num * pow(10, $dist)) / pow(10, $dist);
    if (!$zeroComplete) {
        //去掉小数末尾的0
        $newNum = floatZeroCut($newNum);
        $pos = strpos(strval($newNum), '.');//获取小数点位置
        if (!$pos) {
            //如果没找到
            $dist = 0;
        }else {
            $dist = strlen(strval($newNum)) - $pos - 1;
        }
    }
    $result = number_format($newNum, $dist, '.','');
    return $result;
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size=0, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}


/*******对外接口相关函数开始********************************************************/
/**
 * 接口密钥检测
 * @param $data array 参数
 * @param $sign string 需要验证的签名
 * @return bool
 */
function check_sign($data, $sign)
{
    $newsign = create_sign($data);

    if ($newsign === $sign) {
        return true;
    } else {
        return false;
    }
}

/**
 * 生成接口返回格式
 * @param $data
 * @return array|string
 */
function create_callback($data)
{
//    $data['time'] = date('Y-m-d H:i:s');
//    $sign = create_sign($data);
//    $data = base64_encode(json_encode($data));
//    $json = array(
//        'data' => $data,
//        'sign' => $sign
//    );
//    $json = json_encode($json);
//    return $json;
    return json($data);
}

/**
 * 接口签名生成
 * @param $data array 参数
 * @return string
 */
function create_sign($data)
{
    ksort($data);
    $str = r_implode(",", $data);
    $key = config('apikey.API_KEY');
    $sign = md5($str . $key);
    return $sign;
}

/**
 * 多维数组返回一维数组，拼接字符串输出
 * @param $pieces array 多维数组
 * @param $glue string 分隔符
 * @return string
 */
function r_implode($glue = '', $pieces)
{
    foreach ($pieces as $r_pieces) {
        if (empty($r_pieces) && $r_pieces !== 0 && $r_pieces !== '0' && $r_pieces !== false) {
            continue;
        }
        if ($r_pieces === true) {
            $r_pieces = 'true';
        } elseif ($r_pieces === false) {
            $r_pieces = 'false';
        }
        if (is_array($r_pieces)) {
            $retVal[] = r_implode($glue, $r_pieces);
        } else {
            $retVal[] = $r_pieces;
        }
    }
    if (!empty($retVal)) {
        return implode($glue, $retVal);
    } else {
        return '';
    }
}

/**
 * 接口数据解密
 * @param $post_data
 * @return mixed
 */
function decodeData($post_data)
{
    $post_data = str_replace("%2B", "+", $post_data);
    $post_data = str_replace(" ", "+", $post_data);
    $post_data = dejson($post_data);
    $post_data['data'] = $post_data['data'] ? dejson(base64_decode($post_data['data'])) : '';
    return $post_data;
}

/**
 * 重写json解析
 * @param $str
 * @return mixed
 */
function dejson($str)
{
    $str = str_replace("\r", '', $str);
    $str = str_replace("\n", '', $str);
    return json_decode($str, 1);
}


/**
 * 接口参数生成
 * @param $data
 * @return string
 */
function setkey($data)
{
    header('Content-Type:text/html;charset=utf-8');
    ksort($data);
    $sign = create_sign($data);
    $json = array(
        'data' => base64_encode(json_encode($data)),
        'sign' => $sign
    );
    return json_encode($json);
}

/**
 * 获取七牛文件下载地址
 * @param $url 保存在七牛上文件的key
 * @return string
 */
function Qiniu_Sign($url) {
    if (!$url) {
        return config('app.upload.default_img');
    }else{
        return $url;
    }
    // $url = empty($url)?config('upload.default_img'):$url;
    // $qiniu_config = config('upload.UPLOAD_QINIU');
    // return "http://".$qiniu_config['domain']."/".$url;
}


/**
 * 接口调用方法
 * @param array $data 参数
 * @param null $host 域名 127.0.0.1
 * @param null $port 端口 80
 * @param null $path 接口地址 /api/login
 * @return string
 */
function getapi(array $data = [], $path = null, $host = null, $port = null)
{
    header("Content-type: text/html; charset=utf-8");

    $http_entity_body = setkey($data);
    $http_entity_type = 'application/x-www-form-urlencoded';
    $http_entity_length = strlen($http_entity_body);
    $host = trim($host);
    $port = trim($port);
    $host = !empty($host) ? $host : config('apikey.API_URL_HOST');#ip
    $port = !empty($port) ? $port : config('apikey.API_URL_PORT');#端口
    $path = config('apikey.API_URL_PATH') . $path;
    $result = '';
    $fp = fsockopen($host, $port, $error_no, $error_desc, 30);
    stream_set_blocking($fp, 0); //非阻塞模式
    if ($fp) {
        fputs($fp, "POST {$path} HTTP/1.0\r\n");
        fputs($fp, "Host: {$host}\r\n");
        fputs($fp, "Content-Type: {$http_entity_type}\r\n");
        if (isset($data['access_token'])) {
            fputs($fp, "X-token: {$data['access_token']}\r\n");
        }
        fputs($fp, "Content-Length: {$http_entity_length}\r\n");

        if (isset($data['sessionid'])) {
            fputs($fp, "Cookie: PHPSESSID={$data['sessionid']};\r\n");
        }
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $http_entity_body . "\r\n\r\n");
        $body = '';
        while (!feof($fp)) {
            $body .= fgets($fp, 128);
        }
        fclose($fp);

        $result = substr($body, strpos($body, "\r\n\r\n") + 4);
    }
    return $result;

}


/**
 * 课程接口调用方法
 * @param array $data 参数
 * @param null $host 域名 127.0.0.1
 * @param null $port 端口 80
 * @param null $path 接口地址 /api/login
 * @return string
 */
function cource_getapi(array $data = [], $path = null, $host = null, $port = null)
{
    header("Content-type: text/html; charset=utf-8");

    $http_entity_body = setkey($data);
    $http_entity_type = 'application/x-www-form-urlencoded';
    $http_entity_length = strlen($http_entity_body);
    $host = trim($host);
    $port = trim($port);
    $host = !empty($host) ? $host : config('apikey.COURSE_API_HOST');#ip
    $port = !empty($port) ? $port : config('apikey.COURSE_API_PORT');#端口
    $path = config('apikey.COURSE_API_PATH') . $path;
    $result = '';
    $fp = fsockopen($host, $port, $error_no, $error_desc, 30);
    stream_set_blocking($fp, 0); //非阻塞模式
    if ($fp) {
        fputs($fp, "POST {$path} HTTP/1.0\r\n");
        fputs($fp, "Host: {$host}\r\n");
        fputs($fp, "Content-Type: {$http_entity_type}\r\n");
        if (isset($data['access_token'])) {
            fputs($fp, "X-token: {$data['access_token']}\r\n");
        }
        fputs($fp, "Content-Length: {$http_entity_length}\r\n");

        if (isset($data['sessionid'])) {
            fputs($fp, "Cookie: PHPSESSID={$data['sessionid']};\r\n");
        }
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $http_entity_body . "\r\n\r\n");
        $body = '';
        while (!feof($fp)) {
            $body .= fgets($fp, 128);
        }
        fclose($fp);

        $result = substr($body, strpos($body, "\r\n\r\n") + 4);
    }
    return $result;

}


/**
 * 验证手机是否合法
 * @param $phone 手机
 */
function checkPhone($phone){
    $reg = '/^(1[1-9][0123456789])[0-9]{8}$/';
    if(preg_match($reg,$phone)){
        return  true;
    }else{
        return false;
    }
}


/**
 * curl请求
 * @param array $data
 * @param string $url
 * @param string $method
 * @param array $config
 * @return array
 */
function curl($data, $url, $method = 'POST', $config = [])
{
    $default_config = [
        'useCert'           => false,      //是否带证书
        'second'            => 30,         //超时时间
        'sslcert_path'      => '',         //cert证书路径
        'sslkey_path'       => '',         //key证书路径
        'callback_type'     => 'json'      //返回格式
    ];
    $config = array_merge($default_config, $config);

    $ch = curl_init();

    //设置超时时间
    curl_setopt($ch, CURLOPT_TIMEOUT, $config['second']);
    $method = strtoupper($method);
    switch ($method) {
        case 'GET':
            $url = $url . http_build_query($data);
            curl_setopt($ch, CURLOPT_URL, $url);
            break;

        default:
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    #带证书
    if ($config['useCert'] == true) {
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLCERT, $config['sslcert_path']);
		curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLKEY, $config['sslkey_path']);
    }

    #运行curl
    $output = curl_exec($ch);

    #返回结果
    curl_close($ch);
    
    $callback_type = strtolower($config['callback_type']);
    switch ($callback_type) {
        case 'xml':
            $output = simplexml_load_string($output);
            $output = (array) $output;
            break;
        case 'json':
        default:
            $output = json_decode($output,true);
    }
    return $output;
}

/**
 * 题库第三方调用接口
 */
function question_api($data, $url)
{
    $time = time();
    $data['jgcode'] = 'xuelejia';

    if(!empty($data)){
        ksort($data);      
        $str = implode('', $data);
    }else{
        $str = '';
    }
    $str = $str . $time . config('apikey.QUESTION_API_KEY');
    $sign = md5($str);
    $data['time'] = $time;
    $data['sign'] = $sign;
    $data['Account'] = config('apikey.QUESTION_API_ACCOUNT');
    $result = curl($data, $url);
    return $result;
}

/**
 * 学科ID转换
 * @param int $id
 * @param int $type 平台：1学乐佳，2格灵课堂，3机器人， 4故事机，5题库
 * @return int
 */
function get_xueke($id, $type = 1)
{
    $id = intval($id);
    $type = intval($type);
    if ($id === 0) {
       return $id;
    }
    $xueke_id = 0;
    switch ($type) {
        case 2:
            break;
        case 3:
            break;
        case 4:
            break;
        case 5:
            break;
        case 1:
        default:
    }

    return $xueke_id;
}



