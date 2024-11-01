<?php
if (!class_exists('wtl_filepermissions_info')) {

    class wtl_filepermissions_info {

        // Array of folders to check 
        private $folders = array();
        private $details = array();

        function __construct() {

            $upload_dir = wp_upload_dir();
            $this->folders[] = get_home_path();
            $this->folders[] = $this->wtl_get_admin_path();
            $this->folders[] = WP_CONTENT_DIR;
            $this->folders[] = get_home_path() . WPINC;
            $this->folders[] = WP_PLUGIN_DIR;
            $this->folders[] = $upload_dir['basedir'];
            $this->folders[] = get_theme_root();
            
            foreach ($this->folders as $key => $folder) {
                if (is_dir($folder)) {
                    $permission = substr(sprintf('%o', fileperms($folder)), -4);
                    $this->details[] = array(
                        'title' => str_replace(get_home_path(), '', $folder) . '/',
                        'suggestion' => '= 755',
                        'value' => $permission,
                        'status' => $this->check_status($permission)
                    );
                } else {
                    $this->details[] = array(
                        'title' => $folder,
                        'suggestion' => '= 755',
                        'value' => 'Directory not exists',
                        'status' => 'WARNING'
                    );
                }
            }
        }

        function display_info() {

            foreach ($this->details as $info) { ?>
                <tr>
                    <td><span><?php echo $info['title']; ?></span></td>
                    <td><span><?php echo $info['suggestion']; ?></span></td>
                    <td><span><?php echo $info['value']; ?></span></td>
                    <td><span><?php echo $info['status']; ?></span></td>
                    <td class="wtl-status-<?php echo strtolower($info['status']); ?>"><span class="status"></span></td>
                </tr>
        <?php }
        }

        function check_status($current_permission) {

            $status = 'OK';
            if ($current_permission != 755) {
                $status = "WARNING";
            }
            return $status;
        }

        /**
         * Obtain the path to the admin directory.
         *
         * @return string
         */
        function wtl_get_admin_path() {
            // Replace the site base URL with the absolute path to its installation directory. 
            $admin_path = rtrim(str_replace(get_bloginfo('url') . '/', ABSPATH, get_admin_url()), '/');

            // Make it filterable, so other plugins can hook into it.
            $admin_path = apply_filters('my_plugin_get_admin_path', $admin_path);
            return $admin_path;
        }

    }

}
