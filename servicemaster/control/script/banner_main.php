<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
$id=isset($_GET['id'])?$_GET['id']:"0";
#handle actions here.

switch ($action):
	case'list':
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='banner';
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=60;
		$QueryObj->PageNo=(isset($_GET['page']))?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;	
	case'insert':
	        //print_r($_FILES);exit;
			 $actualfilename="";
			 if(uploadfile($_FILES['ujpg'], $AllowedImageTypes, DIR_FS_SITE_UPLOAD_PHOTO_BANNER)):
				$QueryObj= new query('banner');
				$QueryObj->Data['name']=$_POST['name'];
				$QueryObj->Data['url']=$_POST['url'];
				$QueryObj->Data['type']=$_POST['type'];
				$QueryObj->Data['image']=$_FILES['ujpg']['name'];
				$QueryObj->Insert();
				$admin_session->set_pass_msg('Brand has been uploaded successfully.');
				Redirect(make_admin_url('banner', 'list', 'list'));
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
//				 if(!isset($_POST['is_active'])):
//				$QueryObj->Data['is_active']=0;
//			endif;
				 $QueryObj->Update();
				 $admin_session->set_pass_msg('Image has been uploaded successfully.');
				 Redirect(make_admin_url('banner', 'list', 'list'));
			else:
					$admin_session->set_pass_msg($error);
					Redirect(make_admin_url('banner','list', 'insert'));
			endif;
			break;
	case'delete':
		$id=$_GET['id'];
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='banner';
		$QueryObj->id=$id;
		$QueryObj->Delete();
		header("location:".DIR_WS_SITE_CONTROL."control.php?Page=banner");
		exit;	
		# get the object in variable first and then delete it.
		# now delte the corresponding address object.
		# redirect back to listing page.
		break;
	default:break;
endswitch;

function get_count($type)
{
	$type=strtolower($type);
	$query = new query('banner');
	$query->Where="where type='$type'";
	$query->DisplayAll();
	return $query->GetNumRows();
}



?>
