<?php get_header('banner');
			global $more;
			if ($filter_title) { echo ('<h1>' . $filter_title . '</h1>'); }
			if ($filter_description) { echo ($filter_description); }
			?><div class="listing"><?php if (have_posts()) { while (have_posts()) {
				$more = 0;
				the_post();

				$class = get_post_format();
				$twitter_share = build_url('https://twitter.com/share', array(
					'url' => wp_get_shortlink(),
					'hashtags' => 'bizreimagined',
					'text' => $wp_query->post->post_title
				));
				$image = get_post_thumbnail_id();
				if ($image) {
					$image = wp_get_attachment_image_src($image, 'large');
					$facebook_share['p[images][0]'] = $image[0];
					$image = $image[0];
				} else {
					$image = '';
				}

				if ($class === 'link') {
					if (!get_the_content()) { $class .= ' single'; }
				} elseif ($class === 'video') {
					if (!get_the_title()) { $class .= ' single'; }
				}
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
				<?php if (($class === 'video') || ($class === 'video single')) { ?>
					<div class="content"><?php echo(get_the_content()); ?></div>
					<?php
						$title = get_the_title();
						if ($title) {
					?>
					<div class="category">- <?php the_category(' - '); ?></div>
					<h1><?php the_title(); ?></h1>
					<?php }
				} elseif (($class === 'link') || ($class === 'link single')) {
					$link = get_post_meta(get_the_ID(), 'Link', true);
					$content = get_the_content();
					
					if ($link) {
						echo('<a href="' . $link . '" target="_blank">' .
							'<img src="' . $image . '" alt="' . get_the_title() . '">' .
						'</a>');
					}
					if ($content) {
						echo('<p>' . $content . '</p>');
					}
				} else { ?>
					<a href="<?php echo(get_permalink()); ?>"><img src="<?php echo($image); ?>" alt="<?php the_title(); ?>"></a>
					<div class="category">- <?php the_category(' - '); ?></div>
					<div class="share">
						Join discussion
						<a href="<?php echo($twitter_share); ?>" target="_blank" class="twitter">Share to Twitter</a>
					</div>
					<a href="<?php echo(get_permalink()); ?>"><h1><?php the_title(); ?></h1></a>

					<?php
						echo('<p>' . get_the_excerpt() . '</p>');
						$meta = array();
						foreach (get_post_custom() as $key => $val) { if (($key[0] !== '_') && ($key !== 'Author')) { $meta[$key] = $val; } }
						if (count($meta)) {
							echo('<div class="meta">');
							foreach ($meta as $key => &$values) { echo('<p><span>' . $key . ':</span> ' . implode(', ', $values) . '</p>'); }
							echo('</div>');
						}
					?>

					<div class="tags">
						<?php $tags = get_the_tags();
						foreach ($tags as &$tag) {
							if ($tag->name !== 'Index') { echo('<a href="' . get_tag_link($tag->term_id) . '" rel="tag">' . $tag->name . '</a>'); }
						} ?>
					</div>
				<?php } ?>
				</article>
			<?php } } ?>
			</div>
<?php get_footer(); ?>