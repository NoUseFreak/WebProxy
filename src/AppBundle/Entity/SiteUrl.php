<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SiteUrl
 */
class SiteUrl
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var Site
     */
    private $site;

    /**
     * @var string
     */
    private $url;


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
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return SiteUrl
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
