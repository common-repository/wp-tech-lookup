<?php
if (!class_exists('wtl_database_info')) {

    class wtl_database_info {

        private $details = array();

        function __construct() {
            global $wpdb;
            $tables = $wpdb->get_results('SHOW TABLE STATUS', OBJECT);
            $total_rows = $total_size = 0;

            foreach ($tables as $table) {
                $this->details[] = array(
                    'title' => $table->Name,
                    'engine' => $table->Engine,
                    'update_time' => $table->Update_time,
                    'rows' => $table->Rows,
                    'size' => $table->Data_length + $table->Index_length,
                );
                $total_size += $table->Data_length + $table->Index_length;
                $total_rows += $table->Rows;
            }
            $this->details[] = array(
                'title' => "&nbsp;",
                'engine' => "&nbsp;",
                'update_time' => "<strong>TOTALS: </strong>",
                'rows' => '<strong>'.$total_rows.'<strong>',
                'size' => '<strong>'.$total_size.'<strong>',
            );
        }

        function display_info() {

            foreach ($this->details as $info) { ?>
                <tr>
                    <td><span><?php echo $info['title']; ?></span></td>
                    <td><span><?php echo $info['engine']; ?></span></td>
                    <td><span><?php echo $info['update_time']; ?></span></td>
                    <td><span><?php echo $info['rows']; ?></span></td>
                    <td><span><?php echo $info['size']; ?> KB</span></td>
                </tr>
        <?php }
        }
    }
}