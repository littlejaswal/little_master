<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['del'])?$del=$_GET['del']:$del='';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('event');
                $QueryObj->Where="order by event_date_show desc";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('event');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
                        $QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
                        $rand=rand(0,999999);
			#add image if uploaded.
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
            $admin_user->set_pass_msg('Event has been inserted successfully.');
			Redirect(make_admin_url('event', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('event');
		$QueryObj->Where="where id='".$id."'";
		$event=$QueryObj->DisplayOne();
		//print_r($event);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('event');
			$not=array('submit', 'is_active', 'free_paid', 'register_on_off');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Data['free_paid']=isset($_POST['free_paid'])?1:0;
			$QueryObj->Data['register_on_off']=isset($_POST['register_on_off'])?1:0;
                        if(upload_photo('gallery', $_FILES['image'])):
				$QueryObj->Data['image']=$_FILES['image']['name'];
			endif;
			$QueryObj->Update();
                        $admin_user->set_pass_msg('Event has been updated successfully.');
			Redirect(make_admin_url('event', 'list', 'list'));
		endif;
		break;
          case 'update2': 
                if(is_var_set_in_post('submit')):
                    #update all records of this gallery
                    $query= new query('event');
                    $query->Data['is_active']='0';
                    $query->UpdateCustom();
                    
                    foreach ($_POST['is_active'] as $k=>$v):
                            $q= new query('event');
                            $q->Data['is_active']=1;
                            $q->Data['id']=$k;
                            $q->Update();
                    endforeach;
                endif;
                  if(is_var_set_in_post('submit_position')):
                       
                    foreach ($_POST['position'] as $k=>$v):
                            $q= new query('event');
                            $q->Data['id']=$k;
                            $q->Data['position']=$v;
                            $q->Update();
                    endforeach;
                endif;
                 
                $admin_user->set_pass_msg('Operation has been performed successfully');
                Redirect(make_admin_url('event', 'list', 'list'));
                break;        
	case'delete':
		$QueryObj = new query('event');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('event', 'list', 'list'));
		break;
        	break;
         case 'delete_image':
            if($del){
                    $object= get_object('event', $del);
                    $QueryObj= new query('event');
                    $QueryObj->Data['image']='';
                    $QueryObj->Data['id']=$del;
                    $QueryObj->Update();
                    
                    #delete images from folder
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/large/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/medium/'.$object->image);
                    @unlink(DIR_FS_SITE.'upload/photo/gallery/thumb/'.$object->image);
                    
                    $admin_user->set_pass_msg('Event Image has been successfully deleted.');
                    Redirect(make_admin_url('event', 'update', 'update','id='.$del));
                }            
	default:break;
endswitch;
?>
