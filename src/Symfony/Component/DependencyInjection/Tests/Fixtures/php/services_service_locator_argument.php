<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class Symfony_DI_PhpDumper_Service_Locator_Argument extends Container
{
    protected $parameters = [];
    protected readonly \WeakReference $ref;
    protected \Closure $getService;

    public function __construct()
    {
        $containerRef = $this->ref = \WeakReference::create($this);
        $this->getService = static function () use ($containerRef) { return $containerRef->get()->getService(...\func_get_args()); };
        $this->services = $this->privates = [];
        $this->syntheticIds = [
            'foo5' => true,
        ];
        $this->methodMap = [
            'bar' => 'getBarService',
            'foo1' => 'getFoo1Service',
        ];

        $this->aliases = [];
    }

    public function compile(): void
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled(): bool
    {
        return true;
    }

    public function getRemovedIds(): array
    {
        return [
            '.service_locator.ZP1tNYN' => true,
            'foo2' => true,
            'foo3' => true,
            'foo4' => true,
        ];
    }

    /**
     * Gets the public 'bar' shared service.
     *
     * @return \stdClass
     */
    protected static function getBarService($container)
    {
        $container->services['bar'] = $instance = new \stdClass();

        $instance->locator = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'foo1' => ['services', 'foo1', 'getFoo1Service', false],
            'foo2' => ['privates', 'foo2', 'getFoo2Service', false],
            'foo3' => [false, 'foo3', 'getFoo3Service', false],
            'foo4' => ['privates', 'foo4', NULL, 'BOOM'],
            'foo5' => ['services', 'foo5', NULL, false],
        ], [
            'foo1' => '?',
            'foo2' => '?',
            'foo3' => '?',
            'foo4' => '?',
            'foo5' => '?',
        ]);

        return $instance;
    }

    /**
     * Gets the public 'foo1' shared service.
     *
     * @return \stdClass
     */
    protected static function getFoo1Service($container)
    {
        return $container->services['foo1'] = new \stdClass();
    }

    /**
     * Gets the private 'foo2' shared service.
     *
     * @return \stdClass
     */
    protected static function getFoo2Service($container)
    {
        return $container->privates['foo2'] = new \stdClass();
    }

    /**
     * Gets the private 'foo3' service.
     *
     * @return \stdClass
     */
    protected static function getFoo3Service($container)
    {
        $container->factories['service_container']['foo3'] = function ($container) {
            return new \stdClass();
        };

        return $container->factories['service_container']['foo3']($container);
    }

    /**
     * Gets the private 'foo4' shared service.
     *
     * @return \stdClass
     */
    protected static function getFoo4Service($container)
    {
        throw new RuntimeException('BOOM');
    }
}
