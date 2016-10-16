<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Occurrence;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use PHPUnit_Framework_TestCase;

/**
 * Document test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class OccurrenceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Occurrence
     */
    private $occurrence;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->occurrence = new Occurrence();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->occurrence = null;
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::getType()
     */
    public function getTypeMustBeReturnTypeAttribute()
    {
        $types = [Occurrence::CANCEL, Occurrence::INSERT, Occurrence::UPDATE];
        $type  = $types[ array_rand($types) ];

        $this->modifyAttribute($this->occurrence, 'type', $type);

        $this->assertEquals($type, $this->occurrence->getType());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setType()
     */
    public function setTypeOnlyAcceptPreDefinedTypes()
    {
        $types = [Occurrence::CANCEL, Occurrence::INSERT, Occurrence::UPDATE];
        $type  = $types[ array_rand($types) ];

        $result = $this->occurrence->setType($type);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setType()
     * @expectedException \InvalidArgumentException
     */
    public function setTypeThrowsExceptionWhenNotPredefinedTypes()
    {
        $type = 'X';

        $this->occurrence->setType($type);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setType()
     * @expectedException \InvalidArgumentException
     */
    public function setTypeThrowsExceptionWhenEmpty()
    {
        $type = ' ';

        $this->occurrence->setType($type);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::getReturn()
     */
    public function getReturnMustBeReturnReturnAttribute()
    {
        $this->modifyAttribute($this->occurrence, 'return', 1);

        $this->assertEquals(1, $this->occurrence->getReturn());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setReturn()
     */
    public function setReturnMustBeReturnNullWhenReceiveNumericValue()
    {
        $this->assertNull($this->occurrence->setReturn(1));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setReturn()
     */
    public function setReturnMustBeReturnNullWhenNotReceiveAnyParameter()
    {
        $this->assertNull($this->occurrence->setReturn());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setReturn()
     * @expectedException \InvalidArgumentException
     */
    public function setReturnThrowsExceptionWhenReceiveNonNumericValue()
    {
        $type = 'X';

        $this->occurrence->setReturn($type);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setReturn()
     */
    public function setReturnReturnNullWhenReceiveEmptyValue()
    {
        $this->assertNull($this->occurrence->setReturn(''));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setReturn()
     */
    public function setReturnReturnNullWhenReceiveNumericAsStringValue()
    {
        $this->assertNull($this->occurrence->setReturn('4'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setDescription()
     */
    public function setDescriptionMustBeReturnNullWhenReceiveStringValue()
    {
        $this->assertNull($this->occurrence->setDescription('foo'));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::getDescription()
     */
    public function getDescriptionMustBeReturnDescriptionAttribute()
    {
        $this->modifyAttribute($this->occurrence, 'description', 'foo');

        $this->assertEquals('foo', $this->occurrence->getDescription());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setDescription()
     */
    public function setDescriptionReturnNullWhenReceiveEmptyValue()
    {
        $this->assertNull($this->occurrence->setDescription(''));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setDescription()
     */
    public function setDescriptionReturnNullWhenNotReceiveAnyParameter()
    {
        $this->assertNull($this->occurrence->setDescription());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setDescription()
     * @expectedException \InvalidArgumentException
     */
    public function setDescriptionThrowsExceptionWhenNotReceiveNotString()
    {
        $this->assertNull($this->occurrence->setDescription(33));
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::getDate()
     */
    public function getDateMustBeReturnDateAttribute()
    {
        $date = new \DateTime();
        $this->modifyAttribute($this->occurrence, 'date', $date);

        $this->assertSame($date, $this->occurrence->getDate());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Occurrence::setDate()
     */
    public function setDateMustBeReturnNull()
    {
        $date = new \DateTime();

        $result = $this->occurrence->setDate($date);

        $this->assertNull($result);
    }
}
