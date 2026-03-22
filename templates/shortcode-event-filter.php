<?php
// Available variables: $events, $type, $start, $end, $search
?>

<!-- ======= WPEM EVENTS BLOCK ========= -->

<section class="wpem-events-listing-block">
    <div class="wpem-container">
        <div class="wpem-title-block">
            <h2> Events </h2>
        </div>
    </div>
    
    <!-- ======= WPEM FILTER FORM ========= -->

    <div class="wpem-events-filter-form">
        <form method="GET" class="wpem-event-filter-form">
            <div class="wpem-form-group">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search events"
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
                $terms = get_terms([
                    'taxonomy' => 'event_type',
                    'hide_empty' => false
                ]);
            ?>

            <div class="wpem-form-group">

                <select name="type">
                    <option value="">All Types</option>
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

            <button type="submit">Filter</button>
        </form>

    </div>

    <!-- ======= WPEM EVENTS LISTING ========= -->

    <div class="wpem-events-listing-row">

        <div class="wpem-event-results">

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
                            <li><strong>Date:</strong> <?php echo esc_html($date); ?></li>
                            <li><strong>Location:</strong> <?php echo esc_html($location); ?></li>
                        </ul>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>No events found.</p>

            <?php endif; ?>
        </div>
    </div>
</section>

