<?php

namespace MadeInItalySLC\WP\Plugin\Providers;

use Dotenv\Dotenv;
use League\Container\Container;
use League\Container\ServiceProvider\AbstractServiceProvider;

if (\class_exists('PhpDotEnvProvider')) {
    return;
}

/**
 * Class PhpDotEnvProvider.
 */
class PhpDotEnvProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        'php_dot_env'
    ];

    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        /** @var Container $container */
        $container = $this->getContainer();

        $container->add('php_dot_env', function () {
            $dotenv = Dotenv::create($this->directory);

            $dotenv->load();

            return $dotenv;
        });
    }
}
