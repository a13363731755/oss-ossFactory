<?php

namespace AliOss\OssFactory\src;

interface OssServiceInterface {

    public function config(array $config = []);

    public function upload(string $file);

    public function download(string $file);

}
