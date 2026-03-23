<?php
class Test_WPEM_Meta extends WP_UnitTestCase {

    public function test_event_date_saved() {

        $post_id = $this->factory->post->create([
            'post_type' => 'event'
        ]);

        update_post_meta($post_id, '_event_date', '2026-03-22');

        $this->assertEquals(
            '2026-03-22',
            get_post_meta($post_id, '_event_date', true)
        );
    }

    public function test_event_location_saved() {

        $post_id = $this->factory->post->create([
            'post_type' => 'event'
        ]);

        update_post_meta($post_id, '_location', 'Delhi');

        $this->assertEquals(
            'Delhi',
            get_post_meta($post_id, '_location', true)
        );
    }

    public function test_empty_meta_returns_empty() {

        $post_id = $this->factory->post->create([
            'post_type' => 'event'
        ]);

        $this->assertEmpty(
            get_post_meta($post_id, '_location', true)
        );
    }
}