<div class="gallery_outer">
<div class="gallerycanvas">
    <div class="galleryhead"><?php echo $caption;?></div>
	<div class="photo"><a href="<?php echo make_url('photos-photos', 'gallery_id='.$gid);?>"><img src="<?php echo get_medium('gallery', $image);?>" border="0" width="190px"  /></a></div>
	<div class="caption">
	   <div style="margin-top:5px;"> <a href="<?php echo make_url('photos-photos', 'gallery_id='.$gid);?>" class="viewimages" style="text-decoration:none;"><img src="<?php echo DIR_WS_SITE_GRAPHIC?>viewimages.png"></a>  
	    <a href="<?php echo make_url('slide-show', 'gallery_id='.$gid);?>" class="viewslideshow" style="text-decoration:none;"><img src="<?php echo DIR_WS_SITE_GRAPHIC?>slideshow.png"></a>
	</div></div>
</div> 
</div>