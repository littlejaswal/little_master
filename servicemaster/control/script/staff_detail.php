<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		# get user details.
		$QueryObj = new query('staff');
		$QueryObj->Where="where id=$id";
		$user=$QueryObj->DisplayOne();
		
		# get order history.
		$orders= new query('orders');
		$orders->Where="where user_id='".$id."'";
		$orders->DisplayAll();		
				
		
		break;
	case'block':
		$user= get_object('staff', $id);
		if($user->is_active):
			$q= new query('staff');
			$q->Data['id']=$id;
			$q->Data['is_active']=0;
			$q->Update();
		else:
			$q= new query('staff');
			$q->Data['id']=$id;
			$q->Data['is_active']=1;
			$q->Update();
		endif;
		$admin_user->set_pass_msg('User status has been updated.');
		Redirect(make_admin_url('staff_detail', 'list', 'list', 'id='.$id));
		break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
