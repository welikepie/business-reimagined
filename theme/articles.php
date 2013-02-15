<?php
/*
Template Name: Article Listing
*/

$wp_query = $wp_the_query = new WP_Query(array(
	'post_type' => 'post',
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-video', 'post-format-link' ),
			'operator' => 'NOT IN'
		)
	)
));
include(dirname(__FILE__) . '/index.php');

?>