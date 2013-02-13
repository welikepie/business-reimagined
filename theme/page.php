<?php
	get_header();
	the_post();
	echo('<article class="page">');
	the_content();
	echo('</article>');
	get_footer();
?>