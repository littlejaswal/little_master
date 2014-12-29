<?
	function check_logged_in()
	{
		$login_session =new user_session();
		if($login_session->is_logged_in() && $login_session->is_verified()):
			return 1;
		elseif($login_session->is_logged_in() && !$login_session->is_verified()):
			Redirect(make_url('myaccount'));
		else:
			return 0;
		endif;
	}
	
	function check_logged_in_for_myaccount()
	{
		$login_session =new user_session();
		if(!$login_session->is_logged_in()):
			Redirect(make_url('login'));
		endif;
	}
	
	function check_logged_in_for_wishlist()
	{
		$login_session =new user_session();
		if($login_session->is_logged_in()):
			Redirect(make_url('wishlist'));
		endif;
	}
		
	function page_redirect($url)
	{
		$login_session= new user_session();
		$login_session->redirect_url=$url;
		$login_session->set_redirect_url();
	}


//        function check_logged_in_for_myaccount()
//	{
//		$login_session =new user_session();
//		if(!$login_session->is_logged_in()):
//			Redirect(make_url('login'));
//		endif;
//	}
?>