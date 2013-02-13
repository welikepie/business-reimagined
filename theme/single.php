<?php
	get_header();
	the_post();
?>
			<article class="blog">

				<header>
					<div class="category"><?php the_category(' &bull; '); ?></div>
					<h1><?php the_title('', '', true); ?></h1>

					<div class="tags">
						<?php $tags = get_the_tags();
						foreach ($tags as &$tag) {
							echo('<a href="' . get_tag_link($tag->term_id) . '" rel="tag">' . $tag->name . '</a>');
						} ?>
					</div>
				</header>

				<?php the_content('', false); ?>

				<?php
					$facebook_share = build_url('http://www.facebook.com/sharer.php', array(
						's' => 100,
						'p[url]' => get_permalink(),
						'p[title]' => get_the_title(),
						'p[summary]' => get_the_excerpt()
					));
					$twitter_share = build_url('https://twitter.com/share', array('url' => get_permalink()));
				?>
				<div class="share">
					Join discussion
					<a href="<?php echo($facebook_share); ?>" target="_blank" class="facebook">Share to Facebook</a>
					<a href="<?php echo($twitter_share); ?>" target="_blank" class="twitter">Share to Twitter</a>
				</div>

			</article>
<?php get_footer(); ?>