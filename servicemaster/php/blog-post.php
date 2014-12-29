<?php 
if(isset($_POST['post'])):
	$QueryObj = new query('comments');
	$not=array('post');
	$QueryObj->Data=MakeDataArray($_POST, $not);
	$QueryObj->Data['ipaddress']=$_SERVER['REMOTE_ADDR'];
	$QueryObj->Data['post_date']=date("Y-m-d");
	$QueryObj->Insert();
	Redirect(make_url('blog-post', 'id='.$_POST['post_id']));
endif;
$id=is_set($_GET, 'id', 0);
$blog= new query('blog');
$blog->Where="where id='$id'";
$content=$blog->DisplayOne();
?>