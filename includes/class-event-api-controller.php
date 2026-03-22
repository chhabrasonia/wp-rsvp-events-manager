<?php
	class WPEM_API_Controller {

	    public function __construct() {
	        add_action('rest_api_init', [$this, 'routes']);
	    }

	    public function routes() {
	        register_rest_route('events/v1', '/list', [
	            'methods' => 'GET',
	            'callback' => [$this, 'get_events'],
	            'permission_callback' => '__return_true'
	        ]);
	    }

	    public function get_events() {
	        $posts = get_posts(
	        	[
	        	 'post_type'      => 'event',
	        	 'posts_per_page' => -1, 
	        	 'post_status'    => 'publish'
	        	]
	        );

	        $data = [];

	        foreach ($posts as $p) {
	            $data[] = [
	                'id'       => $p->ID,
	                'title'    => $p->post_title,
	                'date'     => get_post_meta($p->ID, '_event_date', true),
	                'location' => get_post_meta($p->ID, '_location', true)
	            ];
	        }

	        return $data;
	    }
	}
	new WPEM_API_Controller();

?>