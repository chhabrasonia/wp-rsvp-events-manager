<?php
    class WPEM_Template_Loader {

        public function __construct() {
            add_filter('template_include', [$this, 'load_templates'], 99);
        }

        public function load_templates($template) {

            if (is_singular('event')) {
                return WPEM_PATH . 'templates/single-event.php';
            }

            if (is_tax('event_type')) {
                return WPEM_PATH . 'templates/taxonomy-event_type.php';
            }

            return $template;
        }

    }

    new WPEM_Template_Loader();
?>