<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel OSS Server Config
    |--------------------------------------------------------------------------
    |
    | Please enter your oss tickets
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Default OSS Config
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('OSS_CURRENT', 'Aliyun'),


    /**
     * 阿里雲OSS
     */
    'Aliyun' =>[
        'AccessKeyID' => '<yourAccessKeyId>',
        'AccessKeySecret' => '<yourAccessKeySecret>',
        'bucket' => '<yourBucketName>',
        'endpoint' => 'oss-cn-shanghai.aliyuncs.com',
    ],


    /**
     * 騰訊雲
     */
    'Tencent' =>[
        'AccessKeyID' => '<yourAccessKeyId>',
        'AccessKeySecret' => '<yourAccessKeySecret>',
        'bucket' => '<yourBucketName>',
        'endpoint' => '<yourEndpoint>',
    ],


    /**
     * 七牛雲
     */
    'Qiniu' =>[
        'AccessKeyID' => '<yourAccessKeyId>',
        'AccessKeySecret' => '<yourAccessKeySecret>',
        'bucket' => '<yourBucketName>',
        'endpoint' => '<yourEndpoint>',
    ]
];
