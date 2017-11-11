<?php

namespace Sehrgut\WpSitePlugin\Tasks;

/**
 *  Create custom options pages using ACF
 */
class CreateOptionsPages extends Task
{
    /**
     * {@inheritdoc}
     */
    protected $hooks = [
        'init' => 'createOptionsPages'
    ];

    /**
     * Create options pages if ACF is present.
     *
     * @return void
     */
    public function createOptionsPages()
    {
        if( function_exists('acf_add_options_page') ) {

            // "Integrations" page
            acf_add_options_page([
                'page_title' => __('Integrations', 'wp-site-plugin'),
                'menu_title' => __('Integrations', 'wp-site-plugin'),
                'menu_slug' => 'integrations',
                'icon_url' => 'dashicons-editor-code'
            ]);
        }
    }
}
