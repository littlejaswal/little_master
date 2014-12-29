<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=1;

#handle actions here.
switch ($action):
	case'list':
		# get product
		$product =new query('product');
		$product->Where="where id='".$id."'";
		$product= $product->DisplayOne();
		
		# get related products
		$QueryObj = new query('related_product');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->Where="where product_id='".$id."'";
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		$products=array();
		while($sp= $QueryObj->GetObjectFromRecord()):
			$qury= new query('product');
			$qury->Where="where id='".$sp->related_id."'";
			$pro=$qury->DisplayOne();
			array_push($products, array('name'=>$pro->name, 'id'=>$pro->id, 'parent_id'=>$pro->parent_id, 'price'=>$pro->price, 'related_id'=>$sp->id, 'position'=>$sp->position));
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
					$qat= $qcat->DisplayOne();
					$parent_id= $qat->parent_id;
					$string=$qat->name.'&nbsp;>>&nbsp;'.$string;
			endwhile;
			array_push($all_products, array('id'=>$prr->id, 'name'=>$string.$prr->name));
		endwhile;
		
		foreach ($products as $k=>$v):
			foreach ($all_products as $ky=>$vl):
				if($v['id']==$vl['id']):
					unset($all_products[$ky]);
				endif;
			endforeach;
		endforeach;
		//unset($all_products[$product->id]);
		break;
	case'insert':
	//	print_r($_POST);exit;
		if(isset($_POST['submit'])):
			foreach ($_POST['related'] as $key=>$value):
				$QueryObj = new query('related_product');
				$QueryObj->Data['product_id']=$id;
				$QueryObj->Data['related_id']=$value;
				//$QueryObj->print=1;
				$QueryObj->Insert();
			endforeach;
			Redirect(make_admin_url('related_product', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'update':
		if(isset($_POST['submit'])):
			unset($_POST['submit']);
			foreach ($_POST as $k=>$v):
				$QueryObj = new query('related_product');
				$QueryObj->Data['id']=$k;
				$QueryObj->Data['position']=$v;
				$QueryObj->Update();
			endforeach;
			Redirect(make_admin_url('related_product', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'delete':
		$QueryObj = new query('related_product');
		$QueryObj->id=$_GET['related_id'];
		$QueryObj->Delete();
		Redirect(make_admin_url('related_product', 'list', 'list', 'id='.$id));
		break;
	default:break;
endswitch;
?>
