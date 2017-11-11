<?php

namespace Sehrgut\WpSitePlugin\Models;

// Prevent user from directly executing this file.
defined('ABSPATH') or die(__('Mach koan Schmarrn!', 'wp-site-plugin'));

class ExampleModel extends Model
{
    protected $name = 'vegetable';

    protected function getPostType()
    {
        return  [
            'labels' => [
                'name' => __('Vegetables', 'wp-site-plugin'),
                'singular_name' => __('Vegetable', 'wp-site-plugin'),
                'add_new_item' => __('Add New Vegetable', 'wp-site-plugin'),
                'edit_item' => __('Edit Vegetable', 'wp-site-plugin'),
                'new_item' => __('New Vegetable', 'wp-site-plugin'),
                'view_item' => __('View Vegetable', 'wp-site-plugin'),
                'search_items' => __('Search Vegetables', 'wp-site-plugin'),
                'not_found' => __('No vegetables found', 'wp-site-plugin'),
                'not_found_in_trash' => __('No vegetables found in Trash', 'wp-site-plugin'),
                'parent_item_colon' => __('Vegetable Page:', 'wp-site-plugin'),
                'all_items' => __('All Vegetables', 'wp-site-plugin'),
                'archives' => __('Vegetable Archives', 'wp-site-plugin'),
                'insert_into_item' => __('Insert into vegetable', 'wp-site-plugin'),
                'uploaded_to_this_item' => __('Uploaded to this vegetable', 'wp-site-plugin'),
                'featured_image' => __('Vegetable-Cover', 'wp-site-plugin'),
                'set_featured_image' => __('Set vegetable cover', 'wp-site-plugin'),
                'remove_featured_image' => __('Remove vegetable cover', 'wp-site-plugin'),
                'use_featured_image' => __('Use as vegetable cover', 'wp-site-plugin'),
            ],
            'rewrite' => ['slug' => _x('vegetables', 'slug', 'wp-site-plugin')],
            'has_archive' => true,
            'public' => true,
            'show_ui' => true,
            'menu_icon' => 'dashicons-carrot',
            'taxonomies' => ['tags', 'colors'],
            'supports' => [
                'title', 'thumbnail', 'comments', 'revisions', 'editor'
            ]
        ];
    }

    protected function getCustomFields()
    {
        return [
            [
                'key' => 'field_12ff1b9b0300',
                'label' => __('This is a Tab', 'wp-site-plugin'),
                'type' => 'tab'
            ]
        ];
    }
}
