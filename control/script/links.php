<?php
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['page'])?$page=$_GET['page']:$page='1';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

switch ($action):
	case'list':
		$QueryObj = new query('links');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('links');
			$not=array('submit','is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
                        $QueryObj->Data['description']=$_POST['description'];
                         $QueryObj->Data['position']=$_POST['position'];
			 $QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
                         $rand=rand(0,999999);
			/*add image if uploaded.*/
			if(upload_photo('links', $_FILES['image'], $rand)):
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
			if($_POST['url']!=''):
			$prfix="http://www.";
			if(substr($_POST['url'], 0,11)!=$prfix){				
				$QueryObj->Data['url']=$prfix.$_POST['url'];
				}
			endif;				
                        
			$QueryObj->Insert();
			$admin_user->set_pass_msg('Link has been inserted successfully.');
			Redirect(make_admin_url('links', 'list', 'list'));
		endif;
		break;
         case 'update2': 
                if(is_var_set_in_post('submit')):
                    #update all records of this gallery
                    $query= new query('links');
                    $query->Data['is_active']='0';
                    $query->UpdateCustom();
                    
                    foreach ($_POST['is_active'] as $k=>$v):
                            $q= new query('links');
                            $q->Data['is_active']=1;
                            $q->Data['id']=$k;
                            $q->Update();
                    endforeach;
                endif;
                  if(is_var_set_in_post('submit_position')):
                       
                    foreach ($_POST['position'] as $k=>$v):
                            $q= new query('links');
                            $q->Data['id']=$k;
                            $q->Data['position']=$v;
                            $q->Update();
                    endforeach;
                endif;
                 
                $admin_user->set_pass_msg('Operation has been performed successfully');
                Redirect(make_admin_url('links', 'list', 'list'));
                break;         
	case'update':
		$QueryObj = new query('links');
		$QueryObj->Where="where id='".$id."'";
		$news=$QueryObj->DisplayOne();
		if(isset($_POST['submit'])):
			$QueryObj = new query('links');
			$not=array('submit','is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			 $QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;                           
                         $QueryObj->Data['position']=$_POST['position'];
			$QueryObj->Data['id']=$_POST['id'];
                        if(upload_photo('links', $_FILES['image'], $rand)):
                                $image_nam1e= make_image_name($_FILES['image']['name'], $rand); 
				$QueryObj->Data['image']=$image_nam1e;
			endif;
			if($_POST['url']!=''):
			$prfix="http://www.";
			if(substr($_POST['url'], 0,11)!=$prfix){				
				$QueryObj->Data['url']=$prfix.$_POST['url'];
				}
			endif;			
			$QueryObj->Update();
			$admin_user->set_pass_msg('Link has been updated successfully.');
			Redirect(make_admin_url('links', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('links');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		$admin_user->set_pass_msg('Link has been deleted successfully.');
		Redirect(make_admin_url('links', 'list', 'list'));
		break;
	case 'status':
		$status=$_GET['status'];
		$QueryObj = new query('links');
		$QueryObj->Data['is_active']="$status";
		$QueryObj->Data['id']=$id;
		$QueryObj->Update();
		$admin_user->set_pass_msg('links status has been updated successfully.');
		Redirect(make_admin_url('links', 'list', 'list','id='.$id.'&page='.$page));	
        case 'delete_image':
                if($id){
                    $object= get_object('links', $id);
                    $QueryObj= new query('links');
                    $QueryObj->Data['image']='';
                    $QueryObj->Data['id']=$id;
                    $QueryObj->Update();
                    
                    #delete images from folder
                    @unlink(DIR_FS_SITE.'upload/photo/links/large/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/links/medium/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/links/thumb/'.$object->image);
                    
                    $admin_user->set_pass_msg('Link Image has been successfully deleted.');
                    Redirect(make_admin_url('links', 'update', 'update','id='.$id));
                }    
	default:break;
endswitch;
?>
