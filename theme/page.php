<?php
	get_header('banner');
	the_post();
	echo('<article class="page">');
	the_content();
	echo('</article>');
	get_footer();
?>