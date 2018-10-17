<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/10/18
 * Time: 7:57 PM
 */

namespace Jeeno\Generators\Generator;

use Jeeno\Generators\CodeGenerator;
use Jeeno\Generators\FileWriter\FileWriterFactory;
use Jeeno\Generators\TemplateEngine;
use Jeeno\Generators\Exception\GeneratorException;
use League\Flysystem\FileExistsException;
use League\Flysystem\Filesystem;


/**
 * Class AbstractGenerator
 *
 * @package Jeeno\LaravelIntegration\Generator
 */
abstract class AbstractGenerator implements CodeGenerator
{

    /**
     * @var FileWriterFactory
     */
    protected $fileWriterFactory;

    /**
     * @var TemplateEngine
     */
    private $templateEngine;

    /**
     * EntityGenerator constructor.
     *
     * @param TemplateEngine    $templateEngine
     * @param FileWriterFactory $fileWriterFactory
     */
    public function __construct(TemplateEngine $templateEngine, FileWriterFactory $fileWriterFactory)
    {
        $this->fileWriterFactory = $fileWriterFactory;
        $this->templateEngine    = $templateEngine;
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    abstract protected function getWriter(string $domain): Filesystem;

    /**
     * @param string $domain
     * @param string $entity
     */
    abstract public function generate(string $domain, string $entity): void;

    /**
     * @param string $view
     * @param string $domain
     * @param string $entity
     * @param array  $data
     *
     * @return string
     */
    protected function renderView(string $viewName, string $domain, string $entity, array $data = [])
    {
        $data['domain'] = $domain;
        $data['entity'] = $entity;

        $view = $this->templateEngine->make($viewName, $data);

        return $view->render();
    }

    /**
     * @param string $domain
     * @param string $filename
     * @param string $content
     *
     * @throws GeneratorException
     */
    protected function save(string $domain, string $filename, string &$content)
    {
        $writer = $this->getWriter($domain);

        try {
            $writer->write($filename, $content);
        } catch (FileExistsException $e) {
            throw new GeneratorException(static::class);
        }
    }
}