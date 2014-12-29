<?php
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		# get all categories.
		$QueryObj = new query('gallery');
		$QueryObj->Where="where parent_id='".$id."'";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['new_category']) && $_POST['new_category']=='Submit'):
			$not=array('new_category');
			$QueryObj =new query('gallery');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['parent_id']=$id;
                        $QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
                        $QueryObj->Data['show_home']=isset($_POST['show_home'])?1:0;
                        $rand=rand(0,999999);
			/*add image if uploaded.*/
			if(upload_photo('gallery', $_FILES['image'], $rand)):
                                $image_nam1e= make_image_name($_FILES['image']['name'], $rand); 
				$QueryObj->Data['image']=$image_nam1e;
			endif;
                        
                        /*check if meta tags are empty then fill it*/
			if($_POST['meta_name']==''):
				$QueryObj->Data['meta_name']=$_POST['name'];  
			endif;
			if($_POST['urlname']!=''):
				$QueryObj->Data['urlname']=sanitize($_POST['urlname']);
			else:
				$QueryObj->Data['urlname']=sanitize($_POST['name']);  
			endif;
			
			if($_POST['meta_keyword']==''):
				$QueryObj->Data['meta_keyword']=$_POST['name'];  
			endif;
			 if($_POST['meta_description']==''):
				$QueryObj->Data['meta_description']=$_POST['name'];  
			endif;
			$QueryObj->Insert();
			$admin_user->set_pass_msg('Gallery has been inserted successfully.');
			Redirect(make_admin_url('gallery', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'update':
		if(isset($_GET['cat_id'])):
			$QueryObj =new query('gallery');
			$QueryObj->Where="where id='$_GET[cat_id]'";
			$category=$QueryObj->DisplayOne();
		endif;
		if(isset($_POST['update_category']) && $_POST['update_category']=='Submit'):
			$not=array('update_category');
			$QueryObj =new query('gallery');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['parent_id']=$id;
                        $QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
                        $QueryObj->Data['show_home']=isset($_POST['show_home'])?1:0;
			#add image if uploaded
			if(upload_photo('gallery', $_FILES['image'])):
				$QueryObj->Data['image']=$_FILES['image']['name'];
			endif;
			$QueryObj->Update();
			$admin_user->set_pass_msg('Gallery has been updated successfully.');
			Redirect(make_admin_url('gallery', 'list', 'list', 'id='.$id));
		endif;
		
		if(is_var_set_in_post('submit_active')):
			foreach ($_POST['is_active'] as $k=>$v):
				$q= new query('gallery');
				$q->Data['id']=$k;
				$q->Data['is_active']=$v;
				$q->Update();
			endforeach;
			$admin_user->set_pass_msg('Gallery status has been updated successfully.');
			Redirect(make_admin_url('gallery', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'delete':
		$QueryObj = new query('gallery');
		$QueryObj->id=$_GET['cat_id'];
		$QueryObj->Delete();
		Redirect(make_admin_url('gallery', 'list', 'list','id='.$id));
		break;
        case 'delete_image':
                if($id){
                    $object= get_object('gallery', $id);
                    $QueryObj= new query('gallery');
                    $QueryObj->Data['image']='';
                    $QueryObj->Data['id']=$id;
                    $QueryObj->Update();
                    
                    #delete images from folder
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/large/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/medium/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/thumb/'.$object->image);
                    
                    $admin_user->set_pass_msg('Gallery Image has been successfully deleted.');
                    Redirect(make_admin_url('gallery', 'update', 'update','cat_id='.$id));
                }
	default:break;
endswitch;
?>