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

function get_content_navigation_type($selected=array()){
	$query= new query('content_navigation');
	$query->Where="where is_active='yes'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while ($object=$query->GetObjectFromRecord()) {
			if(in_array($object->id, $selected)):
				echo '<option value="'.$object->id.'" selected>'.ucfirst($object->name).'</option>';
			else:
				echo '<option value="'.$object->id.'" >'.ucfirst($object->name).'</option>';
			endif;
		}
	endif;
}

function get_content_collection($selected=array()){
	$query= new query('content_collection');
	$query->Where="where is_active='yes'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		while ($object=$query->GetObjectFromRecord()) {
			if(in_array($object->id, $selected)):
				echo '<option value="'.$object->id.'" selected>'.ucfirst($object->name).'</option>';
			else:
				echo '<option value="'.$object->id.'" >'.ucfirst($object->name).'</option>';
			endif;
		}
	endif;
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

?>