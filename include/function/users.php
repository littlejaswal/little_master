<?php
function validate_user($table, $details=array())
{
	$query= new query($table);
	$query->Where="where username='$details[username]' and password='$details[password]' and is_active=1";
	if($user=$query->DisplayOne()):
		return $user;
	else:
		return false;
	endif;	
}
function update_last_access($id, $status)
{
	$q= new query('admin_user');
	$q->Data['last_access']=date("Y-m-d h:i:s");
	$q->Data['is_loggedin']=$status;
	$q->Data['id']=$id;
	$q->Update();
}

function download_users()
{
	$users= new query('user');
	$users->DisplayAll();
	$users_arr= array();
	if($users->GetNumRows()):
		while($user= $users->GetArrayFromRecord()):
			$user['total orders']=get_total_orders_by_user($user['id']);
			array_push($users_arr, $user);
		endwhile;
	endif;
	$file=make_csv_from_array($users_arr);
	$filename="users".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}
function download_staff()
{
	$users= new query('staff');
	$users->DisplayAll();
	$users_arr= array();
	if($users->GetNumRows()):
		while($user= $users->GetArrayFromRecord()):
			$user['total orders']=get_total_orders_by_user($user['id']);
			array_push($users_arr, $user);
		endwhile;
	endif;
	$file=make_csv_from_array($users_arr);
	$filename="Staff".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}

function download_search_users($email,$first_name,$last_name,$city,$country)
{
	$search_users= new query('user');
	$search_users->Where="where username='$email' OR firstname='$first_name' OR lastname='$last_name' OR city='$city' OR country='$country'";
	$search_users->DisplayAll();
	$search_users_arr= array();
	if($search_users->GetNumRows()):
		while($search_user= $search_users->GetArrayFromRecord()):
			$search_user['total orders']=get_total_orders_by_user($search_user['id']);
			array_push($search_users_arr, $search_user);
		endwhile;
	endif;
	$file=make_csv_from_array($search_users_arr);
	$filename="search_users".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}



?>