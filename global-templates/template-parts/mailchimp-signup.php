<?php
/**
 *  Mailchimp Signup
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$theme_path = get_template_directory_uri();

$mailchimp_footer_title = get_field('mailchimp_footer_title','options');
$mailchimp_footer_subtitle = get_field('mailchimp_footer_subtitle','options');

?>

<!-- Begin Mailchimp Signup Form -->
<div id="mc_embed_signup">
<form action="https://list-manage.us17.list-manage.com/subscribe/post?u=748688dc7ee317f3e8c618957&amp;id=9e3bd438b9" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<label for="mce-EMAIL"><?php echo $mailchimp_footer_title; ?></label>
	<p class='mce-subtitle'><?php echo $mailchimp_footer_subtitle; ?></p>
<!-- 	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="you@email.co.uk" required> -->
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_748688dc7ee317f3e8c618957_9e3bd438b9" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="I'm in" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->