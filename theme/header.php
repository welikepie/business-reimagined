<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/modernizr.js"></script>
		<script type="text/javascript">
		Modernizr.load({
			'load': [
				'<?php echo get_template_directory_uri(); ?>/scripts/vendor.js',
				'<?php echo get_template_directory_uri(); ?>/scripts/scripts.js'
			],
			'complete': function () { jQuery(window.init); }
		});
		</script>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<header>
			<a href="<?php echo(home_url('/')); ?>"><h1>Business Reimagined</h1></a>
			<nav><?php
			$items = wp_get_nav_menu_items('Top Nav');
			foreach ($items as &$item) {
				echo('<a href="' . $item->url . '">' . $item->title . '</a>');
			} ?></nav>
		</header>
		<?php if (isset($banner)) { ?><div class="banner">
			<div class="wrapper">
				<p>
					<span>Lorem ipsum dolor sit amet,</span>
					<span>consectetur adipiscing elit.</span>
					<span>Nam tempor tincidunt tempor.</span>
					<span>Duis nec eros ante, quis vulputate turpis.</span>
				</p>
			</div>
		</div><?php } ?>

		<section id="main">