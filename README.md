# WordPress Plugin Library

Adds some structure to your WordPress plugins.

Requires PHP 7.1+.

## Installation

To use this library in your project, add it to `composer.json`:

```sh
composer require madeinitalyslc/mit-wp-plugin
```

## Creating a Plugin

A plugin is a simple object created to help bootstrap functionality by allowing you to easily retrieve plugin information, reference internal files and URLs, and register hooks.

```php
<?php
/**
 * Plugin Name: Structure
 */

use MadeInItalySLC\WP\Plugin\PluginFactory;

if (file_exists( __DIR__.'/vendor/autoload.php')) {
	require_once __DIR__.'/vendor/autoload.php');
}

$structure = PluginFactory::create('structure');
```

`$stucture` is an instance of `Plugin` and implements the `PluginInterface`, which provides a basic API to access information about the plugin.

## Hook Providers

Related functionality can be encapsulated in a class called a "hook provider" that's registered when bootstrapping the plugin.

Hook providers allow you to encapsulate related functionality, maintain state without using globals, namespace methods without prefixing functions, limit access to internal methods, and make unit testing easier.

For an example, the `MadeInItalySLC\WP\Plugin\Provider\I18n` class is a default hook provider that automatically loads the text domain so the plugin can be translated.

The only requirement for a hook provider is that it should implement the `HookProviderInterface` by defining a method called `registerHooks()`.

Hook providers are registered with the main plugin instance by calling `Plugin::registerHooks()` like this:

```php
<?php
$structure
	->registerHooks(new \MadeInItalySLC\WP\Plugin\Provider\I18n())
	->registerHooks(new \Structure\PostType\BookPostType());
```

The `BookPostType` provider might look something like this:

```php
<?php
namespace Structure\PostType;

class BookPostType extends AbstractHookProvider
{
	const POST_TYPE = 'book';

	public function registerHooks()
	{
		$this->addAction('init', 'registerPostType');
		$this->addAction('init', 'registerMeta');
	}

	protected function registerPostType()
	{
		register_post_type(static::POST_TYPE, $this->getArgs());
	}

	protected function registerMeta()
	{
		register_meta('post', 'isbn', [
			'type'              => 'string',
			'single'            => true,
			'sanitize_callback' => 'sanitize_text_field',
			'show_in_rest'      => true,
		]);
	}

	protected function getArgs()
	{
		return [
			'hierarchical'      => false,
			'public'            => true,
			'rest_base'         => 'books',
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_nav_menus' => false,
			'show_in_rest'      => true,
		];
	}
}
```

## Protected Hook Callbacks

In WordPress, it's only possible to use public methods of a class as hook callbacks, but in the `BookPostType` hook provider above, the callbacks are protected methods of the class.

Locking down the API like that is possible using the `HooksTrait` [developed by John P. Bloch](https://github.com/johnpbloch/wordpress-dev).

## Plugin Awareness

A hook provider may implement the `PluginAwareInterface` to automatically receive a reference to the plugin when its hooks are registered.

For instance, in this class the `enqueueAssets()` method references the internal `$plugin` property to retrieve the URL to a JavaScript file in the plugin.

```php
<?php
namespace Structure\Provider;

use MadeInItalySLC\WP\Plugin\AbstractHookProvider;

class Assets extends AbstractHookProvider
{
	public function registerHooks()
	{
		$this->addAction('wp_enqueue_scripts', 'enqueueAssets');
	}

	protected function enqueueAssets()
	{
		wp_enqueue_script(
			'structure',
			$this->plugin->getUrl('assets/js/structure.js')
		);
	}
}
```

Another example is the `I18n` provider mentioned earlier. It receives a reference to the plugin object so that it can use the plugin's base name and slug to load the text domain.

Classes that extend `AbstractHookProvider` are automatically "plugin aware."

## License

Copyright (c) 2017 Cedaro, LLC
Copyright (c) 2019 Made In Italy SLC

This library is licensed under MIT.

Attribution is appreciated, but not required.
