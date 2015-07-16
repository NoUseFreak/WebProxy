<?php
/**
 * This file is part of the webproxy package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Generator;

use AppBundle\Entity\UpstreamRepository;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class ProxyGenerator
{
    private $writer;
    private $upstreamGenerator;
    private $vhostGenerator;

    public function __construct(
      ConfigWriter $writer,
      UpstreamGenerator $upstreamGenerator,
      VhostGenerator $vhostGenerator
    )
    {
        $this->writer            = $writer;
        $this->upstreamGenerator = $upstreamGenerator;
        $this->vhostGenerator    = $vhostGenerator;
    }

    public function generate(OutputInterface $output)
    {
        $this->writer->setOutput($output);
        $output->writeln('Started');

        $this->upstreamGenerator->generate();
        $this->vhostGenerator->generate();

        $output->writeln('Finished');
    }
}
