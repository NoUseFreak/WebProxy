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
use AppBundle\Entity\Site;
use AppBundle\Entity\SiteRepository;
use AppBundle\Entity\SiteUrl;
use AppBundle\Entity\UpstreamRepository;
use RomanPitak\Nginx\Config\Directive;
use RomanPitak\Nginx\Config\Scope;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class VhostGenerator
{
    private $siteRepository;

    /**
     * @var ConfigWriter
     */
    private $writer;

    public function __construct(
      SiteRepository $siteRepository,
      ConfigWriter $writer
    ) {
        $this->siteRepository = $siteRepository;
        $this->writer         = $writer;
    }

    public function generate()
    {
        $sites = $this->siteRepository->findAllEnabled();

        foreach ($sites as $site) {
            /** @var Site $site */
            if (!$site->getUrls()->count()) {
                //TODO log
                continue;
            }

            $urls = array_map(function(SiteUrl $url) {
                return $url->getUrl();
            }, $site->getUrls()->toArray());

            $config = Directive::create('server')
              ->setChildScope(Scope::create()
                ->addDirective(Directive::create('listen', 80))
                ->addDirective(Directive::create('server_name', implode(' ', $urls)))
                ->addDirective(Directive::create('location', '/', Scope::create()
                  ->addDirective(Directive::create(
                    'proxy_pass',
                    'http://'.$this->transformString($site->getUpstream()->getNode()->getTitle()))
                  )
                )
              )
            );

            $this->writer->write('vhost', $site->getNode()->getTitle(), (string)$config);
        }
    }

    private function transformString($string)
    {
        return preg_replace('/\+/', '_', urlencode($string));
    }
}
