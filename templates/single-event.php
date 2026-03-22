<?php
	get_header();
?>
<!-- ============ EVENT HERO ============ -->

<section class="wpem-inner-hero">
	<div class="wpem-container">
		<div class="wpem-inner-hero-row">
			<h1><?php echo get_the_title() ?> </h1>
		</div>
	</div>
</section>

<!-- ============ EVENT DETAILS ============ -->

<section class="wpem-event-single-block wpem-space">
	<div class="wpem-container">
		<div class="wpem-event-title-block">
			<h2> Event Details </h2>
		</div>
		<div class="wpem-event-item-row">
			<ul>
				<li>
					<strong> Date: </strong>
					<?php  
						echo get_post_meta(get_the_ID(), '_event_date', true)
					?>
				</li>
				<li> 
					<strong> Location: </strong>
					<?php 
						echo get_post_meta(get_the_ID(), '_location', true) 
					?>
				</li>
			</ul>
		</div>
	</div>
</section>
<?php
	get_footer();
?>