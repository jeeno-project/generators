<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/17/18
 * Time: 5:00 PM
 */

namespace Jeeno\Generators;

/**
 * Interface ViewNameResolver
 *
 * @package Jeeno\Generators
 */
interface ViewNameResolver
{
    /**
     * @param string $name
     *
     * @return string
     */
    public function resolve(string $name):string;
}