<?php
/*
 * Navigation Functions
 *
 */

function get_navigation($parent_id=0){
      $q= new query('navigation');
      $q->Where="where is_active='1' and parent_id='$parent_id' order by position ";
      $q->DisplayAll();
      if($q->GetNumRows()){
                return $q;
      }
      return false;
}
function get_last_navigation_id($parent_id=0){
      $q= new query('navigation');
      #$q->Field->'max(position) as ';
      $q->Where="where is_active='1' order by position desc";
      if($ob=$q->DisplayOne()):
          return true;
      else:
         return false;
      endif;
}

function get_navigation_options($query){
      $q= new query('navigation');
      $q->Where="where is_active='1' and parent_id='0' order by position ";
      $q->DisplayAll();
      echo '<option value="0">Root</option>';
      if($q->GetNumRows()){
                while($object=$q->GetObjectFromRecord()){
                    if($query!='' && $query==$object->id):
                        echo '<option value="'.$object->id.'" selected>'.$object->navigation_title.'</option>';
                    else:
                        echo '<option value="'.$object->id.'">'.$object->navigation_title.'</option>';
                    endif;
                }
      }
      return false;
}
function get_navigation_children($parent_id, $limit=0, $fields=array())
{
	$query= new query('navigation');
	if(is_array($fields) && count($fields)):
		$field=implode(',', $fields);
		$query->Field=$field;
	endif;
	if($limit):
		$query->Where="where parent_id='$parent_id' limit 0, $limit";
	else:
		$query->Where="where parent_id='$parent_id'";
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

?>