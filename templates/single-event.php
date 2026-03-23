<?php get_header(); ?>

<!-- ============ EVENT HERO ============ -->

<section class="wpem-inner-hero">
    <div class="wpem-container">
        <h1><?php echo esc_html( get_the_title() ); ?></h1>
    </div>
</section>

<!-- ============ EVENT DETAILS ============ -->

<section class="wpem-event-single-block wpem-space">
    <div class="wpem-container">

        <div class="wpem-event-title-block">
            <h2><?php _e( 'Event Details', WPEM_TEXT_DOMAIN ); ?></h2>
        </div>

        <?php
        $date     = get_post_meta( get_the_ID(), '_event_date', true );
        $location = get_post_meta( get_the_ID(), '_location', true );
        $date_fmt = $date ? date( 'F j, Y', strtotime( $date ) ) : '';
        ?>

        <div class="wpem-event-meta">
            <?php if ( $date_fmt ) : ?>
            <div class="wpem-meta-item">
                <span class="wpem-meta-label"><?php _e( 'Date', WPEM_TEXT_DOMAIN ); ?></span>
                <span class="wpem-meta-value"><?php echo esc_html( $date_fmt ); ?></span>
            </div>
            <?php endif; ?>
            <?php if ( $location ) : ?>
            <div class="wpem-meta-item">
                <span class="wpem-meta-label"><?php _e( 'Location', WPEM_TEXT_DOMAIN ); ?></span>
                <span class="wpem-meta-value"><?php echo esc_html( $location ); ?></span>
            </div>
            <?php endif; ?>
        </div>

        <div class="wpem-event-content">
            <?php the_content(); ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
