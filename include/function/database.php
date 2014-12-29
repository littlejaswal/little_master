<?







function get_city_news($total=2)
{
	$news=array();
	$query= new query('news');
	$query->Field="*, DATE_FORMAT(news_date, '%Y-%M-%d')AS news_date, news_date as newdate";
	$query->Where="where is_active='1' order by newdate desc limit 0, $total";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while($object=$query->GetArrayFromRecord()) 
		{
			$news[]=$object;	
		}
	endif;
	return $news;	
}

function get_featured_categories($parent_id=0, $total=4){
	$data=array();
	$query= new query('category');
	$query->Where="where parent_id='$parent_id' and is_featured='1' order by name limit 0, $total";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while($object=$query->GetArrayFromRecord()):
			$data[]=$object;
		endwhile;
	endif;
	return $data;
}

function get_categories($parent_id=0, $total=4, $table='category'){
	$data=array();
	$query= new query($table);
	$query->Where="where parent_id='$parent_id' and is_active='1' order by name limit 0, $total";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while($object=$query->GetArrayFromRecord()):
			$data[]=$object;
		endwhile;
	endif;
	return $data;
}

function get_featured_categories_not_top($total=4){
	$data=array();
	$query= new query('category');
	$query->Where="where parent_id!='0' and is_featured='1' order by name limit 0, $total";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while($object=$query->GetArrayFromRecord()):
			$data[]=$object;
		endwhile;
	endif;
	return $data;
	
}
/* business listing subscriptioni status my accoutn functions */


function is_business_exists($user_id){
	$query= new query('business');
	$query->Where="where user_id='$user_id'";
	if($object=$query->DisplayOne()):
		return $object->Id;
	else:
		return 0;
	endif;
}


/*#is complete /subscribed*/
function is_business_subscribed($id)
{
	$business= get_object('business', $id);	
	if($business->business_is_complete):
		return $business->Id;
	else:
		return 0;
	endif;
}


/*#is expiring*/
function check_business_subscription_status($id)
{
	$current_date=date("Y-m-d");
	$query= new query('subcriptionbusiness');
	$query->Where="where business_id='$id' and (CAST('$current_date' as DATE) BETWEEN subscription_start_date AND subscription_end_date) and subscription_is_complete='1' order by id desc";
	if($sobject=$query->DisplayOne()):
		if(dateDiff('d', $current_date, $sobject->subscription_end_date)>10):
			return 1; # active
		else:
			return 2; # expiring
		endif;
	else:
		return 0; # expired
	endif;
}
/* done */


function check_user_business_status()
{
	$login_session= new user_session();
	$user_id=$login_session->get_user_id(); 
	$query= new query('business');
	$query->Where="where user_id='$user_id'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		$object=$query->GetObjectFromRecord();
		if($object->business_is_paid):
			return 1;
		else:
			return 2;
		endif;
	else:
		return 0;
	endif;	
}

function business_subscription_status($user_id)
{
	$query= new query('business');
	$query->Where="where user_id='$user_id'";
	$object=$query->DisplayOne();
	
	$current_date=date("Y-m-d");
	$query= new query('subcriptionbusiness');
	$query->Where="where business_id='$object->Id' and (CAST('$current_date' as DATE) BETWEEN subscription_start_date AND subscription_end_date) and subscription_is_complete='1' order by id desc";
	if($sobject=$query->DisplayOne()):
		if(dateDiff('d', $current_date, $sobject->subscription_end_date)>10):
			return 1;
		else:
			return 2;
		endif;
	else:
		return 0;
	endif;
}

function get_featured_businesses($categoryId, $limit=5){ # is featured to be set.
		$category=array();
		$query= new query('business');
		$query->Field='Id, business_name, business_category_id';
		$query->Where="where (business_category_id LIKE '%$categoryId%') and business_is_paid='1' and business_is_active='1' order by Id limit 0, $limit";
		#$query->print=1;
		$query->DisplayAll();
		if($query->GetNumRows()):
			while ($object = $query->GetArrayFromRecord()) 
			{
				$category[$object['Id']]=$object['business_name'];
				record_impression_business($object['Id'], get_category_name_by_id($object['business_category_id']), 'featured');
			}	
		endif;
		return $category;
}

function get_businesses($categoryId, $limit=10){
		$category=array();
		$query= new query('business');
		#$query->Field='Id, business_name';
		$query->Where="where (business_category_id LIKE '%$categoryId%') and business_is_active='1' order by business_is_featured DESC limit 0, $limit";
		#$query->print=1;
		$query->DisplayAll();
		if($query->GetNumRows()):
			while ($object = $query->GetArrayFromRecord()) 
			{
				$category[]=$object;
				record_impression_business($object['Id'], get_category_name_by_id($object['business_category_id']));
			}	
		endif;
		return $category;
}

function get_business_stat($bid, $stat)
{
	$arr=array('b1'=>'list', 'b2'=>'search', 'b3'=>'featured', 'b4'=>'detailed');
	$query= new query('business_statistics');
	$query->Field='count(id) as views, EXTRACT(day from on_date) as day';
	$query->Where="WHERE business_id='$bid' and view_type='$arr[$stat]' group by day";
	$query->DisplayAll();
	$array=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$array[$object->day]=$object->views;
		endwhile;
	endif;
	return $array;
}


function get_business_stat_datewise($bid, $stat)
{
	$arr=array('b1'=>'list', 'b2'=>'search', 'b3'=>'featured', 'b4'=>'detailed');
	$query= new query('business_statistics');
	$query->Field='count(id) as views, on_date as day';
	$query->Where="WHERE business_id='$bid' and view_type='$arr[$stat]' group by day";
	$query->DisplayAll();
	$array=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$array[strtotime($object->day)]=$object->views;
		endwhile;
	endif;
	return $array;
}


function get_local_lists($limit=2)
{
		$category=array();
		$query= new query('business');
		#$query->Field='Id, business_name';
		$query->Where="where business_is_paid='1' and business_is_active='1' order by business_is_featured DESC limit 0, $limit";
		#$query->print=1;
		$query->DisplayAll();
		if($query->GetNumRows()):
			while ($object = $query->GetArrayFromRecord()) 
			{
				$category[]=$object;
				record_impression_business($object['Id'], 'homepage');
			}	
		endif;
		return $category;
}

#view type: list, search, detailed, featured
function record_impression_business($id, $keyword='category', $view_type='list')
{
		$query= new query('business_statistics');
		$query->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
		$query->Data['on_date']=date("Y-m-d");
		$query->Data['business_id']=$id;
		$query->Data['keyword']=$keyword;
		$query->Data['view_type']=$view_type;
		$query->Insert();
}

/* handle favourites */
function mark_favorite($business_id, $page, $query)
{
	$login_session= new user_session();
	if($login_session->is_logged_in()):
		if(if_favorite($business_id, $login_session->get_user_id())):
			echo '<a href="#" onclick="alert(\'This business is already your favourite\');">My Favourite</a>';
		else:
			echo '<a href="'.make_url($page, $query.'&mark=1').'"><img src="'.DIR_WS_SITE_GRAPHIC.'add-favourite.jpg" width="100px" height="20px" /></a>';
		endif;
	else:
		echo '<a href="'.make_url('login','msg=You have to login to mark this business as your favourite.').'"><img src="'.DIR_WS_SITE_GRAPHIC.'add-favourite.jpg" width="100px" height="20px" /></a>';
	endif;
}


function if_favorite($business_id, $user_id)
{
	$query= new query('business_favorite');
	$query->Where="where business_id='$business_id' and user_id='$user_id'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		return true;
	else:
		return false;
	endif;
}


function on_favourite($page, $query1, $business_id){
	
	$login_session = new user_session();
	if(isset($_GET['mark']) && $_GET['mark']==1 && $login_session->is_logged_in()):
		$query = new query('business_favorite');
		$query->Data['business_id']=$business_id;
		$query->Data['user_id']=$login_session->get_user_id();
		$query->Data['on_date']=date("Y-m-d");
		$query->Insert();
		redirect(make_url($page, $query1.'&msg=The business has been added to your favourites'));
	endif;
}

/* favourite secrion ends here */


/* banner functions */
function display_banner($side='right#1', $type='0', $category_type='business')
{
	$today_date=date("Y-m-d");
	$query= new query('banner_subscription_taken');
	if($type):
		if($category_type=='business'):
			$query->Where="where banner_type='$side' and subscription_is_complete='1' and (business_category_id LIKE '%".$type."%') and CAST('$today_date' as DATE) BETWEEN subscription_start_date AND subscription_end_date order by rand() limit 0, 1";
		else:
			$query->Where="where banner_type='$side' and subscription_is_complete='1' and category_id='".$type."' and CAST('$today_date' as DATE) BETWEEN subscription_start_date AND subscription_end_date order by rand() limit 0, 1";
		endif;
	else:
		$query->Where="where banner_type='$side' and subscription_is_complete='1' and (business_category_id='0' and business_category_id='0') and CAST('$today_date' as DATE) BETWEEN subscription_start_date AND subscription_end_date order by rand() limit 0, 1";
	endif;

	if($object=$query->DisplayOne()):
			   count_banner_impression($object->id);
		return make_banner_code($object->id, $side);
	else:
		
		return make_dummy_banner($side);
	endif;
}

function make_banner_code($id)
{
	global $banner_sizes;
	$banner= get_object('banner_subscription_taken', $id);
	if(strtolower(substr($banner->banner_name, -3))!='swf'):
		$code='<a href="'.make_url('spacecity-banner', 'id='.$banner->id).'">';
		$code.='<img src="'.DIR_WS_SITE_UPLOAD_PHOTO.'banner/large/'.$banner->banner_name.'" width="'.$banner_sizes[$banner->banner_type]['width'].'" height="'.$banner_sizes[$banner->banner_type]['height'].'" />';
		$code.='</a>';
	else:
		$code='<a href="'.make_url('spacecity-banner', 'id='.$banner->id).'">';
		$code.='<object width="'.$banner_sizes[$banner->banner_type]['width'].'" height="'.$banner_sizes[$banner->banner_type]['height'].'"><param name="movie" value="'.DIR_WS_SITE_UPLOAD.'flash/banner/'.$banner->banner_name.'"><embed src="'.DIR_WS_SITE_UPLOAD.'flash/banner/'.$banner->banner_name.'" width="'.$banner_sizes[$banner->banner_type]['width'].'" height="'.$banner_sizes[$banner->banner_type]['height'].'"></embed></object>';
		$code.='</a>';
	endif;
	echo $code;
}

function flash_banner($id)
{
	global $banner_sizes;
	$banner= get_object('banner_subscription_taken', $id);
	$code='<object width="'.$banner_sizes[$banner->banner_type]['width'].'" height="'.$banner_sizes[$banner->banner_type]['height'].'"><param name="movie" value="'.DIR_WS_SITE_UPLOAD.'flash/banner/'.$banner->banner_name.'"><embed src="'.DIR_WS_SITE_UPLOAD.'flash/banner/'.$banner->banner_name.'" width="'.$banner_sizes[$banner->banner_type]['width'].'" height="'.$banner_sizes[$banner->banner_type]['height'].'"></embed></object>';
	echo $code;
}

function flash_banner_dummy($side)
{
	global $banner_sizes;
	$code='<object width="'.$banner_sizes[$side]['width'].'" height="'.$banner_sizes[$side]['height'].'"><param name="movie" value="'.DIR_WS_SITE_GRAPHIC.$banner_sizes[$side]['flash'].'"><embed src="'.DIR_WS_SITE_GRAPHIC.$banner_sizes[$side]['flash'].'" width="'.$banner_sizes[$side]['width'].'" height="'.$banner_sizes[$side]['height'].'"></embed></object>';
	echo $code;
}


function count_banner_impression($id)
{
	$query = new query('banner_user_statistics');
	$query->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
	$query->Data['banner_id']=$id;
	$query->Insert();
}

function count_banner_click($id)
{
	$query = new query('banner_user_statistics');
	$query->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
	$query->Data['banner_id']=$id;
	$query->Data['type']='CLK';
	$query->Insert();
}


function make_dummy_banner($side)
{
	global $banner_sizes;
	echo '<a href="'.make_url('advertise-with-us').'"><img src="'.DIR_WS_SITE_GRAPHIC.$banner_sizes[$side]['dummy'].'" width="'.$banner_sizes[$side]['width'].'" height="'.$banner_sizes[$side]['height'].'" style="border:none;" /></a>';
}

function get_banner_stat($bid, $stat){
	$arr=array('b1'=>'IMP', 'b2'=>'CLK');
	$query= new query('banner_user_statistics');
	$query->Field='count(id) as views, EXTRACT(day from on_date) as day';
	$query->Where="WHERE banner_id='$bid' and type='$arr[$stat]' group by day";
	$query->DisplayAll();
	$array=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$array[$object->day]=$object->views;
		endwhile;
	endif;
	return $array;
}

function get_banner_stat_datewise($bid, $stat){
	$arr=array('b1'=>'IMP', 'b2'=>'CLK');
	$query= new query('banner_user_statistics');
	$query->Field='count(id) as views, on_date as day';
	$query->Where="WHERE banner_id='$bid' and type='$arr[$stat]' group by day";
	$query->DisplayAll();
	$array=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$array[strtotime($object->day)]=$object->views;
		endwhile;
	endif;
	return $array;
}

/* banner functions end here */

/* banner subscrition functions */
function banner_exists($user_id){
	$query= new query('banner_subscription_taken');
	$query->Where="where user_id='$user_id' and subscription_is_complete='1'";
	if($object=$query->DisplayOne()):
		return $object->id;
	else:
		return 0;
	endif;
}
		
function get_banner_status($id){
	$today_date= date('Y-m-d');
	$query= new query('banner_subscription_taken');
	$query->Where="where id='$id' and (CAST('$today_date' as DATE) BETWEEN subscription_start_date and subscription_end_date) and subscription_is_complete='1'";
	if($object=$query->DisplayOne()):
		if(dateDiff('d', $today_date, $object->subscription_end_date)>10):
			return 3;
		else:
			return 2;
		endif;
	else:
		return 1;
	endif;
}

function get_banner_by_user_id($user_id)
{
		$query= new query('banner_subscription_taken');
		$query->Where="where subscription_is_complete='1' and user_id='$user_id'";
		if($object=$query->DisplayOne()):
			return $object;
		else:
			return 0;
		endif;
}



/* banner subscriptioins end here */

/* video subscrition functions */
function video_exists($user_id){
	$query= new query('video_subscription_taken');
	$query->Where="where user_id='$user_id' and subscription_is_complete='1'";
	if($object=$query->DisplayOne()):
		return $object->id;
	else:
		return 0;
	endif;
}
		
function get_video_status($id){
	$today_date= date('Y-m-d');
	$query= new query('video_subscription_taken');
	$query->Where="where id='$id' and (CAST('$today_date' as DATE) BETWEEN subscription_start_date and subscription_end_date) and subscription_is_complete='1'";
	if($object=$query->DisplayOne()):
		if(dateDiff('d', $today_date, $object->subscription_end_date)>10):
			return 3;
		else:
			return 2;
		endif;
	else:
		return 1;
	endif;
}

function get_video_by_user_id($user_id)
{
		$query= new query('video_subscription_taken');
		$query->Where="where subscription_is_complete='1' and user_id='$user_id'";
		if($object=$query->DisplayOne()):
			return $object;
		else:
			return 0;
		endif;
}

function get_video_from_yt_link($link, $echo=1)
{
	$code=substr($link, strpos($link, 'v=')+2);
	$video='';
	$video='<object width="295" height="250">';
	$video.='<param name="movie" value="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b"></param>';
	$video.='<param name="allowFullScreen" value="true"></param>';
	$video.='<param name="allowscriptaccess" value="always"></param>';
	$video.='<embed src="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="295" height="250"></embed></object>';
	if($echo):
		echo $video;
	else:
		return $video;
	endif;
}
function get_video_from_yt_link_front($link, $echo=1)
{
	$code=substr($link, strpos($link, 'v=')+2);
	$video='';
	$video='<object width="480" height="360">';
	$video.='<param name="movie" value="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b"></param>';
	$video.='<param name="allowFullScreen" value="true"></param>';
	$video.='<param name="allowscriptaccess" value="always"></param>';
	$video.='<embed src="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="360"></embed></object>';
	if($echo):
		echo $video;
	else:
		return $video;
	endif;
}

function get_video_from_yt_link_big($link, $echo=1)
{
	$code=substr($link, strpos($link, 'v=')+2);
	$video='';
	$video='<object width="425" height="344">';
	$video.='<param name="movie" value="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b"></param>';
	$video.='<param name="allowFullScreen" value="true"></param>';
	$video.='<param name="allowscriptaccess" value="always"></param>';
	$video.='<embed src="';
	$video.='http://www.youtube.com/v/'.$code;
	$video.='&hl=en_US&fs=1&rel=0&color1=0x5d1719&color2=0xcd311b" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed></object>';
	if($echo):
		echo $video;
	else:
		return $video;
	endif;
}


function display_video()
{
	$today= date("Y-m-d");
	$query= new query('video_subscription_taken');
	$query->Where="where subscription_is_complete='1' and CAST('$today' as DATE) BETWEEN subscription_start_date AND subscription_end_date order by rand() limit 0, 1";
	
	if($object=$query->DisplayOne()):
		count_video_impression($object->id);
		echo get_video_from_yt_link($object->video_url, 0);
		echo '<div style="clear:both;"></div><a href="#" class="VideoLink">'.$object->video_name.'</a>';
	else:
		echo 'Sorry! No video advert found';
	endif;
}

function count_video_impression($id)
{
	$query = new query('video_user_statistics');
	$query->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
	$query->Data['video_id']=$id;
	$query->Insert();
}

function get_video_stat($vid, $stat){
	$arr=array('b1'=>'IMP');
	$query= new query('video_user_statistics');
	$query->Field='count(id) as views, EXTRACT(day from on_date) as day';
	$query->Where="WHERE video_id='$vid' and type='$arr[$stat]' group by day";
	#$query->print=1;
	$query->DisplayAll();
	$array=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$array[$object->day]=$object->views;
		endwhile;
	endif;
	return $array;
}

function get_video_stat_datewise($vid, $stat){
	$arr=array('b1'=>'IMP');
	$query= new query('video_user_statistics');
	$query->Field='count(id) as views, on_date as day';
	$query->Where="WHERE video_id='$vid' and type='$arr[$stat]' group by day";
	#$query->print=1;
	$query->DisplayAll();
	$array=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$array[strtotime($object->day)]=$object->views;
		endwhile;
	endif;
	return $array;
}


/* video subscriptioins end here */

/* reviews */
function get_all_my_reviews($id){
	$reviews=array();
	
	$query= new query('businessreview');
	$query->Where="where user_id='$id'";
	$query->DisplayAll();
	
	if($query->GetNumRows()):
		while($review=$query->GetArrayFromRecord()):
			$reviews[]=$review;
		endwhile;		
	endif;
	return $reviews;
}


function get_all_reviews($id){
	$reviews=array();
	$query= new query('businessreview');
	$query->Where="where business_id='$id'";
	$query->DisplayAll();
	
	if($query->GetNumRows()):
		while($review=$query->GetArrayFromRecord()):
			$reviews[]=$review;
		endwhile;		
	endif;
	return $reviews;
}


function on_write($page, $query1, $business_id){
	$login_session = new user_session();
	if(isset($_POST['is_review']) && $_POST['is_review']==1 && $login_session->is_logged_in()):
		if(validate_captcha()):
			$query = new query('businessreview');
			$query->Data['business_id']=$business_id;
			$query->Data['user_id']=$login_session->get_user_id();
			$query->Data['on_date']=date("Y-m-d");
			$query->Data['rating']=$_POST['rating'];
			$query->Data['title']=$_POST['title'];
			$query->Data['text']=$_POST['text'];
			$query->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
			$query->Insert();
			echo 'review has been posted successfully';
			//redirect(make_url($page, $query1.'&msg='.MSG_REVIEW_2));
		else:
			echo MSG_REVIEW_3;
		endif;
	endif;
}

function get_average_rating($business_id){
	
	$rating=0;
	$total=0;
	$query= new query('businessreview');
	$query->Where="where business_id='$business_id' and is_active='1'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while ($object=$query->GetObjectFromRecord()) {
			$rating+=$object->rating;
			$total+=1;	
		}
	endif;
	
	if($total && $rating):
		return round($rating/$total);
	else:
		return 0;
	endif;
}

function display_rating($rating){
	for ($i=1;$i<=$rating;$i++):
		echo '<img src="'.DIR_WS_SITE_GRAPHIC.'rating-sprite.png" alt=" " hspace="2" border="0" />';
	endfor;
}




function get_latest_reviews($total=2)
{
	$query= new query('businessreview');
	$query->Where="where is_active='1' order by on_date desc limit 0, $total";
	$query->DisplayAll();
	
	$reviews=array();
	if($query->GetNumRows()):
		while($object=$query->GetArrayFromRecord()):
			$reviews[]=$object;
		endwhile;
	endif;
	
	return $reviews;
}

function get_rss_feed($flux_id=0, $total=2){
	$rss=array();
	$query= new query('rssaarticle');
	$query->Where="where ARTfluxid='$flux_id' ORDER BY ARTdate limit 0, $total";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while ($object=$query->GetArrayFromRecord()) {
			$rss[]=$object;
		}
	endif;
	return $rss;
}

function get_rss_feed_bydate($fromdate, $todate, $total=2){
	$rss=array();
	$query= new query('rssaarticle');
	$query->Where="where (ARTdate >= CAST('$fromdate' as date)) ORDER BY ARTdate limit 0, $total";
	#$query->print=1;
	$query->DisplayAll();
	if($query->GetNumRows()):
		while ($object=$query->GetArrayFromRecord()) {
			$rss[]=$object;
		}
	endif;
	return $rss;
}


function display_rss_feed($template='news', $feed='', $limit=2)
{
	$rssfeed=array();
	$rssfeed=get_rss_feed($feed, $limit);
	foreach ($rssfeed as $k=>$v):
		$title=$v['ARTtitre'];
		$description=$v['ARTcont'];
		$link=$v['ARTlien'];
		$date=$v['ARTdate'];
		include(DIR_FS_SITE.'template/rss/'.$template.'.php');
	endforeach;
}

function display_rss_feed_today_combined($template='news', $fromdate, $todate, $limit=2)
{
	$rssfeed=array();
	$rssfeed=get_rss_feed_bydate($fromdate, $todate, $limit);
	foreach ($rssfeed as $k=>$v):
		$title=$v['ARTtitre'];
		$description=$v['ARTcont'];
		$link=$v['ARTlien'];
		$date=$v['ARTdate'];
		include(DIR_FS_SITE.'template/rss/'.$template.'.php');
	endforeach;
}

/*
#events database
function get_events_bycat($id)
{
	$date=date("Y-m-d");
	$query= new query('event');
	$query->Where="where event_type='$id' and (CAST('$date' as date) <= event_date) and is_active='1' order by event_date";
	$query->DisplayAll();
	return get_all_in_object($query);			
}

function get_events_bycatmy($id, $year, $month)
{
	$date=date("Y-m-d");
	$query= new query('event');
	$query->Field="*, DAY(event_date) as day";
	if($id=='all'):
		$query->Where="where MONTH(event_date)='$month' and YEAR(event_date)='$year' and is_active='1' order by id";
	else:
		$query->Where="where event_type='$id' and  MONTH(event_date)='$month' and YEAR(event_date)='$year' and is_active='1' order by id";
	endif;
	#$query->print=1;
	$query->DisplayAll();
	return get_all_in_object($query);			
}
*/
function display_right_events($id){
	$array=array();
	$array=get_events_bycat($id);
	$sr=1;
	foreach ($array as $k=>$v):
		if($sr++ >5):break;endif;
		include(DIR_FS_SITE_TEMPLATE.'event-rp.php');
	endforeach;
	if(count($array)>5):
		echo '<a href="'.make_url('events', 'event_id='.$id).'">more events...</a>&nbsp;&nbsp;<a href="'.make_url('events-calendar', 'category='.$id).'"><img src="'.DIR_WS_SITE_GRAPHIC.'calendar-icon.jpg" width="15px"/></a><br/><br/>';
	endif;
}
/*
function get_today_events(){
	$date=date("Y-m-d");
	$query= new query('event');
	$query->Where="where  CAST('$date' as date)=event_date and is_active='1'";
	$query->DisplayAll();
	return get_all_in_object($query);
}

#utitlity functions*/
function get_all_in_object($object, $type='object'){
	$obj_array=array();
	if($object->GetNumRows()):
		if($type=='object'):
			while($obj=$object->GetObjectFromRecord()):
				$obj_array[]=$obj;
			endwhile;
		else:
			while($obj=$object->GetArrayFromRecord()):
				$obj_array[]=$obj;
			endwhile;
		endif;
	endif;
	return $obj_array;
}


//function get_business_by_main_category_featured($id, $total)
//{	
//		$busi=array();
//		$query= new query('business');
//		$query->Where="where business_main_category_id='$id' and business_is_paid='1' and business_is_featured='1' and business_is_active='1' order by Id limit 0, $total";
//		$query->DisplayAll();
//		$busi=get_all_in_object($query, 'array');
//		return $busi;
//}
//
//function get_business_by_main_category_common($id, $total)
//{	
//		$busi=array();
//		$query= new query('business');
//		$query->Where="where business_main_category_id='$id' and business_is_featured='0' and business_is_active='1' order by Id limit 0, $total";
//		$query->DisplayAll();
//		$busi=get_all_in_object($query, 'array');
//		return $busi;
//}

//function get_business_by_category_featured($id, $total)
//{	
//		$busi=array();
//		$query= new query('business');
//		$query->Where="where business_category_id='$id' and business_is_paid='1' and business_is_featured='1' and business_is_active='1' order by Id limit 0, $total";
//		$query->DisplayAll();
//		$busi=get_all_in_object($query, 'array');
//		return $busi;
//}
//
//function get_business_by_category_common($id, $total)
//{	
//		$busi=array();
//		$query= new query('business');
//		$query->Where="where business_category_id='$id' and business_is_featured='0' and business_is_active='1' order by Id limit 0, $total";
//		$query->DisplayAll();
//		$busi=get_all_in_object($query, 'array');
//		return $busi;
//}


/*
function event_type($selected=''){
	global $eventType;
	$array=$eventType;
	foreach ($array as $k=>$v):
		if($v==$selected):
			echo '<option value="'.$v.'" selected>'.ucwords($v).'</option>';
		else:
			echo '<option value="'.$v.'">'.ucwords($v).'</option>';
		endif;
	endforeach;
}
*/
function selected_event($selected='')
{
	$arr=array('monthly'=>'monthly', 'yearly'=>'yearly');
	foreach($arr as $e=>$s):
		if($s==$selected):
			echo '<option value="'.$s.'" selected>'.ucwords($s).'</option>';
		else:
			echo '<option value="'.$s.'">'.ucwords($s).'</option>';
		endif;
	endforeach;
	
}

function get_latest_funny_video(){
	$query= new query('videos');
	$query->Where="where is_active='1' order by id desc";
	if($object=$query->DisplayOne()): 
		return $object->embed_code;
	endif;
	return 0;
}
/*
function expire_year($total=20, $selected='')
	{
		$year=date("Y");
		echo '<option value="">Select Year</option>';
		for($i=0;$i<$total;$i++):
			if($i==$selected):
				echo '<option value="'.($year+$i).'" selected>'.($year+$i).'</option>';
			else:
				echo '<option value="'.($year+$i).'">'.($year+$i).'</option>';
			endif;
		endfor;
	}
	
function expire_month($selected='')
{
	$month=array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun', '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');
	echo '<option value="">Select Month</option>';
	for($i=1;$i<13;$i++):
		if($i==$selected):
			echo '<option value="'.$i.'" selected>'.$month[$i].'</option>';
		else:
			echo '<option value="'.$i.'">'.$month[$i].'</option>';
		endif;
	endfor;
}
*/
function sanitise_value($value){
	return str_replace("'", "", $value);
}

function get_sales_rep($name, $selected='', $class='')
{
	$query= new query('sales_representative');
	$query->Where="where status='1'";
	$query->DisplayAll();
	echo '<select name="'.$name.'" size="1" class="'.$class.'">';
	echo '<option value="">None</option>';
	while ($value=$query->GetArrayFromRecord()):
		if(in_array($value['name'],$selected)):
			echo '<option value="'.$value['name'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
		   
			echo '<option value="'.$value['name'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endwhile;
	echo '</select>';
	
}

function getb2b_cat_featured($category='finance'){
	$query= new query('b2b');
	$query->Where="where category='$category' and is_active='1' and is_featured='1'";
	$query->DisplayAll();
	return get_all_in_object($query);
}

function getb2b_cat_all($category='finance'){
	$query= new query('b2b');
	$query->Where="where category='$category' and is_active='1'";
	$query->DisplayAll();
	return get_all_in_object($query);
}

function get_articles_by_category($id, $select='*',  $number='0'){
	$query= new query('article');
	$query->Field=$select;
	if($number):
		$query->Where="where article_type='$id' and is_active='1' order by id desc limit 0, $number";
	else:
		$query->Where="where article_type='$id' and is_active='1' order by id desc";
	endif;
	$query->DisplayAll();
	return get_all_in_object($query);
}

function get_author($id){
	$object = get_object('article_type', $id);
	return $object->author;
}


 function getbusinesscategory(){
         /* return array all business category*/
       $businesscategory= new query('business_category');
       $businesscategory->Where="where is_active='1' order by name";
       $businesscategory->DisplayAll();
       $cat=array();

            if($businesscategory->GetNumRows()):
                while($object2 = $businesscategory->GetObjectFromRecord()):
                         $cat[$object2->id]=$object2->name;
                endwhile;
            endif;
        return($cat);
   }  
function getlinkheadings(){
         /* return array of link headings*/
       $link_heading= new query('link_heading');
       $link_heading->Where="where is_active='1' order by position";
       $link_heading->DisplayAll();
       $cat=array();

            if($link_heading->GetNumRows()):
                while($object2 = $link_heading->GetObjectFromRecord()):
                         $cat[$object2->id]=$object2->name;
                endwhile;
            endif;
        return($cat);
   }  
function getdepartments(){
         /* return array of all departments*/
       $department= new query('department');
       $department->Where="where is_active='1' order by position";
       $department->DisplayAll();
       $cat=array();

            if($department->GetNumRows()):
                while($object2 = $department->GetObjectFromRecord()):
                         $cat[$object2->id]=$object2->name;
                endwhile;
            endif;
        return($cat);
   }  

/*convert first letter of string to upper case another letters in lower case*/
function only_first_letter_upper($input_string)
{
  /*$lower_string=strtolower($input_string);
  
  $first_upper=ucfirst($lower_string);*/
    
  $first_upper=ucfirst($input_string);
  
  return($first_upper);
}

function only_first_word_upper($input_string)
{
 /* $lower_string=strtolower($input_string);
  
  $first_upper=ucwords($lower_string);*/
  $first_upper=ucwords($input_string);
  return($first_upper);
}
?>