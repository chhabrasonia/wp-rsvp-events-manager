<?php
class WPEM_Admin_Columns {

    public function __construct() {
        add_filter('manage_event_posts_columns', [$this, 'add_columns']);
        add_action('manage_event_posts_custom_column', [$this, 'render'], 10, 2);
    }


    public function add_columns($columns) {
        
        // Remove default date
        $date = $columns['date'];
        unset($columns['date']);

        $columns['event_date'] = __('Event Date', WPEM_TEXT_DOMAIN);
        $columns['location']   = __('Location', WPEM_TEXT_DOMAIN);

        // Add date at end
        $columns['date'] = $date;

        return $columns;
    }

    public function render($column, $post_id) {

        if ($column === 'event_date') {
            echo esc_html(get_post_meta($post_id, '_event_date', true));
        }

        if ($column === 'location') {
            echo esc_html(get_post_meta($post_id, '_location', true));
        }
    }
}

new WPEM_Admin_Columns();