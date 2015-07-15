<?php

namespace AppBundle\Form\Module;

use AppBundle\Form\Type\ServerType;
use Clastic\NodeBundle\Form\Extension\AbstractNodeTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * UpstreamTypeExtension
 */
class UpstreamFormExtension extends AbstractNodeTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->getTabHelper($builder)
            ->findTab('general')
            ->add('servers', 'collection', [
              'type' => new ServerType(),
              'allow_add' => true,
              'allow_delete' => true,
              'by_reference' => false,
              'cascade_validation' => true,
            ]);
    }
}
