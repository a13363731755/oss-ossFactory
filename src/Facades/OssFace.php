<?php
namespace AliOss\OssFactory\Src\Facades;

use AliOss\OssFactory\Src\OssService;
use Illuminate\Support\Facades\Facade;

/**
 *
 * LaravelExcel Facade
 *
 * @category   Laravel Oss
 * @version    1.0.0
 * @package    oss/ossFactory
 */
class OssFace extends Facade {

    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return OssService::class;
    }
}
