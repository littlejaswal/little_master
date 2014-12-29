<?
class admin_session
{
	var $user_id;
	var $logged_in=false;
	var $error='';
	var $pass_msg=array();
	var $pass_msg_flag=false;
	var $redirect_url;
	var $redirect_url_flag=false;
	var $msg_type=false;
	var $username;
	var $place_id;
	var $category_id;
	var $permission;
	var $user_type;
	var $last_access;


	function admin_session()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			$_SESSION['admin_session_secure']=array(
								'user_id'=>'',
								'logged_in'=>false,
								'error'=>'',
								'pass_msg'=>array(),
								'pass_msg_flag'=>false,
								'permission'=>'*',
								'redirect_url'=>'',
								'redirect_url_flag'=>false,
								'username'=>'',
								'user_type'=>'',
								'msg_type'=>false,
								'last_access'=>''
								);
		endif;
	}

	function is_logged_in()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;

		if($_SESSION['admin_session_secure']['logged_in']):
			return true;
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}

	function logout_user()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return true;
		endif;
		if($_SESSION['admin_session_secure']['logged_in']):
			$_SESSION['admin_session_secure']['logged_in']=false;
			$_SESSION['admin_session_secure']['user_id']='';
			$_SESSION['admin_session_secure']['username']='';
			$_SESSION['admin_session_secure']['pass_msg']='';
			$_SESSION['admin_session_secure']['pass_msg_flag']=false;
			$_SESSION['admin_session_secure']['error']='';
			return true;
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}

	function get_user_id()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;

		if($_SESSION['admin_session_secure']['logged_in']):
			return $_SESSION['admin_session_secure']['user_id'];
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}

	function set_user_id()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;
		$_SESSION['admin_session_secure']['user_id']=$this->user_id;
		$_SESSION['admin_session_secure']['logged_in']=true;
		$_SESSION['admin_session_secure']['permission']=$this->permission;
		$_SESSION['admin_session_secure']['user_type']=$this->user_type;
		$_SESSION['admin_session_secure']['last_access']=$this->last_access;

		//$_SESSION['admin_session_secure']['verified']=$this->verified;
		$this->logged_in='true';
		return true;
	}

	function set_username()
	{
		$_SESSION['admin_session_secure']['username']=$this->username;
		return true;
	}

	function get_username()
	{
		return $_SESSION['admin_session_secure']['username'];
	}

	function set_pass_msg($message)
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;
		$_SESSION['admin_session_secure']['pass_msg'][]=$message;
		$_SESSION['admin_session_secure']['pass_msg_flag']=true;
		return true;
	}

	function set_admin_user_from_object($user)
	{
		$this->user_id=$user->id;
		$this->permission=$user->allow_pages;
		$this->user_type=$user->type;
		$this->username=$user->username;
		$this->last_access=$user->last_access;
		$this->set_user_id();
		$this->set_username();
	}


	function unset_pass_msg()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;
		$_SESSION['admin_session_secure']['pass_msg']=array();
		$_SESSION['admin_session_secure']['pass_msg_flag']=false;
		return true;
	}

	function isset_pass_msg()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;

		if($_SESSION['admin_session_secure']['pass_msg_flag']):
			return true;
		else:
			return false;
		endif;
	}

	function get_pass_msg()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;
		if($_SESSION['admin_session_secure']['pass_msg_flag']):
			return $_SESSION['admin_session_secure']['pass_msg'];
		else:
			return false;
		endif;

	}

	function set_redirect_url()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;
		$_SESSION['admin_session_secure']['redirect_url']=$this->redirect_url;
		$_SESSION['admin_session_secure']['redirect_url_flag']=true;
		return true;
	}

	function isset_redirect_url()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;

		if($_SESSION['admin_session_secure']['redirect_url_flag']==true):
			return true;
		else:
			return false;
		endif;
	}

	function get_redirect_url()
	{
		if(!isset($_SESSION['admin_session_secure'])):
			return false;
		endif;
		if($_SESSION['admin_session_secure']['redirect_url_flag']):
			return $_SESSION['admin_session_secure']['redirect_url'];
		else:
			return false;
		endif;
	}

	function set_success()
	{
		$_SESSION['admin_session_secure']['msg_type']=true;
		return true;
	}

	function set_error()
	{
		$_SESSION['admin_session_secure']['msg_type']=false;
		return true;
	}

	function get_msg_type()
	{
		return $_SESSION['admin_session_secure']['msg_type'];
	}

	function set_permision($per)
	{
		$_SESSION['admin_session_secure']['permission']=$per;
		return true;
	}

	function get_permission()
	{
		return  $_SESSION['admin_session_secure']['permission'];
	}

	function get_user_type()
	{
		return  $_SESSION['admin_session_secure']['user_type'];
	}

	function get_last_access()
	{
		return  $_SESSION['admin_session_secure']['last_access'];
	}
};
$admin_user= new admin_session();
?>