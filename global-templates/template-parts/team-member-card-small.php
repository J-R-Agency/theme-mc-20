<?php
/**
 *  Team Member Card (Small)
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class='team-card--small'>
	<img class='team-portrait' src='<?php echo $team_portrait['sizes']['large'] ?>' alt='<?php echo $team_portrait['alt'] ?>"'>
	<h3><?php echo $team_name ?></h3>
	<p><?php echo $team_position ?></p>
</div>