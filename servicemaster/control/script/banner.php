<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['type'])?$type=$_GET['type']:$type='logo';
$type=strtolower($type);
$id=isset($_GET['id'])?$_GET['id']:"0";
#handle actions here.

switch ($action):
	case'list':
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='banner';
		$QueryObj->Where="where type='$type'";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=60;
		$QueryObj->PageNo=(isset($_GET['page']))?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;	
	case'insert':
	         $actualfilename="";
			 if(uploadfile($_FILES['ujpg'], $AllowedImageTypes, DIR_FS_SITE_UPLOAD_PHOTO_BANNER)):
				$QueryObj= new query('banner');
				$QueryObj->Data['name']=$_POST['name'];
				$QueryObj->Data['url']=$_POST['url'];
				$QueryObj->Data['type']=$_POST['type'];
				$QueryObj->Data['image']=$_FILES['ujpg']['name'];
				$QueryObj->Insert();
				$admin_session->set_pass_msg('Brand has been uploaded successfully.');
				Redirect(make_admin_url('banner', 'list', 'list', 'type='.$type));
			else:
				$admin_session->set_pass_msg($error);
				Redirect(make_admin_url('banner','list', 'insert'));
			endif;
	case'update':
			if(isset($_POST['submit']) && $_POST['submit']=='Update'):
				 $QueryObj=new query('banner');
				 if(uploadfile($_FILES['ujpg'], $AllowedImageTypes, DIR_FS_SITE_UPLOAD_PHOTO_BANNER)):
					$QueryObj->Data['image']=$_FILES['ujpg']['name'];
				 endif;
				 $QueryObj->Data['name']=$_POST['name'];
				 $QueryObj->Data['is_active']=$_POST['is_active'];
				 $QueryObj->Data['type']=$_POST['type'];
				 $QueryObj->Data['id']=$_POST['id'];
				 $QueryObj->Update();
				 $admin_session->set_pass_msg('Image has been uploaded successfully.');
				 Redirect(make_admin_url('banner', 'list', 'list', 'type='.$type));
			else:
					$admin_session->set_pass_msg($error);
					Redirect(make_admin_url('banner','list', 'insert', 'type='.$type));
			endif;
			break;
	case'delete':
		$id=$_GET['id'];
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='banner';
		$QueryObj->id=$id;
		$QueryObj->Delete();
		header("location:".DIR_WS_SITE_CONTROL."control.php?Page=banner&type=".$type);
		exit;	
		# get the object in variable first and then delete it.
		# now delte the corresponding address object.
		# redirect back to listing page.
		break;
	case 'status':
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='banner';
		$QueryObj->Data['id']=$id;
		$QueryObj->Data['is_active']=($_GET['is_active'])?0:1;;
		$QueryObj->Update();
		header("location:".DIR_WS_SITE_CONTROL."control.php?Page=banner&type=".$type);
		exit;
		break;
	default:break;
endswitch;
?>
