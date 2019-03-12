<?php

/**
 * Plugin factory.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin;

if (\class_exists('PluginFactory')) {
    return;
}

/**
 * Plugin factory class.
 */
class PluginFactory
{
    /**
     * @param string      $slug
     * @param string|null $filename
     *
     * @return Plugin
     */
    public static function create(string $slug, string $filename = null)
    {
        // Use the calling file as the main plugin file.
        if (!$filename) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
            $filename = $backtrace[0]['file'];
        }

        return new Plugin([
            'plugin.basename' => plugin_basename($filename),
            'plugin.directory' => plugin_dir_path($filename),
            'plugin.filename' => $filename,
            'plugin.slug' => $slug,
            'plugin.url' => plugin_dir_url($filename),
        ]);
    }
}
