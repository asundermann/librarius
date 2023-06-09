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

    public function uploadImage($tmpImage,$directory,$randName)
    {
        $tmpImage->move($directory.'/'.$randName);
    }

    public function deleteImage($directory,$randName)
    {
        FileSystem::delete($directory.'/'.$randName);
    }

    public function updateImage($tmpImage,$directory,$deletionImageName,$randName)
    {
        $this->deleteImage($directory,$deletionImageName);
        $this->uploadImage($tmpImage,$directory,$randName);
    }

}
