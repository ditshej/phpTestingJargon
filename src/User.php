<?php

namespace App;

class User
{

    public function __construct(
        protected string $name,
        protected bool $subscribed = false
    )
    {
    }

    public function isSubscribed(): bool
    {
        return $this->subscribed;
    }

    public function markAsSubscribed(): void
    {
        $this->subscribed = true;
    }

}
