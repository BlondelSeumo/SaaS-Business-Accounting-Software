<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$url = dirname(__FILE__);
$urlStr = '';

$parsed = parse_url($url);
if (empty($parsed['scheme'])) {
    $urlStr = 'http://' . ltrim($url, '/');
}
if (strpos($urlStr,'http') !== false) {
    $link_array = explode('/',$url);
	$value = end($link_array);
} else {
    $cur_dir = explode('\\', $url);
	$value = $cur_dir[count($cur_dir)-1];
}

$language = get_language_values();
foreach ($language as $row) {
	$lang[$row->keyword] = $row->$value;
}

?>
