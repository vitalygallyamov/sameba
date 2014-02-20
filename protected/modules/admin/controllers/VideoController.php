<?php

class VideoController extends AdminController
{
	public function actionGetVideoInfo($vid){
		//The Youtube's API url
		// define('YT_API_URL', "http://gdata.youtube.com/feeds/api/videos?q=$vid");
		define('YT_API_URL', "https://gdata.youtube.com/feeds/api/videos/$vid?v=2");
		
		//die(YT_API_URL);
		//Using cURL php extension to make the request to youtube API
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, YT_API_URL);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// //$feed holds a rss feed xml returned by youtube API
		// $feed = curl_exec($ch);
		// curl_close($ch);

		//Using SimpleXML to parse youtube's feed
		$xml = simplexml_load_file("https://gdata.youtube.com/feeds/api/videos/$vid?v=2");

		//print_r($xml->children('http://search.yahoo.com/mrss/'));
		
		//If no entry whas found, then youtube didn't find any video with specified id
		if(!$xml){
			CJSON::encode('Error: no video with id "' . $vid . '" whas found. Please specify the id of a existing video.');
			Yii::app()->end(404);
		}
		$media = $xml->children('media', true);
		$group = $media->group;
		 
		$title = $group->title;//$title: The video title
		$desc = $group->description;//$desc: The video description
		$vid_keywords = $group->keywords;//$vid_keywords: The video keywords
		$thumb = $group->thumbnail[2];//There are 4 thumbnails, the first one (index 0) is the largest.
		//$thumb_url: the url of the thumbnail. $thumb_width: thumbnail width in pixels.
		//$thumb_height: thumbnail height in pixels. $thumb_time: thumbnail time in the video
		list($thumb_url, $thumb_width, $thumb_height, $thumb_time) = $thumb->attributes();
		$content_attributes = $group->content->attributes();
		//$vid_duration: the duration of the video in seconds. Ex.: 192.
		$vid_duration = $content_attributes['duration'];
		//$duration_formatted: the duration of the video formatted in "mm:ss". Ex.:01:54
		$duration_formatted = str_pad(floor($vid_duration/60), 2, '0', STR_PAD_LEFT) . ':' . str_pad($vid_duration%60, 2, '0', STR_PAD_LEFT);
		 
		//echoing the variables for testing purposes:
		$video = array();

		$video['title']	= $title.'';
		$video['desc'] = $desc.'';
		$video['keywords'] = $vid_keywords.'';
		$video['thumbnail_url'] = $thumb_url.'';
		$video['thumbnail_width'] = $thumb_width.'';
		$video['thumbnail_height'] = $thumb_height.'';
		$video['thumbnail_time'] = $thumb_time.'';
		$video['video_duration'] = $vid_duration.'';

		$this->renderPartial('_video', array('video' => $video));

		// $video = (object) $video;

		// echo CJSON::encode($video);

		// echo 'title: ' . $title . '<br />';
		// echo 'desc: ' . $desc . '<br />';
		// echo 'video keywords: ' . $vid_keywords . '<br />';
		// echo 'thumbnail url: ' . $thumb_url . '<br />';
		// echo 'thumbnail width: ' . $thumb_width . '<br />';
		// echo 'thumbnail height: ' . $thumb_height . '<br />';
		// echo 'thumbnail time: ' . $thumb_time . '<br />';
		// echo 'video duration: ' . $vid_duration . '<br />';
		// echo 'video duration formatted: ' . $duration_formatted;

		Yii::app()->end();
	}
}
