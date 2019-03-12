<?php

/**
 * Container aware interface.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin;

use Psr\Container\ContainerInterface;

if (\interface_exists('ContainerAwareInterface')) {
    return;
}

/**
 * Interface ContainerAwareInterface.
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
