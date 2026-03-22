<?php
class WPEM_RSVP {

    public function __construct() {
        add_action('init', [$this, 'handle_rsvp']);
    }

    public function handle_rsvp() {

        if (!isset($_GET['rsvp_action'], $_GET['event_id'], $_GET['user_id'], $_GET['token'])) {
            return;
        }

        $event_id = intval($_GET['event_id']);
        $user_id  = intval($_GET['user_id']);
        $status   = sanitize_text_field($_GET['rsvp_action']);
        $token    = sanitize_text_field($_GET['token']);

        /********** Validate token ***********/

        if (!wp_verify_nonce($token, 'rsvp_' . $event_id . '_' . $user_id)) {
             wp_die(__('Invalid RSVP link', WPEM_TEXT_DOMAIN));
        }

        global $wpdb;
        $table = $wpdb->prefix . 'event_rsvp';

        /********** Check existing RSVP ***********/

        $existing = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id FROM $table WHERE event_id = %d AND user_id = %d",
                $event_id,
                $user_id
            )
        );

        if ($existing) {

            /********** Update ***********/

            $wpdb->update(
                $table,
                ['status' => $status],
                ['event_id' => $event_id, 'user_id' => $user_id]
            );
        } else {

            /********** Insert ***********/

            $wpdb->insert($table, [
                'event_id' => $event_id,
                'user_id'  => $user_id,
                'status'   => $status,
                'created_at' => current_time('mysql')
            ]);
        }

        /********** Redirect to thank you page ***********/
        wp_redirect(home_url('/thank-you'));
        exit;
    }
}
new WPEM_RSVP();