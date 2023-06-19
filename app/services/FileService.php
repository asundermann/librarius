<?php

namespace App\services;

use Nette,
    Nette\Utils\FileSystem,
    Nette\Utils\Image,
    Nette\Http\FileUpload;

class FileService
{
    public function getRandomName(string $fileName): string
    {
        $ext = explode('.', $fileName);
        $ext = '.' . $ext[count($ext) - 1];
        return md5(time() . rand()) . $ext;
    }

    public function upload($tmp,$directory,$randName)
    {
        $tmp->move($directory.'/'.$randName);
    }

    public function delete($directory,$randName)
    {
        FileSystem::delete($directory.'/'.$randName);
    }

    public function update($tmpImage,$directory,$deletionName,$randName)
    {
        $this->delete($directory,$deletionName);
        $this->upload($tmpImage,$directory,$randName);
    }

}
