<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='3';

#Handle actions here.
switch ($action):
	case'list':
		$QueryObj =new query('diamond_attribute');
		$QueryObj->Where="where id='".$id."'";
		//$QueryObj->print=1;
		$product=$QueryObj->DisplayOne();
		
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='diamond_att_photo';
		$QueryObj->Where="where att_id='$id'";
		//$QueryObj->print=1;
		$QueryObj->DisplayAll();
		break;
	case'insert':

			if(isset($_POST['submit']) && $_POST['submit']=='Upload'):
			//print_r($_FILES);exit;
			$not=array('submit');
			$QueryObj =new query('diamond_att_photo');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['att_id']=$id;
			//$QueryObj->print=1;
			$QueryObj->Insert();
			$id=$QueryObj->GetMaxId();
//			print_r($category_id);exit;
			$QueryObj= new query('diamond_att_photo');
			$QueryObj->Data['id']=$id;
		//	print_r($id);exit;
			#add image if uploaded.
				if(upload_photo('category', $_FILES['photo'], $id)):
					$QueryObj->Data['photo']=make_image_name($_FILES['photo']['name'], $id);
					$QueryObj->Update();
				endif;
			
			$admin_user->set_pass_msg('Image has been inserted successfully.');
			Redirect(make_admin_url('image', 'list', 'list', 'id='.$_GET['id']));
		endif;

	
		break;
		case'insert2':
			 #udpate/set main image
		 if(is_var_set_in_post('image_update'))://print_r($_POST);exit;
		 	$query= new query('diamond_att_photo');
		 	$query->Where="where att_id =$id";
		 	$query->Data['main_image']=0;
		 	$query->UpdateCustom();//print_r($query);print_r($_POST['main_image']);exit;
		 	foreach ($_POST['main_image'] as $key=>$value) {
		 		$query= new query('diamond_att_photo');
		 		$query->Data['main_image']=1;
		 		$query->Data['id']=$value; 
		 		$query->Update();//print_r($query);exit;
		 	}
		 	$admin_user->set_pass_msg('Main image updated successfully.');
		 	Redirect(make_admin_url('image', 'list', 'list', 'id='.$_GET['id'].'#images'));
		 endif;
	

	
		break;
	case'update_default':
			
			break;
	case'delete':
		if(isset($_GET['delete']) && !empty($_GET['delete'])):
			$QueryObj= new query('diamond_att_photo');
			$QueryObj->id=$_GET['delete'];
			//$QueryObj->print=1;
			$QueryObj->Delete();
			$admin_user->set_pass_msg('Image has been deleted successfully.');
			Redirect(make_admin_url('image', 'list', 'list', 'id='.$id));
		endif;
		break;
	default:break;
endswitch;
?>
