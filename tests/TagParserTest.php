<?php

namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    /**
     * @test
     * @dataProvider tagsProvider
     */
    public function it_parses_tags($input, $expected): void
    {
        $parser = new TagParser();

        $result = $parser->parse($input);

        self::assertSame($expected, $result);
    }

    public function tagsProvider(): array
    {
        return [
            ['personal', ['personal']],
            ['personal, money, family', ['personal', 'money', 'family']],
            ['personal,money,family', ['personal', 'money', 'family']],
            ['personal | money | family', ['personal', 'money', 'family']],
            ['personal|money|family', ['personal', 'money', 'family']],
            ['personal!money!family', ['personal', 'money', 'family']],
        ];
    }
}
