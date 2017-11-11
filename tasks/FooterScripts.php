<?php

namespace Sehrgut\WpSitePlugin\Tasks;

/**
 * Add a global field to the "Integrations" options page to allow
 * the user to add custom code to the page footer.
 *
 * Important: Load this task after the "CreateOptionsPages" task!
 */
class FooterScripts extends Task
{
    /**
     * {@inheritdoc}
     */
    protected $hooks = [
        'admin_init' => 'registerCustomField',
        'wp_footer' => ['outputScriptsToFooter', 100, 0],
    ];

    public function outputScriptsToFooter()
    {
        if ($scripts = the_field('footer_scripts', 'options')) {
            echo $scripts;
        }
    }

    public function registerCustomField()
    {
        if( function_exists('acf_add_local_field_group') ) {

            acf_add_local_field_group(array (
                'key' => 'group_585000d66c4b0',
                'title' => 'Footer Scripts',
                'fields' => array (
                    array (
                        'default_value' => '',
                        'new_lines' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'rows' => 12,
                        'key' => 'field_5850012a317ea',
                        'label' => 'Footer Scripts',
                        'name' => 'footer_scripts',
                        'type' => 'textarea',
                        'instructions' => 'Add custom scripts to the footer of each page. You can paste in for example the Google Analytics &lt;script&gt; code.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'integrations',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ));

        }
    }
}
