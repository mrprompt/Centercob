<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Authorization;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use PHPUnit_Framework_TestCase;

/**
 * Address test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class AuthorizationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Authorization
     */
    private $authorization;

    public function setUp()
    {
        parent::setUp();

        $this->authorization = new Authorization();
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Authorization::getNumber
     */
    public function getNumberMustBeReturnNumberAttribute()
    {
        $this->modifyAttribute($this->authorization, 'number', 1);

        $this->assertEquals(1, $this->authorization->getNumber());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Authorization::setNumber
     */
    public function setNumberMustBeReturnNull()
    {
        $result = $this->authorization->setNumber('lajskfsla');

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Authorization::setNumber
     * @expectedException \InvalidArgumentException
     */
    public function setNumberThrowsExceptionWhenExceedMaximumValue()
    {
        $number = str_pad('x', 25, 'x');
        $result = $this->authorization->setNumber($number);

        $this->assertNull($result);
    }
}
