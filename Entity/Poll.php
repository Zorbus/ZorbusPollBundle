<?php

namespace Zorbus\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\PollBundle\Entity\Poll
 */
class Poll extends Base\Poll
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $question
     */
    private $question;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var string $lang
     */
    private $lang;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var boolean $enabled
     */
    private $enabled;

    /**
     * @var \DateTime $created_at
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     */
    private $updated_at;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $options;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set question
     *
     * @param string $question
     * @return Poll
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Poll
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return Poll
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Poll
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Poll
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Poll
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
     * @return Poll
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
     * Add options
     *
     * @param Zorbus\PollBundle\Entity\Option $options
     * @return Poll
     */
    public function addOption(\Zorbus\PollBundle\Entity\Option $options)
    {
        $this->options[] = $options;

        return $this;
    }

    /**
     * Remove options
     *
     * @param Zorbus\PollBundle\Entity\Option $options
     */
    public function removeOption(\Zorbus\PollBundle\Entity\Option $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getOptions()
    {
        return $this->options;
    }
    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $token
     */
    private $token;


    /**
     * Set title
     *
     * @param string $title
     * @return Poll
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Poll
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
    /**
     * @ORM\PrePersist
     */
    public function addToken()
    {
        $this->setToken(md5(time().$this->getTitle()));
    }
    /**
     * @var integer $votes
     */
    private $votes;


    /**
     * Set votes
     *
     * @param integer $votes
     * @return Poll
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    
        return $this;
    }

    /**
     * Get votes
     *
     * @return integer 
     */
    public function getVotes()
    {
        return $this->votes;
    }
}