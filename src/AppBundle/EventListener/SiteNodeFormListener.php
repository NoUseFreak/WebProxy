<?php
/**
 * This file is part of the webproxy package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Site;
use Clastic\NodeBundle\Event\NodeFormPersistEvent;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class SiteNodeFormListener implements EventSubscriberInterface
{
    private $originalUrls;

    public function __construct()
    {
        $this->originalUrls = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
          FormEvents::PRE_SET_DATA => 'preSetData',
          NodeFormPersistEvent::NODE_FORM_PERSIST=> 'persist',
        ];
    }

    public function preSetData(FormEvent $event)
    {
        /** @var Site $site */
        $site = $event->getData();
        foreach ($site->getUrls() as $url) {
            $this->originalUrls->add($url);
        }
    }

    public function persist(NodeFormPersistEvent $event)
    {
        /** @var Site $site */
        $site = $event->getForm()->getData();

        foreach ($this->originalUrls as $url) {
            if (false === $site->getUrls()->contains($url)) {
                $event->getEntityManager()->remove($url);
            }
        }

        $event->getEntityManager()->flush();
    }
}
