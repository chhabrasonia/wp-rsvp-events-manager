<?php

class WPEM_Shortcode {

    public function __construct() {
        add_shortcode('event_list', [$this, 'render_shortcode']);
    }

    /**
     ***************************
     * Shortcode Render
     * ***************************
     */
    public function render_shortcode() {

        // Sanitize GET params
        $type   = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
        $start  = isset($_GET['start']) ? sanitize_text_field($_GET['start']) : '';
        $end    = isset($_GET['end']) ? sanitize_text_field($_GET['end']) : '';
        $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

        // Get events
        $events = $this->get_filtered_events($type, $start, $end, $search);

        // Load template
        ob_start();

        $template = WPEM_PATH . 'templates/shortcode-event-filter.php';

        if (file_exists($template)) {
            include $template;
        } else {
            echo '<p>Template not found</p>';
        }

        return ob_get_clean();
    }

    /**
     **************************************
     * Get filtered events with caching
     **************************************
     */
    private function get_filtered_events($type, $start, $end, $search) {

        // Create unique cache key
        $cache_key = 'event_filter_' . md5($type . $start . $end . $search);

        // Try cache
        $events = get_transient($cache_key);

        if ($events !== false) {
            return $events;
        }

        /**
         *******************
         * Base Query
         *******************
         */
        $args = [
            'post_type' => 'event',
            'posts_per_page' => -1,
        ];

        /**
         *******************
         * SEARCH
         ********************
         */
        if (!empty($search)) {
            $args['s'] = $search;
        }

        /**
         *******************
         * TAXONOMY FILTER
         *******************
         */
        if (!empty($type)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'event_type',
                    'field'    => 'slug',
                    'terms'    => $type,
                ]
            ];
        }

        /**
         ******************
         * DATE FILTER
         *******************
         */
        if ($start || $end) {

            $meta_query = [
                'key'  => '_event_date',
                'type' => 'DATE',
            ];

            if ($start && $end) {
                // BETWEEN
                $meta_query['value'] = [$start, $end];
                $meta_query['compare'] = 'BETWEEN';

            } elseif ($start) {
                // >= start
                $meta_query['value'] = $start;
                $meta_query['compare'] = '>=';

            } elseif ($end) {
                // <= end
                $meta_query['value'] = $end;
                $meta_query['compare'] = '<=';
            }

            $args['meta_query'][] = $meta_query;
        }

        /**
         ********************
         * EXECUTE QUERY
         ********************
         */
        $query = new WP_Query($args);
        $events = $query->posts;

        /**
         *********************
         * CACHE RESULTS
         *********************
         */
        set_transient($cache_key, $events, HOUR_IN_SECONDS);

        return $events;
    }
}
	new WPEM_Shortcode();
?>