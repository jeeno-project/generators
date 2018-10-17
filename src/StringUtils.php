<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/17/18
 * Time: 5:08 PM
 */

namespace Jeeno\Generators;


/**
 * Interface StringUtils
 *
 * @package Jeeno\Generators
 */
interface StringUtils
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function toSnakeCase(string $string): string;

    /**
     * @param string $string
     *
     * @return string
     */
    public function toPlural(string $string): string;
}