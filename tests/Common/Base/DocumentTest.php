<?php
namespace MrPrompt\Centercob\Tests\Common\Base;

use MrPrompt\Centercob\Common\Base\Document;
use MrPrompt\Centercob\Common\Util\ChangeProtectedAttribute;
use Mockery as m;
use PHPUnit_Framework_TestCase;

/**
 * Document test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class DocumentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @see \Centercob\Tests\ChangeProctedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @var Document
     */
    private $document;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->document = new Document();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->document = null;
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Document::__construct
     * @covers \MrPrompt\Centercob\Common\Base\Document::getType
     */
    public function getTypeMustBeReturnTypeAttribute()
    {
        $this->modifyAttribute($this->document, 'type', 2);

        $this->assertEquals(2, $this->document->getType());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Document::__construct
     * @covers \MrPrompt\Centercob\Common\Base\Document::setType
     */
    public function setTypeOnlyAcceptPreDefinedTypes()
    {
        $types = [Document::CNPJ, Document::CPF];
        $type = $types[ array_rand($types) ];

        $result = $this->document->setType($type);

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Document::__construct
     * @covers \MrPrompt\Centercob\Common\Base\Document::setType
     * @expectedException \InvalidArgumentException
     */
    public function setTypeThrowsExceptionWhenInvalidtype()
    {
        $this->document->setType('PASSPORT');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Document::__construct
     * @covers \MrPrompt\Centercob\Common\Base\Document::setType
     * @expectedException \InvalidArgumentException
     */
    public function setTypeThrowsExceptionWhenEmptyValue()
    {
        $this->document->setType('');
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Document::__construct
     * @covers \MrPrompt\Centercob\Common\Base\Document::getNumber
     */
    public function getNumberMustBeReturnNumberAttribute()
    {
        $this->modifyAttribute($this->document, 'number', 2);

        $this->assertEquals(2, $this->document->getNumber());
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Document::__construct
     * @covers \MrPrompt\Centercob\Common\Base\Document::setNumber
     */
    public function setNumberMustBeReturnNull()
    {
        $result = $this->document->setNumber('11122233344');

        $this->assertNull($result);
    }

    /**
     * @test
     * @covers \MrPrompt\Centercob\Common\Base\Document::__construct
     * @covers \MrPrompt\Centercob\Common\Base\Document::setNumber
     * @expectedException \InvalidArgumentException
     */
    public function setNumberThrowsExceptionWhenExceedMaxLength()
    {
        $result = $this->document->setNumber(str_pad(0, 20, 0));

        $this->assertNull($result);
    }
}
