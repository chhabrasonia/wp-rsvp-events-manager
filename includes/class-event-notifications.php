<?php
class WPEM_Notifications {

    public function __construct() {
        add_action('publish_event', [$this, 'send_event_email']);
        add_action('post_updated', [$this, 'send_update_email'], 10, 3);
    }

    /**
     ***************************
     * Send email on publish
     ****************************
     */
    public function send_event_email($post_id) {
        $this->send_email_to_users($post_id, 'New Event Published');
    }

    /**
     ****************************
     * Send email on update
     ****************************
     */
    public function send_update_email($post_id, $post_after, $post_before) {

        if ($post_after->post_type !== 'event') return;

        $this->send_email_to_users($post_id, 'Event Updated');
    }

    /**
     ****************************
     * Common email function
     ****************************
     */
    private function send_email_to_users($event_id, $subject_prefix) {

        $users = get_users();

        foreach ($users as $user) {

            $token = wp_create_nonce('rsvp_' . $event_id . '_' . $user->ID);

            $yes_link = add_query_arg([
                'rsvp_action' => 'yes',
                'event_id' => $event_id,
                'user_id' => $user->ID,
                'token' => $token
            ], home_url());

            $no_link = add_query_arg([
                'rsvp_action' => 'no',
                'event_id' => $event_id,
                'user_id' => $user->ID,
                'token' => $token
            ], home_url());

            $maybe_link = add_query_arg([
                'rsvp_action' => 'maybe',
                'event_id' => $event_id,
                'user_id' => $user->ID,
                'token' => $token
            ], home_url());

            $subject = "$subject_prefix: " . get_the_title($event_id);

            $message = "
            Hi {$user->display_name},

            Event: " . get_the_title($event_id) . "

            Please confirm your attendance:

            Yes: $yes_link
            No: $no_link
            Maybe: $maybe_link ";

            wp_mail($user->user_email, $subject, $message);
        }
    }
}

new WPEM_Shortcode();