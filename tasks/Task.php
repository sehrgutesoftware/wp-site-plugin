<?php

namespace Sehrgut\WpSitePlugin\Tasks;

/**
 * Base Class for a task.
 *
 * A task is a single feature to be added or a single modification to be made.
 * You can bind public methods to action/filters hooks via the $hooks array.
 */
class Task
{
    /**
     * A reference to the base plugin.
     *
     * @var SehrGut\WpSitePlugin\Plugin
     */
    protected $plugin;

    /**
     * Bind methods to hooks like this:
     *
     *     'hook_name' => 'method_name'
     *         or
     *     'hook_name' => ['method_name', prio, arguments]
     *
     * Methods must be public.
     *
     * @var array
     */
    protected $hooks = [];

    /**
     * Construct a new instance of the task.
     *
     * Should be called during `plugins_loaded`. Registers hooks.
     *
     * @param SehrGut\WpSitePlugin\Plugin &$plugin A reference to the plugin
     */
    public function __construct(&$plugin)
    {
        $this->plugin = $plugin;
        $this->registerHooks();
    }

    /**
     * Loop through $hooks and bind methods.
     *
     * @return $this
     */
    private function registerHooks()
    {
        foreach ($this->hooks as $hook => $method) {
            if (is_string($method)) {
                add_filter($hook, [$this, $method]);
            }
            elseif (is_array($method)) {
                add_filter($hook, [$this, $method[0]], $method[1], $method[2]);
            }
        }
        return $this;
    }
}
