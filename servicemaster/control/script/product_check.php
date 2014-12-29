<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=1;

#handle actions here.
switch ($action):
	case'list':
		# get all the option here
		$check_options =new query('product_check_box');
		$check_options->DisplayAll();
		# get products
		$QueryObj = new query('product_check_box_value');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->Where="where option_id='".$id."'";
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		$products=array();
		while($sp= $QueryObj->GetObjectFromRecord()):
			$qury= new query('product');
			$qury->Where="where id='".$sp->product_id."'";
			if($pro=$qury->DisplayOne()):
				array_push($products, array('name'=>$pro->name, 'id'=>$pro->id, 'parent_id'=>$pro->parent_id, 'price'=>$pro->price, 'option_id'=>$sp->id, 'position'=>$sp->position));
			endif;
		endwhile;
		
		#Make an array of all the products that can be added to the list of products:
		$pr= new query('product');
		$pr->DisplayAll();
		$all_products= array();
		while($prr=$pr->GetObjectFromRecord()):
			$parent_id= $prr->parent_id;
			$string='';
			while($parent_id!=0):
					$qcat= new query('category');
					$qcat->Where="where id='".$parent_id."'";
					if($qat= $qcat->DisplayOne()):
						$parent_id= $qat->parent_id;
						$string=$qat->name.'&nbsp;>>&nbsp;'.$string;
					else:
						$parent_id=0;
					endif;
			endwhile;
			array_push($all_products, array('id'=>$prr->id, 'name'=>$string.$prr->name));
		endwhile;
		
		foreach ($products as $k=>$v):
			foreach ($all_products as $ky=>$vl):
				if($v['id']==$vl['id']):
					unset($all_products[$k]);
				endif;
			endforeach;
		endforeach;
		
		break;
	case'insert':
		if(isset($_POST['submit'])):
			foreach ($_POST['product_check'] as $key=>$value):
				$QueryObj = new query('product_check_box_value');
				$QueryObj->Data['product_id']=$value;
				$QueryObj->Data['option_id']=$id;
				$QueryObj->Insert();
			endforeach;
			Redirect(make_admin_url('product_check', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'update':
		if(isset($_POST['submit'])):
			unset($_POST['submit']);
			foreach ($_POST as $k=>$v):
				$QueryObj = new query('product_check_box_value');
				$QueryObj->Data['id']=$k;
				$QueryObj->Data['position']=$v;
				$QueryObj->Update();
			endforeach;
			Redirect(make_admin_url('product_check', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'delete':
		$QueryObj = new query('product_check_box_value');
		$QueryObj->id=$_GET['option_id'];
		$QueryObj->Delete();
		Redirect(make_admin_url('product_check', 'list', 'list', 'id='.$id));
		break;
	default:break;
endswitch;
?>
