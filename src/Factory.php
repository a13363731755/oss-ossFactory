<?php

/*
 * This file is part of oss.
 *
 * (c)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AliOss\OssFactory\Src;


class Factory
{
    protected $type;

    protected $config;

    protected $server;

    /**
     * 默认阿里云
     * Factory constructor.
     * @param string $oss
     * @param array $config
     */
    public function __construct($oss = '', $config = [])
    {
        $this->type = $oss ? $oss : config('oss-config.default');
        $this->config = $config ? $config : config('oss-config.' . $this->type);

        $className = __NAMESPACE__ . '\\' . $this->type . 'OssService';

        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Missing format class.');
        }

        $this->Server =  new $className();
    }

    /**
     * 可配置
     * @param array $config
     * @return mixed
     * @throws \Exception
     */
    public function config($config = [])
    {
        if (empty($config['AccessKeyID']) || empty($config['AccessKeySecret']) || empty($config['bucket']) || empty($config['endpoint'])) {
            throw new \Exception('配置文件缺失');
        }
        $this->config = $config;
        return $this->server;
    }

    public function upload($file)
    {
        return $this->server->config($this->config)->upload($file);
    }

    public function download()
    {
        return ;
    }

}
