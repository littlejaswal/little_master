<div id="testimonialtext" >
	
	<?php
	    $sr=1;
		$testimonial = new query('testimonials');
	    $testimonial->Where="where is_active='1' limit 0,2";
	    $testimonial->DisplayAll();
	    while($test=$testimonial->GetObjectFromRecord())
	    {
		?>
		  <div class="name yellow"><?php echo $test->name;?></div>
		  <?
	    	echo html_entity_decode($test->short_description);
		?>
	   
		 <div align="right" class="linkview" style="margin-right:0px; padding-top:10px;" ><a href="<?php echo make_url('testimonials');?>" style="color:#004C86">Read More &nbsp;&raquo;&nbsp;</a></div>
         
	<?                 
	     }
	?>
    <div align="right" class="linkview"><a href="<?php echo make_url('testimonials');?>" style="color:#004C86">View All &nbsp;&raquo;&nbsp;</a></div>
</div>