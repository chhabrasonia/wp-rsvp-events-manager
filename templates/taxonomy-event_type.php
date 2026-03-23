<?php get_header(); ?>

<!-- ============ HERO SECTION ============ -->
<section class="wpem-inner-hero">
    <div class="wpem-container">
        <h1><?php single_term_title(); ?></h1>
    </div>
</section>


<!-- ============ EVENT LISTING BY TERM ============ -->

<section class="wpem-events-listing-block wpem-space">
    <div class="wpem-container">

        <div class="wpem-event-title-block">
            <h2><?php _e( 'Events', WPEM_TEXT_DOMAIN ); ?></h2>
        </div>

        <div class="wpem-grid-3">
            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post();
                    $date     = get_post_meta( get_the_ID(), '_event_date', true );
                    $location = get_post_meta( get_the_ID(), '_location', true );
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
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
                            <a href="<?php the_permalink(); ?>" class="wpem-event-link">
                                <?php _e( 'View Event', WPEM_TEXT_DOMAIN ); ?>
                            </a>
                        </div>
                    </div>

                <?php endwhile; ?>

            <?php else : ?>
                <p class="wpem-no-events"><?php _e( 'No events found.', WPEM_TEXT_DOMAIN ); ?></p>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
