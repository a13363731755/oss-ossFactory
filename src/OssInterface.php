<?php

namespace Oss\OssFactory\src;

interface OssInterface {

    public function config(array $config = []);

    public function upload(string $file);

    public function download(string $file);

}
