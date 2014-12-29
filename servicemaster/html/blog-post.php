<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style'));?>
		<?php js($array=array('jquery-1.2.6.min'));?>
		<style>
			#banners a{
				color:#FFFFFF;
			}
			.blog_post_back a{ text-decoration:none;}
			.blog_post_back a:hover{ text-decoration:underline;}
		</style>
	</head>
<?php 
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Blog</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">
	<div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;<a href="<?php echo make_url('blog');?>">Blog</a>&nbsp;&raquo;&nbsp;Blog Post</div>
	<?php include(DIR_FS_SITE.'template/blog-post-complete.php');?>
	<p class="blog_post_back"><a href="<?php echo make_url('blog');?>">&larr;&nbsp;go back</a></p>
   <?php include(DIR_FS_SITE.'template/veiw-comments.php');?> 
 <?php include(DIR_FS_SITE.'template/comments.php');?>

</div>
</div>
    </div>
      <div id="ourservicesbottom21"></div>
    </div>
  </div>

<?php

include_once(DIR_FS_SITE_INCLUDE.'right.php');
include_once(DIR_FS_SITE_INCLUDE.'bottom.php');

?>