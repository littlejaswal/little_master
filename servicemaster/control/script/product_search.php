<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
$results=0;
#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('category');
		$QueryObj->Where="where parent_id='0'";
		$QueryObj->DisplayAll();
		break;
	case'search':
		$QueryObj = new query('category');
		$QueryObj->Where="where parent_id='0'";
		$QueryObj->DisplayAll();
		$results=0;
		if(isset($_GET['submit_search'])):
			$results=0;
			$keyword=$_GET['keyword'];
			$category=$_GET['category'];
			$q= new query('product');
			$where='';
			if($keyword!=''):
				$keyword_splitted=explode(' ', $keyword);
				foreach ($keyword_splitted as $k=>$v):
					$where.="(description like '%$v%') or (name like '%$v%') or";
				endforeach;
			endif;
			if($where!=''):
				$where=substr($where, 0, strlen($where)-3);
				$where='('.$where.')';
				if($category):
					#Get ids of all sub-categories.
					#level -1
					$ids=get_all_sub_cats('category', $category);
					$id_ar=explode(',', $ids);
					#level -2
					foreach ($id_ar as $k=>$v):
						if($sub_id=get_all_sub_cats('category', str_replace("'", '', $v))):
							$ids.=', '.$sub_id;
						endif;
					endforeach;
					$where.=" and parent_id IN ($ids)";
				endif;
			else:
				if($category):
					#Get ids of all sub-categories.
					#level -1
					$ids=get_all_sub_cats('category', $category);
					$id_ar=explode(',', $ids);
					#level -2
					foreach ($id_ar as $k=>$v):
						if($sub_id=get_all_sub_cats('category', str_replace("'", "", $v))):
							$ids.=', '.$sub_id;
						endif;
					endforeach;
					$where.=" parent_id IN ($ids)";
				endif;
			endif;
			$q->Where="where ".$where;
			$q->AllowPaging=true;
			$q->PageSize=100;
			$q->PageNo=isset($_GET['page'])?$_GET['page']:1;
			$q->DisplayAll();
			if($q->GetNumRows()):
				$results=1;
			endif;
		endif;
		break;
	case'update':
		$QueryObj = new query('news');
		$QueryObj->Where="where id='".$id."'";
		$news=$QueryObj->DisplayOne();
		//print_r($news);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('news');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('news', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('news');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('news', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
