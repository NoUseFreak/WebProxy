<?php

namespace AppBundle\Form\Module;

use AppBundle\EventListener\SiteNodeFormListener;
use AppBundle\Form\Type\SiteBackendType;
use AppBundle\Form\Type\SiteUrlType;
use Clastic\NodeBundle\Form\Extension\AbstractNodeTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * SiteTypeExtension
 */
class SiteFormExtension extends AbstractNodeTypeExtension
{
    /**
     * @var SiteNodeFormListener
     */
    private $siteFormListener;

    public function __construct(SiteNodeFormListener $listener)
    {
        $this->siteFormListener = $listener;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->getTabHelper($builder)
          ->findTab('general')
          ->add('description', 'textarea');

        $this->getTabHelper($builder)
          ->createTab('url_tab', 'Url', [
              'position' => 'first',
          ])
          ->add('urls', 'collection',[
            'type' => new SiteUrlType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'cascade_validation' => true,
          ]);

        $this->getTabHelper($builder)
          ->createTab('backend_tab', 'Backend', [
            'position' => 'first',
          ])
          ->add('backends', 'collection',[
            'type' => new SiteBackendType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'cascade_validation' => true,
          ]);

        $builder->addEventSubscriber($this->siteFormListener);
    }
}
