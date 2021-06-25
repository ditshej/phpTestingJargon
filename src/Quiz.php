<?php

namespace App;

class Quiz
{
    protected array $questions;
    protected int $currentQuestion = 1;

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
        if (!isset($this->questions[$this->currentQuestion - 1])) {
            return false;
        }

        $question = $this->questions[$this->currentQuestion - 1];

        $this->currentQuestion++;

        return $question;
    }

    public function grade(): float|int
    {
        if (!$this->isComplete()) {
            throw new \Exception('This quiz has not yet been completed.');
        }

        $correct = count($this->correctlyAnsweredQuestions());

        return ($correct / count($this->questions)) * 100;
    }

    public function isComplete(): bool
    {
        $answeredQuestions = count(array_filter($this->questions, fn($question) => $question->answered()));
        $totalQuestions = count($this->questions);

        return $answeredQuestions === $totalQuestions;
    }

    protected function correctlyAnsweredQuestions(): array
    {
        return array_filter($this->questions, static fn(Question $question) => $question->solved());
    }
}
