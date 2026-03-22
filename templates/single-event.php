<?php
	get_header();
?>
<section class="wpem-inner-hero">
	<div class="wpem-container">
		<div class="wpem-inner-hero-row">
			<h1><?php echo get_the_title() ?> </h1>
		</div>
	</div>
</section>

<section class="wpem-event-single-block">
	<div class="wpem-container">
		<div class="wpem-event-title-block">
			<h2> Event Details </h2>
		</div>
		<div class="wpem-event-item-row">
			<p> Date: 
				<?php  
					echo get_post_meta(get_the_ID(), '_event_date', true)
				?>
			</p>
			<p> Location: 
				<?php 
					echo get_post_meta(get_the_ID(), '_location', true) 
				?>
			</p>
		</div>
	</div>
</section>
<?php
	get_footer();
?>