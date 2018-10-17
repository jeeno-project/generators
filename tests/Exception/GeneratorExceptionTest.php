<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/17/18
 * Time: 3:03 PM
 */

namespace Jeeno\Generators\Exception;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class GeneratorExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetMessage()
    {
        $generatorName = 'DummyGenerator';
        $message       = "Generation error: $generatorName";

        $exception = new GeneratorException($generatorName);

        Assert::assertEquals($message, $exception->getMessage());
    }
}