<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/7/18
 * Time: 3:18 AM
 */

namespace Jeeno\Generators\Generator;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Jeeno\LaravelIntegration\Config\FileWriterFactory;
use League\Flysystem\Filesystem;


/**
 * Class ModelGenerator
 *
 * @package Jeeno\LaravelIntegration\Generator
 */
class ProviderGenerator extends AbstractGenerator
{
    /**
     * @param string $domain
     * @param string $entity
     */
    public function generate(string $domain, string $entity): void
    {
        $filename = "{$domain}ServiceProvider.php";
        $content  = $this->renderView('provider', $domain, $entity);

        $this->save($domain, $filename, $content);
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    protected function getWriter(string $domain): Filesystem
    {
        return $this->fileWriterFactory->getProviderWriter($domain);
    }
}