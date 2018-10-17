<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/10/18
 * Time: 5:02 PM
 */

namespace Jeeno\Generators\FileWriter;


use League\Flysystem\Filesystem;

/**
 * Interface FileWriterFactory
 *
 * @package Jeeno\LaravelIntegration\Config
 */
interface FileWriterFactory
{
    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getEntityWriter(string $domain):Filesystem;

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getRepositoryWriter(string $domain): Filesystem;

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getControllerWriter(string $domain):Filesystem;

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getProviderWriter(string $domain):Filesystem;

    /**
     * @param string $domain
     *
     * @return Filesystem
     */
    public function getRoutesWriter(string $domain):Filesystem;
}