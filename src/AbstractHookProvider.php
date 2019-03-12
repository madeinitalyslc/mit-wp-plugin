<?php

/**
 * Base hook provider.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin;

if (\class_exists('AbstractHookProvider')) {
    return;
}

/**
 * Base hook provider class.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
abstract class AbstractHookProvider implements HookProviderInterface
{
    use HooksTrait;

    /**
     * Registers hooks for the plugin.
     */
    abstract public function registerHooks();
}
