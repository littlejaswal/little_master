<div class="news">
	<div class="head"><?php echo $v->name?></div>		
	<div class="text"><?php echo $v->short_description;?></div>
	<div class="link"><a href="<?php echo make_url('news-detail', 'id='.$v->id);?>"><img src="<?php echo DIR_WS_SITE_GRAPHIC?>readmore.png"></a>&nbsp;</div>			
	<div class="spacer"></div>
</div>