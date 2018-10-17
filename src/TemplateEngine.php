<?php

namespace Jeeno\Generators;

/**
 * Interface TemplateEngine
 *
 * @package Jeeno\Generators
 */
interface TemplateEngine
{
    /**
     * @param string $templateName
     *
     * @param array  $data
     *
     * @return Template
     */
    public function make(string $templateName, array $data): Template;
}