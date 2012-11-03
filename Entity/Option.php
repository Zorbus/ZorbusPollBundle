<?php

namespace Zorbus\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PollBundle\Entity\Option
 */
class Option extends Base\Option
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $option
     */
    private $answer;

    /**
     * @var string $image
     */
    private $image;

    /**
     * @var boolean $enabled
     */
    private $enabled;

    /**
     * @var integer $position
     */
    private $position;

    /**
     * @var \DateTime $created_at
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     */
    private $updated_at;

    /**
     * @var Zorbus\PollBundle\Entity\Poll
     */
    private $poll;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set option
     *
     * @param string $option
     * @return Option
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get option
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Option
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Option
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Option
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Option
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Option
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set poll
     *
     * @param Zorbus\PollBundle\Entity\Poll $poll
     * @return Option
     */
    public function setPoll(\Zorbus\PollBundle\Entity\Poll $poll = null)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return Zorbus\PollBundle\Entity\Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }
    /**
     * @ORM\PrePersist
     */
    public function preImageUpload()
    {
        if (null !== $this->imageTemp)
        {
            $this->image = sha1(uniqid(mt_rand(), true)) . '.' . $this->imageTemp->guessExtension();
        }
    }

    /**
     * @ORM\PostRemove
     */
    public function postRemove()
    {
        if ($file = $this->getAbsolutePath($this->image))
        {
            @unlink($file);
        }
    }

    /**
     * @ORM\PostPersist
     */
    public function postImageUpload()
    {
        if ($this->imageTemp instanceof \Symfony\Component\HttpFoundation\File\UploadedFile)
        {
            $this->imageTemp->move($this->getUploadRootDir(), $this->image);

            unset($this->imageTemp);
        }
    }
}