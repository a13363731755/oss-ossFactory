<?php

namespace AliOss\OssFactory\src;

interface OssServiceInterface {

    public function config($config = []);

    public function upload($file, $fileName = '');

    public function download($file, $path, $type = 0);

}
