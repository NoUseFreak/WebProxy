<?php
/**
 * This file is part of the webproxy package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Helper;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class QueueHelper
{
    /**
     * @var AMQPStreamConnection
     */
    private $connection;

    /**
     * @var AMQPChannel
     */
    private $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('192.168.99.100', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('build_queue', false, true, false, false);
    }

    public function queue($message)
    {
        $msg = new AMQPMessage($message, [
          'delivery_mode' => 2, // persistent
        ]);
        $this->channel->basic_publish($msg, '', 'build_queue');
    }

    public function worker($callback)
    {
        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume('build_queue', '', false, false, false, false, $callback);
    }

    public function wait()
    {
        // Loop as long as the channel has callbacks registered
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
