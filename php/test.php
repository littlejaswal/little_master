<?php

$to = strtotime("2011-01-05"); // 
$from = strtotime("2010-12-29");
$datediff = $to - $from;
$days=floor($datediff/(60*60*24));
echo $days; exit;


$data = 'http://search.twitter.com/search.json?q=from:SkiMarble';
$feed = file_get_contents($data); //Getting the skimarble data.
$valid_data = json_decode($feed); // Converting the skimarble data to PHP format.
$valid_data = $valid_data->results; // Valid data now with just the tweet result.


print_r($valid_data); exit;


foreach ($valid_data as $key=>$value) {
	$tweet=get_object_from_table('twitter',"tweet_id='$value->id'");
	if($tweet):
		$query= new query('twitter');
		$query->Data['id']=$tweet->id;
		$query->Data['tweet_id']=$value->id;
		$query->Data['on_date']=date("Y-m-d",strtotime($value->created_at));
		$query->Data['tweet_text']=$value->text;
		$query->Data['tweeter_link']="https://twitter.com/SkiMarble";
		$query->Data['tweet_logo']=$value->profile_image_url;
		$query->Data['id_str']=$value->id_str;
		
		$query->Update();
	else:
		$query= new query('twitter');
		$query->Data['tweet_id']=$value->id;
		$query->Data['on_date']=date("Y-m-d",strtotime($value->created_at));
		$query->Data['tweet_text']=$value->text;
		$query->Data['tweeter_link']="https://twitter.com/SkiMarble";
		$query->Data['tweet_logo']=$value->profile_image_url;
		$query->Data['id_str']=$value->id_str;
		$query->Insert();
	endif;
}

?>