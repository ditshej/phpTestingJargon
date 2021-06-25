<?php

namespace App;

use Exception;

class Quiz
{
    protected Questions $questions;

    public function __construct()
    {
        $this->questions = new Questions();
    }

    public function addQuestion(Question $question): void
    {
        $this->questions->add($question);
    }

    public function begin(): Question
    {
        return $this->nextQuestion();
    }

    public function nextQuestion(): Question|bool
    {
        return $this->questions->next();
    }

    public function questions(): Questions
    {
        return $this->questions;
    }

    /**
     * @throws Exception
     */
    public function grade(): float|int
    {
        if (!$this->isComplete()) {
            throw new Exception('This quiz has not yet been completed.');
        }

        $correct = count($this->questions->solved());

        return ($correct / $this->questions->count()) * 100;
    }

    public function isComplete(): bool
    {
        return count($this->questions->answered()) === $this->questions->count();
    }

}
