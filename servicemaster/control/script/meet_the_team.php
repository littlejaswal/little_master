<?php
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('team');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('team');
			$not=array('submit','is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$random=rand(0, 99999999);
			if(upload_photo('team', $_FILES['team_logo'], $random)):
				$QueryObj->Data['team_logo']=make_file_name($_FILES['team_logo']['name'], $random);
			endif;
			$QueryObj->Insert();
			Redirect(make_admin_url('meet_the_team', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('team');
		$QueryObj->Where="where id='".$id."'";
		$team=$QueryObj->DisplayOne();
		if(isset($_POST['submit'])):
			$QueryObj = new query('team');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$rand=rand(0, 9999999);
			if(upload_photo('team', $_FILES['team_logo'], $rand)):
				$QueryObj->Data['team_logo']=make_image_name($_FILES['team_logo']['name'], $rand); 
			endif;
			$QueryObj->Update();
			Redirect(make_admin_url('meet_the_team', 'list', 'list'));
		endif;
		break;
	case 'update2':
			if(isset($_POST['update_position'])):
				foreach($_POST['position'] as $k=>$v):
					$Q= new query('team');
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
				$query= new query('team');
				$query->Data['is_active']=0;
				$query->UpdateCustom();
				
				foreach($_POST['is_active'] as $k=>$v):
					$query= new query('team');
					$query->Data['is_active']=1;
					$query->Data['id']=$k;
					$query->Update();
				endforeach;
			endif;
			Redirect(make_admin_url('meet_the_team', 'list', 'list'));
		
		break;
	case'delete':
		$QueryObj = new query('team');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('meet_the_team', 'list', 'list'));
		break;
	default:break;
endswitch;
?>