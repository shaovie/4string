<?php
/**
 * @Author shaowei
 * @Date   2015-10-11
 */

namespace src\common;

class Upload
{
    private $fileField;
    private $saveDir;
    private $fileName;
    private $fullFileName;
    private $maxSize;
    private $base64;
    private $allowTypes = array();
    private $errDesc = '';
    private $errInfo = array(
        'OK',
        '文件大小超出 upload_max_filesize 限制',
        '文件大小超出 MAX_FILE_SIZE 限制',
        '文件未被完整上传',
        '没有文件被上传',
        '上传文件为空',
        'PARAM' => 'POST数据格式错误',
        'POST' => '文件大小超出 post_maxSize 限制',
        'SIZE' => '文件大小超出网站限制',
        'TYPE' => '不允许的文件类型',
        'DIR'  => '目录创建失败',
        'IO'   => '输入输出错误',
        'UNKNOWN' => '未知错误',
        'MOVE' => '文件保存时出错',
        'DIR_ERROR' => '创建目录失败',
    );

    function __construct($field, // $_FILES['xxx']
        $saveDir, //
        $maxSize, // bytes
        $allowTypes, // array('.mp4', '.jpg', '.jpeg', '.png'),
        $base64 = false
    ) {
        $this->fileField = $field;
        $this->saveDir = $saveDir;
        $this->maxSize = $maxSize;
        $this->allowTypes = $allowTypes;
        $this->base64 = $base64;
    }
    private function getErr($err)
    {
        if (!array_key_exists($err, $this->errInfo)) {
            $err = 'UNKNOWN';
        }
        return $this->errInfo[$err];
    }

    private function base64ToImage($content, $ext)
    {
        if (!in_array($ext, $this->allowTypes)) {
            $this->errDesc = $this->getErr('TYPE');
            return false;
        }
        $img = base64_decode($content);
        if (strlen($img) > $this->maxSize) {
            $this->errDesc = $this->getErr('SIZE');
            return false;
        }
        if (!file_exists($this->saveDir)) {
            if (!mkdir($this->saveDir, 0777, true)) {
                $this->errDesc = $this->getErr('DIR_ERROR');
                return false;
            }
        }
        $this->fileName = md5(microtime(true) . mt_rand(1, 9999999)) . $ext;
        $this->fullFileName = $this->saveDir . '/' . $this->fileName;
        if (!file_put_contents($this->fullFileName , $img)) {
            $this->errDesc = $this->getErr('IO');
            return false;
        }
        return true;
    }

    //=
    public function error()
    {
        return $this->errDesc;
    }

    public function fileName()
    {
        return $this->fileName;
    }

    public function fullFileName()
    {
        return $this->fullFileName;
    }

    public function fileSize()
    {
        return $this->fileField['size'];
    }

    public function up()
    {
        if (empty($this->fileField)) {
            $this->errDesc = $this->getErr('PARAM');
            return false;
        }
        if ($this->fileField['error']) {
            $this->errDesc = $this->getErr($this->fileField['error']);
            return false;
        }
        if ($this->fileField['size'] > $this->maxSize) {
            $this->errDesc = $this->getErr('SIZE');
            return false;
        }
        if (!is_uploaded_file($this->fileField['tmp_name'])) {
            $this->errDesc = $this->getErr('UNKNOWN');
            return false;
        }
        $ext = strtolower(strrchr($this->fileField['name'], '.'));
        if (!in_array($ext, $this->allowTypes)) {
            $this->errDesc = $this->getErr('TYPE');
            return false;
        }
        if (!file_exists($this->saveDir)) {
            if (!mkdir($this->saveDir, 0777, true)) {
                $this->errDesc = $this->getErr('DIR_ERROR');
                return false;
            }
        }
        $this->fileName = md5(microtime(true) . mt_rand(1, 9999999)) . $ext;
        $this->fullFileName = $this->saveDir . '/' . $this->fileName;
        if (!move_uploaded_file($this->fileField['tmp_name'],
                $this->fullFileName)) {
            $this->errDesc = $this->getErr('MOVE');
            return false;
        }
        return true;
    }

    public function upBase64Image($content, $mime)
    {
        if (empty($content)) {
            $this->errDesc = $this->getErr(5);
            return false;
        }
        $ext = explode('/', $mime);
        if (!isset($ext[1])) {
            $this->errDesc = $this->getErr('TYPE');
            return false;
        }
        $ext = '.' . $ext[1];
        if (!in_array($ext, $this->allowTypes)) {
            $this->errDesc = $this->getErr('TYPE');
            return false;
        }
        return $this->base64ToImage($content, $ext);
    }
}

