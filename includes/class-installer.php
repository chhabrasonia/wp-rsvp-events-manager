<?php
	class WPEM_Installer {

	    public static function activate() {
	        WPEM_Event::register(); 
	        self::create_rsvp_table();
	        flush_rewrite_rules();
	    }

	    public static function deactivate() {
	        flush_rewrite_rules();
	    }

	    /*
		************************
		 * Create RSVP Table
		************************
 		*/
	    private static function create_rsvp_table() {
	        global $wpdb;
	        $table = $wpdb->prefix . 'event_rsvp';

	        $sql = "CREATE TABLE IF NOT EXISTS $table (
	            id         BIGINT AUTO_INCREMENT PRIMARY KEY,
	            event_id   BIGINT NOT NULL,
	            user_id    BIGINT NOT NULL,
	            status     VARCHAR(10) NOT NULL DEFAULT 'yes',
	            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	            UNIQUE KEY unique_rsvp (event_id, user_id)
	        ) " . $wpdb->get_charset_collate();

	        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	        dbDelta($sql);
    	}
	}

?>