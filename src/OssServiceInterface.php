<?php

namespace AliOss\OssFactory\src;

interface OssServiceInterface {

    public function config($config = []);

    public function upload($file);

    public function download($file);

}
