<?php

	class Event {

		public static function init() {
        	add_action('init', [self::class, 'register']);
    	}
    	/*
		*****************************************
		* Register event post type and taxonomy 
		*****************************************
		*/
	    public static function register() {
	        register_post_type('event', [
	            'label'        => __('Events', WPEM_TEXT_DOMAIN),
	            'public'       => true,
	            'has_archive'  => true,
	            'show_in_rest' => true,
	            'supports'     => ['title', 'editor','thumbnail']
	        ]);

	        register_taxonomy('event_type', 'event', [
	            'label'        => __('Event Type', WPEM_TEXT_DOMAIN),
	            'hierarchical' => true,
	            'public'       => true,
	            'rewrite'      => ['slug' => 'event-type'],
	            'show_in_rest' => true
	        ]);
	    }
	}
	
	Event::init();
