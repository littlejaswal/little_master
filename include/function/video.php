<?php
function get_video_player($link, $echo=1)
{
	$firstpos=strpos($link, '=');
	$secondpos=strpos($link, '&');
       	if(!$secondpos or $secondpos==''):
		$code=substr($link, $firstpos+1);
	else:
                $length=$secondpos-($firstpos+1);
		$code=substr($link, $firstpos+1, $length);
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

function get_photo_from_yt_link($link, $id, $echo=1)
{
	$start=strpos($link, '=');
	$end=strpos($link, '&');
	if($end):
		$code=substr($link, $start+1, ($end-$start)-1);
	else:
		$code=substr($link, $start+1, strlen($link));
	endif;

	$video='';
	$video='<a href="#" rel="'.$id.'" title="click to watch this video" class="video_image"><img src="http://img.youtube.com/vi/'.$code.'/0.jpg" width="200px" height="150px" style="border:none;" alt="video image"></a>';
	if($echo):
		echo $video;
	else:
		return $video;
	endif;
}

/*pass youtube id to this function and get video*/

function get_video_from_youtube_link($code, $echo=1)
{
      
	$video='';
	$video='<iframe width="295" height="250"';
	$video.='src="http://www.youtube.com/embed/'.$code;
	$video.='" frameborder="0" allowfullscreen></iframe>';
         if($echo):
		echo $video;
	else:
		return $video;
	endif;
}
function get_video_from_youtube_link_front($code, $echo=1)
{
      
	$video='';
	$video='<iframe width="480" height="360"';
	$video.='src="http://www.youtube.com/embed/'.$code;
	$video.='" frameborder="0" allowfullscreen></iframe>';
         if($echo):
		echo $video;
	else:
		return $video;
	endif;
}

/*pass vimeo id to this function and gt video*/

function get_video_from_vimeo_link($code, $echo=1)
{
      
	$video='';
	$video='<iframe src="http://player.vimeo.com/video/'.$code;
	$video.='?title=0&amp;byline=0&amp;portrait=0"';
	$video.='width="295" height="250" frameborder="0"';
        $video.='webkitAllowFullScreen allowFullScreen></iframe>';
        
	if($echo):
		echo $video;
	else:
		return $video;
	endif;
}
function get_video_from_vimeo_link_front($code, $echo=1)
{
      
	$video='';
	$video='<iframe src="http://player.vimeo.com/video/'.$code;
	$video.='?title=0&amp;byline=0&amp;portrait=0"';
	$video.='width="480" height="360" frameborder="0"';
        $video.='webkitAllowFullScreen allowFullScreen></iframe>';
        
	if($echo):
		echo $video;
	else:
		return $video;
	endif;
}

/*get image form vimeo video*/

function getVimeoInfo($id) {
                if (!function_exists('curl_init')) die('CURL is not installed!');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                $output = unserialize(curl_exec($ch));
                $output = $output[0];
                curl_close($ch);
                return $output;
}
?>