<?php
/**
 * Plugin Name: wp-site-plugin
 * Author: Sehr gute Software <dev@sehrgute.software>
 * Description: Plugin defining model logic and other customizations for a WP site.
 * Version: 1.0.0
 * Text Domain: wp-site-plugin
 * Domain Path: /languages
 */

namespace Sehrgut\WpSitePlugin;

require_once('tasks/Task.php');
require_once('tasks/CreateOptionsPages.php');
require_once('tasks/FooterScripts.php');
require_once('tasks/RegisterTaxonomies.php');
require_once('tasks/RegisterPostTypes.php');

// Prevent user from directly executing this file.
defined('ABSPATH') or die(__('Mach koan Schmarrn!', 'wp-site-plugin'));

/**
 * This class is just a loader for all the registered `$tasks`.
 */
class Plugin
{
    public static $plugin_path;

    /**
     * List all the tasks to be loaded.
     *
     * @var array
     */
    protected $tasks = [
        Tasks\CreateOptionsPages::class,
        Tasks\FooterScripts::class,
        Tasks\RegisterTaxonomies::class,
        Tasks\RegisterPostTypes::class
    ];

    /**
     * Contains the instantiated tasks.
     *
     * @var array
     */
    protected $task_instances = [];

    public function __construct()
    {
        // Determine the absolute path to the plugin directory
        self::$plugin_path = static::getPluginDirPath();

        // Abort plugin activation if dependencies are unmet
        register_activation_hook(__FILE__, [$this, 'checkDependencies']);

        // Bind plugin initialization to the appropriate hook
        add_action('plugins_loaded', [$this, 'bootstrap']);
    }

    /**
     * Bootstrap the plugin: Load all tasks.
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->loadTextdomain();
        $this->loadTasks();
    }

    /**
     * Make sure required plugins are installed.
     *
     * @return void
     */
    protected function checkDependencies()
    {
        //
    }

    /**
     * Load translations.
     *
     * @return void
     */
    protected function loadTextdomain()
    {
        load_plugin_textdomain('wp-site-plugin', null, 'wp-site-plugin/languages');
    }

    /**
     * Load all the individual tasks in the stated order.
     *
     * @return void
     */
    protected function loadTasks()
    {
        foreach ($this->tasks as $task) {
            $this->task_instances[] = new $task($this);
        }
    }

    /**
     * Get the path to the plugin directory.
     *
     * When running on trellis, use the `current` directory
     * instead of `releases/\d+`.
     *
     * @return string
     */
    protected static function getPluginDirPath()
    {
        return preg_replace('/\/releases\/\d+\//i', '/current/', plugin_dir_path(__FILE__));
    }
}

$Plugin = new Plugin();
