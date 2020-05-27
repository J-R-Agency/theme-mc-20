<?php
/**
 * Template Name: Contact Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bw = 'black';
$page_color = 'cyan';
$header_position = get_field('header_position');

include( locate_template( 'header.php', false, false ) );  ?>

<!-- Contact info -->
<section class='generic bg-white'>
	<div class='contact-header'>
		<h1>Let's <span class='circle-cyan-2'>Talk</span></h1>
	</div>
	
	<div class='container contact-info'>
		<div class='row'>
			
			<div class='col-12 col-md-3'>
				<h3>Meet</h3>
				<?php the_field('company_address','option');?>
			</div>
			
			<div class='col-12 col-md-3'>
				<h3>Chat</h3>
				<a href="tel: <?php the_field('company_phone','option');?>">
					<?php the_field('company_phone','option');?>
				</a>
			</div>
			
			<div class='col-12 col-md-3'>
				<h3>Stalk</h3>
				<div class='contact-sm-icons'>
					<?php include(get_template_directory() . '/global-templates/template-parts/social-media.php'); ?>
				</div>
			</div>
			
			<div class='col-12 col-md-3'>
				<h3>Write</h3>
				<a href='mailto:<?php the_field('company_email','option');?>'>
					<?php the_field('company_email','option');?>
				</a>
			</div>
			
		</div>
	</div>
</section>

<!-- CONTACT FORM -->
<section class='slant-top bg-light-grey'>
	Contact form coming soon
</section>

<section class='generic bg-navy'>
	<h2>Friendly Faces</h2>
	<div class='users-container'>
		
		<?php
		$users = get_field("friendly_face");
		if( $users ): ?>
		    <?php foreach( $users as $user ):
			    $user_id = 'user_'.$user['ID'];
			    $position = get_field('user_position', $user_id);
			    
		    ?>
		    	<div class='user-profile'>
		            <img src="<?php echo esc_attr(get_avatar($user_id)); ?>" alt="author-avatar" />
		            <p><?php echo $user['display_name']; ?></p>
		            <p><?php echo $position; ?></p>
	            </div>
		    <?php endforeach; ?>
		<?php endif; ?>
		
	</div>
</section>

<!-- MAP -->
<section class='contact-map'>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2379.009330572452!2d-2.9820339841596413!3d53.39677297998957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487b21277e55e18f%3A0x5e237f2152ed6217!2s54%20St%20James%20St%2C%20Liverpool%20L1%200AB!5e0!3m2!1sen!2suk!4v1590589775107!5m2!1sen!2suk" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="true" tabindex="0"></iframe>
</section>

<?php include( locate_template( 'footer.php', false, false ) ); ?>

<script>
	
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {lat: -33, lng: 151},
          disableDefaultUI: true
        });
      }
</script>
