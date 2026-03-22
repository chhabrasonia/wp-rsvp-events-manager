<?php get_header(); ?>

<!-- ============ HERO SECTION ============ -->

<section class="wpem-inner-hero">
    <div class="wpem-container">
        <div class="wpem-inner-hero-row">
            <h1><?php single_term_title(); ?></h1>
        </div>
    </div>
</section>

<!-- ============ EVENT LISTING BY TERM ============ -->

<section class="wpem-events-listing-block wpem-space">
    <div class="wpem-container">
        <div class="wpem-event-title-block">
            <h2><?php _e('Event Details', WPEM_TEXT_DOMAIN); ?></h2>
        </div>
        <div class="wpem-event-list wpem-grid-3">
            <?php if (have_posts()): ?>

                <?php while (have_posts()): the_post(); ?>

                    <div class="wpem-event-item">
                        <h3><?php the_title(); ?></h3>
                        <ul>
                            <li>
                                <strong><?php _e('Date:', WPEM_TEXT_DOMAIN); ?></strong>
                                <?php echo esc_html(get_post_meta(get_the_ID(), '_event_date', true)); ?>
                            </li>
                            <li>
                                <strong><?php _e('Location:', WPEM_TEXT_DOMAIN); ?></strong>
                                <?php echo esc_html(get_post_meta(get_the_ID(), '_location', true)); ?>
                            </li>
                        </ul>
                    </div>

                <?php endwhile; ?>

            <?php else: ?>
                <p><?php _e('No events found.', WPEM_TEXT_DOMAIN); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
