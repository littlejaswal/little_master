
</div>
  <div id="rightpanel">
    <div id="latestnewstop"></div>
    
    <div id="latestnewsmiddle">
      <div id="Latestnews">Latest News</div>
      <div id="lorem1">
        <?php
			  $sr=1;
        	 $testimonial = new query('news');
			 $testimonial->Where="where is_active='1' limit 0,3";
			 $testimonial->DisplayAll();
			 while($news=$testimonial->GetObjectFromRecord())
			 {
		?>
            <div class="name yellow"><?php echo $news->name?>&nbsp;</div>
      <?php echo html_entity_decode($news->short_description);?>
     
     	<div class="linkview" align="right"><a href="<?php echo make_url('news-detail','id='.$news->id);?>" style="color:#004C86">Read More 					         &nbsp;&raquo;&nbsp;</a></div>
			<?php echo ($sr++%1==0)?'<div style=" clear:both"></div>':'';?>
      		<?		 
			 }
			?>
            <div align="right" class="linkview"><a href="<?php echo make_url('news');?>" style="color:#004C86">View All &nbsp;&raquo;&nbsp;</a></div>
               </div>  </div>
            
    <div id="latestbottom"></div>
  </div>
  <div id="rightpanel2">
    <div id="testimonialtop"></div>
    <div id="testimonialmiddle">
      <div id="testimonialwritten">Testimonials</div>
      
      <?php include(DIR_FS_SITE.'template/boxes/testimonial.php');?>
     
     
    </div>
    <div id="testimonialbottom"></div>
 
  <div id="rightpanel23">
    <div id="testimonialtop"></div>
    <div id="testimonialmiddle">
      <div id="testimonialwritten">Newsletters</div> 
      <?php include(DIR_FS_SITE.'template/boxes/newsletter.php');?>
  	 </div>
    <div id="testimonialbottom"></div>
  </div> 

  