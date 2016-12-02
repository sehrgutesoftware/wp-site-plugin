<?php

namespace Sehrgut\WpSitePlugin\Tasks;

// Prevent user from directly executing this file.
defined('ABSPATH') or die(__('Mach koan Schmarrn!', 'wp-site-plugin'));

/**
 *  Define custom post taxonomies in this task.
 */
class RegisterTaxonomies extends Task
{
    /**
     * {@inheritdoc}
     */
    protected $hooks = [
        'init' => 'registerTaxonomies'
    ];

    public function registerTaxonomies()
    {
        register_taxonomy('colors', null, [
            'label' => 'Colors',
            'show_ui' => true,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true
        ]);
    }
}