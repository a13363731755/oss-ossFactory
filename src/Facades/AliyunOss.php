<?php
namespace AliOss\OssFactory\Src\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * LaravelExcel Facade
 *
 * @category   Laravel Oss
 * @version    1.2.2
 * @package    oss/ossFactory
 */
class AliyunOss extends Facade {

    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'AliyunOssServer';
    }
}
