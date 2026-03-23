<?php

class Test_WPEM_Query extends WP_UnitTestCase {

    public function test_filter_by_date_range() {

        $event1 = $this->factory->post->create(['post_type' => 'event']);
        $event2 = $this->factory->post->create(['post_type' => 'event']);

        update_post_meta($event1, '_event_date', '2026-03-10');
        update_post_meta($event2, '_event_date', '2026-04-10');

        $query = new WP_Query([
            'post_type' => 'event',
            'meta_query' => [
                [
                    'key' => '_event_date',
                    'value' => '2026-03-01',
                    'compare' => '>=',
                    'type' => 'DATE'
                ],
                [
                    'key' => '_event_date',
                    'value' => '2026-03-31',
                    'compare' => '<=',
                    'type' => 'DATE'
                ]
            ]
        ]);

        $this->assertEquals(1, $query->found_posts);
    }
}