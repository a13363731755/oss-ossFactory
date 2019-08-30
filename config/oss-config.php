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
