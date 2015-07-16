<?php
/**
 * This file is part of the webproxy package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Generator;

use AppBundle\Entity\Server;
use AppBundle\Entity\UpstreamRepository;
use RomanPitak\Nginx\Config\Directive;
use RomanPitak\Nginx\Config\Scope;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class UpstreamGenerator
{
    private $upstreamRepository;

    /**
     * @var ConfigWriter
     */
    private $writer;

    public function __construct(
      UpstreamRepository $upstreamRepository,
      ConfigWriter $writer
    ) {
        $this->upstreamRepository = $upstreamRepository;
        $this->writer             = $writer;
    }

    public function generate()
    {
        $upstreams = $this->upstreamRepository->findAllEnabled();

        foreach ($upstreams as $upstream) {
            $serverScope = Scope::create();

            foreach ($upstream->getServers() as $server) {
                /** @var Server $server */
                $serverScope->addDirective(Directive::create('server', $server->getUrl()));
            }
            $config = Directive::create('upstream', $this->transformString($upstream->getNode()->getTitle()))
                ->setChildScope($serverScope);

            $this->writer->write('upstream', $upstream->getNode()->getTitle(), (string)$config);
        }
    }

    private function transformString($string)
    {
        return preg_replace('/\+/', '_', urlencode($string));
    }
}
