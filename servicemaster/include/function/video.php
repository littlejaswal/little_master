<?php
function get_video_player($link, $echo=1)
{
	$firstpos=strpos($link, '=');
	$secondpos=strpos($link, '&');
	if(!$secondpos or $secondpos==''):
		$code=substr($link, $firstpos+1);
	else:
		$code=substr($link, $firstpos, $secondpos);
	endif;
		
	$video='';
	$video='<object width="640" height="505">';
	$video.='<param name="movie" value="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b"></param>';
	$video.='<param name="allowFullScreen" value="true"></param>';
	$video.='<param name="allowscriptaccess" value="always"></param>';
	$video.='<embed src="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="505"></embed></object>';
	if($echo):
		echo $video;
	else:
		return $video;
	endif;
}
?>