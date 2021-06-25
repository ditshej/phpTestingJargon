<?php

namespace Tests;

use App\Question;
use App\Quiz;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{

    protected Quiz $quiz;

    /** @test */
    public function it_consists_of_questions(): void
    {
        $this->quiz->addQuestion(new Question("What is 2 + 2?", 4));

        self::assertCount(1, $this->quiz->questions());
    }

    /** @test */
    public function it_grades_a_perfect_quiz(): void
    {
        $this->quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $this->quiz->begin()->answer(4);

        self::assertEquals(100, $this->quiz->grade());
    }

    /** @test */
    public function it_grades_a_failed_quiz(): void
    {
        $this->quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $this->quiz->begin()->answer('incorrect answer');

        self::assertEquals(0, $this->quiz->grade());
    }

    /** @test */
    public function it_correctly_tracks_the_next_question_in_the_queue(): void
    {

        $this->quiz->addQuestion($question1 = new Question("What is 2 + 2?", 4));
        $this->quiz->addQuestion($question2 = new Question("What is 3 + 3?", 6));

        self::assertEquals($question1, $this->quiz->nextQuestion());
        self::assertEquals($question2, $this->quiz->nextQuestion());

    }

    /** @test */
    public function it_returns_false_if_there_are_no_remaining_next_question_in_the_queue(): void
    {
        $this->quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $this->quiz->nextQuestion();
        self::assertFalse($this->quiz->nextQuestion());
    }

    /** @test */
    public function it_cannot_be_graded_until_all_questions_have_been_answered(): void
    {
        $this->quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $this->expectException(\Exception::class);

        $this->quiz->grade();
    }

    /** @test */
    public function it_knows_if_it_is_complete(): void
    {
        $this->quiz->addQuestion(new Question("What is 2 + 2?", 4));

        self::assertFalse($this->quiz->isComplete());

        $this->quiz->nextQuestion()->answer(4);

        self::assertTrue($this->quiz->isComplete());
    }

    protected function setUp(): void
    {
        $this->quiz = new Quiz();
    }

}
