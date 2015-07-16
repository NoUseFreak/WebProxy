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
use AppBundle\Helper\QueueHelper;
use Clastic\NodeBundle\Event\NodeFormPersistEvent;
use Doctrine\Common\Collections\ArrayCollection;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class QueueListener implements EventSubscriberInterface
{
    /**
     * @var QueueHelper
     */
    private $queueHelper;

    /**
     * QueueListener constructor.
     * @param QueueHelper $queueHelper
     */
    public function __construct(QueueHelper $queueHelper)
    {
        $this->queueHelper = $queueHelper;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
          NodeFormPersistEvent::NODE_FORM_PERSIST => 'queue',
        ];
    }

    public function queue(NodeFormPersistEvent $event)
    {
        $this->queueHelper->queue('rebuild');
    }
}
