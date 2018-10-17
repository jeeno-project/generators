<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/7/18
 * Time: 3:18 AM
 */

namespace Jeeno\Generators\Generator;

use Jeeno\Generators\Exception\GeneratorException;
use Jeeno\Generators\FileWriter\FileWriterFactory;
use Jeeno\Generators\StringUtils;
use Jeeno\Generators\TemplateEngine;
use League\Flysystem\Filesystem;


/**
 * Class ModelGenerator
 *
 * @package Jeeno\LaravelIntegration\Generator
 */
class EntityGenerator extends AbstractGenerator
{
    /**
     * @var StringUtils
     */
    private $stringUtils;

    /**
     * EntityGenerator constructor.
     *
     * @param TemplateEngine    $templateEngine
     * @param FileWriterFactory $fileWriterFactory
     * @param StringUtils       $stringUtils
     */
    public function __construct(TemplateEngine $templateEngine,
                                FileWriterFactory $fileWriterFactory,
                                StringUtils $stringUtils
    ) {
        parent::__construct($templateEngine, $fileWriterFactory);

        $this->stringUtils = $stringUtils;
    }

    /**
     * @param string      $domain
     * @param string      $entity
     * @param string|null $table
     *
     * @throws GeneratorException
     */
    public function generate(string $domain, string $entity, string $table = null): void
    {
        $table    = $table ?: $this->getTableName($entity);
        $filename = "{$entity}.php";
        $content  = $this->renderView('entity', $domain, $entity, ['table' => $table]);

        $this->save($domain, $filename, $content);
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    protected function getWriter(string $domain): Filesystem
    {
        return $this->fileWriterFactory->getEntityWriter($domain);
    }

    /**
     * @param string $entity
     *
     * @return string
     */
    private function getTableName(string $entity): string
    {
        return $this->stringUtils->toSnakeCase(
            $this->stringUtils->toPlural($entity)
        );
    }
}