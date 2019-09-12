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
 *
 * @method static array listBuckets()
 * @method static $this config()
 * @method static \OSS\OssClient getHttpClient()
 * @method static string upload()
 * @method static string getFileName()
 * @method static string download()
 * @method static string createBucket(string $bucket, int $ossType = 0, int $ossStorage = 0)
 * @method static bool isExistBucket(string $bucket)
 * @method static |null deleteBucket(string $bucket)
 * @method static bool doesObjectExist(string $object)
 * @method static |null setFileAcl(string $object, int $acl = 0)
 * @method static string getFileAcl(string $object)
 * @method static array listAllFileOfBucket(array $options = [])
 * @method static string signUrl(string $object, int $timeout)
 *
 */
class OssFace extends Facade {

    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'OssServer';
    }
}
