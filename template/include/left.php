  <?php
$links=new query('links');
$links->Where="where is_active='1' order by id";
$links->DisplayAll();
?>
<?php js($array=array('jquery.cycle.all.latest'));?>
<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
});
</script>
<div id="sidebar">

	<div id="featured">
        <div class="featured slideshow">
 <?php if($links->GetNumRows()):
		 while($featured_img=$links->GetObjectFromRecord()):
				if($featured_img->image!=''): 
						if($featured_img->url!=''):  ?>
							<a href="<?php echo $featured_img->url; ?>" target="_blank"><img src="<?php echo get_large('links', $featured_img->image);?>" border="0"  style="width:200px; height:133px;" title="<?php echo $featured_img->name;?>"/></a> 
				  <?php else: ?>
							<img src="<?php echo get_large('links', $featured_img->image);?>" border="0"  style="width:200px; height:133px;" />
				  <?php endif;
				endif; 
				  
		 endwhile;		
	  else: ?>
				<img src="<?php echo DIR_WS_SITE_GRAPHIC?>featured.jpg" alt="Featured 1" /> 
	<?php endif; ?>			
        </div>
        
    </div><!-- end featured -->
    
	    <ul id="sideNav">
    	<li><a class="home" href="<?php echo make_url('home') ?>">Home</a></li>
        <li><a class="service" href="<?php echo make_url('services') ?>">Services</a></li>
		<li><a class="form" href="<?php echo make_url('form') ?>">Form</a></li>
        <li><a class="about" href="<?php echo make_url('about') ?>">About Us</a></li>
		<li><a class="service_provider" href="<?php echo make_url('service_provider') ?>">Service Providers</a></li>
        <li><a class="contact" href="<?php echo make_url('contact') ?>">Contact Us</a></li>
        <li><a class="testimonials" href="<?php echo make_url('testimonials') ?>">Testimonials</a></li>
	<!--	<li><a class="properties" href="<?php echo make_url('links') ?>">Properties</a></li>  -->
    </ul>    
    <img class="map" src="<?php echo DIR_WS_SITE_GRAPHIC?>map.png" alt="Pearland" />
    <img class="moving" src="<?php echo DIR_WS_SITE_GRAPHIC?>moving.png" alt="Moving?" />
    
    </div><!-- end sidebar -->