<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		#get the discount item.
		$QueryObj = new query('discount');
		$QueryObj->Where="where id='".$id."'";
		$discount=$QueryObj->DisplayOne();
		
		#get the discount categories
		$QueryObj = new query('discount_category');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->Where="where discount_id='$id'";
		$QueryObj->DisplayAll();
		$categories=array();
		while($cat= $QueryObj->GetObjectFromRecord()):
			$categories[$cat->id]=$cat->category_id;
		endwhile;
				
		#Make an array of all the products that can be added to the list of products:
		$pr= new query('category');
		$pr->DisplayAll();
		$all_products= array();
		while($prr=$pr->GetObjectFromRecord()):
			$parent_id= $prr->parent_id;
			$string='';
			while($parent_id!=0):
					$qcat= new query('category');
					$qcat->Where="where id='".$parent_id."'";
					$qat= $qcat->DisplayOne();
					$parent_id= $qat->parent_id;
					$string=$qat->name.'&nbsp;>>&nbsp;'.$string;
			endwhile;
			array_push($all_products, array('id'=>$prr->id, 'name'=>$string.$prr->name));
		endwhile;
		
		foreach ($categories as $k=>$v):
			foreach ($all_products as $ky=>$vl):
				if($v==$vl['id']):
					unset($all_products[$ky]);
				endif;
			endforeach;
		endforeach;
		
		break;
	case'insert':
		//print_r($_POST);exit;
		if(isset($_POST['submit'])):
			foreach ($_POST['category'] as $key=>$value):
				$QueryObj = new query('discount_category');
				$QueryObj->Data['category_id']=$value;
				$QueryObj->Data['discount_id']=$id;
				$QueryObj->Insert();
			endforeach;
			Redirect(make_admin_url('discount_cat', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'update':break;
	case'delete':
		$QueryObj = new query('discount_category');
		$QueryObj->id=$_GET['idd'];
		$QueryObj->Delete();
		Redirect(make_admin_url('discount_cat', 'list', 'list', 'id='.$id));
		break;
	default:break;
endswitch;
?>
