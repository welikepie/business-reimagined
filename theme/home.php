<?php
/*
Template Name: Home Page Listing
*/

$wp_query = $wp_the_query = new WP_Query('tag=index');
include(dirname(__FILE__) . '/index.php');

?>