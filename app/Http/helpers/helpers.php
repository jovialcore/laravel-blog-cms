<?php

//helpers help you get stuff done and help you put stuff in the right place.. you get
use APP\post;
// a helper function to enavle us get al pages and em links to the homepage..you get
function getPages() {
	$pages = post::where('post_type', 'page')->where('is_published', '1')->get();
	return $pages;
}