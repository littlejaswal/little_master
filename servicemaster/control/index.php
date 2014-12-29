<?
	require_once("../include/config/config.php");
	$function=array('url', 'database','input', 'admin', 'users');
	include_functions($function);
	if(is_var_set_in_post('login')):
		if($user=validate_user('admin_user', $_POST)):
			$admin_user->set_admin_user_from_object($user);
			update_last_access($user->id, 1);
			re_direct(DIR_WS_SITE_CONTROL."control.php");
		else:
			$admin_user->set_pass_msg(MSG_LOGIN_INVALID_USERNAME_PASSWORD);
			re_direct(DIR_WS_SITE_CONTROL.'index.php');
		endif;
	endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title><?=SITE_NAME?> :: Website Control Panel</title>
	<style>
		Body{margin:70px 0px 0px 0px; padding:0px; background:url(image/bg.jpg) repeat-x #f57900; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#3c3c3c;}
		form{display:inline;}
		td{line-height:normal;}
		a{ color:#3c3c3c; text-decoration:underline;}
		a:hover{color:#3c3c3c; text-decoration:none;}
		.bg{background:url(image/mainimage.png) no-repeat;}
		h1{color:#ffffff; margin:0px; padding:78px 0px 0px 18px; text-align:left; font-size:22px;}
		.button{font-size:18px; background:#5dbbd2; color:#ffffff; border:none;}
		.textarea{border:1px solid #CCCCCC; height:25px; line-height:20px; font-size:17px; width:220px;}
		.error{background:url(image/error_bg.jpg) center top no-repeat; height:34px; width:320px; margin:10px 0px 0px 0px; text-align:left; padding:12px 0px 0px 28px;}
		.bottomtxt{padding:0px 30px 0px 15px; font-size:10px; margin:10px 0px 0px 0px}
	</style>
</head>

<body>
<table width="346" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="346" height="345" align="center" valign="top" class="bg"><h1>Admin
        Login</h1>
           	<?
			if($admin_user->isset_pass_msg()):
				echo ' <div class="error">';
				foreach ($admin_user->get_pass_msg() as $k=>$v):
					echo $v;
				endforeach;
				echo'</div>';
				$admin_user->unset_pass_msg();
			endif;
			?>
       		<form method="POST">
      <div style="padding-top:20px;">
          <table height="118" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td width="25%" align="left">Email</td>
              <td width="75%" align="left" valign="top"><input name="username" type="text" class="textarea"  tabindex="1"/></td>
            </tr>
            <tr>
              <td height="31" align="left">Password</td>
              <td align="left" valign="top"><input name="password" type="password" class="textarea" tabindex="2" /></td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td align="left" valign="top"><input name="login" type="submit" class="button" value="Login" /></td>
            </tr>
          </table>
      </div>
      </form>
      </td>
  </tr>
</table>
</body>
</html>