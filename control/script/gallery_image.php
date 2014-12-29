<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='3';
isset($_GET['del'])?$del=$_GET['del']:$del='';
isset($_GET['cat_id'])?$cat=$_GET['cat_id']:$cat='';

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
                        if(count($_POST['position'])){
                            foreach($_POST['position'] as $k=>$v){
                               
                                if(!$_FILES['pic']['error'][$k]){
                                    $image=array('name'=>$_FILES['pic']['name'][$k],'tmp_name'=>$_FILES['pic']['tmp_name'][$k],'type'=>$_FILES['pic']['type'][$k],'size'=>$_FILES['pic']['size'][$k], 'error'=>$_FILES['pic']['error'][$k]);
                                    $idd=rand(99999999999,000000000000);
                                   # print_r($image);exit;
                                    if(upload_photo('gallery', $image, $idd)){
                                        $QueryObj= new query('gimage');
                                        $QueryObj->Data['parent_id']=$id;
                                        $QueryObj->Data['position']=$v;
                                        $QueryObj->Data['caption']=$_POST['caption'][$k];
                                        $QueryObj->Data['image']=  make_file_name($_FILES['pic']['name'][$k], $idd);
                                        $QueryObj->Data['is_active']=isset($_POST['is_active'][$k])?'1':'0';
                                        $QueryObj->Insert();
                                    }
                                }
                            }
                            $admin_user->set_pass_msg('Image has been uploaded successfully.');
                            Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id));
                        }
                   endif;
                
		break;
            case'update':
		if(isset($_GET['cat_id'])):
                    $QueryObj =new query('gimage');
			$QueryObj->Where="where id='$cat'";
			$category=$QueryObj->DisplayOne();
		endif;
		if(isset($_POST['update_category']) && $_POST['update_category']=='Submit'):
                   
                        $not=array('update_category');
			$QueryObj =new query('gimage');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			
                        $QueryObj->Data['is_active']=isset($_POST['is_active'])?'1':'0';
                      #add image if uploaded
			if(upload_photo('gallery', $_FILES['image'])):
				$QueryObj->Data['image']=$_FILES['image']['name'];
			endif;
			$QueryObj->Update();
                       
			$admin_user->set_pass_msg('Image has been updated successfully.');
			Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id));
		endif;
		
		
		break;           
	case'update2':
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
				Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id.'&page='.$page));
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
         case 'update_default': 
                if(is_var_set_in_post('submit')):
                    #update all records of this gallery
                    $query= new query('gimage');
                    $query->Data['is_active']='off';
                    $query->Where="where parent_id='$id'";
                    $query->UpdateCustom();
                    
                    foreach ($_POST['is_active'] as $k=>$v):
                            $q= new query('gimage');
                            $q->Data['id']=$k;
                            $q->Data['is_active']=$v;
                            $q->Update();
                    endforeach;
                endif;
                  if(is_var_set_in_post('submit_position')):
                       
                    foreach ($_POST['position'] as $k=>$v):
                            $q= new query('gimage');
                            $q->Data['id']=$k;
                            $q->Data['position']=$v;
                            $q->Update();
                    endforeach;
                endif;
                 
                $admin_user->set_pass_msg('Operation has been performed successfully');
                Redirect(make_admin_url('gallery_image', 'list', 'list', 'id='.$id.'&page='.$page));
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
            case 'delete_image':
            if($del){
                    $object= get_object('gimage', $del);
                    $QueryObj= new query('gimage');
                    $QueryObj->Data['image']='';
                    $QueryObj->Data['id']=$del;
                    $QueryObj->Update();
                    
                    #delete images from folder
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/large/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/medium/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/thumb/'.$object->image);
                    
                    $admin_user->set_pass_msg(' Image has been successfully deleted.');
                    Redirect(make_admin_url('gallery_image', 'update', 'update','id='.$id.'&cat_id='.$del));
                }                
	default:break;
endswitch;
?>
