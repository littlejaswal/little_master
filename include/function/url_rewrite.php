<?php

$conf_rewrite_url = array(
  
    'content' => 'page',  
	'home' => 'home',     
	'about' => 'about',	
	'location' => 'location',
	'contact' => 'contact-us',
	'monument' => 'monument',	
	'services' => 'services',	
	'testimonials' => 'testimonials',    
	'sitemap' => 'site-map',
	'legal' => 'legal',

   
); 

function make_url($page, $query=NULL) {
    global $conf_rewrite_url;
    parse_str($query, $string);
    if (isset($conf_rewrite_url[strtolower($page)]))
        return _makeurl($page, $string);
    else
        return DIR_WS_SITE . '?page=' . $page . '&' . $query;
}

function load_url() {
    global $conf_rewrite_url;
    $prefix = '/pearlandpm/';
    $URL = $_SERVER['REQUEST_URI'];
    if (strpos($URL, '?') === false):
        $string = substr($URL, -(strlen($URL) - strlen($prefix)));
        $string_parts = explode('/', $string);
        $url_array = array_flip($conf_rewrite_url);
        /* print_r($url_array); */
        if (isset($url_array[$string_parts['0']])) {
            _load($url_array[$string_parts['0']], $string_parts);
        }
    endif;
}

function _makeurl($page, $string) {

    switch ($page) {      
       
        case 'content':
            if (isset($string['id'])):
                $object = get_object('content', $string['id']);
                return DIR_WS_SITE .'page/'.$object->urlname;
            endif;
            break;

		case'about':
            return DIR_WS_SITE . 'about';
            break;		
				
		case'legal':
            return DIR_WS_SITE . 'legal';
            break;
				
			
		case'location':
            return DIR_WS_SITE . 'location';
            break;			
					
	  case 'contact':
				if(isset($string ['msg'])):
                                      
					return DIR_WS_SITE.'contact-us/'.(($string['msg']));
				else:
					return DIR_WS_SITE.'contact-us';
				endif;
				break;
     	
		case'services':
            return DIR_WS_SITE . 'services';
            break;
			
		case'testimonials':
            return DIR_WS_SITE . 'testimonials';
            break;		
            
            
        case'sitemap':
            return DIR_WS_SITE . 'site-map';
            break;
     

        case 'home':
            return DIR_WS_SITE;
            break;
        default: break;
    }
}

function _load($page, $string_parts) {
    global $conf_rewrite_url;

    switch ($page) {
	
		case 'about':
            $_REQUEST['page'] = 'about';

            break;	

		case 'legal':
            $_REQUEST['page'] = 'legal';

            break;
	
		case 'location':
            $_REQUEST['page'] = 'location';

            break;	
	
		case 'testimonials':
            $_REQUEST['page'] = 'testimonials';

            break;
	
        case 'home':
            return DIR_WS_SITE;
            break;
      
            break;
        case 'content':
            if (count($string_parts) == 2):
                $object = get_object_by_col('content', 'urlname', urldecode($string_parts['1']));
                $_REQUEST['page'] = 'content';
                $_GET['id'] = $object->id;
			else:				
				$object=get_object_by_col('content', 'urlname', urldecode($string['1']));
				$_REQUEST['page']='content';
				$_GET['id']=$object->id;
				$_GET['p']=$string_parts['2'];
            endif;
            break;

          
        case 'services':
            $_REQUEST['page'] = 'services';

            break;
		
		case 'links':
            $_REQUEST['page'] = 'links';

            break;	

 case 'contact':
                          if(count($string_parts)==2):
                             $_REQUEST['page']='contact';
                             $_GET['msg']=$string_parts['1'];
                          else:
                             $_REQUEST['page']='contact';
                          endif;
                          break;     

        case 'sitemap':
            $_REQUEST['page'] = 'sitemap';

            break;


        default:
    }
}

?>