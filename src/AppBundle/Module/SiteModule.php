<?php

namespace AppBundle\Module;

use Clastic\NodeBundle\Module\NodeModuleInterface;

/**
 * Site
 */
class SiteModule implements NodeModuleInterface
{
    /**
     * The name of the module.
     *
     * @return string
     */
    public function getName()
    {
        return 'Site';
    }

    /**
     * The name of the module.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'site';
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return 'AppBundle:Site';
    }

    /**
     * @return string|bool
     */
    public function getDetailTemplate()
    {
        return 'AppBundle:Site:detail.html.twig';
    }
}
