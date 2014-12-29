<?php echo "hi"; exit; ?>
	<?php if($object->image!=''): ?>
		 <div class="link_logo" style="float: left; margin-right: 30px;">
			<?php if($object->url!=''):  ?>
			<a href="<?php echo $object->url; ?>" target="_blank"><img src="<?php echo get_large('links', $object->image);?>" border="0" alt="<?php echo $object->image;?>" style="max-width:280px; border:solid 0px" /></a> 
			<?php else: ?>
				<img src="<?php echo get_large('links', $object->image);?>" border="0" alt="<?php echo $object->image;?>" style="max-width:280px; border:solid 0px" />
		 <?php endif; ?>
		 </div>
	<?php endif; ?>
 <div class="link_text">
 <span class="link_heading"><strong><?php echo $object->name; ?></strong></span><br />
<div style="margin-bottom:5px;"><a class="a3" href="<?php echo $object->url; ?>" target="_blank"><?php echo $object->url; ?> </a></div> 
<?php echo $object->text_description; ?> </div>
<div class="link_icon"><img src="graphic/img-16.jpg" /></div>
<div style="clear:both"></div>
<div class="ob_line"></div>


					

				 