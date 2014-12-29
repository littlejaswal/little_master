<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=1;

#handle actions here.
switch ($action):
	case'list':
		#get categories
		$query= new query('category');
		$query->Where="where parent_id=0 and is_active=1";
	    $query->DisplayAll();
		
	    break;
	case'insert':
		$queryObj1= new query('category');
		$queryObj1->Where="where parent_id=0 and is_active=1";
	    $queryObj1->DisplayAll();

		if(isset($_POST['move']) && $_POST['move'] == 'Submit')://print_r($_POST);exit;
		  foreach ($_POST['cat_id'] as $key=>$value):
			$QueryObj= new query('category');
			$QueryObj->Data['parent_id']=$_POST['move_to'];
			$QueryObj->Data['id']=$value;
			$QueryObj->Update();
		  endforeach;
		  $admin_user->set_pass_msg('This category has been moved to target category successfully.');
		  Redirect(make_admin_url('category_move', 'list', 'list'));
		endif;
		break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
