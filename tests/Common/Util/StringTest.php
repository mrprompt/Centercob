<?php
namespace MrPrompt\Centercob\Tests\Common\Util;

use PHPUnit_Framework_TestCase;
use MrPrompt\Centercob\Common\Util\String;

/**
 * String test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class StringTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Util\String::whiteSpaceFill
     */
    public function whiteSpaceFillMustBeReturnExactLengthWithoutFillSideParam()
    {
        $foo = String::whiteSpaceFill(1, 10);

        $this->assertEquals(10, strlen($foo));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Util\String::whiteSpaceFill
     */
    public function whiteSpaceFillMustBeReturnExactStringWhenLengthIsEqualsWithoutFillSideParam()
    {
        $foo = String::whiteSpaceFill(1, 3);

        $this->assertEquals(3, strlen($foo));
    }
    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Util\String::whiteSpaceFill
     */
    public function whiteSpaceFillMustBeReturnExactLengthWithFillSideParam()
    {
        $foo = String::whiteSpaceFill(1, 10, String::FILL_LEFT);

        $this->assertEquals(10, strlen($foo));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Util\String::whiteSpaceFill
     */
    public function whiteSpaceFillMustBeReturnExactStringWhenLengthIsEqualsWithFillSideParam()
    {
        $foo = String::whiteSpaceFill(1, 3, String::FILL_LEFT);

        $this->assertEquals(3, strlen($foo));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Util\String::whiteSpaceFill
     */
    public function whiteSpaceFillThrowsExceptionWithoutParams()
    {
        $return = String::whiteSpaceFill('', 0, 1);

        $this->assertEmpty($return);
    }
}
