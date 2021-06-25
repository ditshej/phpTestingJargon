<?php

namespace App;


class Questions implements \Countable
{
    protected array $questions;

    public function __construct(array $questions = [])
    {
        $this->questions = $questions;
    }

    public function add(Question $question): void
    {
        $this->questions[] = $question;
    }

    public function next() : Question|bool
    {
        $question = current($this->questions);

        next($this->questions);

        return $question;
    }

    public function answered(): array
    {
        return array_filter($this->questions, static fn($question) => $question->answered());
    }

    public function solved(): array
    {
        return array_filter($this->questions, static fn(Question $question) => $question->solved());
    }

    public function count(): int
    {
        return count($this->questions);
    }
}
