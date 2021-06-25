<?php

namespace Tests;

use App\Question;
use App\Quiz;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    /** @test */
    public function it_consists_of_questions(): void
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        self::assertCount(1, $quiz->questions());
    }

    /** @test */
    public function it_grades_a_perfect_quiz(): void
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $question = $quiz->nextQuestion();

        $question->answer(4);

        self::assertEquals(100, $quiz->grade());
    }

    /** @test */
    public function it_grades_a_failed_quiz(): void
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $question = $quiz->nextQuestion();

        $question->answer('incorrect answer');

        self::assertEquals(0, $quiz->grade());
    }

    /** @test */
    public function it_correctly_tracks_the_next_question_in_the_queue(): void
    {

        $quiz = new Quiz();

        $quiz->addQuestion($question1 = new Question("What is 2 + 2?", 4));
        $quiz->addQuestion($question2 = new Question("What is 3 + 3?", 6));

        self::assertEquals($question1, $quiz->nextQuestion());
        self::assertEquals($question2, $quiz->nextQuestion());

    }

    /** @test */
    public function it_returns_false_if_there_are_no_remaining_next_question_in_the_queue(): void
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $quiz->nextQuestion();
        self::assertFalse($quiz->nextQuestion());
    }

    /** @test */
    public function it_cannot_be_graded_until_all_questions_have_been_answered(): void
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $this->expectException(\Exception::class);

        $quiz->grade();
    }
}
