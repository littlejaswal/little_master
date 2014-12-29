<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='3';
isset($_GET['image_id'])?$image_id=$_GET['image_id']:$image_id='3';
isset($_GET['parent_id'])?$parent_id=$_GET['parent_id']:$parent_id='0';
#Handle actions here.
switch ($action):
	case'list':
		$QueryObj =new query('gallery');
		$QueryObj->Where="where id='".$id."'";
		$product=$QueryObj->DisplayOne();
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='gimage';
		$QueryObj->Where="where parent_id='$id'";
		$QueryObj->DisplayAll();
		break;
	case'insert':
		$error='';
		if(isset($_POST['submit']) && $_POST['submit']=='Upload'):
			if(upload_photo('gallery', $_FILES['pic'])):
				$QueryObj= new query('gimage');
				$QueryObj->Data['parent_id']=$id;
				$QueryObj->Data['caption']=$_POST['caption'];
				$QueryObj->Data['position']=$_POST['position'];
				$QueryObj->Data['link_url']=$_POST['link_url'];
				$QueryObj->Data['target']=$_POST['target'];
				$QueryObj->Data['image']=make_image_name($_FILES['pic']['name'], '0'); 
				$QueryObj->Insert();
				$admin_user->set_pass_msg('Image has been uploaded successfully.');
				Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id));
			else:
				$admin_user->set_pass_msg('Image could not be uploaded. Please try again.');
				Redirect(make_admin_url('gallery_image','list', 'insert', 'id='.$id));
			endif;
		endif;
		break;
		
	case'update':
		$gimg=get_object('gimage', $image_id);
		$error='';
		if(isset($_POST['submit']) && $_POST['submit']=='Upload'):
				$QueryObj= new query('gimage');
				if(!$_FILES['pic']['error']):
					upload_photo('gallery', $_FILES['pic']);
					$QueryObj->Data['image']=make_image_name($_FILES['pic']['name'], '0'); 
				endif;
				$QueryObj->Data['parent_id']=$id;
				$QueryObj->Data['caption']=$_POST['caption'];
				$QueryObj->Data['position']=$_POST['position'];
				$QueryObj->Data['link_url']=$_POST['link_url'];
				$QueryObj->Data['target']=$_POST['target'];
				$QueryObj->Data['id']=$_POST['image_id'];
				$QueryObj->Update();
				$admin_user->set_pass_msg('Image details have been updated successfully.');
				Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id));
		endif;
		break;
		case 'update2':
			if(isset($_POST['update_position'])):
				foreach($_POST['position'] as $k=>$v):
					$Q= new query('gimage');
					if($v==''):
						$Q->Data['position']=0;
					else:
						$Q->Data['position']=$v;
					endif;
					$Q->Data['id']=$k;
					$Q->Update();
				endforeach;
			endif;
		
			if(isset($_POST['update_status'])):
				$query= new query('gimage');
				$query->Data['is_active']=0;
				$query->UpdateCustom();
				
				foreach($_POST['is_active'] as $k=>$v):
					$query= new query('gimage');
					$query->Data['is_active']=1;
					$query->Data['id']=$k;
					$query->Update();
				endforeach;
			endif;
			Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id.'&parent_id='.$parent_id));
		
		break;
	case'update_default':
			if(is_var_set_in_post('default_image')):
				$images=new query('gimage');
				$images->Where="where parent_id='$id'";
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
						$query= new query('gimage');
						$query->Data['id']=$k;
						$query->Data['default_image']=0;
						$query->Update();
					else:
						$query= new query('gimage');
						$query->Data['id']=$k;
						$query->Data['default_image']=1;
						$query->Update();
					endif;
				endforeach;
				$admin_user->set_pass_msg('Image target been updated successfully.');
				Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id));
			endif;
			if(is_var_set_in_post('target_image')):		
				foreach ($_POST['target'] as $k=>$v):
					$q= new query('gimage');
					$q->Data['id']=$k;
					$q->Data['target']=$v;
					$q->Update();	
				endforeach;
				$admin_user->set_pass_msg('Image target been updated successfully.');
				Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id));
			endif;
			
			break;
	case'delete':
		if(isset($_GET['delete']) && !empty($_GET['delete'])):
			$image=get_object('gimage', $_GET['delete']);
			$QueryObj= new query('gimage');
			$QueryObj->id=$_GET['delete'];
			$QueryObj->Delete();
			delete_if_image_exists('gallery', 'large', $image->image);
			delete_if_image_exists('gallery', 'thumb', $image->image);
			$admin_user->set_pass_msg('Image has been deleted successfully.');
			Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id));
		endif;
		break;
	default:break;
endswitch;
?>
