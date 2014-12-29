<div style="margin-bottom:20px;margin-left:25px;">
	<span style="font-weight:bold;"><?php echo $object->page_name;?></span><br/>
	<div style="padding-top:5px;"><?php echo substr(strip_tags(html_entity_decode($object->page)), 0, 200);?>&nbsp;<a href="<?php echo make_url($pagearray[get_super_parent($object->id)], 'id='.$object->id.'&pn='.$object->page_name)?>">read more...</a></div>
</div>