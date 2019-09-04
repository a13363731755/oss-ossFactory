<?php

namespace AliOss\OssFactory\Src;

use OSS\Core\OssException;
use OSS\Http\RequestCore;
use OSS\Http\ResponseCore;
use OSS\OssClient;
use AliOss\OssFactory\Src\Exceptions\InvalidParamException;
use AliOss\OssFactory\Src\Exceptions\ServerDisposeException;

class AliyunOssService implements OssServiceInterface
{

    protected $config;

    //存储空间的权限
    protected $ossType = [
        OssClient::OSS_ACL_TYPE_PUBLIC_READ_WRITE, //公共读写
        OssClient::OSS_ACL_TYPE_PUBLIC_READ, //公共读
        OssClient::OSS_ACL_TYPE_PRIVATE, //私有
    ];

    //存储类型
    protected $ossStorage = [
        OssClient::OSS_STORAGE_STANDARD, //标准存储类型
        OssClient::OSS_STORAGE_IA, //低频访问存储类型（Infrequent Access）
        OssClient::OSS_STORAGE_ARCHIVE, //归档存储类型（Archive）
    ];

    //文件权限
    protected $ossAcl = [
        'private',
        'public-read',
        'public-read-write'
    ];

    /**
     * 配置項初始化
     * @param array $config
     * @return $this
     */
    public function config($config = [])
    {
        if (empty($config['AccessKeyID']) || empty($config['AccessKeySecret']) || empty($config['bucket']) || empty($config['endpoint'])) {
            $config['AccessKeyID'] = config('oss-config.Aliyun.AccessKeyID');
            $config['AccessKeySecret'] = config('oss-config.Aliyun.AccessKeySecret');
            $config['bucket'] = config('oss-config.Aliyun.bucket');
            $config['endpoint'] = config('oss-config.Aliyun.endpoint');
        }
        $this->config = $config;
        return $this;
    }

    /**
     * OSS服务
     * @return OssClient
     * @throws \OSS\Core\OssException
     */
    public function getHttpClient()
    {
        if (empty($this->config)) {
            $this->config();
        }
        return new OssClient($this->config['AccessKeyID'], $this->config['AccessKeySecret'], $this->config['endpoint']);
    }

    /**
     * 執行上傳
     * @param string $file
     * @param string $fileName
     * @return string
     * @throws InvalidParamException
     * @throws ServerDisposeException
     */
    public function upload($file, $fileName = '')
    {
        if (!is_string($file) || !is_file($file)) {
            throw new InvalidParamException('invalid file param');
        }
        try {
            if(!$fileName){
                $fileName = $this->parseFile($file);
            }
            if(!$this->doesObjectExist($fileName)){
                $res = $this->getHttpClient()->uploadFile($this->config['bucket'], $fileName, $file);
                return $res['oss-request-url'];
            }
            throw new OssException('该文件已存在');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 随机文件名
     * @param string $file
     * @return string
     */
    public function getFileName($file)
    {
        $extension = substr($file, strrpos($file, '.'));
        return md5($file) . time() . $extension;
    }

    /**
     * 下载到本地/缓存
     * @param $file
     * @param $type
     * @param $path
     * @return string
     * @throws OssException
     */
    public function download($file, $path, $type = 0)
    {
        $options = array(
            OssClient::OSS_FILE_DOWNLOAD => $path,
        );
        try {
            if ($type == 1) {
               return $this->getHttpClient()->getObject($this->config['bucket'], $file, $options);
            } elseif($type == 2) {
                $res = $this->getHttpClient()->getObject($this->config['bucket'], $file);
                header("Content-type:application/octet-stream");
                header("Content-Disposition: attachment; filename=".$file);
                print($res);
            } else {
                $res = $this->getHttpClient()->getObject($this->config['bucket'], $file);
                header('Content-type: application/pdf');
                print($res);
            }

        } catch (OssException $e) {
            throw new OssException($e->getMessage());
        }
    }

    /**
     * 创建存储空间
     * @param $bucket
     * @param int $ossType
     * @param int $ossStorage
     * @return void|null
     * @throws InvalidParamException
     * @throws \OSS\Core\OssException
     */
    public function createBucket($bucket, $ossType = 0, $ossStorage = 0)
    {
        if (empty($bucket) && !is_string($bucket)) {
            throw new InvalidParamException('invalid bucket name param');
        }
        if (!in_array($ossType, [0, 1, 2]) && !in_array($ossStorage, [0, 1, 2])) {
            throw new InvalidParamException('invalid ossStorage param');
        }
        try {
            // 设置存储空间的存储类型为低频访问类型，默认是标准类型。
            $options = array(
                OssClient::OSS_STORAGE => $this->ossStorage[$ossStorage]
            );
            // 设置存储空间的权限为公共读，默认是私有读写。
            if ($this->isExistBucket($bucket)) {
                $ret = $this->getHttpClient()->createBucket($bucket, $this->ossType[$ossType], $options);
                return $ret['info']['url'];
            }
            throw new OssException('该存储空间名称已被占用');
        } catch (OssException $e) {
            throw new OssException($e->getMessage());
        }
    }

    /**
     * 判断存储空间是否存在
     * @param $bucket
     * @return bool
     */
    public function isExistBucket($bucket)
    {
        try {
            return $this->getHttpClient()->doesBucketExist($bucket);
        } catch (OssException $e) {
            return false;
        }
    }

    /**
     * 删除空间
     * @param $bucket
     * @return |null
     * @throws OssException
     */
    public function deleteBucket($bucket)
    {
        try {
            return $this->getHttpClient()->deleteBucket($bucket);
        } catch (OssException $e) {
            throw new OssException($e->getMessage());
        }
    }

    /**
     * 判断文件是否存在
     * @param $object
     * @return bool
     * @throws OssException
     */
    public function doesObjectExist($object)
    {
        try{
            return $this->getHttpClient()->doesObjectExist($this->config['bucket'], $object);
        } catch(OssException $e) {
            throw new OssException($e->getMessage());
        }
    }

    /**
     * 设置文件权限
     * @param $object
     * @param $acl
     * @return |null
     * @throws OssException
     */
    public function setFileAcl($object, $acl = 0)
    {
        try {
            return $this->getHttpClient()->putObjectAcl($this->config['bucket'], $object, $this->ossAcl[$acl]);
        } catch (OssException $e) {
            throw new OssException($e->getMessage());
        }
    }

    /**
     * 获取文件权限
     * @param $object
     * @return string
     * @throws OssException
     */
    public function getFileAcl($object)
    {
        try {
            return $this->getHttpClient()->getObjectAcl($this->config['bucket'], $object);
        } catch (OssException $e) {
            throw new OssException($e->getMessage());
        }
    }

    /**
     * 获取所有文件及目录
     * @param array $options
     * @return array
     * @throws OssException
     */
    public function listAllFileOfBucket($options = [])
    {
        $objectLists = $prefixLists = [];
        try {
            $listObjectInfo = $this->getHttpClient()->listObjects($this->config['bucket'], $options);
        } catch (OssException $e) {
            throw new OssException($e->getMessage());
        }
        $objectList = $listObjectInfo->getObjectList(); // object list
        $prefixList = $listObjectInfo->getPrefixList(); // directory list
        if (!empty($objectList)) {
            foreach ($objectList as $objectInfo) {
                $objectLists[] = $objectInfo->getKey();
            }
        }
        if (!empty($prefixList)) {
            foreach ($prefixList as $prefixInfo) {
                $prefixLists[] = $prefixInfo->getPrefix();
            }
        }
        return compact('objectLists','prefixLists');
    }


    /**
     * 解析文件路径
     * @param $file
     * @return mixed
     */
    private function parseFile($file)
    {
        $paseFile = pathinfo($file);
        return $paseFile['basename'];
    }

    /**
     * 授权临时访问url
     * @param $object
     * @param $timeout
     * @return string
     * @throws OssException
     */
    public function signUrl($object, $timeout)
    {
        try {
            // 生成GetObject的签名URL。
            return $this->getHttpClient()->signUrl($this->config['bucket'], $object, $timeout);
        } catch (OssException $e) {
            throw new OssException($e->getMessage());
        }
    }
}
