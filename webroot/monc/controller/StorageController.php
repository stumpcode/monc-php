<?php


/**
 * Created by IntelliJ IDEA.
 * User: apple
 * Date: 14/12/8
 * Time: 上午8:59
 */
class StorageController extends MController {

    function test() {

        $fileKey = $this->get('key');

        $storage = Alibaba::Storage();

        if (!$storage->fileExists($fileKey)) {
            throw new MHttpException(404);
        }

        $meta = $storage->getMeta($fileKey);
        if (!$meta['content-length']) {
            throw new MHttpException('file size is 0 or file not found');
        }

        $tmpFile = MONC . 'tmp' . DS . $fileKey;


        // 不存在，锁住下载

        if (!$storage->get($fileKey, $tmpFile)) {
            throw new Exception('fail to get file from[' . $fileKey . ']
                to [' . $tmpFile . ']');
        }

        header("Content-type: " . $meta['content-type']);
        header('Content-Disposition: attachment; filename="' . basename($fileKey) . '"');
        header("Content-Length: " . $meta['content-length']);

        echo readfile($tmpFile);
    }

    function remove() {
        $fileKey = $this->get('key');
        $tmpFile = MONC . 'tmp' . $fileKey;
        unlink($tmpFile);
    }

    function upload() {

        if (!$this->isPost()) {
            throw new CHttpException(412);
        }

        $storage = Alibaba::Storage();

        if (!empty($_FILES)) {
            foreach ($_FILES as $fileData) {

                $file = array ();

                $name = $fileData['name'];
                $tmpPath = $fileData['tmp_name'];
                $fileType = $fileData['type'];
                $size = $fileData['size'];

                $type = $this->get('type');
                switch ($type) {
                    case 'image':
                        $ext = substr($name, strrpos($name, '.') + 1);
                        break;
                    default:
                        $ext = substr($name, strrpos($name, '.') + 1);
                        break;
                }

                $uuid = Helper::uuid();

                $fileKey = "$uuid.$ext";

                if (!$storage->saveFile($fileKey, $tmpPath)) {
                    $this->renderCode(1, 'fail to upload to oss');
                }

                //if (!$meta = $storage->getMeta($fileKey)) {
                //    $this->renderCode(1, 'fail to get meta from oss');
                //}

                $file = array_merge($file, array (
                    'name' => $name,
                    'type' => $fileType,
                    //'content-type' => $meta['content-type'],
                    //'content-length' => $meta['content-length'],
                    'size' => $size,
                    'fileKey' => $fileKey,
                ));

                $this->renderCode(0, '', array ('file' => $file));
            }
        }
        $this->renderCode(1, 'no files');

    }

    function down() {

        $fileKey = $this->get('key');

        $storage = Alibaba::Storage();

        if (!$storage->fileExists($fileKey)) {
            throw new MHttpException(404);
        }

        $meta = $storage->getMeta($fileKey);
        if (!$meta['content-length']) {
            throw new MHttpException('file size is 0 or file not found');
        }

        $tmpFile = MONC . 'tmp' . DS . $fileKey;


        // 不存在，锁住下载

        if (!$storage->get($fileKey, $tmpFile)) {
            throw new Exception('fail to get file from[' . $fileKey . ']
                to [' . $tmpFile . ']');
        }

        header("Content-type: " . $meta['content-type']);
        header('Content-Disposition: attachment; filename="' . basename($fileKey) . '"');
        header("Content-Length: " . $meta['content-length']);

        echo readfile($tmpFile);
    }
} 
