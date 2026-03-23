<?php
class WPEM_Notifications {

    public function __construct() {
        add_action( 'publish_event', array( $this, 'send_event_email' ), 10, 2 );
    }

    /**
     *****************************************
     * Send email on publish post or updated
     ******************************************
     */

    public function send_event_email( $post_id, $post ) {

        /******* First publish *******/
        if ( ! get_post_meta( $post_id, '_wpem_publish_notified', true ) ) {
            $this->send_email_to_users( $post_id, __( 'New Event Published', WPEM_TEXT_DOMAIN ) );
            update_post_meta( $post_id, '_wpem_publish_notified', 1 );
            return;
        }

        /******** Every update after that ******/
        $this->send_email_to_users( $post_id, __( 'Event Updated', WPEM_TEXT_DOMAIN ) );
    }


    /**
     ********************
     * Email Content 
     ********************
     */

    private function send_email_to_users( $event_id, $subject_prefix ) {

        $users = get_users();

        foreach ( $users as $user ) {

            $token = wp_create_nonce( 'rsvp_' . $event_id . '_' . $user->ID );

            $yes_link   = add_query_arg( array( 'rsvp_action' => 'yes',   'event_id' => $event_id, 'user_id' => $user->ID, 'token' => $token ), home_url() );
            $no_link    = add_query_arg( array( 'rsvp_action' => 'no',    'event_id' => $event_id, 'user_id' => $user->ID, 'token' => $token ), home_url() );
            $maybe_link = add_query_arg( array( 'rsvp_action' => 'maybe', 'event_id' => $event_id, 'user_id' => $user->ID, 'token' => $token ), home_url() );

            $subject  = $subject_prefix . ': ' . get_the_title( $event_id );

            $message  = sprintf( __( 'Hi %s,', WPEM_TEXT_DOMAIN ), $user->display_name ) . "\n\n";
            $message .= sprintf( __( 'Event: %s', WPEM_TEXT_DOMAIN ), get_the_title( $event_id ) ) . "\n\n";
            $message .= __( 'Please confirm your attendance:', WPEM_TEXT_DOMAIN ) . "\n\n";
            $message .= __( 'Yes:', WPEM_TEXT_DOMAIN )   . ' ' . $yes_link   . "\n";
            $message .= __( 'No:', WPEM_TEXT_DOMAIN )    . ' ' . $no_link    . "\n";
            $message .= __( 'Maybe:', WPEM_TEXT_DOMAIN ) . ' ' . $maybe_link . "\n";

            wp_mail( $user->user_email, $subject, $message );
        }
    }
}

new WPEM_Notifications();