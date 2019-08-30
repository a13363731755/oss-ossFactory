# oss-ossFactory
the oss-factory is a aliyun/oss collection package


[![Latest Stable Version](https://poser.pugx.org/aliyuncs/oss-sdk-php/v/stable)](https://packagist.org/packages/aliyuncs/oss-sdk-php)
[![Build Status](https://travis-ci.org/aliyun/aliyun-oss-php-sdk.svg?branch=master)](https://travis-ci.org/aliyun/aliyun-oss-php-sdk)
[![Coverage Status](https://coveralls.io/repos/github/aliyun/aliyun-oss-php-sdk/badge.svg?branch=master)](https://coveralls.io/github/aliyun/aliyun-oss-php-sdk?branch=master)

## [README of Chinese](https://github.com/aliyun/aliyun-oss-php-sdk/blob/master/README-CN.md)

## Overview

Alibaba Cloud Object Storage Service (OSS) is a cloud storage service provided by Alibaba Cloud, featuring a massive capacity, security, a low cost, and high reliability. You can upload and download data on any application anytime and anywhere by calling APIs, and perform simple management of data through the web console. The OSS can store any type of files and therefore applies to various websites, development enterprises and developers.


## Run environment
- PHP 7.1+.
- cURL extension.

Tips:

- In Ubuntu, you can use the ***apt-get*** package manager to install the *PHP cURL extension*: `sudo apt-get install php7-curl`.

## Install OSS PHP SDK

- If you use the ***composer*** to manage project dependencies, run the following command in your project's root directory:

        composer require rsp/oss-factory

   You can also declare the dependency on Alibaba Cloud OSS SDK for PHP in the `composer.json` file.

        "require": {
            "rsp/oss-factory": "V1.2.1"
        }
        
    Finally, you will want to publish the config using the following command:
    
    Laravel 4:
    
        $ php artisan config:publish rsp/oss-factory
            
    Laravel 5:

        $ php artisan vendor:publish --provider="AliOss\OssFactory\Src\OssServiceProvider"
    
    




## Quick use

### Common classes

| Class | Explanation |
|:------------------|:------------------------------------|
|AliOss\OssFactory\Src\OssService | OSS client class. An OSSClient instance can be used to call the interface.  |
|Src\Exceptions\ServerDisposeException |OSS Exception class . You only need to pay attention to this exception when you use the OSSClient. |

### Initialize an OSSClient

The SDK's operations for the OSS are performed through the OSSClient class. The code below creates an OSSClient object:

```php
<?php
$accessKeyId = "<AccessKeyID that you obtain from OSS>";
$accessKeySecret = "<AccessKeySecret that you obtain from OSS>";
$endpoint = "<Domain that you select to access an OSS data center, such as "oss-cn-hangzhou.aliyuncs.com>";
try {
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
} catch (OssException $e) {
    print $e->getMessage();
}


or...

$file = public_path('test.png');
dd(OssFace::config([])->upload($file));
```

### Operations on objects

Objects are the most basic data units on the OSS. You can simply consider objects as files. The following code uploads an object:



## License

- MIT

## Contact us

- [Alibaba Cloud OSS official website](http://oss.aliyun.com).
- [Alibaba Cloud OSS official forum](http://bbs.aliyun.com).
- [Alibaba Cloud OSS official documentation center](http://www.aliyun.com/product/oss#Docs).
- Alibaba Cloud official technical support: [Submit a ticket](https://workorder.console.aliyun.com/#/ticket/createIndex).

[releases-page]: https://github.com/aliyun/aliyun-oss-php-sdk/releases
[phar-composer]: https://github.com/clue/phar-composer

