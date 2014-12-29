<?php
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['page'])?$page=$_GET['page']:$page='1';
#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('news');
		$QueryObj->Where="order by position";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('news');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
                        $QueryObj->Data['is_active']=isset($_POST['is_active'])?on:off;
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
			$admin_user->set_pass_msg('News has been inserted successfully.');
			Redirect(make_admin_url('news', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('news');
		$QueryObj->Where="where id='".$id."'";
		$news=$QueryObj->DisplayOne();
		if(isset($_POST['submit'])):
			$QueryObj = new query('news');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?on:off;
                        #add image if uploaded
			if(upload_photo('gallery', $_FILES['image'])):
				$QueryObj->Data['image']=$_FILES['image']['name'];
			endif;
			$QueryObj->Update();
			$admin_user->set_pass_msg('News has been updated successfully.');
			Redirect(make_admin_url('news', 'list', 'list'));
		endif;
		break;
	case 'update2':
                if(is_var_set_in_post('submit')):
                // print_r($_POST);exit;
                     $query= new query('news');
                    $query->Data['is_active']='off';
                    $query->UpdateCustom();
                    foreach ($_POST['is_active'] as $k=>$v):
                            $q= new query('news');
                            $q->Data['is_active']='on';
                            $q->Data['id']=$k;
                            $q->Update();
                    endforeach;
                endif;
                  if(is_var_set_in_post('submit_position')):
                    
                    foreach ($_POST['position'] as $k=>$v):
                            $q= new query('news');
                            $q->Data['id']=$k;
                            $q->Data['position']=$v;
                            $q->Update();
                    endforeach;
                endif;
                if(isset($_POST['multiopt_go']) && $_POST['multiopt_go']=='Go'):
                    if($_POST['multiopt_action']=='delete'):
                        foreach($_POST['multiopt'] as $k=>$v):
                                $query= new query('news');
                                $query->id="$k";
                                $query->Delete();
                        endforeach;
                    endif;
                endif;     
                $admin_user->set_pass_msg('Operation has been performed successfully');
                Redirect(make_admin_url('news', 'list', 'list', 'id='.$id.'&page='.$page));
                break;
	case'delete':
		$QueryObj = new query('news');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('news', 'list', 'list'));
		break;
	case 'status':
		$status=$_GET['status'];
		$QueryObj = new query('news');
		$QueryObj->Data['is_active']="$status";
		$QueryObj->Data['id']=$id;
		$QueryObj->Update();
		$admin_user->set_pass_msg('News status has been updated successfully.');
		Redirect(make_admin_url('news', 'list', 'list','id='.$id.'&page='.$page));
          case 'delete_image':
                if($id){
                    $object= get_object('news', $id);
                    $QueryObj= new query('news');
                    $QueryObj->Data['image']='';
                    $QueryObj->Data['id']=$id;
                    $QueryObj->Update();
                    
                    #delete images from folder
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/large/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/medium/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/thumb/'.$object->image);
                    
                    $admin_user->set_pass_msg('News Image has been successfully deleted.');
                    Redirect(make_admin_url('news', 'update', 'update','id='.$id));
                }        
	default:break;
endswitch;
?>
