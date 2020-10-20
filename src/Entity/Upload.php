<?php

namespace App\Entity;

class Upload
{

    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(string $file) {
        $this->filename=$file;
    }
}
