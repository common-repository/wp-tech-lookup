<?php
if (!function_exists('wtl_tech_lookup')) {

    function wtl_tech_lookup() {
        ?>

        <div class="wrap wtl-main">
            <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
            <hr class="wp-header-end">

            <div id="post-body" class="metabox-holder columns-3">
                <div id="postbox-container-1" class="postbox-container">

                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">

                        <div class="postbox " style="display: block;">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Hosting Server Info</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>Hosting Server Info</span></h2>
                            <div class="inside">
                                <table class="wp-list-table widefat fixed striped posts">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Parameter</span></th>
                                            <th scope="col" class="manage-column"><span>Suggestion</span></th>
                                            <th scope="col" class="manage-column"><span>Value</span></th>
                                            <th scope="col" class="manage-column"><span>Result</span></th>
                                            <th scope="col" class="manage-column"><span>Status</span></th>
                                        </tr>
                                    </thead>

                                    <tbody id="the-list">
                                        <?php
                                        $wtl_server_info = new wtl_server_info();
                                        $wtl_server_info->display_server_info();
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Parameter</span></th>
                                            <th scope="col" class="manage-column"><span>Suggestion</span></th>
                                            <th scope="col" class="manage-column"><span>Value</span></th>
                                            <th scope="col" class="manage-column"><span>Result</span></th>
                                            <th scope="col" class="manage-column"><span>Status</span></th>                                            
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        
                        <div class="postbox " style="display: block;">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: WordPress Info</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>WordPress Info</span></h2>
                            <div class="inside">
                                <table class="wp-list-table widefat fixed striped posts">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Parameter</span></th>
                                            <th scope="col" class="manage-column"><span>Value</span></th>
                                        </tr>
                                    </thead>

                                    <tbody id="the-list">
                                        <?php
                                        $wtl_wordpress_info = new wtl_wordpress_info();
                                        $wtl_wordpress_info->display_info();
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Parameter</span></th>
                                            <th scope="col" class="manage-column"><span>Value</span></th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        <div class="postbox " style="display: block;">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: File Permissions</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>File Permissions</span></h2>
                            <div class="inside">
                                <table class="wp-list-table widefat fixed striped posts">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Relative Path</span></th>
                                            <th scope="col" class="manage-column"><span>Suggestion</span></th>
                                            <th scope="col" class="manage-column"><span>Value</span></th>
                                            <th scope="col" class="manage-column"><span>Result</span></th>
                                            <th scope="col" class="manage-column"><span>Status</span></th>
                                        </tr>
                                    </thead>

                                    <tbody id="the-list">
                                        <?php
                                        $folder_info = new wtl_filepermissions_info();
                                        $folder_info->display_info();
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Relative Path</span></th>
                                            <th scope="col" class="manage-column"><span>Suggestion</span></th>
                                            <th scope="col" class="manage-column"><span>Value</span></th>
                                            <th scope="col" class="manage-column"><span>Result</span></th>
                                            <th scope="col" class="manage-column"><span>Status</span></th>                                            
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        <div class="postbox " style="display: block;">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: DataBase/Table size</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>DataBase/Table size</span></h2>
                            <div class="inside">
                                <table class="wp-list-table widefat fixed striped posts">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Database Table</span></th>
                                            <th scope="col" class="manage-column"><span>Engine</span></th>
                                            <th scope="col" class="manage-column"><span>Last Updated</span></th>
                                            <th scope="col" class="manage-column"><span>Rows</span></th>
                                            <th scope="col" class="manage-column"><span>Size</span></th>
                                        </tr>
                                    </thead>

                                    <tbody id="the-list">
                                        <?php
                                        $database_info = new wtl_database_info();
                                        $database_info->display_info();
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th scope="col" class="manage-column"><span>Database Table</span></th>
                                            <th scope="col" class="manage-column"><span>Engine</span></th>
                                            <th scope="col" class="manage-column"><span>Last Updated</span></th>
                                            <th scope="col" class="manage-column"><span>Rows</span></th>
                                            <th scope="col" class="manage-column"><span>Size</span></th>                                            
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        <div class="postbox " style="display: block;">
                            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">Toggle panel: WordPress Scheduled Actions (CRON)</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>WordPress Scheduled Actions (CRON) </span></h2>
                            <div class="inside">
                                <div class="wtl-cron-warning"></div>
                                <?php
                                $wtl_cron_info = new wtl_cron_info();
                                $wtl_cron_info->display_info();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <?php
    }

}
