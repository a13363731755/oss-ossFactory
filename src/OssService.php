<?php

namespace AliOss\OssFactory\Src;

use OSS\OssClient;
use AliOss\OssFactory\Src\Exception\InvalidParamException;
use AliOss\OssFactory\Src\Exception\ServerDisposeException;

class OssService implements OssServiceInterface
{

    protected $config;

    /**
     * 配置項初始化
     * @param array $config
     * @return $this
     */
    public function config(array $config = [])
    {
        if (empty($config['accessKeyId']) || empty($config['accessKeySecret']) || empty($config['bucket']) || empty($config['endpoint'])) {
            $config['accessKeyId'] = config('oss.AccessKeyID');
            $config['accessKeySecret'] = config('oss.AXDKKReJDiWQcx2WvUok3EjUOGIgKK');
            $config['bucket'] = config('oss.bucket');
            $config['endpoint'] = config('oss.endpoint');
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
        return new OssClient($this->config['accessKeyId'], $this->config['accessKeySecret'], $this->config['endpoint']);
    }

    /**
     * 執行上傳
     * @param string $file
     * @param string $service
     * @return string
     * @throws InvalidParamException
     * @throws ServerDisposeException
     */
    public function upload(string $file, string $service='oss'): string
    {
        if (!is_string($file) || !is_file($file)) {
            throw new InvalidParamException('invalid file param');
        }
        if (!in_array($service, ['oss', 'local'])) {
            throw new ServerDisposeException('service dones not exists' . $service);
        }
        try {
            $res = $this->getHttpClient()->uploadFile($this->config['bucket'], $this->getFileName($file), $file);
            return $res['oss-request-url'];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 随机文件名
     * @param string $file
     * @return string
     */
    public function getFileName(string $file): string
    {
        $extension = substr($file, strrpos($file, '.'));
        return md5($file) . time() . $extension;
    }

    public function download(string $file)
    {
        
    }
}
