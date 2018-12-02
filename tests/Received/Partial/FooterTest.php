<?php
namespace MrPrompt\Centercob\Tests\Received\Partial;

use PHPUnit\Framework\TestCase;
use MrPrompt\Centercob\Tests\Mock;
use MrPrompt\ShipmentCommon\Base\Sequence;
use MrPrompt\Centercob\Received\Partial\Footer;
use MrPrompt\Centercob\Tests\ChangeProtectedAttribute;

/**
 * Footer test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class FooterTest extends TestCase
{
    /**
     * @see \Centercob\Common\Util\ChangeProtectedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @see \Centercob\Tests\Gateway\Mock
     */
    use Mock;

    /**
     * @var Footer
     */
    private $footer;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $file = file_get_contents(__DIR__ . '/../resources/RET0000759-19.05.2015-18.54.42.TXT');
        $rows = explode(PHP_EOL, $file);

        $this->footer = new Footer(array_pop($rows));
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->footer = null;

        parent::tearDown();
    }

    /**
     * @test
     * @cover \Centercob\Gateway\Received\Partial\Footer::__construct()
     * @cover \Centercob\Gateway\Received\Partial\Footer::getRows()
     */
    public function getRowsMustBeReturnInteger()
    {
        $rows = $this->footer->getRows();

        $this->assertNotNull($rows);
    }

    /**
     * @test
     * @cover \Centercob\Gateway\Received\Partial\Footer::__construct()
     * @cover \Centercob\Gateway\Received\Partial\Footer::setRows()
     */
    public function setRowsMustBeReturnNull()
    {
        $rows = $this->footer->setRows(1);

        $this->assertNull($rows);
    }

    /**
     * @test
     * @cover \Centercob\Gateway\Received\Partial\Footer::__construct()
     * @cover \Centercob\Gateway\Received\Partial\Footer::getSequence()
     */
    public function getSequenceMustBeReturnSequenceInstance()
    {
        $sequence = $this->footer->getSequence();

        $this->assertInstanceOf(Sequence::class, $sequence);
    }

    /**
     * @test
     * @cover \Centercob\Gateway\Received\Partial\Footer::__construct()
     * @cover \Centercob\Gateway\Received\Partial\Footer::setSequence()
     */
    public function setSequenceMustBeReturnNull()
    {
        $sequence = $this->footer->setSequence(new Sequence());

        $this->assertNull($sequence);
    }
}
