<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
//print_r($_POST);exit;
#handle actions here.
switch ($action):
	case'list':

                $QueryObj = new query('setting');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=200;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->Where="group by name";
		$QueryObj->DisplayAll();
		$name='';
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('news');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('demo', 'list', 'list'));
		endif;
		break;
	case'update':
		if(isset($_POST['Submit'])):
			foreach ($_POST['key'] as $k=>$v):
				$QueryObj = new query('setting');
				$QueryObj->Data['id']=$k;
				$QueryObj->Data['value']=$v;
				$QueryObj->Update();
			endforeach;
			$admin_user->set_pass_msg('Settings have been updated');
			Redirect(make_admin_url('setting', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('news');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('news', 'list', 'list'));
		break;
	default:break;
endswitch;

function getSettingsByName($name){
       $QueryObj = new query('setting');
       $QueryObj->Where="where name='$name'";
       $QueryObj->DisplayAll();
       $ObjArray= array();
       if($QueryObj->GetNumRows()):
                while($object=$QueryObj->GetArrayFromRecord()):
                    $ObjArray[]=$object;
                endwhile;
        endif;
        return $ObjArray;
}
?>
