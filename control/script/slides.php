<?php
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['slideshow_id'])?$id=$_GET['slideshow_id']:$id='';
isset($_GET['del'])?$del=$_GET['del']:$del='';
isset($_GET['cat_id'])?$cat=$_GET['cat_id']:$cat='';
#Handle actions here.
switch ($action):
	case'list':
		$QueryObj =new query('slideshow');
		$QueryObj->Where="where id='".$id."'";
		$product=$QueryObj->DisplayOne();
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='slide';
		$QueryObj->Where="where slideshow_id='$id'";
		$QueryObj->DisplayAll();
                
		break;
        case'update':
		if(isset($_GET['cat_id'])):
                    $QueryObj =new query('slide');
			$QueryObj->Where="where id='$cat'";
			$category=$QueryObj->DisplayOne();
		endif;
		if(isset($_POST['update_category']) && $_POST['update_category']=='Submit'):
                   
                        $not=array('update_category');
			$QueryObj =new query('slide');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			
                        $QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
                      #add image if uploaded
			if(upload_photo('gallery', $_FILES['image'])):
				$QueryObj->Data['image']=$_FILES['image']['name'];
			endif;
			$QueryObj->Update();
                       
			$admin_user->set_pass_msg('Slide has been updated successfully.');
			Redirect(make_admin_url('slides', 'list', 'list', 'slideshow_id='.$id));
		endif;
		
		
		break;    
	case'insert':
		$error='';
		if(isset($_POST['submit']) && $_POST['submit']=='Upload'):
			//echo "yes"; exit;
			$QueryObj =new query('slide');
                        $QueryObj->Data['slideshow_id']=$id;
                        $QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
                        $QueryObj->Data['title']=$_POST['title'];
                        $QueryObj->Data['short_description']=$_POST['short_description'];
                        $rand=rand(0,999999);
                        #add image if uploaded.
                         if(upload_photo('gallery', $_FILES['image'], $rand)):
                        $image_nam1e= make_image_name($_FILES['image']['name'], $rand);
                        $QueryObj->Data['image']=$image_nam1e;
                        endif;
                        $QueryObj->Insert();

			$admin_user->set_pass_msg('Slide has been inserted successfully.');
			Redirect(make_admin_url('slides', 'list', 'list', 'slideshow_id='.$id));
		endif;
		break;
	
	case'delete':
		if(isset($_GET['delete']) && !empty($_GET['delete'])):
			$image=get_object('slide', $_GET['delete']);
			$QueryObj= new query('slide');
			$QueryObj->id=$_GET['delete'];
			$QueryObj->Delete();
			delete_if_image_exists('gallery', 'large', $image->image);
			delete_if_image_exists('gallery', 'thumb', $image->image);
			$admin_user->set_pass_msg('slide has been deleted successfully.');
			Redirect(make_admin_url('slides', 'list', 'list', 'slideshow_id='.$id));
		endif;
		break;
         case 'delete_image':
            if($del){
                    $object= get_object('slide', $del);
                    $QueryObj= new query('slide');
                    $QueryObj->Data['image']='';
                    $QueryObj->Data['id']=$del;
                    $QueryObj->Update();
                    
                    #delete images from folder
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/large/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/medium/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/thumb/'.$object->image);
                    
                    $admin_user->set_pass_msg('Slide Image has been successfully deleted.');
                    Redirect(make_admin_url('slides', 'update', 'update','slideshow_id='.$id.'&cat_id='.$del));
                }        
	default:break;
endswitch;
?>
