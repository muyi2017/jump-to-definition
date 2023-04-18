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
class ProjectServiceContainer extends Container
{
    protected $parameters = [];
    protected readonly \WeakReference $ref;

    public function __construct()
    {
        $this->ref = \WeakReference::create($this);
        $this->services = $this->privates = [];
        $this->methodMap = [
            'App\\Bus' => 'getBusService',
            'App\\Db' => 'getDbService',
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
            'App\\Handler1' => true,
            'App\\Handler2' => true,
            'App\\Processor' => true,
            'App\\Registry' => true,
            'App\\Schema' => true,
        ];
    }

    /**
     * Gets the public 'App\Bus' shared service.
     *
     * @return \App\Bus
     */
    protected static function getBusService($container)
    {
        $a = ($container->services['App\\Db'] ?? self::getDbService($container));

        $container->services['App\\Bus'] = $instance = new \App\Bus($a);

        $b = ($container->privates['App\\Schema'] ?? self::getSchemaService($container));
        $c = new \App\Registry();
        $c->processor = [$a, $instance];

        $d = new \App\Processor($c, $a);

        $instance->handler1 = new \App\Handler1($a, $b, $d);
        $instance->handler2 = new \App\Handler2($a, $b, $d);

        return $instance;
    }

    /**
     * Gets the public 'App\Db' shared service.
     *
     * @return \App\Db
     */
    protected static function getDbService($container)
    {
        $container->services['App\\Db'] = $instance = new \App\Db();

        $instance->schema = ($container->privates['App\\Schema'] ?? self::getSchemaService($container));

        return $instance;
    }

    /**
     * Gets the private 'App\Schema' shared service.
     *
     * @return \App\Schema
     */
    protected static function getSchemaService($container)
    {
        $a = ($container->services['App\\Db'] ?? self::getDbService($container));

        if (isset($container->privates['App\\Schema'])) {
            return $container->privates['App\\Schema'];
        }

        return $container->privates['App\\Schema'] = new \App\Schema($a);
    }
}
