<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style'));?>
		<?php js($array=array('jquery-1.2.6.min'));?>
		<style>
		.contentpage{
			padding-left:20px;
			padding-right:10px;
			padding-top:10px;
		}
		
			ul.sitemap{
				display:block;
				margin-left:25px;
				padding:5px;
				
			}
			ul.sitemap li{
			display:block;
			line-height:25px;
			font:Arial, Helvetica, sans-serif;
			}
			ul.sitemap li a{ text-decoration:underline; color:#000;}
			ul.sitemap a{ text-decoration:none;}
			.spacer{clear:both;text-align:right;}   
				.head{
				padding-left:10px;
				width:630px;
				height:auto;
			}
		</style>
	</head>
<?php 
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
 <div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Sitemap</div>
      </div>
      <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
          <div id="restorationtext21">
				<div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;Sitemap</div>
 
						<p>
						<ul class="sitemap" >
						<li><a href="<?php echo make_url('home');?>" >Homepage</a></li>
                     
						<li><a href="<?php echo make_url('about-us');?>">About Us</a></li>
						<?php
							$about_pages=array();
							$about_pages=get_content_children('21', 0, array('page_name', 'id'));
						?>
                         </li><ul>
						<? foreach ($about_pages as $ak=>$av):	?>
						<li>
                         <a href="<?php echo make_url('content', 'id='.$av->id);?>"><?php echo $av->page_name;?></a></li>
						<? endforeach;;?>
						</ul></li>
						<li>
						<a href="<?php echo make_url('meet-the-team');?>">Meet the Team</a>
						<?php
								 $_pages=array();
								 $_pages=get_content_children('19', 0, array('page_name', 'id'));
						?>
                    
						<ul>
						<? foreach ($_pages as $ak=>$av):	?>
						<li><a href="<?php echo make_url('content', 'id='.$av->id);?>"><?php echo $av->page_name;?></a></li>
						<? endforeach;?>
						</ul></li>
                      
                       
						
									<li><a href="<?php echo make_url('testimonials');?>">Testimonials</a></li>
									<li><a href="<?php echo make_url('news');?>">News</a></li>
                                    	<li>
							<a href="#">Services</a>
                            <li>Restoration</li>
                            <li>
							<ul>
								<div id="services" >
          					
          					<?php
							 $services_pages=array();
							 $services_pages=get_content_children('8', 0, array('page_name', 'id', 'urlname'));
							?>
					
						<?	 foreach ($services_pages as $sk=>$sv):	?>
							<div>	
			<a href="<?php echo make_url('content', 'id='.$sv->id.'&pn='.$sv->urlname);?>"><?php echo $sv->page_name;?></a>
								</div>	  
						<?   endforeach;?>
        									 </div>
                             
							</ul></li>
                            <li>Cleaning</li>
							<li><ul>
								  <div id="services" >
          					
          					<?php
							 $services_pages=array();
							 $services_pages=get_content_children('9', 0, array('page_name', 'id', 'urlname'));
							?>
					
						<?	 foreach ($services_pages as $sk=>$sv):	?>
							<div>	
			<a href="<?php echo make_url('content', 'id='.$sv->id.'&pn='.$sv->urlname);?>"><?php echo $sv->page_name;?></a>
								</div>	  
						<?   endforeach;?>
        									 </div>
                             
							</ul></li>	
                            </li>
									<li><a href="<?php echo make_url('contact-us');?>">Contact Us</a></li>
						
							<li>
							<a href="#">Media</a>
							<ul>
								<li><a href="<?php echo make_url('photos');?>">Photos</a></li>
								<li><a href="<?php echo make_url('videos');?>">Videos</a></li>
							</ul></li>
                              <li><a href="<?php echo make_url('blog');?>">Blog</a></li>
								<li><a href="<?php echo make_url('frequently-asked-questions');?>">FAQ</a></li>
                                 <li><a href="<?php echo make_url('glossary');?>">Glossary</a></li>
                                  <li><a href="<?php echo make_url('events');?>">Events</a></li>
                                  <li><a href="<?php echo make_url('privacy-policy');?>">Privacy Policy </a></li>
                                   <li><a href="<?php echo make_url('terms-of-use');?>">Terms of Use </a></li>
									<li><a href="<?php echo make_url('newsletter');?>">Newsletters</a></li>
									</ul>
								</p>
                              
							<div class="spacer"></div>	
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