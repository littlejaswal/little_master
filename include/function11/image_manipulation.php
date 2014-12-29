<?
function resize_image($url, $width='', $height='')
{
	if(isset($url))
	{
		$type='';
		$image=$url;
		if(!empty($image) and file_exists($image)):
			$type=substr($image, -3);			
			if($type=='jpg'):
				$ImageObj = imagecreatefromjpeg($image);
			elseif($type=='gif'):
				$ImageObj = imagecreatefromgif($image);
			endif;
		else:
			$ImageObj = imagecreatefromjpeg("../graphic/no_image.jpg");
		endif;
	}
	
	$Height = isset($height) ? $width:100;
	$Width = isset($height) ? $width:100;

	$NewHeight = $Height;
	$NewWidth = $Width;

	if(imagesx($ImageObj) >= $Width)
	{
		$NewHeight = imagesy($ImageObj) / imagesx($ImageObj) * $Width;
		if($NewHeight > $Height)
		{
			$NewHeight = $Height;
			$NewWidth = imagesx($ImageObj) / imagesy($ImageObj) * $Height;
		}
	}
	elseif (imagesy($ImageObj) >= $Height)
	{
		$NewWidth = imagesx($ImageObj) / imagesy($ImageObj) * $Height;
		if($NewWidth > $Width)
		{
			$NewWidth = $Width;
			$NewHeight = imagesy($ImageObj) / imagesx($ImageObj) * $Width;
		}
	}
	else
	{
		$NewHeight = imagesy($ImageObj);
		$NewWidth = imagesx($ImageObj);
	}
	$ImageNewObj = imagecreatetruecolor($NewWidth,$NewHeight);
	imagecopyresampled($ImageNewObj,$ImageObj,0,0,0,0,$NewWidth,$NewHeight,imagesx($ImageObj),imagesy($ImageObj));
	if($type=='gif'):
		ob_start();
		header("content-type: image/gif");
		imagegif($ImageNewObj);
		
	elseif($type=='jpg'):
		ob_start();
		header("content_type: image/jpeg");
		imagejpeg($ImageNewObj);
		exit;
	endif;
	
}

function link_image($name)
{
	return '<img src="'.DIR_WS_SITE_GRAPHIC.$name.'" border="0">';
}

function create_thumb($type, $image){
    
	// Get the original geometry and calculate scales
	$source_path=DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$image;
	$destination_path=DIR_FS_SITE.'upload/photo/'.$type.'/thumb/'.$image;
	list($width, $height) = getimagesize($source_path);
    $xscale=$width/THUMB_WIDTH;
    $yscale=$height/THUMB_HEIGHT;
	
    $new_width = THUMB_WIDTH;
    $new_height = round($height * (1/$xscale));
    // Recalculate new size with default ratio
    /*if ($yscale>$xscale){
        $new_width = round($width * (1/$yscale));
        $new_height = round($height * (1/$yscale));
    }
    else {
        $new_width = round($width * (1/$xscale));
        $new_height = round($height * (1/$xscale));
    }*/

    // Resize the original image & output
    $imageResized = imagecreatetruecolor($new_width, $new_height);
    $imageTmp     = imagecreatefromjpeg ($source_path);
    imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    output_img($imageResized, image_type_to_mime_type(getimagesize($source_path)), $destination_path);
}

function create_medium($type, $image){
    
	// Get the original geometry and calculate scales
	echo $source_path=DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$image;
	echo $destination_path=DIR_FS_SITE.'upload/photo/'.$type.'/medium/'.$image;
	list($width, $height) = getimagesize($source_path);
    $xscale=$width/MEDIUM_WIDTH;
    $yscale=$height/MEDIUM_HEIGHT;
    
    // Recalculate new size with default ratio
    if ($yscale>$xscale){
        $new_width = round($width * (1/$yscale));
        $new_height = round($height * (1/$yscale));
    }
    else {
        $new_width = round($width * (1/$xscale));
        $new_height = round($height * (1/$xscale));
    }

    // Resize the original image & output
    $imageResized = imagecreatetruecolor($new_width, $new_height);
    $imageTmp     = imagecreatefromjpeg ($source_path);
    imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    output_img($imageResized, image_type_to_mime_type(getimagesize($source_path)), $destination_path);
}

function output_img($rs, $mime, $path)
{
	switch ($mime)
	{
		case 'image/jpeg':
		case 'image/jpg':
		case 'image/pjpeg':
		case 'image/pjpg':
				imagejpeg($rs, $path, 8);
				break;
		case 'image/gif':
				imagegif($rs, $path, 8);
				break;
		case 'image/png':
				imagepng($rs, $path, 8);
				break;
		default:
				imagejpeg($rs, $path, 8);
	}
}

function get_thumb($type, $image)
{
	echo DIR_WS_SITE.'upload/photo/'.$type.'/thumb/'.$image;
}

function get_medium($type, $image)
{
	echo DIR_WS_SITE.'upload/photo/'.$type.'/medium/'.$image;
}

function delete_if_image_exists($type, $size, $image)
{
	if(file_exists(DIR_FS_SITE.'upload/photo/'.$type.'/'.$size.'/'.$image)):
		unlink(DIR_FS_SITE.'upload/photo/'.$type.'/'.$size.'/'.$image);
	endif;
}

function upload_photo($type, $file_name,$id)
{	$admin_user=new admin_session();
	global $conf_allowed_photo_mime_type;
	if($file_name['error']):
		return false;
	endif;
	
	$image_name= make_image_name($file_name['name'], $id);
	
	if(in_array($file_name['type'], $conf_allowed_photo_mime_type)):
		
		if(move_uploaded_file($file_name['tmp_name'], DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$image_name)):
			if(file_exists(DIR_FS_SITE.'upload/photo/'.$type.'/thumb/'.$image_name)):
				$admin_user->set_pass_msg('Image already exists with same name.Please select another image .');	
				return false;
			else:
				create_thumb($type, $image_name);
				create_medium($type, $image_name);
				return true;
			endif;
		else:
			return false;
		endif;
	endif;
	return false;
}

/*function upload_banner($type, $file_name)
{	$admin_user=new admin_session();
	global $conf_allowed_photo_mime_type;
	if($file_name['error']):
		return false;
	endif;
	
	$image_name=$file_name['name'];
	
	if(in_array($file_name['type'], $conf_allowed_photo_mime_type)):
		
		if(move_uploaded_file($file_name['tmp_name'], DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$image_name)):
			if(file_exists(DIR_FS_SITE.'upload/photo/'.$type.'/thumb/'.$image_name)):
				$admin_user->set_pass_msg('Image already exists with same name.Please select another image .');	
				return false;
			else:
				create_thumb($type, $image_name);
				create_medium($type, $image_name);
				return true;
			endif;
		else:
			return false;
		endif;
	endif;
	return false;
}*/


function upload_banner($type, $file_name,$id)
{	$admin_user=new admin_session();
	global $conf_allowed_photo_mime_type;
	if($file_name['error']):
		return false;
	endif;
	
	$image_name= make_image_name($file_name['name'], $id);
	
	if(in_array($file_name['type'], $conf_allowed_photo_mime_type)):
		
		if(move_uploaded_file($file_name['tmp_name'], DIR_FS_SITE.'upload/photo/'.$type.'/large/'.$image_name)):
			if(file_exists(DIR_FS_SITE.'upload/photo/'.$type.'/thumb/'.$image_name)):
				$admin_user->set_pass_msg('Image already exists with same name.Please select another image .');	
				return false;
			else:
				create_thumb($type, $image_name);
				create_medium($type, $image_name);
				return true;
			endif;
		else:
			return false;
		endif;
	endif;
	return false;
}

function get_banner($id)
{
	$query= new query('gimage');
	$query->Where="where id='$id'";
	$banner=$query->DisplayOne();
	return $banner->image;
}

function get_large($type, $image)
{
	echo DIR_WS_SITE.'upload/photo/'.$type.'/large/'.$image;
}

function get_control_icon($name)
{
	return '<img src="'.DIR_WS_SITE.ADMIN_FOLDER.'/image/'.$name.'.png" border="none" align="absmiddle">';
}

function make_image_name($name, $id)
{
	$file_name_parts=explode('.', $name);
	$file_name_parts['0'].=$id;
	return $file_name_parts['0'].'.'.$file_name_parts['1'];
}
?>