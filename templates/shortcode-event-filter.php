<?php
// Available variables: $events, $type, $start, $end, $search
?>

<!-- ======= WPEM EVENTS BLOCK ========= -->

<section class="wpem-events-listing-block wpem-space">
    <div class="wpem-container">
        <div class="wpem-event-title-block">
            <h2><?php _e('Events', WPEM_TEXT_DOMAIN); ?></h2>
        </div>
    </div>

    <!-- ======= WPEM FILTER FORM ========= -->

    <div class="wpem-events-filter-form">
        <form method="GET" class="wpem-event-filter-form">
            <div class="wpem-row wpem-grid-5">
                <div class="wpem-form-group">
                    <input
                        type="text"
                        name="search"
                        placeholder="<?php esc_attr_e('Search events', WPEM_TEXT_DOMAIN); ?>"
                        value="<?php echo esc_attr($search); ?>"
                        class="wpem-form-control"
                    />
                </div>
                <div class="wpem-form-group">
                    <input
                        type="date"
                        name="start"
                        value="<?php echo esc_attr($start); ?>"
                        class="wpem-form-control"
                    />
                </div>
                <div class="wpem-form-group">
                    <input
                        type="date"
                        name="end"
                        value="<?php echo esc_attr($end); ?>"
                        class="wpem-form-control"
                    />
                </div>

                <?php
                    $terms = get_terms(['taxonomy' => 'event_type', 'hide_empty' => false]);
                ?>

                <div class="wpem-form-group">
                    <select name="type" class="wpem-form-control">
                        <option value=""><?php _e('All Types', WPEM_TEXT_DOMAIN); ?></option>
                        <?php foreach ($terms as $term): ?>
                            <option
                                value="<?php echo esc_attr($term->slug); ?>"
                                <?php selected($type, $term->slug); ?>
                            >
                                <?php echo esc_html($term->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="wpem-btn-primary wpem-btn">
                    <?php _e('Filter', WPEM_TEXT_DOMAIN); ?>
                </button>
            </div>
        </form>
    </div>

    <!-- ======= WPEM EVENTS LISTING ========= -->

    <div class="wpem-events-listing-row">
        <div class="wpem-event-list wpem-grid-3">

            <?php if (!empty($events)): ?>

                <?php foreach ($events as $event): ?>

                    <div class="wpem-event-item">
                        <h3>
                            <a href="<?php echo esc_url(get_permalink($event->ID)); ?>">
                                <?php echo esc_html($event->post_title); ?>
                            </a>
                        </h3>

                        <?php
                            $date     = get_post_meta($event->ID, '_event_date', true);
                            $location = get_post_meta($event->ID, '_location', true);
                        ?>
                        <ul>
                            <li><strong><?php _e('Date:', WPEM_TEXT_DOMAIN); ?></strong> <?php echo esc_html($date); ?></li>
                            <li><strong><?php _e('Location:', WPEM_TEXT_DOMAIN); ?></strong> <?php echo esc_html($location); ?></li>
                        </ul>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p><?php _e('No events found.', WPEM_TEXT_DOMAIN); ?></p>

            <?php endif; ?>

        </div>
    </div>
</section>
