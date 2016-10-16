<?php
namespace MrPrompt\Centercob\Common\Util;

/**
 * Class String
 * @package Centercob\Common\Util
 *
 * @author Walter Discher Cechinel <mistrim@gmail.com>
 */
abstract class String
{
    const FILL_LEFT  = 0;
    const FILL_RIGHT = 1;

    /**
     * @param $value
     * @param $length
     * @param int $fillSide
     * @return string
     */
    public static function whiteSpaceFill($value, $length, $fillSide = self::FILL_RIGHT)
    {
        return str_pad($value, $length, "\x20", $fillSide);
    }
}
