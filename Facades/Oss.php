<?php
namespace Oss\OssFactory\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * LaravelExcel Facade
 *
 * @category   Laravel Oss
 * @version    1.0.0
 * @package    oss/ossFactory
 */
class Oss extends Facade {

    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Oss\OssFactory\Oss::class;
    }
}
