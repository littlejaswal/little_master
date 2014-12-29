<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='3';

#Handle actions here.
switch ($action):
	case'list':
		$QueryObj =new query('content');
		$QueryObj->Where="where id='".$id."'";
		$product=$QueryObj->DisplayOne();
		$QueryObj->InitilizeSQL();
		
		$QueryObj->TableName='content_photo';
		$QueryObj->Where="where page_id='$id'";
		$QueryObj->DisplayAll();
		break;
	case'insert':
		$error='';
		if(isset($_POST['submit']) && $_POST['submit']=='Upload'):
			if(upload_photo('content', $_FILES['pic'])):
				$QueryObj= new query('content_photo');
				$QueryObj->Data['page_id']=$id;
				$QueryObj->Data['position']=$_POST['position'];
				$QueryObj->Data['image']=make_image_name($_FILES['pic']['name'], '0');
				$QueryObj->Insert();
				$admin_user->set_pass_msg('Image has been uploaded successfully.');
				Redirect(make_admin_url('content_photo', 'list', 'list', 'id='.$id));
			else:
				$admin_user->set_pass_msg($error);
				Redirect(make_admin_url('content_photo','list', 'insert', 'id='.$id));
			endif;
		endif;
		break;
	case'update_default':
			$images=new query('content_photo');
			$images->Where="where page_id='$id'";
			$images->DisplayAll();
			$image_arr= array();
			while($image=$images->GetObjectFromRecord()):
				$image_arr[$image->id]=$image->default_image;
			endwhile;
			$default=0;
			foreach($_POST['default'] as $k=>$v):
				if($v==1):
					$default=$k;
				endif;
			endforeach;
			
			foreach ($image_arr as $k=>$v):
				if($k!=$default):
					$query= new query('content_photo');
					$query->Data['id']=$k;
					$query->Data['default_image']=0;
					$query->Update();
				else:
					$query= new query('content_photo');
					$query->Data['id']=$k;
					$query->Data['default_image']=1;
					$query->Update();
				endif;
			endforeach;
			Redirect(make_admin_url('content_photo', 'list', 'list', 'id='.$id));
			break;
	case'delete':
		if(isset($_GET['delete']) && !empty($_GET['delete'])):
			$QueryObj= new query('content_photo');
			$QueryObj->id=$_GET['delete'];
			$QueryObj->Delete();
			$admin_user->set_pass_msg('Image has been deleted successfully.');
			Redirect(make_admin_url('content_photo', 'list', 'list', 'id='.$id));
		endif;
		break;
	default:break;
endswitch;
?>
