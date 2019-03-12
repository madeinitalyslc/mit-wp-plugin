<?php

/**
 * Container aware trait.
 *
 * Container implementation courtesy of Slim 3.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 *
 * @see https://github.com/slimphp/Slim/blob/e80b0f8b4d23e165783e8bf241b31c35272b0e28/Slim/App.php
 *
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin;

use Psr\Container\ContainerInterface;

if (\trait_exists('ContainerAwareTrait', true)) {
    return;
}

/**
 * Container aware trait.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
trait ContainerAwareTrait
{
    /**
     * Container.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Proxy access to container services.
     *
     * @param string $name service name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->container->get($name);
    }

    /**
     * Whether a container service exists.
     *
     * @param string $name service name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return $this->container->has($name);
    }

    /**
     * Calling a non-existant method on the class checks to see if there's an
     * item in the container that is callable and if so, calls it.
     *
     * @param string $method method name
     * @param array  $args   method arguments
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        if ($this->container->has($method)) {
            $object = $this->container->get($method);
            if (is_callable($object)) {
                return call_user_func_array($object, $args);
            }
        }
    }

    /**
     * Enable access to the DI container by plugin consumers.
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set the container.
     *
     * @param ContainerInterface $container dependency injection container
     *
     * @throws \InvalidArgumentException when no container is provided that implements ContainerInterface
     *
     * @return $this
     */
    public function setContainer(ContainerInterface $container)
    {
        if (!$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Expected a ContainerInterface.');
        }

        $this->container = $container;

        return $this;
    }
}
