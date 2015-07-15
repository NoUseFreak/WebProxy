<?php

namespace AppBundle\Entity;

use Clastic\NodeBundle\Node\NodeReferenceInterface;
use Clastic\NodeBundle\Node\NodeReferenceTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 */
class Site implements NodeReferenceInterface
{
    use NodeReferenceTrait;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ArrayCollection
     */
    private $urls;

    /**
     * @var Upstream
     */
    private $upstream;

    public function __construct()
    {
        $this->urls     = new ArrayCollection();
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function addUrl(SiteUrl $url)
    {
        $url->setSite($this);

        $this->urls->add($url);
    }

    public function removeUrl(SiteUrl $url)
    {
        $this->urls->removeElement($url);
    }

    /**
     * @return ArrayCollection
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @return Upstream
     */
    public function getUpstream()
    {
        return $this->upstream;
    }

    /**
     * @param Upstream $upstream
     */
    public function setUpstream($upstream)
    {
        $this->upstream = $upstream;
    }

    /**
     * @param SiteUrl[] $urls
     */
    public function setUrls($urls)
    {
        $this->urls = $urls;
    }
}
