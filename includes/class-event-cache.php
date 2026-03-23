<?php
class WPEM_Cache {

    /**
     **********************************************************************
     * Called on event save and delete so listings never show stale data.
     **********************************************************************
     */
    public static function flush() {
        global $wpdb;
        $wpdb->query(
            "DELETE FROM {$wpdb->options}
             WHERE option_name LIKE '_transient_event_filter_%'
             OR option_name LIKE '_transient_timeout_event_filter_%'"
        );
    }
}

/********* Clear cache whenever an event is saved ************/
add_action( 'save_post_event', array( 'WPEM_Cache', 'flush' ) );

/********** Clear cache whenever an event is deleted ************/
add_action( 'delete_post', function( $post_id ) {
    if ( get_post_type( $post_id ) === 'event' ) {
        WPEM_Cache::flush();
    }
} );
