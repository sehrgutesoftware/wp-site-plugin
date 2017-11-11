<?php

namespace Sehrgut\WpSitePlugin\Models;

// Prevent user from directly executing this file.
defined('ABSPATH') or die(__('Mach koan Schmarrn!', 'wp-site-plugin'));

/**
 * Base Class for a model.
 *
 * A model is the definiton of a custom post type along with custom fields.
 */
abstract class Model
{
    /**
     * Store the name of the model. This is used for the custom post type.
     *
     * @var string
     */
    protected $name;

    /**
     * Return parameters for `register_post_type()` here.
     *
     * @return array
     */
    protected abstract function getPostType();

    /**
     * Return custom field definitions for this model.
     *
     * @return array
     */
    protected abstract function getCustomFields();


    public function __construct()
    {
        $this->registerHooks();
    }

    /**
     * Bind to the appropriate hooks to create the post type
     * and register the custom fields with acf pro.
     *
     * @return $this
     */
    private function registerHooks()
    {
        add_action('init', [$this, 'registerPostType']);
        add_action('acf/init', [$this, 'registerCustomFields']);

        // By implementing `onAcfInit`, you can execute additional
        // logic in your model during the `acf/init` hook.
        if (method_exists($this, 'onAcfInit')) {
            add_action('acf/init', [$this, 'onAcfInit']);
        }

        if (method_exists($this, 'getAdminColumns')) {
            add_action(sprintf('manage_%s_posts_columns', $this->name), [$this, 'adminColumns']);
            add_action(sprintf('manage_%s_posts_custom_column', $this->name), [$this, 'adminColumnContent'], 10, 2);
        }

        return $this;
    }

    /**
     * Registers a post type for this model.
     *
     * @return $this
     */
    public function registerPostType()
    {
        register_post_type($this->name, $this->getPostType());

        return $this;
    }

    /**
     * Registers custom fields for the post type.
     *
     * @return $this
     */
    public function registerCustomFields()
    {
        acf_add_local_field_group([
            'key' => sprintf('post_type_%s', $this->name),
            'title' => sprintf(_x('%s Admin', 'Name of the field group for post type', 'wp-site-plugin'), ucfirst($this->name)),
            'fields' => $this->getCustomFields(),
            'style' => 'seamless',
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => $this->name,
                    ],
                ],
            ],
            'hide_on_screen' => [
            // 'permalink',
            // 'the_content',
            // 'excerpt',
            'custom_fields',
            'discussion',
            'comments',
            'revisions',
            'slug',
            'author',
            'format',
            'page_attributes',
            // 'featured_image',
            // 'categories',
            // 'tags',
            'send-trackbacks',
      ],
        ]);

        return $this;
    }

    /**
     * Register custom admin columns.
     *
     * @return array
     */
    public function adminColumns($columns)
    {
        foreach ($this->getAdminColumns() as $key => $column) {
            $columns[$key] = $column['title'];
        }

        return $columns;
    }

    /**
     * Output the content of custom admin columns.
     *
     * @param  string $column  Name of the column as set in `adminColumns` (key)
     * @param  int $post_id Id of the currently rendered post
     * @return void
     */
    public function adminColumnContent($column, $post_id)
    {
        $columns = $this->getAdminColumns();
        if (array_key_exists($column, $columns)) {
            $field = $columns[$column]['meta_key'];
            echo get_post_meta($post_id, $field, true);
        }
    }
}
