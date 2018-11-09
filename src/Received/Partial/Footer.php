<?php
namespace MrPrompt\Centercob\Received\Partial;

use MrPrompt\Centercob\Common\Base\Sequence;

/**
 * File footer
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class Footer
{
    /**
     * Line lenght
     *
     * @const int
     */
    const LENGTH = 1006;

    /**
     * Type of register
     *
     * @var string
     */
    const TYPE = 'Z';

    /**
     * @var int
     */
    private $rows;

    /**
     * @var Sequence
     */
    private $sequence;

    /**
     * Constructor
     * @param string $row
     */
    public function __construct($row)
    {
        $this->rows = substr($row, 1, 6);
        $this->sequence = new Sequence((substr($row, 500, 6)));
    }

    /**
     * @return int
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param int $rows
     */
    public function setRows($rows = 0)
    {
        $this->rows = $rows;
    }

    /**
     * @return Sequence
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param Sequence $sequence
     */
    public function setSequence(Sequence $sequence)
    {
        $this->sequence = $sequence;
    }
}
