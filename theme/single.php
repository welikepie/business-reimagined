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
							if ($tag->name !== 'Index') { echo('<a href="' . get_tag_link($tag->term_id) . '" rel="tag">' . $tag->name . '</a>'); }
						} ?>
					</div>

					<?php
						$authors = implode(', ', get_post_meta(get_the_ID(), 'Author', false));
						if (strlen($authors)) {
							echo('<div class="authors">' . $authors . '</div>');
						}
					?>
				</header>

				<?php the_content('', false); ?>

				<?php
					$twitter_share = build_url('https://twitter.com/share', array(
						'url' => wp_get_shortlink(),
						'hashtags' => 'bizreimagined',
						'text' => $wp_query->post->post_title
					));
				?>
				<div class="share">
					Join discussion
					<a href="<?php echo($twitter_share); ?>" target="_blank" class="twitter">Share to Twitter</a>
				</div>

			</article>
<?php get_footer(); ?>