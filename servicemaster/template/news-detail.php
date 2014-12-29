<div class="news_detail">
	<div class="head"><?php echo ucwords($object->name);?></div>
	<div class="text"><?php echo html_entity_decode($object->long_description);?></div>
	<div class="link">Published on:&nbsp;<?php echo $object->date_show;?></div>	
    <div class="news_detail_footer"><a href="<?php echo make_url('news');?>" class="news_right">&larr;&nbsp;go back</a>	</div>		
	<div class="spacer"></div>
</div>		