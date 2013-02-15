<?php
/*
Template Name: Video Listing
*/

$wp_query = $wp_the_query = new WP_Query(array(
	'post_type' => 'post',
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-video' )
		)
	)
));
include(dirname(__FILE__) . '/index.php');

?>