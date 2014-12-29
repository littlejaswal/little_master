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

		if(isset($_POST['copy']) && $_POST['copy'] == 'Submit'):
		  foreach ($_POST['pid'] as $key=>$value):
		 	$queryObj2 = new query('product');
			$queryObj2->Where="where id=$value";
			$product=$queryObj2->DisplayOne();
			
			$data= array();
			$not=array('id',$product->parent_id);
			$data= MakeDataArray($product,$not);
			
			foreach ($_POST['copy_to'] as $k=>$v):
				$QueryObj1= new query('product');
				$QueryObj1->Data=$data;
				$QueryObj1->Data['parent_id']=$v;
				$QueryObj1->Insert();
				
				$new_id= $QueryObj1->GetMaxId();
		 		#copy all images
		 		copy_images($value, $new_id);
		 		#copy all related products
		 		copy_related_products($value, $new_id);
		 		#copy all attributes
		 		copy_attributes($value, $new_id);
			endforeach;
	 	endforeach;
	 	$admin_user->set_pass_msg('This product has been copied to target category(s) successfully.');
	 	Redirect(make_admin_url('product_copy', 'list', 'list'));
	 endif;
		break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
