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
 * Class ModelGenerator
 *
 * @package Jeeno\LaravelIntegration\Generator
 */
class RoutesGenerator extends AbstractGenerator
{
    /**
     * @param string $domain
     * @param string $entity
     */
    public function generate(string $domain, string $entity): void
    {
        $content  = $this->renderView('routes', $domain, $entity);
        $filename = "routes.php";

        $this->save($domain, $filename, $content);
    }

    /**
     * @return Filesystem
     */
    protected function getWriter(string $domain): Filesystem
    {
        return $this->fileWriterFactory->getRoutesWriter($domain);
    }

    /**
     * @param string $view
     * @param string $domain
     * @param string $entity
     * @param array  $data
     *
     * @return string
     */
    protected function renderView(string $view, string $domain, string $entity, array $data = [])
    {
        return "<?php\n\n\\App\\Domain\\{$domain}\\Controllers\\{$entity}Controller::registerRoutes();";
    }
}