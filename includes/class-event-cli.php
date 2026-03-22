<?php
class Event_CLI {
    public function generate() {
        wp_insert_post([
            'post_type' => 'event',
            'post_title' => 'CLI Event',
            'post_status' => 'publish'
        ]);
    }
}
WP_CLI::add_command('event generate', ['Event_CLI', 'generate']);