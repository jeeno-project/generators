<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/7/18
 * Time: 3:18 AM
 */

namespace Jeeno\Generators\Generator;

use League\Flysystem\Filesystem;


/**
 * Class RepositoryGenerator
 *
 * @package Jeeno\LaravelIntegration\Generator
 */
class RepositoryGenerator extends AbstractGenerator
{
    /**
     * @param string $domain
     * @param string $entity
     */
    public function generate(string $domain, string $entity): void
    {
        $filename = "{$entity}Repository.php";
        $content  = $this->renderView('repository_interface', $domain, $entity);

        $this->save($domain, $filename, $content);


        $filename = "Doctrine{$entity}Repository.php";
        $content  = $this->renderView('repository_doctrine', $domain, $entity);

        $this->save($domain, $filename, $content);
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    protected function getWriter(string $domain): Filesystem
    {
        return $this->fileWriterFactory->getRepositoryWriter($domain);
    }
}