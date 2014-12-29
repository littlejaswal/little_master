<div class="event">
	<div class="event_head"><?php echo ucwords($object->name);?></div>
	<div class="event_content"><?php echo nl2br(limit_text($object->short_description));?><br/>
		<strong><?php echo $object->event_date;?>/<?php echo $object->venue;?></strong><br/>
		<strong><?php echo ($object->register_on_off)?'Registration required<br/>':'';?></strong>
		<strong><?php echo ($object->fee)?'/$'.$object->fee.'<br/>':'';?></strong>
		<div class="event_footer"><a href="<?php echo make_url('event-detail', 'id='.$object->id.'&pn='.$object->name);?>">full event details</a></div>	
	</div>
	
</div>