<?php

class Test_WPEM_Post_Type extends WP_UnitTestCase {

    public function test_event_post_type_registered() {

        $this->assertTrue(post_type_exists('event'));
    }

    public function test_event_post_type_supports_title() {

        $this->assertTrue(post_type_supports('event', 'title'));
    }
}