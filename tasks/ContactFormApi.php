<?php

namespace Sehrgut\WpSitePlugin\Tasks;

use \WP_REST_Request;
use \WP_REST_Response;

// Prevent user from directly executing this file.
defined('ABSPATH') or die(__('Mach koan Schmarrn!', 'wp-site-plugin'));

/**
 * Add an Endpoint to the WP REST API to handle a contact
 * form and send out an email to the admin of the site.
 *
 * At its default settings, the endpoint accepts POST requests
 * with a JSON payload at `/wp-json/contact-form/v1/submit`.
 */
class ContactFormApi extends Task
{
    /**
     * {@inheritdoc}
     */
    protected $hooks = [
        'rest_api_init' => 'registerEndpoint',
    ];

    /**
     * Prefix to the url of the endpoint.
     *
     * @var string
     */
    protected $url_namespace = 'contact-form/v1';

    /**
     * Second part of the url. Append to `$url_namespace`
     * to get the full path of the endpoint.
     *
     * @var string
     */
    protected $url_location = '/submit';

    /**
     * Register our endpoint with the REST API.
     *
     * @return void
     */
    public function registerEndpoint()
    {
        register_rest_route($this->url_namespace, $this->url_location, [
            'methods' => 'POST',
            'callback' => [$this, 'handle'],
        ]);
    }

    /**
     * Handle requests to the API endpoint.
     *
     * @param WP_REST_Request $request
     * @return void
     */
    public function handle(WP_REST_Request $request)
    {
        $recipient = $this->getRecipientAddress();
        $subject = $this->getSubject($request);
        $message = json_encode($request->get_json_params(), JSON_PRETTY_PRINT);

        if (wp_mail($recipient, $subject, $message)) {
            return new WP_REST_Response(__('Thank you for your message!', 'wp-site-plugin'), 200);
        }
        else {
            return new WP_REST_Response(__('There was an error submitting your message!', 'wp-site-plugin'), 500);
        }
    }

    /**
     * Retrieve the recipient email address.
     *
     * By default, the wp `admin_email` is used. It can be changed
     * through the `contact_form_recipient_address` filter.
     *
     * @return string
     */
    protected function getRecipientAddress()
    {
        $admin_email = get_option('admin_email');
        return apply_filters('contact_form_recipient_address', $admin_email);
    }

    /**
     * Get the email subject.
     *
     * Can be overridden through the `contact_form_subject` filter, which
     * will get the WP_REST_Request object as its second parameter.
     *
     * @param  WP_REST_Request $request
     * @return string
     */
    protected function getSubject(WP_REST_Request $request)
    {
        $default_subject = __('New message through a contact form', 'wp-site-plugin');
        return apply_filters('contact_form_subject', $default_subject, $request);
    }
}