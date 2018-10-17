<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/10/18
 * Time: 5:03 PM
 */

namespace Jeeno\Generators\FileWriter;


use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

/**
 * Class LocalFileWriterFactory
 *
 * @package Jeeno\LaravelIntegration\Config
 */
class LocalFileWriterFactory implements FileWriterFactory
{
    /**
     * @var JeenoConfig
     */
    private $config;

    /**
     * @var FilesystemFactory
     */
    private $filesystemFactory;

    /**
     * LocalFileWriterFactory constructor.
     *
     * @param JeenoConfig       $config
     * @param FilesystemFactory $filesystemFactory
     */
    public function __construct(JeenoConfig $config, FilesystemFactory $filesystemFactory)
    {
        $this->config            = $config;
        $this->filesystemFactory = $filesystemFactory;
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getEntityWriter(string $domain): Filesystem
    {
        return $this->buildPath($domain, $this->config->getEntitiesFolder());
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getRepositoryWriter(string $domain): Filesystem
    {
        return $this->buildPath($domain, $this->config->getRepositoriesFolder());
    }

    /**
     * @return Filesystem
     */
    public function getControllerWriter(string $domain): Filesystem
    {
        return $this->buildPath($domain, $this->config->getControllerFolder());
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getProviderWriter(string $domain): Filesystem
    {
        return $this->buildPath($domain, $this->config->getProviderFolder());
    }

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getRoutesWriter(string $domain): Filesystem
    {
        return $this->buildPath($domain, $this->config->getRoutesFolder());
    }


    /**
     * @param string $domain
     *
     * @param string $folder
     * @param bool   $append
     *
     * @return Filesystem
     */
    private function buildPath(string $domain, string $folder, bool $append = false): Filesystem
    {
        $appPath = $this->config->getAppPath();

        $path    = "{$appPath}/Domain/{$domain}/{$folder}";

        return $this->filesystemFactory->getLocalFilesystem($path, $append);
    }
}