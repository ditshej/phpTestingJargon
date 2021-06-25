<?php

namespace App;

class Question
{

    protected $answer;

    protected $correct;

    public function __construct(protected $body, protected $solution)
    {
    }

    public function answer($answer): bool
    {
        $this->answer = $answer;

        return $this->solved();
    }

    public function answered(): bool
    {
        return isset($this->answer);
    }

    public function solved(): bool
    {
        return $this->answer === $this->solution;
    }
}
