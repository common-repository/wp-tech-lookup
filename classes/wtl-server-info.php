<?php
if (!class_exists('wtl_server_info')) {

    class wtl_server_info {

        private $details = array();
        private $min_php_version = '5.3';
        private $min_wp_version = '4.7.5';
        private $min_sql_version = '5.0.15';

        function __construct() {

            // Server Heading
            $this->details[] = array(
                'title' => 'Server Details:',
                'heading' => true
            );
            // Server Hostname
            $this->details[] = array(
                'title' => 'Server Hostname',
                'suggestion' => '',
                'require' => '',
                'value' => php_uname('n'),
                'tip' => '',
                'status' => ''
            );
            // Server IP
            $this->details[] = array(
                'title' => 'Server IP',
                'suggestion' => '',
                'require' => '',
                'value' => $_SERVER['SERVER_ADDR'],
                'tip' => '',
                'status' => ''
            );
            // Server Protocol
            $this->details[] = array(
                'title' => 'Server Protocol',
                'suggestion' => '',
                'require' => '',
                'value' => $_SERVER['SERVER_PROTOCOL'],
                'tip' => '',
                'status' => ''
            );
            // OS
            $this->details[] = array(
                'title' => 'Server Software',
                'suggestion' => '',
                'require' => '',
                'value' => $_SERVER['SERVER_SOFTWARE'],
                'tip' => '',
                'status' => ''
            );
            // Server Web Port
            $this->details[] = array(
                'title' => 'Server Web Port',
                'suggestion' => '',
                'require' => '',
                'value' => $_SERVER['SERVER_PORT'],
                'tip' => '',
                'status' => ''
            );
            if (isset($_SERVER['GATEWAY_INTERFACE'])) {
                // CGI Version
                $this->details[] = array(
                    'title' => 'CGI Version',
                    'suggestion' => '',
                    'require' => '',
                    'value' => $_SERVER['GATEWAY_INTERFACE'],
                    'tip' => '',
                    'status' => ''
                );
            }
            // OS
            $this->details[] = array(
                'title' => 'Operating System',
                'suggestion' => 'Linux',
                'require' => 'Linux',
                'value' => PHP_OS,
                'tip' => '',
                'status' => $this->check_status('Linux', PHP_OS)
            );

            //  PHP title
            $this->details[] = array(
                'title' => 'PHP Details:',
                'heading' => true
            );
            // PHP version
            $this->details[] = array(
                'title' => 'PHP Version',
                'suggestion' => '>= ' . $this->min_php_version,
                'require' => $this->min_php_version,
                'value' => phpversion(),
                'tip' => 'Version of PHP currently running on this site.',
                'status' => $this->check_status($this->min_php_version, phpversion(), 'version')
            );
            // REGISTER GLOBALS
            $this->details[] = array(
                'title' => 'PHP Register Globals',
                'suggestion' => 'disabled',
                'require' => 'disabled',
                'value' => ($this->ini_get_bool('register_globals') === true) ? 'enabled' : 'disabled',
                'tip' => '',
                'status' => $this->check_status('disabled', ($this->ini_get_bool('register_globals') === true) ? 'enabled' : 'disabled')
            );
            // MAGIC QUOTES GPC
            $this->details[] = array(
                'title' => 'PHP Magic Quotes GPC',
                'suggestion' => 'disabled',
                'require' => 'disabled',
                'value' => ($this->ini_get_bool('magic_quotes_gpc') === true) ? 'enabled' : 'disabled',
                'tip' => '',
                'status' => $this->check_status('disabled', ($this->ini_get_bool('magic_quotes_gpc') === true) ? 'enabled' : 'disabled')
            );
            // MAGIC QUOTES RUNTIME
            $this->details[] = array(
                'title' => 'PHP Magic Quotes Runtime',
                'suggestion' => 'disabled',
                'require' => 'disabled',
                'value' => ($this->ini_get_bool('magic_quotes_runtime') === true) ? 'enabled' : 'disabled',
                'tip' => '',
                'status' => $this->check_status('disabled', ($this->ini_get_bool('magic_quotes_runtime') === true) ? 'enabled' : 'disabled')
            );
            // SAFE MODE
            $this->details[] = array(
                'title' => 'PHP Safe Mode',
                'suggestion' => 'disabled',
                'require' => 'disabled',
                'value' => ($this->ini_get_bool('safe_mode') === true) ? 'enabled' : 'disabled',
                'tip' => '',
                'status' => $this->check_status('disabled', ($this->ini_get_bool('safe_mode') === true) ? 'enabled' : 'disabled')
            );
            // PHP Max execution time
            $this->details[] = array(
                'title' => 'PHP Max Execution Time',
                'suggestion' => '>= ' . '30 (seconds)',
                'require' => 30,
                'value' => ini_get('max_execution_time'),
                'tip' => '',
                'status' => $this->check_status(30, ini_get('max_execution_time'), 'number')
            );
            // MEMORY LIMIT
            $memoryLimit = $this->check_memory_limit();
            $this->details[] = array(
                'title' => 'PHP Memory Limit',
                'suggestion' => '>= 128M',
                'require' => '128',
                'value' => ini_get('memory_limit'),
                'tip' => '',
                'status' => $memoryLimit
            );
            $this->details[] = array(
                'title' => 'PHP Max Upload Size',
                'suggestion' => '',
                'require' => '',
                'value' => ini_get("upload_max_filesize"),
                'tip' => '',
                'status' => ''
            );            
            $this->details[] = array(
                'title' => 'Post Max Size',
                'suggestion' => '>= 8M',
                'require' => '8',
                'value' => ini_get('post_max_size'),
                'tip' => '',
                'status' => $this->check_status(8, ini_get('post_max_size'), 'number')
            );
            $this->details[] = array(
                'title' => 'PHP Max Input Vars',
                'suggestion' => '',
                'require' => '',
                'value' => ini_get('max_input_vars'),
                'tip' => '',
                'status' => ''
            );

            //  SQL title
            $this->details[] = array(
                'title' => 'Database Details:',
                'heading' => true
            );
            // SQL
            $this->details[] = array(
                'title' => 'Database Software',
                'suggestion' => '',
                'require' => '',
                'value' => $this->database_software(),
                'tip' => '',
                'status' => ''
            );
            $this->details[] = array(
                'title' => 'Max No. Of Connection',
                'suggestion' => '',
                'require' => '',
                'value' => $this->database_max_no_connection(),
                'tip' => '',
                'status' => ''/* $this->check_status(1, $this->database_max_no_connection(), 'number') */
            );
            global $wpdb;
            $this->details[] = array(
                'title' => 'MySQL Version',
                'suggestion' => '>= 5.0.15',
                'require' => $this->min_sql_version,
                'value' => $wpdb->db_version(),
                'tip' => '',
                'status' => $this->check_status($this->min_sql_version, $wpdb->db_version(), 'version')
            );
        }

        function check_status($require, $current, $compare = 'string') {
            $status = 'WARNING';
            if ($compare == 'number' && $require <= $current) {
                $status = "OK";
            } elseif ($compare == 'version' && version_compare($require, $current, '<=')) {
                $status = "OK";
            } elseif ($compare == 'string' && $require == $current) {
                $status = "OK";
            }
            return $status;
        }

        function check_memory_limit() {
            $memory_limit = ini_get('memory_limit');
            if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
                if ($matches[2] == 'M') {
                    $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                } else if ($matches[2] == 'K') {
                    $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
                }
            }
            $ok = ($memory_limit >= 128 * 1024 * 1024); // at least 64M?
            return ($ok ? 'OK' : 'WARNING');
        }

        function display_server_info() {

            foreach ($this->details as $info) {
                if (isset($info['heading'])): ?>
                    <tr class="wtl-table-head 
                        <td colspan="5"><strong><span><?php echo $info['title']; ?></span></strong></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><span><?php echo $info['title']; ?></span></td>
                        <td><span><?php echo $info['suggestion']; ?></span></td>
                        <td><span><?php echo $info['value']; ?></span></td>
                        <td><span><?php echo $info['status']; ?></span></td>
                        <td class="wtl-status-<?php echo strtolower($info['status']); ?>"><span class="status"></span></td>
                    </tr>
                <?php endif;
            }
        }

        private function ini_get_bool($a) {
            $b = ini_get($a);
            switch (strtolower($b)) {
                case 'on':
                case 'yes':
                case 'true':
                    return 'assert.active' !== $a;
                case 'stdout':
                case 'stderr':
                    return 'display_errors' === $a;
                default:
                    return (bool) (int) $b;
            }
        }

        private function database_software() {

            $db_software = get_transient('wpss_db_software');
            if ($db_software === FALSE) {
                global $wpdb;
                $db_software_query = $wpdb->get_row("SHOW VARIABLES LIKE 'version_comment'");
                $db_software_dump = $db_software_query->Value;
                if (!empty($db_software_dump)) {
                    $db_soft_array = explode(" ", trim($db_software_dump));
                    $db_software = $db_soft_array[0];
                    set_transient('wpss_db_software', $db_software, WEEK_IN_SECONDS);
                } else {
                    $db_software = __('N/A', 'wp-server-stats');
                }
            }
            return $db_software;
        }

        private function database_max_no_connection() {

            $db_max_connection = get_transient('wpss_db_max_connection');
            if ($db_max_connection === FALSE) {
                global $wpdb;
                $connection_max_query = $wpdb->get_row("SHOW VARIABLES LIKE 'max_connections'");
                $db_max_connection = $connection_max_query->Value;
                if (empty($db_max_connection)) {
                    $db_max_connection = __('N/A', 'wp-server-stats');
                } else {
                    $db_max_connection = number_format_i18n($db_max_connection, 0);
                    set_transient('wpss_db_max_connection', $db_max_connection, WEEK_IN_SECONDS);
                }
            }
            return $db_max_connection;
        }

    }

}