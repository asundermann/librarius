<?php

namespace App\services;

use Nette,
    Nette\Utils\FileSystem,
    Nette\Utils\Image,
    Nette\Http\FileUpload;

class ImageService
{
    public function getRandomName(string $fileName): string
    {
        $ext = explode('.', $fileName);
        $ext = '.' . $ext[count($ext) - 1];
        return md5(time() . rand()) . $ext;
    }

    public function uploadImage($image,$directory,$randName)
    {
        $image->move($directory.'/'.$randName);
    }
}
