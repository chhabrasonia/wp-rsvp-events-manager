<?php
	class Event_Installer {

	    public static function activate() {
	        Event::register(); 
	        self::create_rsvp_table();
	        flush_rewrite_rules();
	    }

	    public static function deactivate() {
	        flush_rewrite_rules();
	    }

	    private static function create_rsvp_table() {
	        global $wpdb;
	        $table = $wpdb->prefix . 'event_rsvp';

	        $sql = "CREATE TABLE $table (
	            id BIGINT AUTO_INCREMENT PRIMARY KEY,
	            event_id BIGINT,
	            user_id BIGINT,
	            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	            UNIQUE KEY unique_rsvp (event_id, user_id)
	        ) " . $wpdb->get_charset_collate();

	        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	        dbDelta($sql);
    	}
	}

?>