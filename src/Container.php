<?php

/**
 * Container.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin;

use Pimple\Container as PimpleContainer;

if (\class_exists('Container')) {
    return;
}

/**
 * Container class.
 */
class Container extends PimpleContainer
{
}
