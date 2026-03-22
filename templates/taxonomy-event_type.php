<?php
    get_header();
?>

<!-- ============ HERO SECTION ============ -->

<section class="wpem-inner-hero">
    <div class="wpem-container">
        <div class="wpem-inner-hero-row">
            <h1><?php single_term_title(); ?></h1>
        </div>
    </div>
</section>

<!-- ============ EVENT LISTING BY TERM ============ -->

<section class="wpem-events-listing-block">
    <div class="wpem-container">
        <div class="wpem-event-title-block">
            <h2> Event Details </h2>
        </div>
        <div class="wpem-event-item-row">
            <?php if (have_posts()): ?>
                <div class="wpem-event-item">
                    <?php while (have_posts()): the_post(); ?>
                        <h3><?php the_title(); ?></h3>
                        <ul>
                            <li>
                                <strong> Date: </strong>
                                 <?php  
                                    echo get_post_meta(get_the_ID(), '_event_date', true);
                                ?>
                            </li>
                            <li>
                                <strong> Location: </strong>
                                 <?php  
                                    echo get_post_meta(get_the_ID(), '_location', true) 
                                ?>
                            </li>
                        </ul>
                    <?php endwhile; ?>

            <?php else: ?>
                <p>No events found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
    get_footer();
?>