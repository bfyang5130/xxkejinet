<?php

namespace common\services;

use common\services\OssService ;
use Yii;
use yii\base\Exception;
use yii\helpers\VarDumper;
use yii\imagine\Image;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class BaseToolService {

    /**
     * 加密密码
     * @param int $order
     * @param string $password
     * @return boolean
     */
    public static function encodePassword($order, $password) {
        return md5(md5($password) . $order);
    }

    /**
     * 生成user表的order字段
     * @return string
     */
    public static function createOrder() {
        $order = substr(uniqid(rand()), -6);
        return $order;
    }

    /**
     * 验证手机格式
     * @param string $phone
     * @return boolean
     */
    public static function validPhone($phone) {
        $pattern = "/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/";
        $result = preg_match($pattern, $phone);
        return $result;
    }

    /**
     * 生成序列号
     * @return string
     */
    public static function createSerialNum() {
        $cur_time = date("YmdHis");
        $serial_num = $cur_time . rand(10000, 99999);
        return $serial_num;
    }

    /**
     *
     * @param type $string
     * @param type $length
     * @param type $etc
     * @return type
     * utf-8截取字符串
     */
    public static function cutstr($string, $length, $etc = '...') {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return $result;
    }

    /**
     * 时间转换
     * @param $date
     * @return mixed
     */
    public static function dateChange($date) {
        $time = strtotime($date);
        $cur_date = date("Y-m-d", $time);
        return $cur_date;
    }

    /**
     * 同步图片到服务器上
     * @param $url
     * @param $filename
     * @param $path 本地文件真实路径
     * @param $type
     * #param $file_path 服务器保存路径
     */
    public static function syncImage($url, $filename, $path, $type, $file_path) {
        $key = \Yii::$app->params['api_key'];
        $cur_time = date("YmdH");
        //token
        $token = md5(md5($key) . $cur_time);
        if (class_exists('\CURLFile')) {
            $data = array(
                'file_name' => new \CURLFile(realpath($path), $type, $filename),
                'file_path' => $file_path,
                'token' => $token
            );
        } else {
            $data = array(
                'file_name' => '@' . realpath($path) . ";type=" . $type . ";filename=" . $filename,
                'file_path' => $file_path,
                'token' => $token
            );
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_data = curl_exec($ch);
        return $return_data;
    }

    /**
     * 重新推入指定的redis
     * 按缓存ID删除前台的缓存
     * @param $cache_id
     * @return mixed
     */
    public static function pushRedis($data) {
        //获得配置的redis对应接口地址
        $redisUrl = \Yii::$app->params['redis_url'];
        $redisToken = \Yii::$app->params['redis_token'];
        if ($redisUrl && $redisToken) {
            //将data处理成要求的JSON格式
            $fitData = [];
            foreach ($data as $oneData) {
                $typeName = '媒体报道';
                $typeUrl = 'http://news.tuandai.com/about_us/news.aspx?mark=10';
                switch ($oneData['Location']) {
                    case 1:
                        $typeName = '政府关怀';
                        $typeUrl = 'http://news.tuandai.com/about/guest.html?mark=20';
                        break;
                    case 2:
                        $typeName = '媒体报道';
                        $typeUrl = 'http://news.tuandai.com/about_us/news.aspx?mark=10';
                        break;
                    default :
                        $typeName = '媒体报道';
                        $typeUrl = 'http://news.tuandai.com/about_us/news.aspx?mark=10';
                        break;
                }
                /**
                  $fitData[] = [
                  'Type' => urlencode(intval($oneData['Location'])),
                  'Title' => urlencode($oneData['Title']),
                  'Url' => urlencode($oneData['OutChain']),
                  'TypeName' => urlencode($typeName),
                  'TypeUrl' => urlencode($typeUrl),
                  'AddDate' => urlencode(Date('Y-m-d H:i:s', strtotime($oneData['AddDate'])))
                  ];
                 */
                $fitData[] = [
                    'Type' => intval($oneData['Location']),
                    'Title' => $oneData['Title'],
                    'Url' => $oneData['OutChain'],
                    'TypeName' => $typeName,
                    'TypeUrl' => $typeUrl,
                    'AddDate' => Date('Y-m-d H:i:s', strtotime($oneData['AddDate']))
                ];
            }
            $jsonData = json_encode($fitData, JSON_UNESCAPED_UNICODE);
            $jsonDatas = str_replace('\\/', '/', $jsonData); //处理被转换的号码
            $newsJsonData = urlencode($jsonDatas);
            $fitToken = self::createRedisToken($redisToken, $newsJsonData);
            $fitJsonToken = json_encode(['jsonString' => $newsJsonData, 'token' => $fitToken], JSON_UNESCAPED_UNICODE);
            $rawBody = str_replace('\\/', '/', $fitJsonToken); //处理被转换的号码
            //配置请求的URL
            $newUrl = $redisUrl;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $newUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $rawBody);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $return_data = curl_exec($ch);
            Yii::info("媒体报道推向redis结果:".$return_data,"tdwinfosystem") ;
            curl_close($ch);
            if (!is_null($return_data) && $return_data == '1') {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    /**
     * 把字符串转成数组
     * @param type $string
     * @return type
     */
    public static function getBytes($string) {
        $bytes = array();
        for ($i = 0; $i < strlen($string); $i++) {
            $bytes[] = ord($string[$i]);
        }
        return $bytes;
    }

    /**
     * 处理REDISTOKEN
     * @param type $redisToken
     * @param type $jsonData
     * @return type
     */
    public static function createRedisToken($redisToken, $jsonData) {
        //print_r(strtolower($jsonData));exit;
        //self::getBytes($redisToken . strtolower($jsonData));exit;

        $sha1 = strtoupper(sha1($redisToken . strtolower($jsonData)));

        $s1 = implode(str_split($sha1, 2), "-");
        $md5 = strtoupper(md5($s1 . $redisToken));
        $s2 = implode(str_split($md5, 2), "-");
        return $s2;
    }

    /**
     * 按缓存ID删除前台的缓存
     * @param $cache_id
     * @return mixed
     */
    public static function delFrontendCache($cacheKey) {
        $existRs = Yii::$app->cache->exists($cacheKey);
        if ($existRs == false) {
            $msg = '缓存不存在';
            return ['status' => false, "msg" => $msg];
        }
        $delRs = Yii::$app->cache->delete($cacheKey);
        if ($delRs == true) {
            $msg = '删除缓存成功';
        } else {
            $msg = '删除缓存失败';
        }
        return ['status' => false, "msg" => $msg];
    }

    /**
     * 按缓存ID删除前台的缓存
     * @param $cache_id
     * @return mixed
     */
    public static function delFrontendStaticpage($cache_id) {
        $frontend_domain_arr = Yii::$app->params['frontend_static_page'];
        $err_msg = '';
        $err_status = false;
        foreach ($frontend_domain_arr as $frontend_domain) {
            $post_url = $frontend_domain . "/api/del-staticpage.html";
            $token = self::getApiToken();
            $post_data = array("cache_key" => $cache_id, "token" => $token);
            $post_rs = HttpService::curlPost($post_url, $post_data);
            $post_return = json_decode($post_rs, true);
            if ($post_return['code'] <> 200) {
                $err_status = true;
                $err_msg = $err_msg . "IP:".$frontend_domain."-". $post_return['message'] . ",";
            }else{
                $err_msg = $err_msg ."IP:".$frontend_domain."-清除成功,";
            }
        }
        if ($err_status == true) {
            $err_msg = substr($err_msg, 0, -1);
            return ['status' => false, "msg" => $err_msg];
        } else {
            return ['status' => true, "msg" => "清除成功"];
        }
    }

    
      /**
     * 重新生成缓存文件
     * @param $cache_id
     * @return mixed
     */
    public static function deladdFrontendStaticpage($cache_id) {
        $frontend_domain_arr = Yii::$app->params['frontend_static_page'];
        $err_msg = '';
        $err_status = false;
        foreach ($frontend_domain_arr as $frontend_domain) {
            $post_url = $frontend_domain . "/api/del-add.html";
            $token = self::getApiToken();
            $post_data = array("cache_key" => $cache_id, "token" => $token,'cache_url'=>$frontend_domain); //增加当前域名值的传递：cache_url;
            $post_rs = HttpService::curlPost($post_url, $post_data);
            $post_return = json_decode($post_rs, true);
            if ($post_return['code'] <> 200) {
                $err_status = true;
                $err_msg = $err_msg . $post_return['message'] . ",";
            }
        }
        if ($err_status == true) {
            $err_msg = substr($err_msg, 0, -1);
            return ['status' => false, "msg" => $err_msg];
        } else {
            return ['status' => true, "msg" => "清除成功"];
        }
    }
    
    
    /**
     * 获取要验证token
     * @return string
     */
    public static function getApiToken() {
        $key = \Yii::$app->params['api_key'];
        $cur_time = date("Ymd");
        $token = md5(md5($key) . $cur_time);
        return $token;
    }

    /**
     * 创建目录
     * @param $path
     * @return array
     */
    public static function createDir($path) {
        //$path upload/image/welfare/1470887840975.jpg  前面不能还/ 不然保存不了
        if (empty($path)) {
            return array("status" => false, "msg" => "path不能为空");
        }
        //截取左边的/
        if (0 === strpos($path, '/')) {
            $path = substr($path, 1);
        }

        $filename = strrchr($path, '/');
        $pos = strpos($path, $filename);
        $end_pos = $pos + 1;
        $save_dir = substr($path, 0, $end_pos);
        if (0 !== strpos($save_dir, './')) {
            $save_dir = './' . $save_dir;
        }
        //创建保存目录
        if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
            return array("status" => false, "msg" => "创建保存目录失败");
        }
    }

    /**
     * 将图片转化成base64
     */
    public static function base64EncodeImage($image_file) {
        $base64_image = '';
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
        return $base64_image;
    }

    /**
     * 路径处理-用于团贷服务器path
     * $filename = "1471595715136678.jpg" ;
     * $filepatch = "/upload/image/welfare/20160819/1471595715136678.jpg" ;
     * 返回 "upload/image/welfare/20160819" ;
     */
    public static function pathDeal($filename, $filepath) {
        $search = "/" . $filename;
        if (0 === strpos($filepath, '/')) {
            $filepath = substr($filepath, 1);
        }
        $path = str_replace($search, '', $filepath);
        return $path;
    }

    /**
     * 同步图片到团贷的服务器-用于UEditor
     * $filename = "1471595715136678.jpg" ;
     * $fullname = "/upload/image/welfare/20160819/1471595715136678.jpg" ;
     * $file  $_FILE 原始的图片流
     */
    public static function syncImageToTuanDaiImageOnUe($filename, $fullname, $file) {
        $newTdService = TuanDaiService::getInstance();
        $td_image_path = self::pathDeal($filename, $fullname);
        $image_full_path = $newTdService->uploadFileUseOrigFile($file['tmp_name'], $file['size'], $filename, $td_image_path);
        return $image_full_path;
    }

    /**
     * 普通的同步图片到团贷的图片服务器
     * $filename = "1471595715136678.jpg" ;
     * $td_image_path = "news/welfare" ;
     * $upload_rs  Yii  UploadedFile实例
     */
    public static function syncImageToTuanDaiImage($filename, $td_image_path, $upload_rs) {
        $newTdService = TuanDaiService::getInstance();
        $image_full_path = $newTdService->uploadFile($upload_rs, $filename, $td_image_path);
        $on_line_image_domain = \Yii::$app->params['on_line_image_domain'];
        $image_domain = \Yii::$app->params['image_domain'];
        if (!empty($on_line_image_domain)) {
            //替换为外网的图片服务器的地址
            $image_full_path = str_replace($image_domain, $on_line_image_domain, $image_full_path);
        }
        return $image_full_path;
    }

    /**
     * 普通的同步图片到团贷的图片服务器
     * $filename = "1471595715136678.jpg" ;
     * $td_image_path = "news/welfare" ;
     * $upload_rs  Yii  UploadedFile实例
     */
    public static function syncThumbImageToTuanDaiImage($filename, $td_image_path, $real_file_path) {
        $newTdService = TuanDaiService::getInstance();
        $image_full_path = $newTdService->uploadFile($real_file_path, $filename, $td_image_path);
        $on_line_image_domain = \Yii::$app->params['on_line_image_domain'];
        $image_domain = \Yii::$app->params['image_domain'];
        if (!empty($on_line_image_domain)) {
            //替换为外网的图片服务器的地址
            $image_full_path = str_replace($image_domain, $on_line_image_domain, $image_full_path);
        }
        return $image_full_path;
    }

    //同步图片到本地的服务器
    public static function syncImageToLocalImage($imageName, $td_image_path, $upload_rs) {
        $filename = $upload_rs->name;
        $path = $upload_rs->tempName;
        $type = $upload_rs->type;
        $image_path = 'upload/image/' . $td_image_path . '/' . $imageName;
        self::createDir($image_path);

        $sync_url = Yii::$app->params['image_sync_url'];
        self::syncImage($sync_url, $filename, $path, $type, $image_path);
        move_uploaded_file($path, $image_path);//保存后台图片路径
        return $image_path;
    }

    //转化sql service时间
    public static function changeTimeToFormatTime($date_time) {
        $str_date_time = strtotime($date_time);
        $format_time = date("Y-m-d H:i:s", $str_date_time);
        return $format_time;
    }

    //压给html页面函数
    public static function compress_html($string) {

        return ltrim(rtrim(preg_replace(array("/> *([^ ]*) *</", "//", "'/\*[^*]*\*/'", "/\r\n/", "/\n/", "/\t/", '/>[ ]+</'), array(">\\1<", '', '', '', '', '', '><'), $string)));
    }

    /**
     * 同步图片到阿里云的图片服务器
     * $filename = "1471595715136678.jpg" ;
     * $td_image_path = "news/welfare" ;
     * $upload_rs  Yii  UploadedFile实例
     */
    public static function syncImageToAliyunImage($filename, $td_image_path, $upload_rs, $ue_tag = false) {
        if ($ue_tag == true) {
            $tmp_path = $upload_rs['tmp_name'];
        } else {
            $tmp_path = $upload_rs->tempName;
        }
        $base_name = $td_image_path . "/" . $filename;
        OssService::upload($base_name, $tmp_path, true);
        $real_path = OssService::getUrl($base_name);
        $real_path = urldecode($real_path);//返回的地址被urlencode,需要decode
        $aliyun_image_domail_replace = Yii::$app->params['aliyun_image_domail_replace'];
        if (!empty($aliyun_image_domail_replace)) {
            // $begin = strpos($real_path,".com/") ;
            // if(!empty($begin)){
            //     $begin = $begin + 3 ;
            //     $real_path = substr($real_path,$begin) ;
            //     $real_path = $aliyun_image_domail_replace.$real_path ;
            // }
            if (substr($base_name, 0, 1) == '/') {
                $real_path = $aliyun_image_domail_replace . $base_name;
            } else {
                $real_path = $aliyun_image_domail_replace . '/' . $base_name;
            }
        }
        return $real_path;
    }

    /**
     * $filename = "1471595715136678.jpg" ;
     * $td_image_path = "news/welfare" ;
     * $upload_rs  Yii  UploadedFile实例
     */
    public static function syncImageToService($filename, $td_image_path, $upload_rs) {
        $type = Yii::$app->params['image_service_type'];
        if($upload_rs->error == 1){
            Yii::$app->controller->redirect(["/tip/index","msg"=>"图片太大，尺寸大小不能超过1M"]) ;
            Yii::$app->end();
        }

        //压缩图片
        self::compress_image($upload_rs);
        // local,aliyun,tuandai_image
        switch ($type) {
            case "local" ://本地
                $image_path = self::syncImageToLocalImage($filename, $td_image_path, $upload_rs);
                $image_path = Yii::$app->params['local_image_domain'] . "/" . $image_path;
                break;
            case "tuandai_image" ://团贷图片服务器
                $image_path = self::syncImageToTuanDaiImage($filename, $td_image_path, $upload_rs);
                $image_path = empty($image_path) ? "" : $image_path;
                break;
            case "aliyun" ://阿里云
                $image_path = self::syncImageToAliyunImage($filename, $td_image_path, $upload_rs);
                break;
            default :
                //默认是到本地的服务器
                $image_path = self::syncImageToLocalImage($filename, $td_image_path, $upload_rs);
                break;
        }
        //删除本地压缩图片
        @unlink($upload_rs->tempName);
        return $image_path;
    }

    /**
     * 压缩图片
     * @param UploadedFile $file
     */
    public static function compress_image(UploadedFile &$file) {
        $thumb_size = empty(\Yii::$app->params['thumb_size']) ? 1000000 : \Yii::$app->params['thumb_size']; //图片超出大小，进行压缩
        $max_width = empty(\Yii::$app->params['thumb_width']) ? 900 : \Yii::$app->params['thumb_width']; //宽度最大分辨率，图片超出这个限定，就要进行压缩
        $quality = empty(\Yii::$app->params['thumb_quality']) ? 60 : \Yii::$app->params['thumb_quality']; //图片质量
        $original_img = getimagesize($file->tempName);
        $original_img_size = $file->size;
        //如果文件不是图像，不做压缩处理
        if ($original_img) {
            //$original_img_width 为原图宽度
            $original_img_width = $original_img[0];
            $original_img_height = $original_img[1];
            if ($original_img_width > $max_width && $thumb_size < $original_img_size) {
                //计算，进行等比例压缩
                $t_height = ($original_img_width - $max_width) / $original_img_width;
                $t_height = floatval(1 - $t_height);
                $t_height = round($t_height * $original_img_height);
                //创建临时保存文件
                $imageName = time() . rand(100, 999) . '.' . $file->extension;
                $td_image_path = \Yii::getAlias("@webroot") . '/upload/tmp/';
                if (!is_dir($td_image_path) && !mkdir($td_image_path, 0777, true)) {
                    //抛出异常
                    throw new NotFoundHttpException('创建目录失败' . $td_image_path);
                }
                //生成压缩图片
                Image::thumbnail($file->tempName, $max_width, $t_height)->save($td_image_path . $imageName, ['quality' => $quality]);
                $file->tempName = $td_image_path . $imageName;
            }
        }
    }

    /**
     * 记录调试日志
     * @param $var
     * @param string $category
     */
    public static function debug($var, $category = 'application'){
        $dump = VarDumper::dumpAsString($var);
        Yii::info($dump, $category);
    }

    /**
     * 记录信息日志
     * @param $var
     * @param string $category
     */
    public static function info($var, $category = 'application'){
        $dump = VarDumper::dumpAsString($var);
        Yii::info($dump, $category);
    }

    /**
     * 记录错误日志
     * @param $var
     * @param string $category
     */
    public static function error($var, $category = 'application'){
        $dump = VarDumper::dumpAsString($var);
        Yii::error($dump, $category);
    }

    /**
     * 记录警告日志
     * @param $var
     * @param string $category
     */
    public static function warning($var, $category = 'application'){
        $dump = VarDumper::dumpAsString($var);
        Yii::warning($dump, $category);
    }


}
