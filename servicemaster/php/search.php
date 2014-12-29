<?php
$status=0;
if(isset($_GET['keyword']) && !empty($_GET['keyword'])):
	$keyword=$_GET['keyword'];
	$keys=explode(' ', $keyword);
	
	$query=new query('content');
	$q='where (';
	foreach ($keys as $k=>$v):
		$q.=" page_name LIKE '%".$v."%' OR";
		$q.=" page LIKE '%".$v."%' OR";
	endforeach;
	
	$q=substr($q, 0, strlen($q)-3);
	$q.=')';
	$query->Where=$q;
	$query->AllowPaging=true;
	$query->PageNo=isset($_GET['p'])?$_GET['p']:1;
	$query->PageSize=6;
	#$query->print=1;
	$query->DisplayAll();
	$status=0;
	if($query->GetNumRows()):
		$status=1;
	endif;
	$qstring='&keyword='.$_GET['keyword'];
endif;

#page array;
$pagearray=array('1'=>'content', '9'=>'content', '14'=>'content', '25'=>'home', '26'=>'reports', '31'=>'content');

function get_super_parent($id){
	$parent_id=0;
	while($id!=0):
		$QueryObj =new query('content');
		$QueryObj->Where="where id='".$id."'";
		$cat=$QueryObj->DisplayOne();
		if($cat->parent_id):
			$id=$cat->parent_id;	
		else:
			break;
		endif;
	endwhile;
	return $id;
}
?>