<?php

namespace Tests;

use App\Gateway;
use App\Subscription;
use App\User;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{

    /** @test */
    public function it_creates_a_stripe_subscription() : void
    {
        $this->markTestSkipped();
    }
    
    /** @test */
    public function creating_a_subscription_marks_the_user_as_subscribed() : void
    {
        $subscription = new Subscription($this->createMock(Gateway::class));
        $user = new User('John Doe');

        self::assertFalse($user->isSubscribed());

        $subscription->create($user);

        self::assertTrue($user->isSubscribed());
    }
    
}
