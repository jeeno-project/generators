<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/17/18
 * Time: 1:18 PM
 */

namespace Jeeno\Generators\FileWriter;


use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

/**
 * Class FilesystemFactory
 *
 * @package Jeeno\LaravelIntegration\Config
 */
class FilesystemFactory
{
    /**
     * @param string $path
     * @param bool   $append
     *
     * @return Filesystem
     */
    public function getLocalFilesystem(string $path, bool $append = false): Filesystem
    {
        $writeFlags = $append ? FILE_APPEND | LOCK_EX : LOCK_EX;

        $adapter = new Local($path, $writeFlags);

        return new Filesystem($adapter);
    }
}