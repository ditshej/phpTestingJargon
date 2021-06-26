<?php

namespace Tests;

use App\Gateway;
use App\Mailer;
use App\Subscription;
use App\User;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{

    /** @test */
    public function it_creates_a_stripe_subscription(): void
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function creating_a_subscription_marks_the_user_as_subscribed(): void
    {
        $subscription = new Subscription(
            $this->createMock(Gateway::class), // dummy
            $this->createMock(Mailer::class) // dummy
        );

        $user = new User('John Doe');

        self::assertFalse($user->isSubscribed());

        $subscription->create($user);

        self::assertTrue($user->isSubscribed());
    }

    /** @test */
    public function it_delivers_a_receipt(): void
    {
        // stub
        $gateway = $this->createMock(Gateway::class);
        $gateway->method('create')->willReturn('receipt-stub');

        // mock
        $mailer = $this->createMock(Mailer::class);
        $mailer
            ->expects(self::once())
            ->method('deliver')
            ->with('Your receipt number is: receipt-stub');

        $subscription = new Subscription($gateway, $mailer);

        $subscription->create(new User('John Doe'));
    }
}
