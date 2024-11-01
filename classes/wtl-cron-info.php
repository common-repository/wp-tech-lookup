<?php
if (!class_exists("wtl_cron_info")) {

    class wtl_cron_info {

        private $details = array();

        function __construct() {
            $crons = get_option('cron');
            $timeFormate = get_option('date_format') . ' ' . get_option('time_format');
            foreach ($crons as $key => $cron) {
                if (is_numeric($key)) {
                    foreach ($cron as $hook => $cron_details) {
                        $event_key = key($cron_details);
                        $this->details[] = array(
                            'event_time' => $key,
                            'event_name' => $hook,
                            'event_key' => $event_key,
                            'event_run_time' => date($timeFormate . ' ' . get_option('gmt_offset'), $key + ( get_option('gmt_offset') * 3600 )) . ' (' . $key . ')',
                            'event_schedule' => (isset($cron_details[$event_key]['schedule']) && !empty($cron_details[$event_key]['schedule'])) ? $cron_details[$event_key]['schedule'] : 'one time only',
                            'event_interval' => (isset($cron_details[$event_key]['interval']) && !empty($cron_details[$event_key]['interval'])) ? $cron_details[$event_key]['interval'] . ' Seconds ' : 'one time only',
                            'event_argu' => (isset($cron_details[$event_key]['args']) && !empty($cron_details[$event_key]['args'])) ? implode(', ', $cron_details[$event_key]['args']) : 'None',
                        );
                    }
                }
            }
            add_action('wp_ajax_wtl_cron_delete', array($this, 'wtl_cron_delete'));
            add_action('wp_ajax_nopriv_wtl_cron_delete', array($this, 'wtl_cron_delete'));
        }

        function display_info() {

            foreach ($this->details as $info) { ?>
                <div class="cron-schedules" id="<?php echo $info['event_name']; ?>">
                    <div class="cron-action"><strong>Event Action: </strong><?php echo $info['event_name']; ?> </div>
                    <div class="cron-key"><strong>Event Key: </strong><?php echo $info['event_key']; ?></div>
                    <div class="cron-time"><strong>Run Time: </strong> <?php echo $info['event_run_time']; ?></div>
                    <div class="cron-schedule"><strong>Schedule: </strong> <?php echo $info['event_schedule']; ?></div>
                    <div class="cron-interval"><strong>Interval: </strong> <?php echo $info['event_interval']; ?></div>
                    <div class="cron-argu"><strong>Arguments: </strong> <?php echo $info['event_argu']; ?></div>
                </div>
            <?php }
        }

        function wtl_cron_delete() {
            if (!current_user_can( 'manage_options' ) ) {
                return wp_send_json( array( 'result' => 'Authentication error' ) );
            }
            $time = intval($_POST['event_time']);
            $hook = $_POST['event_hook'];
             $timestamp = wp_next_scheduled($hook);
            if (!empty($time) && !empty($hook)) {
                $original_args = array();
                $wtl_result = wp_unschedule_event($timestamp, $hook, $original_args);
                if ($wtl_result == null || !isset($wtl_result) || empty($wtl_result) || $wtl_result != false ) {
                    echo 1;
                } else {
                    echo "Cron is not deleted";
                }
            } else {
                echo 0;
            }
            exit();
        }
    }
    $wtl_cron_info = new wtl_cron_info();
}

