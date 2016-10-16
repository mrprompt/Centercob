<?php
namespace MrPrompt\Centercob\Common\Base;

use InvalidArgumentException;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator;

/**
 * Sequence
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class Sequence
{
    /**
     * @var int
     */
    private $value;

    /**
     * Construtor
     * 
     * @param string $value
     */
    public function __construct($value = 1)
    {
        $this->setValue($value);
    }

    /**
     * Return the value from sequence
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value from sequence
     *
     * @param int $value
     * @return void
     * @throws InvalidArgumentException
     */
    public function setValue($value)
    {
        $this->value = (int)  $value;
    }
}
