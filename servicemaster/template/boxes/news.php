<div id="BoxNews" >
<div id="BoxNewsTitle">News</div>
	<?php 
	$query= new query('news');
	$query->Where="where is_active='1'";
	$query->DisplayAll();
	while($news=$query->GetObjectFromRecord())
	{
	?>
		<div class="name"><?php echo $news->short_description;?></div>
		<div >&nbsp;-<?php echo $news->name?>&nbsp;</div>
		<div align="right" class="link1"><a href="<?php echo make_url('news');?>"><img src="<?php echo DIR_WS_SITE_GRAPHIC?>readmore.png" hspace="3" vspace="3"></a></div>
	<?php 
	}
	?>
</div>