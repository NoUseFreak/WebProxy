<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // Standard symfony
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // Clastic Bundles
            new Clastic\CoreBundle\ClasticCoreBundle(),
                new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Clastic\BackofficeBundle\ClasticBackofficeBundle(),
                new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
                new WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle(),
                new Ivory\OrderedFormBundle\IvoryOrderedFormBundle(),
            new Clastic\UserBundle\ClasticUserBundle(),
                new FOS\UserBundle\FOSUserBundle(),
            new Clastic\NodeBundle\ClasticNodeBundle(),
            new Clastic\SecurityBundle\ClasticSecurityBundle(),

            // Your project
            new AppBundle\AppBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Clastic\GeneratorBundle\ClasticGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
