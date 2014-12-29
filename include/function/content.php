<?php
function page_preview($is_preview, $preview_update_date='', $publish_date='', $preview_of_page_id='')
{
	global $Data;
	$preview_update_date=($preview_update_date=='')?date("Y-m-d"):$preview_update_date;
	$publish_date=($publish_date=='')?date("Y-m-d"):$publish_date;
	$preview_of_page_id=($preview_of_page_id=='')?0:$preview_of_page_id;
	$is_preview=$is_preview?1:0;
	$Data['is_preview']=$is_preview;
	$Data['preview_update_date']=$preview_update_date;
	$Data['publish_date']=$publish_date;
	$Data['preview_of_page_id']=$preview_of_page_id;
	#return array('is_preview'=>$is_preview, 'preview_update_date'=>$preview_update_date, 'publish_date'=>$publish_date, 'preview_of_page_id'=>$preview_of_page_id);	
}

function is_published($id, $table='content')
{
	$object=get_object_by_col($table, 'id', $id);
	return ($object->is_preview)?false:true;
}

function is_secure_published($id)
{
	$object=get_object_by_col('secure_content', 'id', $id);
	return ($object->is_preview)?false:true;
}





function get_content_page_names_by_parent_id($id=0)
{
	$query= new query('content');
	$query->Where="where parent_id='$id' and is_preview='0'";
	$query->DisplayAll();
	$content=array();
	while($object=$query->GetObjectFromRecord()):
		array_push($content, array('id'=>$object->id, 'name'=>$object->name));
	endwhile;
	return $content;
}

function get_content_children($parent_id, $limit=0, $fields=array())
{
	$query= new query('content');
	if(is_array($fields) && count($fields)):
		$field=implode(',', $fields);
		$query->Field=$field;
	endif;
	if($limit):
		$query->Where="where parent_id='$parent_id' and is_preview='0' limit 0, $limit";
	else:
		$query->Where="where parent_id='$parent_id' and is_preview='0'";
	endif;
	$query->DisplayAll();
	$list=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$list[]=$object;
		endwhile;
	endif;
	return $list;
}

function get_cotent_parent_id($id)
{
	$object= get_object('content', $id);
	return $object->parent_id;
}

function get_content($id, $fields=array()){
	$query= new query('content');
	if(is_array($fields) && count($fields)):
		$field=implode(',', $fields);
		$query->Field=$field;
	endif;
	$query->Where="where id='$id'";
	$content=$query->DisplayOne();
	return $content;
}

/*Get all sections */
function get_all_sections()
{
     $query= new query('section');
     $query->DisplayAll();
        if($query->GetNumRows()):
                while($object = $query->GetObjectFromRecord()):
                      
       echo '<li><a href="'.make_admin_url('content', 'list', 'list'.'&type='.$object->id).'">Manage '.$object->name.' Pages</a></li>';
                endwhile;
            endif;
       
    
}
/*get section name*/
function get_section_name($id)
{
    $object=get_object('section', $id);
    return $object->name;
}
/*Get all Modules */
function get_all_modules()
{
     $query= new query('module');
     $query->DisplayAll();
     $modules=array();
        if($query->GetNumRows()):
                while($object = $query->GetObjectFromRecord()):
                     $modules[$object->page_name]=$object->display_name;
                endwhile;
        endif;
    return($modules);         
          
}

/*Get all Content Pages */
function get_all_content_pages()
{
     $query= new query('content');
     $query->DisplayAll();
     $pages=array();
        if($query->GetNumRows()):
                while($object = $query->GetObjectFromRecord()):
                     $pages[$object->id]=$object->page_name;
                endwhile;
        endif;
    return($pages);         
          
}

?>