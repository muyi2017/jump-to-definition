<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Scheduler\Tests\Messenger;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Scheduler\Exception\LogicException;
use Symfony\Component\Scheduler\Generator\MessageGeneratorInterface;
use Symfony\Component\Scheduler\Messenger\ScheduledStamp;
use Symfony\Component\Scheduler\Messenger\SchedulerTransport;

class SchedulerTransportTest extends TestCase
{
    public function testGetFromIterator()
    {
        $messages = [
            (object) ['id' => 'first'],
            (object) ['id' => 'second'],
        ];
        $generator = $this->createConfiguredMock(MessageGeneratorInterface::class, [
            'getMessages' => $messages,
        ]);
        $transport = new SchedulerTransport($generator);

        foreach ($transport->get() as $envelope) {
            $this->assertInstanceOf(Envelope::class, $envelope);
            $this->assertNotNull($envelope->last(ScheduledStamp::class));
            $this->assertSame(array_shift($messages), $envelope->getMessage());
        }

        $this->assertEmpty($messages);
    }

    public function testAckIgnored()
    {
        $transport = new SchedulerTransport($this->createMock(MessageGeneratorInterface::class));

        $this->expectNotToPerformAssertions();
        $transport->ack(new Envelope(new \stdClass()));
    }

    public function testRejectException()
    {
        $transport = new SchedulerTransport($this->createMock(MessageGeneratorInterface::class));

        $this->expectNotToPerformAssertions();
        $transport->reject(new Envelope(new \stdClass()));
    }

    public function testSendException()
    {
        $transport = new SchedulerTransport($this->createMock(MessageGeneratorInterface::class));

        $this->expectException(LogicException::class);
        $transport->send(new Envelope(new \stdClass()));
    }
}
