<?php

namespace Sehrgut\WpSitePlugin\Tasks;

/**
 * <task_description_here>
 *
 * TODO: Don't forget to "require" this file and register the task
 *       in the `$tasks` array in your main plugin php file.
 */
class ExampleTask extends Task
{
    /**
     * {@inheritdoc}
     */
    protected $hooks = [
        'init' => 'myCallback',
        'some_filter' => ['myCallbackWithParameters', 10, 2],
    ];

    public function myCallback()
    {
        // Your code goes here
    }
}
