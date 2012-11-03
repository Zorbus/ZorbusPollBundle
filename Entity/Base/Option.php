<?php

namespace Zorbus\PollBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PollBundle\Entity\Option
 */
abstract class Option
{
    protected $imageTemp;

    public function __toString()
    {
        return strip_tags($this->getAnswer());
    }

    public function getImageTemp()
    {
        return $this->imageTemp;
    }

    public function setImageTemp($image)
    {
        $this->imageTemp = $image;
    }

    public function getAbsolutePath($file)
    {
        return null === $file ? null : $this->getUploadRootDir() . '/' . $file;
    }

    public function getWebPath($file)
    {
        return null === $file ? null : $this->getUploadDir() . '/' . $file;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/poll';
    }
}
