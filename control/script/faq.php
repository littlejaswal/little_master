<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['page'])?$page=$_GET['page']:$page='1';
#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('faq');
		$QueryObj->Where="order by position";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('faq');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			$admin_user->set_pass_msg('FAQ has been inserted successfully.');
			Redirect(make_admin_url('faq', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('faq');
		$QueryObj->Where="where id='".$id."'";
		$news=$QueryObj->DisplayOne();
		if(isset($_POST['submit'])):
			$QueryObj = new query('faq');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Update();
			$admin_user->set_pass_msg('FAQ has been updated successfully.');
			Redirect(make_admin_url('faq', 'list', 'list'));
		endif;
		break;
		case'update2':
		$chip_info= new query('faq');
		$chip_info->Where="where is_active='1'";
		$chip_info->DisplayAll();
		$chip1=array();
		while($pa= $chip_info->GetObjectFromRecord()):
			$chip1[$pa->id]=$pa->name;
		endwhile;
		if(isset($_POST['update_position'])):
				foreach($_POST['position'] as $k=>$v):
					$Q= new query('faq');
					if($v==''):
						$Q->Data['position']=0;
					else:
						$Q->Data['position']=$v;
					endif;
					$Q->Data['id']=$k;
					$Q->Update();
				endforeach;
			endif;
	   if(isset($_POST['submit'])):
	   		$act_count=array();
	   		foreach ($chip1 as $kk=>$vv):
	   		if(!in_array($vv,$_POST['is_active'])):
	   		$act_count[$kk]=$vv;
	   		endif;
	   		endforeach;
	   		
	   		if(sizeof($act_count)!=0):
	   		foreach($act_count as $k=>$v):
					$QueryObj1 = new query('faq');
					$QueryObj1->Data['is_active']=0;
					$QueryObj1->Data['id']=$k;
					$QueryObj1->Update();
			endforeach;
	   		endif;
	   	
			foreach ($_POST['is_active'] as $k=>$v):
					$QueryObj = new query('faq');
					$QueryObj->Data['is_active']=1;
					$QueryObj->Data['id']=$k;
					$QueryObj->Update();
			endforeach;
			 endif;
			Redirect(make_admin_url('faq', 'list', 'list'));
		break;
		/*case 'update2':
			if(isset($_GET['up'])):  #reduce the position number
				$catlist=array();
				$query= new query('faq');
				$query->Field='id, position';
				$query->Where="order by position asc";
				//$query->print=1;
				$query->DisplayAll();
				while($obj=$query->GetObjectFromRecord()):
					$catlist[$obj->id]=$obj->position;
				endwhile;

				for($i=0;$i<$_GET['up'];$i++):
					$current=0;
					$prev=0;
					foreach ($catlist as $k=>$v):
						if($k==$_GET['cat_id']):
							$current=$k;
							break;
						else:
							$prev=$k;
						endif;
					endforeach;
					if($prev==0):
						$prev=$current;
					endif;
					$cpos=$catlist[$current];
					$catlist[$current]=$catlist[$prev];
					$catlist[$prev]=$cpos;

				endfor;
				foreach ($catlist as $k=>$v):
					if($k!='' && $v!=''):
						$query= new query('faq');
						$query->Data['id']=$k;
						$query->Data['position']=$v;
						$query->Update();
					endif;
				endforeach;

				$admin_user->set_pass_msg('Position has been updated successfully.');
				Redirect1(make_admin_url('faq', 'list', 'list', 'id='.$id));
			endif;
				if(isset($_GET['down'])):  #reduce the position number
				$catlist=array();
				$query= new query('faq');
				$query->Field='id, position';
				$query->Where="order by position asc";
				$query->DisplayAll();
				while($obj=$query->GetObjectFromRecord()):
					$catlist[$obj->id]=$obj->position;
				endwhile;
				for($i=0;$i<$_GET['down'];$i++):
					$current=0;
					$prev=0;
					$p=0;
					foreach ($catlist as $k=>$v):
						if($k==$_GET['cat_id']):
							$current=$k;
							$p=1;
						elseif($p):
							$prev=$k;
							break;
						endif;
					endforeach;
					if($prev==0):
						$prev=$current;
					endif;
					$cpos=$catlist[$current];
					$catlist[$current]=$catlist[$prev];
					$catlist[$prev]=$cpos;
				endfor;

				foreach ($catlist as $k=>$v):
					if($k!='' && $v!=''):
						$query= new query('faq');
						$query->Data['id']=stripslashes($k);
						$query->Data['position']=$v;
						$query->Update();
					endif;
				endforeach;

				$admin_user->set_pass_msg('Position has been updated successfully.');
				Redirect1(make_admin_url('faq', 'list', 'list', 'id='.$id));
			endif;
			if(is_var_set_in_post('submit')):
			foreach ($_POST['is_active'] as $k=>$v):
				$q= new query('faq');
				$q->Data['id']=$k;
				$q->Data['is_active']=$v;
				$q->Update();
			endforeach;
			endif;
			if(isset($_POST['multiopt_go']) && $_POST['multiopt_go']=='Go'):
                            if($_POST['multiopt_action']=='delete'):
                                foreach($_POST['multiopt'] as $k=>$v):
                                        $query= new query('faq');
                                        $query->id="$k";
                                        //$query->print=1;
                                        $query->Delete();
                                endforeach;
                            endif;
                        endif;         
			Redirect(make_admin_url('faq', 'list', 'list', 'id='.$id.'&page='.$page));
			break;*/
	case'delete':
		$QueryObj = new query('faq');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('faq', 'list', 'list'));
		break;
	case 'status':
		$status=$_GET['status'];
		$QueryObj = new query('faq');
		$QueryObj->Data['is_active']="$status";
		$QueryObj->Data['id']=$id;
		//$QueryObj->print=1;
		$QueryObj->Update();
		$admin_user->set_pass_msg('Faq status has been updated successfully.');
		Redirect(make_admin_url('faq', 'list', 'list','id='.$id.'&page='.$page));
	default:break;
endswitch;
?>
