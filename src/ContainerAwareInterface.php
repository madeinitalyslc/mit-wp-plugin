<?php

namespace MadeInItalySLC\WP\Plugin;

use Psr\Container\ContainerInterface;

/**
 * Interface ContainerAwareInterface
 *
 * @package MadeInItalySLC\WP\Plugin
 */
interface ContainerAwareInterface
{
    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container);

    /**
     * @return ContainerInterface
     */
    public function getContainer();
}