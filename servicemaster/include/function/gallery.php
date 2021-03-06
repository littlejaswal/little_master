<?php
function get_banner_images($count)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="gimage.*";
	$query->TableName="gimage";
	$query->Where="where parent_id=5 order by position limit 0, $count";
	$query->DisplayAll();
	$banner=array();
	if($query->GetNumRows()):
		while ($pro=$query->GetArrayFromRecord()) {
			$banner[]=$pro;
		}
	endif;
	return $banner;
}

function get_bottom_banner_images($count)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="gimage.*";
	$query->TableName="gimage";
	$query->Where="where parent_id=9 order by position limit 0, $count";
	$query->DisplayAll();
	$bottom_banner=array();
	if($query->GetNumRows()):
		while ($pro=$query->GetArrayFromRecord()) {
			$bottom_banner[]=$pro;
		}
	endif;
	return $bottom_banner;
}

function get_centre_banner_images($count)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="gimage.*";
	$query->TableName="gimage";
	$query->Where="where parent_id=10 order by position limit 0, $count";
	$query->DisplayAll();
	$centre_banner=array();
	if($query->GetNumRows()):
		while ($pro=$query->GetArrayFromRecord()) {
			$centre_banner[]=$pro;
		}
	endif;
	return $centre_banner;
}

function get_banner_by_id($id)
{
	$query= new query('gimage', $id);
	if(is_object($query)):
		return $query;
	else:
		return 0;
	endif;
}

function get_banners_in_category($id)
{
	$query = new query('gimage');
	$query->Where="where parent_id='$id'";
	$query->DisplayAll();
	
	$list=array();
	
	if($query->GetNumRows()):
		while ($object=$query->GetObjectFromRecord()) {
			$list[]=$object;
		}
	endif;
	return $list;
}

function get_banner_image_from_array($array){
	if(is_object($array)):
		return DIR_WS_SITE.'upload/photo/gallery/large/'.$array->image;
	else:
		return DIR_WS_SITE.'graphic/blood-bg.jpg';
	endif;
}

function get_banner_link_from_array($array){
	if(is_object($array)):
		return $array->link_url;
	else:
		return '#';
	endif;
}

function get_banner($id)
{
	$query= new query('gimage');
	$query->Where="where id='$id'";
	$banner=$query->DisplayOne();
	return $banner->image;
}

function banner_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_BANNER.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_BANNER.$name;
	endif;
}


?>