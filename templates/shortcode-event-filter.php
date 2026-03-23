<?php
// Available variables: $events, $type, $start, $end, $search
?>

<!-- ======= WPEM EVENTS BLOCK ========= -->

<section class="wpem-events-listing-block wpem-space">
    <div class="wpem-container">

        <div class="wpem-event-title-block">
            <h2><?php _e( 'Events', WPEM_TEXT_DOMAIN ); ?></h2>
        </div>

         <!-- ======= WPEM FILTER FORM ========= -->

        <div class="wpem-events-filter-form">
            <form method="GET" class="wpem-event-filter-form">
                <div class="wpem-grid-5">
                    <div class="wpem-form-group">
                        <input
                            type="text"
                            name="search"
                            placeholder="<?php esc_attr_e( 'Search events', WPEM_TEXT_DOMAIN ); ?>"
                            value="<?php echo esc_attr( $search ); ?>"
                            class="wpem-form-control"
                        />
                    </div>
                    <div class="wpem-form-group">
                        <input type="date" name="start" value="<?php echo esc_attr( $start ); ?>" class="wpem-form-control" />
                    </div>
                    <div class="wpem-form-group">
                        <input type="date" name="end" value="<?php echo esc_attr( $end ); ?>" class="wpem-form-control" />
                    </div>
                    <div class="wpem-form-group">
                        <?php $terms = get_terms( array( 'taxonomy' => 'event_type', 'hide_empty' => false ) ); ?>
                        <select name="type" class="wpem-form-control">
                            <option value=""><?php _e( 'All Types', WPEM_TEXT_DOMAIN ); ?></option>
                            <?php foreach ( $terms as $term ) : ?>
                                <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $type, $term->slug ); ?>>
                                    <?php echo esc_html( $term->name ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="wpem-btn wpem-btn-primary">
                        <?php _e( 'Filter', WPEM_TEXT_DOMAIN ); ?>
                    </button>
                </div>
            </form>
        </div>

         <!-- ======= WPEM EVENTS LISTING ========= -->
         
        <div class="wpem-grid-3">
            <?php if ( ! empty( $events ) ) : ?>

                <?php foreach ( $events as $event ) :
                    $date     = get_post_meta( $event->ID, '_event_date', true );
                    $location = get_post_meta( $event->ID, '_location', true );
                    $day      = $date ? date( 'j',   strtotime( $date ) ) : '';
                    $month    = $date ? date( 'M',   strtotime( $date ) ) : '';
                    $date_fmt = $date ? date( 'M j, Y', strtotime( $date ) ) : '';
                ?>
                    <div class="wpem-event-item">
                        <div class="wpem-event-item-header">
                            <?php if ( $date ) : ?>
                            <div class="wpem-event-date-badge">
                                <span class="day"><?php echo esc_html( $day ); ?></span>
                                <span class="month"><?php echo esc_html( $month ); ?></span>
                            </div>
                            <?php endif; ?>
                            <h3 class="wpem-event-item-title">
                                <a href="<?php echo esc_url( get_permalink( $event->ID ) ); ?>">
                                    <?php echo esc_html( $event->post_title ); ?>
                                </a>
                            </h3>
                        </div>
                        <div class="wpem-event-item-body">
                            <ul>
                                <?php if ( $date_fmt ) : ?>
                                <li><strong><?php _e( 'Date:', WPEM_TEXT_DOMAIN ); ?></strong> <?php echo esc_html( $date_fmt ); ?></li>
                                <?php endif; ?>
                                <?php if ( $location ) : ?>
                                <li><strong><?php _e( 'Location:', WPEM_TEXT_DOMAIN ); ?></strong> <?php echo esc_html( $location ); ?></li>
                                <?php endif; ?>
                            </ul>
                            <a href="<?php echo esc_url( get_permalink( $event->ID ) ); ?>" class="wpem-event-link">
                                <?php _e( 'View Event', WPEM_TEXT_DOMAIN ); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else : ?>
                <p class="wpem-no-events"><?php _e( 'No events found.', WPEM_TEXT_DOMAIN ); ?></p>
            <?php endif; ?>
        </div>

    </div>
</section>
