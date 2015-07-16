<?php
/**
 * This file is part of the webproxy package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Command;

use AppBundle\Generator\ConfigWriter;
use AppBundle\Generator\ProxyGenerator;
use AppBundle\Generator\UpstreamGenerator;
use AppBundle\Helper\QueueHelper;
use Doctrine\ORM\Proxy\Proxy;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class WorkerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
          ->setName('worker')
          ->setDescription('Do the background work')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = $this->getProxyGenerator();

        $this->getQueueHelper()->worker(function(AMQPMessage $message) use ($generator, $output) {
            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
            if ($message->body == 'rebuild') {
                $generator->generate($output);
            }
        });

        $this->getQueueHelper()->wait();
    }

    /**
     * @return QueueHelper
     */
    private function getQueueHelper()
    {
        return $this->getContainer()->get('app_bundle.helper.queue');
    }

    /**
     * @return ProxyGenerator
     */
    private function getProxyGenerator()
    {
        return $this->getContainer()->get('app_bundle.proxy_generator');
    }
}