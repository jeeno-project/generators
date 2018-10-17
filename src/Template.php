<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/17/18
 * Time: 4:54 PM
 */

namespace Jeeno\Generators;


/**
 * Interface Template
 *
 * @package Jeeno\Generators
 */
interface Template
{
    /**
     * @return string
     */
    public function render():string;
}