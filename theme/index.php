<?php get_header();
			if ($filter_title) { echo ('<h1>' . $filter_title . '</h1>'); }
			if ($filter_description) { echo ('<p>' . $filter_description . '</p>'); }
			?><div class="listing"><?php if (have_posts()) { while (have_posts()) {
				the_post();

				$class = get_post_format();

				$facebook_share = build_url('http://www.facebook.com/sharer.php', array(
					's' => 100,
					'p[url]' => get_permalink(),
					'p[title]' => get_the_title(),
					'p[summary]' => get_the_excerpt()
				));
				$twitter_share = build_url('https://twitter.com/share', array('url' => get_permalink()));

				$image = get_post_thumbnail_id();
				if ($image) {
					$image = wp_get_attachment_image_src($image, 'large');
					$facebook_share['p[images][0]'] = $image[0];
					$image = $image[0];
				} else {
					$image = '';
				}
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
				<?php if ($class === 'video') { ?>
					<?php the_content(); ?>
				<?php } elseif ($class === 'link') { ?>
					<a target="_blank" href="<?php echo(get_page()->post_content); ?>"><img src="<?php echo($image); ?>" alt="<?php the_title(); ?>"></a>
				<?php } else { ?>
					<div class="share">
						Join discussion
						<a href="<?php echo($facebook_share); ?>" target="_blank" class="facebook">Share to Facebook</a>
						<a href="<?php echo($twitter_share); ?>" target="_blank" class="twitter">Share to Twitter</a>
					</div>

					<a style="display: block; width: 100%;" href="<?php echo(get_permalink()); ?>">
						<h1><?php the_title(); ?></h1>
						<img src="<?php echo($image); ?>" alt="<?php the_title(); ?>">
					</a>

					<?php the_content(); ?>

					<div class="tags">
						<?php $tags = get_the_tags();
						foreach ($tags as &$tag) {
							echo('<a href="' . get_tag_link($tag->term_id) . '" rel="tag">' . $tag->name . '</a>');
						} ?>
					</div>
				<?php } ?>
				</article>
			<?php } } ?>
			</div>
<?php get_footer(); ?>