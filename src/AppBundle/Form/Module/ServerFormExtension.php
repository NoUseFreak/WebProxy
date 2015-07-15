<?php

namespace AppBundle\Form\Module;

use AppBundle\Form\Type\KeyValueType;
use Clastic\NodeBundle\Form\Extension\AbstractNodeTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ServerTypeExtension
 */
class ServerFormExtension extends AbstractNodeTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->getTabHelper($builder)
          ->findTab('general')
          ->add('url', 'text', ['label' => 'Url'])
          ->add('options', 'collection', [
            'label' => 'Options',
            'type' => new KeyValueType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'cascade_validation' => true,
          ]);
    }
}
