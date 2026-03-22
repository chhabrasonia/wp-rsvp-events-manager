<?php get_header(); ?>

<!-- ============ EVENT HERO ============ -->

<section class="wpem-inner-hero">
    <div class="wpem-container">
        <div class="wpem-inner-hero-row">
            <h1><?php echo esc_html(get_the_title()); ?></h1>
        </div>
    </div>
</section>

<!-- ============ EVENT DETAILS ============ -->

<section class="wpem-event-single-block wpem-space">
    <div class="wpem-container">
        <div class="wpem-event-title-block">
            <h2><?php _e('Event Details', WPEM_TEXT_DOMAIN); ?></h2>
        </div>
        <div class="wpem-event-item-row">
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
    </div>
</section>

<?php get_footer(); ?>
