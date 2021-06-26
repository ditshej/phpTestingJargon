<?php

namespace Tests;

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
        $gateway = new FakeGateway(); // don't user the actual Gateway. Use a dummy/fake version
        $subscription = new Subscription($gateway);
        $user = new User('John Doe');

        self::assertFalse($user->isSubscribed());

        $subscription->create($user);

        self::assertTrue($user->isSubscribed());
    }
    
}
