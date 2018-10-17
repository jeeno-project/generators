<?php

namespace Jeeno\Generators;

/**
 * Interface CodeGenerator
 *
 * @package Jeeno\LaravelIntegration\Generator
 */
interface CodeGenerator
{
    /**
     * @param string $domain
     * @param string $entity
     *
     * @return void
     *
     */
    function generate(string $domain, string $entity):void;
}