<?php

namespace Zorbus\PollBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PollBundle\Entity\Poll
 */
abstract class Poll
{
    public function __toString()
    {
        return $this->getTitle();
    }
}
