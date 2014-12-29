<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=0;
isset($_GET['parent_id'])?$parent_id=$_GET['parent_id']:$parent_id=0;

#handle actions here.
switch ($action):
	case 'list':
		$QueryObj = new query('content');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->Where="where parent_id='$parent_id'";
		#$QueryObj->print=1;
		$QueryObj->DisplayAll();
		$AllRecords = new query('content');
		$AllRecords->DisplayAll();
		break;
	case 'view':
		if($id!=0):
			$QueryObj =new query('content');
			$QueryObj->Where="where id='".$id."'";
			//$QueryObj->print=1;
			$page_cotent=$QueryObj->DisplayOne();
		endif;
		break;
	case 'update':
		$AllRecords = new query('content');
		$AllRecords->DisplayAll();
		
		if($id!=0):
			$QueryObj =new query('content');
			$QueryObj->Where="where id='".$id."'";
			$page_cotent=$QueryObj->DisplayOne();
		endif;
		
		if(isset($_POST['save'])):
			
			if(isset($_POST['navigation']) && is_array($_POST['navigation'])):
				$_POST['navigation']=implode(',', $_POST['navigation']);
			endif;
			
			if(isset($_POST['collection']) && is_array($_POST['collection'])):
				$_POST['collection']=implode(',', $_POST['collection']);
			endif;
		
		
			if(is_published($id)):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='content';
				$not=array('save');
				$Data=MakeDataArray($_POST, $not);
				page_preview(1,'','',$id);
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('The page has successfully been Added.');
				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));
			else:
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='content';
				$not=array('save');
				$Data=MakeDataArray($_POST, $not);
				$Data['id']=$id;
				page_preview(1);
				$QueryObj->Data=$Data;
				$QueryObj->Update();
				$admin_user->set_pass_msg('The page has successfully been updated.');
				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));
			endif;
		endif;
				
		if(isset($_POST['publish'])):
			if(isset($_POST['navigation']) && is_array($_POST['navigation'])):
				$_POST['navigation']=implode(',', $_POST['navigation']);
			endif;
			
			if(isset($_POST['collection']) && is_array($_POST['collection'])):
				$_POST['collection']=implode(',', $_POST['collection']);
			endif;
			
			if(is_published($id)):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='content';
				$not=array('publish');
				$Data=MakeDataArray($_POST, $not);
				page_preview(0);
				$Data['id']=$id;
				$QueryObj->Data=$Data;
				$QueryObj->Update();
				$admin_user->set_pass_msg('The page has successfully been Updated.');
				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));
			else:
				# get object contents
				$object=get_object_by_col('content', 'id', $id);
				# update the previous page.
				if($object->preview_of_page_id):
					$QueryObj->InitilizeSQL();
					$QueryObj->TableName='content';
					$Data['id']=$object->preview_of_page_id;
					$Data['page']=$object->page;
					$Data['meta_keyword']=$object->meta_keyword;
					$Data['meta_description']=$object->meta_description;
					page_preview(0);
					$QueryObj->Data=$Data;
					$QueryObj->Update();
					# delete the preview page.
					$query= new query('content');
					$query->id=$id;
					$query->Delete();
				else:
					$QueryObj->InitilizeSQL();
					$QueryObj->TableName='content';
					$Data['id']=$id;
					page_preview(0);
					$QueryObj->Data=$Data;
					$QueryObj->Update();
				endif;
												
				$admin_user->set_pass_msg('The page has successfully been updated.');
				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));
			endif;
		endif;
					
		break;
	case 'insert':
			
			if(isset($_POST['navigation']) && is_array($_POST['navigation'])):
				$_POST['navigation']=implode(',', $_POST['navigation']);
			endif;
			
			if(isset($_POST['collection']) && is_array($_POST['collection'])):
				$_POST['collection']=implode(',', $_POST['collection']);
			endif;
				
		
			if(isset($_POST['publish'])):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='content';
				$not=array('publish');
				$Data=MakeDataArray($_POST, $not);
				$Data['id']=$id;
				page_preview(0);
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('The page has successfully been Added.');
				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));
			endif;
			
			if(isset($_POST['save'])):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='content';
				$not=array('save');
				$Data=MakeDataArray($_POST, $not);
				$Data['id']=$id;
				page_preview(1);
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('The page has successfully been Added.');
				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));
			endif;
			
			break;
	case 'delete':
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='content';
			$QueryObj->id=$id;
			$QueryObj->Delete();
			$admin_user->set_pass_msg('The page has successfully been deleted.');
			Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));
	default:break;
endswitch;


function get_name_by_id($id)
{
	if($id!=0):
		$q= new query('content');
		$q->Where="where id='".$id."'";
		$r=$q->DisplayOne();
		return $r->name;
	else:
		return 'Root';
	endif;
}
?>
