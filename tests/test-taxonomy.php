<?php

class Test_WPEM_Taxonomy extends WP_UnitTestCase {

    public function test_event_type_taxonomy_exists() {

        $this->assertTrue(taxonomy_exists('event_type'));
    }

    public function test_taxonomy_attached_to_event() {

        $taxonomies = get_object_taxonomies('event');

        $this->assertContains('event_type', $taxonomies);
    }
}