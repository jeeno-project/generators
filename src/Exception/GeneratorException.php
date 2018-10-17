<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/9/18
 * Time: 2:27 PM
 */

namespace Jeeno\Generators\Exception;

/**
 * Class GeneratorException
 *
 * @package Jeeno\LaravelIntegration\Exception
 */
class GeneratorException extends \RuntimeException
{
    /**
     * GeneratorException constructor.
     *
     * @param string $generatorName
     */
    public function __construct($generatorName)
    {
        parent::__construct("Generation error: $generatorName");
    }
}