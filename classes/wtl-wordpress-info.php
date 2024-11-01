<?php

if (!class_exists('wtl_wordpress_info')) {

    class wtl_wordpress_info {

        
        private $details = array();

        /**
         * @description: Get all rquired
         * 
         * @global type 
         */
        function __construct() {

            // WP version
            global $wp_version;
            $this->details[] = array(
                'title' => 'WordPress Version',
                'value' => $wp_version
            );

            $this->details[] = array(
                'title' => 'WordPress Multisite',
                'value' => ( is_multisite() ) ? __('Yes') : __('No')
            );

            $this->details[] = array(
                'title' => 'WordPress Memory Limit',
                'value' => size_format(wp_max_upload_size())
            );

            // Current theme name
            $theme_details = wp_get_theme();
            $this->details[] = array(
                'title' => 'Active Theme',
                'value' => $theme_details->get('Name')
            );

            // Theme Version
            $this->details[] = array(
                'title' => 'Current Theme Version',
                'value' => $theme_details->get('Version')
            );

            // Theme Author
            $this->details[] = array(
                'title' => 'Current Theme Author',
                'value' => $theme_details->get('Author')
            );

            $this->details[] = array(
                'title' => 'Active Plugins',
                'value' => count((array) get_option('active_plugins'))
            );

            // Registerd Posttypes
            $custom_posts = get_post_types(array('public' => true, '_builtin' => false), 'names');
            $this->details[] = array(
                'title' => 'Custom Post Types',
                'value' => (is_array($custom_posts) && !empty($custom_posts)) ? implode(', ', $custom_posts) : 'No CPT registerd'
            );

            // Database Hostname
            $this->details[] = array(
                'title' => 'Database Hostname',
                'value' => DB_HOST
            );

            // Database Name
            $this->details[] = array(
                'title' => 'Database Name',
                'value' => DB_NAME
            );

            // Database User Name
            $this->details[] = array(
                'title' => 'Database Username',
                'value' => DB_USER
            );

            // Database Charset
            $this->details[] = array(
                'title' => 'Database Charset',
                'value' => DB_CHARSET
            );

            $db_collate = DB_COLLATE;
            if (!empty($db_collate)) {
                // Database Collation
                $this->details[] = array(
                    'title' => 'Database Collation',
                    'value' => DB_COLLATE
                );
            }

            // Wordpress Debugging
            $this->details[] = array(
                'title' => 'Wordpress Debugging',
                'value' => (WP_DEBUG) ? 'Enabled' : 'Disabled'
            );
        }

        /**
         * @Description Display information of WordPress.
         */
        function display_info() {

            foreach ($this->details as $info) {
                ?>
                <tr>
                    <td><span><?php echo $info['title']; ?></span></td>
                    <td><span><?php echo $info['value']; ?></span></td>
                </tr>
                <?php
            }
        }

    }

}
