<?php

$yt_videos = [
	'ydEuZnUZwNs',
	'rVcqGhoKErU',
	'2OU11DyVpCg',
	'-m2bYHlPIe0',
	'1nEPGxSWxEA',
	'UIFUSvmPMps',
];

$yt_video_titles = [];
foreach($yt_videos as $video) {
	$yt_video_titles[$video] = $video;
	// $yt_video_titles[$video] = explode('</title>', explode('<title>', file_get_contents("https://www.youtube.com/watch?v={$video}"))[1])[0];
}

view('videos.view.php', [
	'meta_title' => __('videos.page_title'),
	'meta_description' => __('videos.page_description'),
	'yt_videos' => $yt_videos,
	'yt_video_titles' => $yt_video_titles,
]);