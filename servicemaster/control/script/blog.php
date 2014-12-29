<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=0;

#handle actions here.
switch ($action):
	case 'list':
		$QueryObj = new query('blog');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
	
		$QueryObj->DisplayAll();
		$AllRecords = new query('blog');
		$AllRecords->DisplayAll();
		break;
	case 'view':
		if($id!=0):
			$QueryObj =new query('blog');
			$QueryObj->Where="where id='".$id."'";
			//$QueryObj->print=1;
			$page_cotent=$QueryObj->DisplayOne();
		endif;
		break;
	case 'update':
		$AllRecords = new query('blog');
		$AllRecords->DisplayAll();
		
		if($id!=0):
			$QueryObj =new query('blog');
			$QueryObj->Where="where id='".$id."'";
			$page_cotent=$QueryObj->DisplayOne();
		endif;
		
		if(isset($_POST['save'])):
			if(is_published($id, 'blog')):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='blog';
				$not=array('save');
				$Data=MakeDataArray($_POST, $not);
				page_preview(1,'','',$id);
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('The article has successfully been Added.');
				Redirect(make_admin_url('blog', 'list', 'list'));
			else:
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='blog';
				$not=array('save');
				$Data=MakeDataArray($_POST, $not);
				$Data['id']=$id;
				page_preview(1);
				$QueryObj->Data=$Data;
				$QueryObj->Update();
				$admin_user->set_pass_msg('The article has successfully been updated.');
				Redirect(make_admin_url('blog', 'list', 'list'));
			endif;
		endif;
				
		if(isset($_POST['publish'])):
			if(is_published($id, 'blog')):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='blog';
				$not=array('publish');
				$Data=MakeDataArray($_POST, $not);
				page_preview(0);
				$Data['id']=$id;
				$QueryObj->Data=$Data;
				$QueryObj->Update();
				$admin_user->set_pass_msg('The article has successfully been Updated.');
				Redirect(make_admin_url('blog', 'list', 'list'));
			else:
				# get object blogs
				$object=get_object_by_col('blog', 'id', $id);
				# update the previous page.
				if($object->preview_of_page_id):
					$QueryObj->InitilizeSQL();
					$QueryObj->TableName='blog';
					$Data['id']=$object->preview_of_page_id;
					$Data['page']=$object->page;
					$Data['meta_keyword']=$object->meta_keyword;
					$Data['meta_description']=$object->meta_description;
					page_preview(0);
					$QueryObj->Data=$Data;
					$QueryObj->Update();
					# delete the preview page.
					$query= new query('blog');
					$query->id=$id;
					$query->Delete();
				else:
					$QueryObj->InitilizeSQL();
					$QueryObj->TableName='blog';
					$Data['id']=$id;
					page_preview(0);
					$QueryObj->Data=$Data;
					$QueryObj->Update();
				endif;
												
				$admin_user->set_pass_msg('The article has successfully been updated.');
				Redirect(make_admin_url('blog', 'list', 'list'));
			endif;
		endif;
					
		break;
	case 'insert':
			if(isset($_POST['publish'])):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='blog';
				$not=array('publish');
				$Data=MakeDataArray($_POST, $not);
				$Data['id']=$id;
				page_preview(0);
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('The article has successfully been Added.');
				Redirect(make_admin_url('blog', 'list', 'list'));
			endif;
			
			if(isset($_POST['save'])):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='blog';
				$not=array('save');
				$Data=MakeDataArray($_POST, $not);
				$Data['id']=$id;
				page_preview(1);
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('The article has successfully been Added.');
				Redirect(make_admin_url('blog', 'list', 'list'));
			endif;
			
			break;
	case 'delete':
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='blog';
			$QueryObj->id=$id;
			$QueryObj->Delete();
			$admin_user->set_pass_msg('The article has successfully been deleted.');
			Redirect(make_admin_url('blog', 'list', 'list'));
	default:break;
endswitch;


function get_name_by_id($id)
{
	if($id!=0):
		$q= new query('blog');
		$q->Where="where id='".$id."'";
		$r=$q->DisplayOne();
		return $r->name;
	else:
		return 'Root';
	endif;
}
?>
