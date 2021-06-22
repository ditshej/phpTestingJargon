<?php

namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    /** @test */
    public function it_parses_a_single_tag(): void
    {
        $parser = new TagParser();

        $result = $parser->parse('personal');
        $expected = ['personal'];

        self::assertSame($expected, $result);
    }

    /** @test */
    public function it_parses_a_comma_space_separated_list_of_tags(): void
    {
        $parser = new TagParser();

        $result = $parser->parse('personal, money, family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }
    
    /** @test */
    public function it_parses_a_comma_separated_list_of_tags() : void
    {
        $parser = new TagParser();
        
        $result = $parser->parse('personal,money,family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }
    
    /** @test */
    public function it_parses_a_space_pipe_space_separated_list_of_tags() : void
    {
        $parser = new TagParser();

        $result = $parser->parse('personal | money | family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }


    /** @test */
    public function it_parses_a_pipe_separated_list_of_tags() : void
    {
        $parser = new TagParser();

        $result = $parser->parse('personal|money|family');
        $expected = ['personal', 'money', 'family'];

        self::assertSame($expected, $result);
    }
}
