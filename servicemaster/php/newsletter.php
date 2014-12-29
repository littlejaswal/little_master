<?php 
if(isset($_POST['submit'])):
	$email= $_POST['email'];
	if($email!=''):
		$query= new query('lists');
		$query->Where="where emailaddress='$email'";
		if($object=$query->DisplayOne()):
			Redirect(make_url('newsletter', 'msg=This email address is already registered with us.'));
		else:
			$query= new query('lists');
			$query->Data['emailaddress']=$email;
			$query->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
			$query->Data['signupon']=date("Y/m/d H:i:s");
			$query->Insert();
			Redirect(make_url('newsletter', 'msg=Thank you, your email address has now been registered with us.'));
		endif;
	else:
		Redirect(make_url('newsletter', 'msg=Please enter your email address.'));
	endif;
endif;
if(!isset($_GET['msg'])):
	$_GET['msg']='Please use the newsletter box on the right side panel to register your email address with us. This shall enable us to send you ocassional newsletters.';
endif;
?>