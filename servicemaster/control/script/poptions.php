<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['pid'])?$pid=$_GET['pid']:$pid='0';

#handle actions here.
switch ($action):
	case'list':
		$Query =new query('product');
		$Query->Where="where id='".$pid."'";
		$product=$Query->DisplayOne();
				
		$QueryObj = new query('poptions');
		$QueryObj->Where="where product_id='".$pid."'";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('poptions');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('poptions', 'list', 'list', 'pid='.$pid));
		endif;
		break;
	case'update':
		$Query =new query('product');
		$Query->Where="where id='".$pid."'";
		$product=$Query->DisplayOne();
		
		$QueryObj = new query('poptions');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
	
		$QueryObj1 = new query('poptions');
		$QueryObj1->Where="where id='".$id."'";
		$poptions=$QueryObj1->DisplayOne();
		//print_r($poptions);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('poptions');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Update();
			Redirect(make_admin_url('poptions', 'list', 'list',  'pid='.$pid));
		endif;
		break;
	case'delete':
		$QueryObj = new query('poptions');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('poptions', 'list', 'list','pid='.$pid));
		break;
	default:break;
endswitch;
?>
