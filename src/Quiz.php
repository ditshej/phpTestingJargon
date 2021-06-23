<?php

namespace App;

class Quiz
{

    protected array $questions;

    public function addQuestion(Question $question): void
    {
        $this->questions[] = $question;
    }

    public function questions(): array
    {
        return $this->questions;
    }

    public function nextQuestion()
    {
        return $this->questions[0];
    }

    public function grade(): float|int
    {
        $correct = count($this->correctlyAnsweredQuestions());

        return ($correct / count($this->questions)) * 100;
    }

    protected function correctlyAnsweredQuestions(): array
    {
        return array_filter($this->questions, static fn(Question $question) => $question->solved());
    }
}
