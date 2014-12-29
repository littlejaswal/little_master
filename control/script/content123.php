<?php

isset($_GET['action'])?$action=$_GET['action']:$action='list';

isset($_GET['section'])?$section=$_GET['section']:$section='list';

isset($_GET['id'])?$id=$_GET['id']:$id=0;

isset($_GET['parent_id'])?$parent_id=$_GET['parent_id']:$parent_id=0;

isset($_GET['page'])?$page=$_GET['page']:$page=1;

isset($_GET['type'])?$type=$_GET['type']:$type='1';

#handle actions here.

switch ($action):

	case 'list':

		$QueryObj = new query('content');
                
                $QueryObj->Where="where parent_id='$parent_id' and section='$type' order by position";

		
		$QueryObj->DisplayAll();

                

		$AllRecords = new query('content');

		$AllRecords->DisplayAll();

		break;

	case 'view':

		if($id!=0):

			$QueryObj =new query('content');

			$QueryObj->Where="where id='".$id."'";

			//$QueryObj->print=1;

			$page_cotent=$QueryObj->DisplayOne();

		endif;

		break;

	case 'update':

		$AllRecords = new query('content');

		$AllRecords->DisplayAll();

		

		if($id!=0):

			$QueryObj =new query('content');

			$QueryObj->Where="where id='".$id."'";

			$page_cotent=$QueryObj->DisplayOne();

                        

                        #see if already in navigation - 

                        $nObject = new query('navigation');

                        $nObject->Where="where navigation_link='content' and page_id='$id'";

                        $nObject->DisplayAll();

                        if($nObject->GetNumRows()):

                            $nObj=$nObject->GetObjectFromRecord();

                        endif;

                       

		endif; 

                	                

                if(isset($_POST['save'])):

                    

                        if(isset($_POST['navigation']) && is_array($_POST['navigation'])):

				$_POST['navigation']=implode(',', $_POST['navigation']);

			endif;

			

			if(isset($_POST['collection']) && is_array($_POST['collection'])):

				$_POST['collection']=implode(',', $_POST['collection']);

			endif;

		if(isset($_POST['remove_menu'])) 
				unset($_POST['remove_menu']);
            if(isset($_POST['menu_title'])) 
				unset($_POST['menu_title']);
            if(isset($_POST['menu_parent'])) 
				unset($_POST['menu_parent']);
		

			if(is_published($id)):

				$QueryObj->InitilizeSQL();

				$QueryObj->TableName='content';

				$not=array('save');

				$Data=MakeDataArray($_POST, $not);
                                $Data['show_in_menu']=isset($_POST['show_in_menu'])?'1':'0';
				page_preview(1,'','',$id);

				$QueryObj->Data=$Data;

				$QueryObj->Insert();

				$admin_user->set_pass_msg('The page has successfully been Added.');

				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id.'&type='.$type));

			else:

				$QueryObj->InitilizeSQL();

				$QueryObj->TableName='content';

				$not=array('save');

				$Data=MakeDataArray($_POST, $not);
                                 $Data['show_in_menu']=isset($_POST['show_in_menu'])?'1':'0';

				$Data['id']=$id;

				page_preview(1);

				$QueryObj->Data=$Data;

				$QueryObj->Update();

				$admin_user->set_pass_msg('The page has successfully been updated.');

				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));

			endif;

		endif;

				

		if(isset($_POST['publish'])):

			if(isset($_POST['navigation']) && is_array($_POST['navigation'])):

				$_POST['navigation']=implode(',', $_POST['navigation']);

			endif;

			

			if(isset($_POST['collection']) && is_array($_POST['collection'])):

				$_POST['collection']=implode(',', $_POST['collection']);

			endif;
                        

			if(isset($_POST['remove_menu'])) 
				unset($_POST['remove_menu']);
            if(isset($_POST['menu_title'])) 
				unset($_POST['menu_title']);
            if(isset($_POST['menu_parent'])) 
				unset($_POST['menu_parent']);

			if(is_published($id)):

				$QueryObj->InitilizeSQL();

				$QueryObj->TableName='content';

				$not=array('publish');

				$Data=MakeDataArray($_POST, $not);
                                 $Data['show_in_menu']=isset($_POST['show_in_menu'])?'1':'0';

				page_preview(0);

				$Data['id']=$id;

				$QueryObj->Data=$Data;

				$QueryObj->Update();

				$admin_user->set_pass_msg('The page has successfully been Updated.');

				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id.'&type='.$type));

			else:

				# get object contents

				$object=get_object_by_col('content', 'id', $id);

				# update the previous page.

				if($object->preview_of_page_id):

					$QueryObj->InitilizeSQL();

					$QueryObj->TableName='content';

					$Data['id']=$object->preview_of_page_id;

					$Data['page']=$object->page;

					$Data['meta_keyword']=$object->meta_keyword;

					$Data['meta_description']=$object->meta_description;

					page_preview(0);

					$QueryObj->Data=$Data;

					$QueryObj->Update();

					# delete the preview page.

					$query= new query('content');

					$query->id=$id;

					$query->Delete();

				else:

					$QueryObj->InitilizeSQL();

					$QueryObj->TableName='content';
                                      
					$Data['id']=$id;

					page_preview(0);

					$QueryObj->Data=$Data;

					$QueryObj->Update();

				endif;

												

				$admin_user->set_pass_msg('The page has successfully been updated.');

				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id.'&type='.$type));

			endif;

		endif;

					

		break;

		case 'update2':

		         if(is_var_set_in_post('submit')):
                   
                    $query= new query('content');
                    $query->Where="where section='$type'";     
                    $query->Data['show_in_menu']='0';
                    $query->UpdateCustom();
                    
                    foreach ($_POST['show_in_menu'] as $k=>$v):
                            $q= new query('content');
                            $q->Data['show_in_menu']=1;
                            $q->Data['id']=$k;
                            $q->Update();
                    endforeach;
                endif;

			if(isset($_POST['update_position'])):

				foreach($_POST['position'] as $k=>$v):

					$Q= new query('content');

					if($v==''):

						$Q->Data['position']=0;

					else:

						$Q->Data['position']=$v;

					endif;

					$Q->Data['id']=$k;

					$Q->Update();

				endforeach;

			endif;

			Redirect(make_admin_url('content', 'list', 'list','parent_id='.$parent_id.'&type='.$type));

		

		break;

	case 'insert':

			

			if(isset($_POST['navigation']) && is_array($_POST['navigation'])):

				$_POST['navigation']=implode(',', $_POST['navigation']);

			endif;

			

			if(isset($_POST['collection']) && is_array($_POST['collection'])):

				$_POST['collection']=implode(',', $_POST['collection']);

			endif;

				

		

			if(isset($_POST['publish'])):

				$QueryObj->InitilizeSQL();

				$QueryObj->TableName='content';

				$not=array('publish', 'menu_title', 'menu_parent','remove_menu');

				$Data=MakeDataArray($_POST, $not);
                                
                $Data['show_in_menu']=isset($_POST['show_in_menu'])?'1':'0';
                                
				$Data['id']=$id;
                                
				page_preview(0);
                               
				$QueryObj->Data=$Data;
                               
				$QueryObj->Insert();

                                $id=$QueryObj->GetMaxId();

                                $admin_user->set_pass_msg('The page has successfully been Added.');

				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id.'&type='.$type));

			endif;

			

			if(isset($_POST['save'])):

				$QueryObj->InitilizeSQL();

				$QueryObj->TableName='content';

				$not=array('save', 'menu_title', 'menu_parent', 'remove_menu');

				$Data=MakeDataArray($_POST, $not);
                                 
                                 $Data['show_in_menu']=isset($_POST['show_in_menu'])?'1':'0';
                               
				$Data['id']=$id;

				page_preview(1);

				$QueryObj->Data=$Data;
                                
                                $QueryObj->Insert();
                              
                                $id=$QueryObj->GetMaxId();

                                $admin_user->set_pass_msg('The page has successfully been Added.');

				Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id));

			endif;

                        

			break;

	case 'delete':

			$QueryObj->InitilizeSQL();

			$QueryObj->TableName='content';

			$QueryObj->id=$id;

			$QueryObj->Delete();

                        

                        #delete page from menu

                        $query= new query('navigation');

                        $query->Where="where page_id=$id";

                        $query->Delete_where();

                                                

			$admin_user->set_pass_msg('The page has successfully been deleted.');

			Redirect(make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id.'&type='.$type));

	default:break;

endswitch;







?>

