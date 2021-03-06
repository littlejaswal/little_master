<?	require_once("../include/config/config.php");

	

	include_functions(array(

		'video', 

		'date', 

		'email', 

		'file_handling', 

		'http', 

		'image_manipulation', 

		'paging', 

		'news', 

		'testimonials', 

		'recaptchalib', 

		'content',

		'footer',

		'gallery',

		'testimonials',

		'category'

		));

	if(!$admin_user->is_logged_in()):

		Redirect(DIR_WS_SITE.ADMIN_FOLDER.'/index.php');

	endif;

	if($admin_user->get_permission() !='*'):

		$PageAccess = split("@@",$admin_user->get_permission());

	else:

		$PageAccess='*';

	endif;

	$Page =isset($_GET['Page'])?$_GET['Page']:"home";



	if($Page!='' && file_exists(DIR_FS_SITE.ADMIN_FOLDER.'/script/'.$Page.'.php')):

		if($PageAccess=='*' || in_array($Page, $PageAccess)):

			include(DIR_FS_SITE.ADMIN_FOLDER.'/script/'.$Page.'.php');

		endif;

	endif;

	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/include/header.php');

	include_once(DIR_FS_SITE.ADMIN_FOLDER.'/js/fckeditor/fckeditor.php');



?>

<table border="0" cellpadding="0" cellspacing="0" width="98%">

	<tr>

		<td valign="top" align="center">

			<?

			if($Page !="")

			{

				if(file_exists(DIR_FS_SITE.ADMIN_FOLDER.'/form/'.$Page.".php")):

				  	if($PageAccess=='*' || in_array($Page, $PageAccess)):

				  		require_once(DIR_FS_SITE.ADMIN_FOLDER.'/form/'.$Page.".php");

					else:

						echo"<br><br><font size='3'><b>Welcome ".$admin_user->get_username()."!</b></font><br><br>";

						echo "You do not have the permission to access this page.";

					endif;

				else:

					echo"<font size='3'><br><br><b>Page is under construction....</b></font>";

				endif;

			}

			?>

		</td>

	 </tr>

</table>

<?	require_once(DIR_FS_SITE.ADMIN_FOLDER.'/include/'."right.php"); ?>

<?	require_once(DIR_FS_SITE.ADMIN_FOLDER.'/include/'."footer.php"); ?>