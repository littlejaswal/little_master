<?
class user_session
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
	var $verified=false;
		
	function user_session()
	{
		if(!isset($_SESSION['user_session'])):
			$_SESSION['user_session']=array('user_id'=>'',
								'logged_in'=>false,
								'error'=>'',
								'pass_msg'=>array(),
								'pass_msg_flag'=>false,
								'verified'=>false,
								'place_id'=>false,
								'category_id'=>false,
								'redirect_url'=>'',
								'redirect_url_flag'=>false,
								'username'=>'',
								'msg_type'=>false);
		endif;
	}

	function is_logged_in()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['logged_in']):
			return true;
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}
	
	function logout_user()
	{
		if(!isset($_SESSION['user_session'])):
			return true;
		endif;
		if($_SESSION['user_session']['logged_in']):
			$_SESSION['user_session']['logged_in']=false;
			$_SESSION['user_session']['user_id']='';
			$_SESSION['user_session']['username']='';
			$_SESSION['user_session']['pass_msg']='';
			$_SESSION['user_session']['pass_msg_flag']=false;
			$_SESSION['user_session']['verified']=false;
			$_SESSION['user_session']['error']='';
			return true;
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}
	
	function get_user_id()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['logged_in']):
			return $_SESSION['user_session']['user_id'];
		else:
			$this->error='Sorry! you are not logged in.';
			return false;
		endif;
	}
	
	function set_user_id()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['user_id']=$this->user_id;
		$_SESSION['user_session']['logged_in']=true;
		$_SESSION['user_session']['verified']=$this->verified;
		$this->logged_in='true';
		return true;
	}
	
	function set_username()
	{
		$_SESSION['user_session']['username']=$this->username;
		return true;
	}
	
	function get_username()
	{
		return $_SESSION['user_session']['username'];
	}
	
	function set_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['pass_msg']=$this->pass_msg;
		$_SESSION['user_session']['pass_msg_flag']=true;
		return true;
	}
	
	function unset_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['pass_msg']=array();
		$_SESSION['user_session']['pass_msg_flag']=false;
		return true;
	}
	
	function isset_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['pass_msg_flag']):
			return true;
		else:
			return false;
		endif;
	}
	
	function get_pass_msg()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		if($_SESSION['user_session']['pass_msg_flag']):
			return $_SESSION['user_session']['pass_msg'];
		else:
			return false;
		endif;
		
	}
	
	function set_redirect_url()
	{	
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		$_SESSION['user_session']['redirect_url']=$this->redirect_url;
		$_SESSION['user_session']['redirect_url_flag']=true;
		return true;
	}
	
	function isset_redirect_url()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		
		if($_SESSION['user_session']['redirect_url_flag']==true):
			return true;
		else:
			return false;
		endif;
	}
	
	function get_redirect_url()
	{
		if(!isset($_SESSION['user_session'])):
			return false;
		endif;
		if($_SESSION['user_session']['redirect_url_flag']):
			return $_SESSION['user_session']['redirect_url'];
		else:
			return false;
		endif;
	}
	
	function set_success()
	{
		$_SESSION['user_session']['msg_type']=true;
		return true;
	}
	
	function set_error()
	{
		$_SESSION['user_session']['msg_type']=false;
		return true;
	}
	
	function get_msg_type()
	{
		return $_SESSION['user_session']['msg_type'];
	}
	
	function is_verified()
	{
		return $_SESSION['user_session']['verified'];
	}
};
$login_session= new user_session();
?>