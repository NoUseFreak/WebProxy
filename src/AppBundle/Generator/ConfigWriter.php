<?php
/**
 * This file is part of the webproxy package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Generator;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class ConfigWriter
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * ConfigWriter constructor.
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param string $type
     * @param string $name
     * @param string $content
     */
    public function write($type, $name, $content)
    {
        $dir = sys_get_temp_dir();
        $filename = $dir.'/'.$this->safeName($type.' '.$name.'.conf');

        file_put_contents($filename, $content);

        if ($this->output) {
            $this->output->writeln(sprintf('[%s] %s -> %s', $type, $name, $filename));
        }
    }

    private function safeName($string)
    {
        return preg_replace('/\+/', '_', urlencode($string));
    }
}
