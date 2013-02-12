<?php

	$filter_title = single_tag_title('', false);
	$filter_description = tag_description();
	include(dirname(__FILE__) . '/index.php');

?>