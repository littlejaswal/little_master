<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#Handle actions here.
switch ($action):
	case'list':
		//$QueryObj =new query('slider');
		//$QueryObj->Where="where id='".$id."'";
		//$product=$QueryObj->DisplayOne();
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='forms';
		//$QueryObj->Where="where parent_id='$id'";
		$QueryObj->DisplayAll();
		break;
	case'insert':
		$error='';
		if(isset($_POST['submit']) && $_POST['submit']=='Upload'):
		//print_r($_FILES);exit;
		    if(upload_photo('forms', $_FILES['pic1'])):
			    //upload_photo('forms', $_FILES['pic1']);
			    
				$QueryObj= new query('forms');
				$QueryObj->Data['title']=$_POST['title'];
				//$QueryObj->Data['position']=$_POST['position'];
			
				$QueryObj->Data['name']=$_FILES['pic1']['name'];
				$QueryObj->Insert();
				//print_r($QueryObj);exit;
				$admin_user->set_pass_msg('file has been uploaded successfully.');
			    Redirect(make_admin_url('forms', 'list', 'list', ''));
			 else:
			 	Redirect(make_admin_url('forms', 'list', 'list', ''));
			 endif;
		endif;
		break;
		
		
	case'update':
		if(isset($_GET['update'])):
			$QueryObj =new query('forms');
			$QueryObj->Where="where id='".$_GET['update']."'";
			$category=$QueryObj->DisplayOne();
			//print_r($category);exit;
		endif;
		if(isset($_POST['update_category']) && $_POST['update_category']=='Submit'):
		   $image=get_object('forms', $_GET['id']);
			$not=array('update_category');
			$QueryObj =new query('forms');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			
			 
			
			if(upload_photo('forms', $_FILES['pic1'])):
			    //upload_photo_slider('large', $_FILES['pic']);
                $QueryObj->Data['name']=$_FILES['pic1']['name'];
				$QueryObj->Data['title']=$_POST['title'];
			    $QueryObj->Update();
				delete_if_image_exists('forms', 'large', $image->name);
				//print_r($QueryObj);exit;
			endif;
			
			
			$admin_user->set_pass_msg('file have been updated successfully.');
			Redirect(make_admin_url('forms', 'list', 'list', 'id='.$id));
		endif;
		
	
		break;	
		
		
	
	case'delete':
		if(isset($_GET['delete']) && !empty($_GET['delete'])):
			$file=get_object('forms', $_GET['delete']);
			$QueryObj= new query('forms');
			$QueryObj->id=$_GET['delete'];
			$QueryObj->Delete();
			delete_if_image_exists('forms', 'large', $file->name);
			
			//delete_if_image_exists('slider', 'thumb', $image->image);
			$admin_user->set_pass_msg('form has been deleted successfully.');
			Redirect(make_admin_url('forms', 'list', 'list', 'id='.$id));
		endif;
		break;
	default:break;
endswitch;
?>
