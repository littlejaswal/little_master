<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=1;
#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query();
		$QueryObj->TableName='emails';
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=30;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		break;
	case'update':
		break;
		
	case'delete':
		if(isset($_GET['delete']) && !empty($_GET['delete'])):
			$QueryObj = new query();
			$QueryObj->TableName='emails';
			$QueryObj->id=$_GET['delete'];
			$QueryObj->Delete();
			header("location:".DIR_WS_SITE_CONTROL."control.php?Page=letters");
			exit;
		endif;
		break;
	default:break;
endswitch;
?>
