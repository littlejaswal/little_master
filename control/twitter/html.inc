<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Twitter Integration with <?echo SITE_NAME?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>
    <div style="width:400px;margin:100px;padding:10px;border:solid 1px #dcdcdc;font-family:arial, sans-serif;font-size:11px;">
      <h2>Twitter Account Integration</h2>
      <p> This page shall help you to connect your twitter account with the content management system. You shall be able to make posts directly to the twitter from CMS once you complete the integration steps.</p>
	  <?php if($linked):?>
			<p>Hello <strong><?php echo $user['screen_name']?></strong></p>
			<p>You already have a linked account with the CMS</p>
			<p> <a href="unlink.php">Unlink Existing Account</a> </p> 
	  <?php else:?>
			<p> <a href="redirect.php">Link New Account</a> with CMS</p>
	  <?php endif;?>
	</div>
  </body>
</html>