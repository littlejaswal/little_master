<?
	function Redirect($URL)
	{
		header("location:$URL");
		exit;
	}
	
	function Redirect1($filename)
	{
    	if (!headers_sent())
       		 header('Location: '.$filename);
   	else {
		        echo '<script type="text/javascript">';
		        echo 'window.location.href="'.$filename.'";';
		        echo '</script>';
		        echo '<noscript>';
		        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
		        echo '</noscript>';
    	}
	}

	
	function re_direct($URL)
	{
		header("location:$URL");
		exit;
	}
/*	function make_url($page, $query=null)
	{
		return DIR_WS_SITE.'index.php?page='.$page.'&'.$query;
	}*/
	
	function display_url($title, $page, $query='', $class='')
	{
		return '<a href="'.make_url($page, $query).'" class="'.$class.'">'.$title.'</a>';
	}
	
	function make_admin_url($page, $action='list', $section='list', $query='')
	{
		return DIR_WS_SITE_CONTROL.'control.php?Page='.$page.'&action='.$action.'&section='.$section.'&'.$query;
		
	}
	
	function make_admin_url2($page, $action='list', $section='list', $query='')
	{
		if($page=='home'):
			return DIR_WS_SITE.'index.php';
		else:
			return DIR_WS_SITE_CONTROL.'control.php?Page='.$page.'&action2='.$action.'&section2='.$section.'&'.$query;
		endif;
	}

function category_img_url($name)
{
	if($name==''):
		return DIR_WS_SITE_UPLOAD_PHOTO_CATEGORY.'no_image.jpg';
	else:	
		return DIR_WS_SITE_UPLOAD_PHOTO_CATEGORY.$name;
	endif;
}

	function category_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_CATEGORY.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_CATEGORY.$name;
	endif;
}

	function product_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_PRODUCT.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_PRODUCT.$name;
	endif;
}
function banner_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_BANNER.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_BANNER.$name;
	endif;
}

/**
 * Make admin anchor tag
 *
 * @param url $url
 * @param text $text
 * @param  Title $title
 * @param css class $class
 * @param alt tag $alt
 */
function make_admin_link($url, $text, $title='', $class='', $alt='')
{
	return  '<a href="'.$url.'" class="'.$class.'" title="'.$title.'" alt="'.$alt.'" >'.$text.'</a>';
}


/////////////////////// functions for URL rewrite ///////////////////////////////
function make_url($page, $query=null)
	{
		return DIR_WS_SITE.'?page='.$page.'&'.$query;
	}
/* function make_url($page, $query=null)
	{
		#parse query string
		$string=array();
		parse_str($query, $string);
		switch ($page){
			case 'content':
					$q= new query($page);
					$q->Field='name';
					$q->Where="where id='$string[id]'";
					$con=$q->DisplayOne();
					#$url=DIR_WS_SITE.'content/'.str_replace(' ', '-', strtolower($con->name));
					$url=DIR_WS_SITE.'content/'.$con->name;
					return $url;
					break;
			case 'product':
					$id=$string['id'];
					$p=isset($string['p'])?$string['p']:0;
					$category= new query('category');
					$category->Where="where id='".$id."' and is_active='1'";
					if($cat=$category->DisplayOne()):
						if($p):
							return DIR_WS_SITE.'category/'.str_replace(' ', '-', strtolower($cat->name)).'/'.$p;
						else:
							return DIR_WS_SITE.'category/'.str_replace(' ', '-', strtolower($cat->name));
						endif;
					else:
						return DIR_WS_SITE;
					endif;
					break;
			case 'pdetail':
					if(isset($string['id'])):
						$proid=$string['id'];
						$p0= new query('product');
						$p0->Where="where id='".$proid."' and is_active='1'";
						$pro=$p0->DisplayOne();
						return DIR_WS_SITE.'product/'.str_replace(' ', '-', strtolower($pro->name));
					else:
						return DIR_WS_SITE.'404';
					endif;
					break;
			case 'cart':
					if(count($string)==0):
						return  DIR_WS_SITE.'shopping-basket';
					endif;
					if(isset($string['shipping'])):
						return DIR_WS_SITE.'shipping-'.$string['shipping'];
					endif;
					if(isset($string['edit'])):
						#return DIR_WS_SITE.'your-cart-edit.html';
						return DIR_WS_SITE.'shopping-basket-edit.html';
					endif;

					if(count($string)==2 && isset($string['delete'])):
						$id=$string['id'];
						$p= new query('cart');
						$p->Where="where id='".$id."'";
						$cat=$p->DisplayOne();
						return DIR_WS_SITE.'shopping-basket/delete/'.$string['id'].'/'.str_replace(' ', '-', strtolower($cat->name));
					endif;

					break;
			case 'shipping':
					return DIR_WS_SITE.'shipping';
					break;
			case 'billing':
					return DIR_WS_SITE.'billing';
					break;
			case 'confirm':
					$url=DIR_WS_SITE;
					if(isset($string['id'])):
						$url.='confirm-order/'.$string['id'];
						return $url;
						break;
					endif;
					return DIR_WS_SITE.'confirm-order';
					break;
			case 'search':
					$url=DIR_WS_SITE;
					$url.='?page='.$page.'&';
					foreach ($string as $k=>$v):	
						$url.=$k.'='.$v.'&';
					endforeach;
					return $url;
					break;
			case 'home':
					$url=DIR_WS_SITE;
					return $url;
					break;
			case 'wish_list':
					$url=DIR_WS_SITE;
					if(isset($string['delete'])):
						return DIR_WS_SITE.'saved-favourites/delete/'.$string['id'];
					endif;
					if(isset($string['add_wishlist'])):
						return DIR_WS_SITE.'saved-favourites/add/'.$string['id'];
					endif;
					return DIR_WS_SITE.'saved-favourites';
					break;
			case 'payment':
					$url=DIR_WS_SITE;
					return $url.'payment/'.$string['id'];
					break;
			default:
					$url=DIR_WS_SITE;
					if(isset($string['id'])):
						$url.=$page.'/'.$string['id'];
					else:
						$url.=$page.'.html';
					endif;
					return $url;
					break;

		}
		return  false;
	} */

function prepare_query($queryString)
{
	#print_r($_GET);exit;
	$string='';
	parse_str($queryString, $string);
	switch ($string['page']):
		case 'content':
			$query= new query('content');
			#$name=strtolower(str_replace('-', " ", $string['id']));
			$name=$string['id'];
			$query->Where="where name='$name'";
			$object=$query->DisplayOne();
			$_GET['id']=$object->id;
			$_REQUEST['id']=$object->id;
			break;
		case 'category':
				$category_name=strtolower(str_replace('-', " ", $string['id']));
				$id=get_category_id_by_name($category_name);
				$_GET['id']=$id; $_REQUEST['id']=$id;
				isset($string['p'])?$_GET['p']=$string['p']:'';
				$_GET['page']='product'; $_REQUEST['page']='product';
				break;
		case 'pdetail':
				$category_name=strtolower(str_replace('-', " ", $string['id']));
				if($id=get_product_id_by_url_name($string['id'])):
					$_GET['id']=$id; $_REQUEST['id']=$id;
					$_GET['page']='pdetail'; $_REQUEST['page']='pdetail';
				elseif($id=get_product_id_by_product_name($category_name)):
					$_GET['id']=$id; $_REQUEST['id']=$id;
					$_GET['page']='pdetail'; $_REQUEST['page']='pdetail';
				endif;
				break;
		case 'wish_list':
				$_GET['page']='wish_list'; $_REQUEST['page']='wish_list';
				isset($string['id'])?$_GET['id']=$string['id']:''; 
				isset($string['id'])?$_REQUEST['id']=$string['id']:''; 
				isset($string['delete'])?$_GET['delete']=1:'';
				isset($string['add_wishlist'])?$_GET['add_wishlist']=1:'';
				break;
		case 'search':
				$_GET['page']='search'; $_REQUEST['page']='search';
				isset($string['category'])?$_GET['category']=$string['category']:''; 
				isset($string['keyword'])?$_GET['keyword']=$string['keyword']:''; 
				isset($string['p'])?$_GET['p']=$string['p']:''; 
				break;
		case 'payment':
				isset($string['id'])?$_GET['id']=$string['id']:'';
				break;
		default: 
				isset($string['id'])?$_GET['id']=$string['id']:'';
				!isset($_GET['page'])?$_GET['page']='home':'';		
				break;
	endswitch;
}


function get_product_id_by_url_name($url_name)
	{
		$query = new query('product');
		$query->Where="where urlname='$url_name'";
		if($object=$query->DisplayOne()):
			return $object->id;
		else:
			return false;
		endif;
	}

function get_product_id_by_product_name($name)
	{
		$query = new query('product');
		$query->Where="where name='$name'";
		if($object=$query->DisplayOne()):
			return $object->id;
		else:
			return false;
		endif;
	}

function get_category_id_by_name($name)
	{
		$query = new query('category');
		$query->Where="where name='$name'";
		if($object=$query->DisplayOne()):
			return $object->id;
		else:
			return false;
		endif;
	}

?>