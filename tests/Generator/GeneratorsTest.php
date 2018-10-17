<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/9/18
 * Time: 1:39 PM
 */

namespace Jeeno\Generators\Generator;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Jeeno\LaravelIntegration\Config\FileWriterFactory;
use League\Flysystem\FileExistsException;
use League\Flysystem\Filesystem;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class EntityGeneratorTest
 *
 * @package Jeeno\LaravelIntegration\Tests\Generator
 */
class GeneratorsTest extends TestCase
{
    /**
     * @test
     * @dataProvider generatorProvider
     *
     * @param string $generatorClass
     * @param string $viewName
     */
    public function shouldGenerateACode(string $generatorClass, string $viewName, string $factoryMethod, array $extraData)
    {
        $domain  = 'MyDomain';
        $entity  = 'MyEntity';
        $content = 'Rendered view';

        $data = [
            'domain' => $domain,
            'entity' => $entity
        ];

        $viewFactory = $this->mockViewFactory(
            "jeeno::{$viewName}",
            $content,
            $data + $extraData
        );

        $fileWriterFactory = $this->mockFileWriterFactory($domain, $entity, $content, $factoryMethod, false);

        /** @var CodeGenerator $generator */
        $generator = new $generatorClass($viewFactory, $fileWriterFactory);

        $generator->generate($domain, $entity);
    }

    /**
     * @test
     * @expectedException \Jeeno\Generators\Exception\GeneratorException
     * @expectedExceptionMessage Generation error: Jeeno\LaravelIntegration\Generator\EntityGenerator
     */
    public function shouldRaiseException()
    {
        $domain  = 'MyDomain';
        $entity  = 'MyEntity';
        $content = 'Rendered view';

        $viewFactory = $this->mockViewFactory('jeeno::entity',
            $content,
            [
                'table'  => 'my_entities',
                'domain' => $domain,
                'entity' => $entity
            ]);

        $fileWriterFactory = $this->mockFileWriterFactory($domain, $entity, $content, true);

        $generator = new EntityGenerator($viewFactory, $fileWriterFactory);

        $generator->generate($domain, $entity);
    }

    /**
     * @return array
     */
    public function generatorProvider(): array
    {
        return [
            [EntityGenerator::class, 'entity', 'getEntityWriter', ['table' => 'my_entities']],
            [ControllerGenerator::class, 'controller', 'getControllerWriter', []],
            [ProviderGenerator::class, 'provider', 'getProviderWriter',[]],
        ];
    }

    /**
     * @return ViewFactory|\Mockery\MockInterface
     */
    private function mockViewFactory(string $viewName, string $content, array $data)
    {
        $mock = Mockery::mock(ViewFactory::class);

        $mock->shouldReceive('make')
             ->with($viewName, $data)
             ->once()
             ->andReturn($this->mockView($content));

        return $mock;
    }

    /**
     * @param string $filename
     * @param string $content
     * @param bool   $throwException
     *
     * @return Filesystem|\Mockery\MockInterface
     */
    private function mockFilesystem(string $filename, string $content, bool $throwException)
    {
        $mock = Mockery::mock(Filesystem::class);

        if ($throwException) {
            $mock->shouldReceive('write')
                 ->once()
                 ->andThrow(new FileExistsException($filename));
        } else {
            $mock->shouldReceive('write')
                 ->once()
                 ->with($filename, $content)
                 ->andReturn(true);
        }

        return $mock;
    }

    /**
     * @param string $content
     *
     * @return View|Mockery\MockInterface
     */
    private function mockView(string $content)
    {
        $mock = Mockery::mock(View::class);

        $mock->shouldReceive('render')->once()->andReturn($content);

        return $mock;
    }

    /**
     * @return FileWriterFactory|Mockery\MockInterface
     */
    private function mockFileWriterFactory(string $domain, string $className, string $content, string $factoryMethod, bool $throwException)
    {
        $mock = Mockery::mock(FileWriterFactory::class);

        $mock->shouldReceive($factoryMethod)
             ->with($domain)
             ->andReturn(
                 $this->mockFilesystem($className . '.php', $content, $throwException)
             );

        return $mock;
    }
}