<?php

namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    protected TagParser $parser;

    /** @test */
    public function it_parses_a_single_tag(): void
    {
        $result = $this->parser->parse('personal');
        $expected = ['personal'];

        self::assertSame($expected, $result);
    }

    /** @test */
    public function it_parses_a_comma_space_separated_list_of_tags(): void
    {
        $result = $this->parser->parse('personal, money, family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }

    /** @test */
    public function it_parses_a_comma_separated_list_of_tags(): void
    {
        $this->parser = new TagParser();

        $result = $this->parser->parse('personal,money,family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }

    /** @test */
    public function it_parses_a_space_pipe_space_separated_list_of_tags(): void
    {
        $result = $this->parser->parse('personal | money | family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }

    /** @test */
    public function it_parses_a_pipe_separated_list_of_tags(): void
    {
        $result = $this->parser->parse('personal|money|family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }

    protected function setUp(): void
    {
        $this->parser = new TagParser();

    }
}
