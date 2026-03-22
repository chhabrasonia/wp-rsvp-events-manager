<?php
	class WPEM_Meta {

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add']);
        add_action('save_post', [$this, 'save']);
    }
    public function add() {
        add_meta_box('event_meta',  __('Event Details', WPEM_TEXT_DOMAIN), [$this, 'html'], 'event');
    }

    /**
     ***************************
     * Meta data html 
     ****************************
     */

    public function html($post) {
        wp_nonce_field('event_nonce', 'event_nonce');
        $location = get_post_meta($post->ID, '_location', true);
        $date     = get_post_meta($post->ID, '_event_date', true);

        echo "<div class='wpem-form-group'>
                <div class='wpem-form-label'>
                	<label>Event Date</label>
                </div>
                <div class='wpem-form-control'>
                	<input type='date' name='event_date' value='" . esc_attr($date) . "' />
                </div>
              </div>";

        echo "<div class='wpem-form-group'>
                 <div class='wpem-form-label'>
                 	<label>Location</label>
                 </div>
                 <div class='wpem-form-control'>
              		  <textarea name ='location'> ". esc_textarea($location) ." </textarea>
              	</div>";
    }

    /**
     ***************************
     * Save meta data
     ****************************
     */

    public function save($post_id) {

        if (!isset($_POST['event_nonce']) || 
            !wp_verify_nonce($_POST['event_nonce'], 'event_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if (get_post_type($post_id) !== 'event') return;

        // Save Date
        if (isset($_POST['event_date'])) {
            update_post_meta(
                $post_id,
                '_event_date',
                sanitize_text_field($_POST['event_date'])
            );
        }

        // Save Location
        if (isset($_POST['location'])) {
            update_post_meta(
                $post_id,
                '_location',
                sanitize_textarea_field($_POST['location'])
            );
        }
    }
}
new WPEM_Meta();