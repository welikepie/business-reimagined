<?php

	$filter_title = single_cat_title('', false);
	$filter_description = category_description();
	include(dirname(__FILE__) . '/index.php');

?>