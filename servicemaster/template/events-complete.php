<div class="event_detail">
	<div class="event_detail_head"><?php echo ucwords($object->name);?></div>
	<div class="event_detail_content">
		<strong>Event Date: <?php echo $object->event_date_show;?></strong><br/>
		<strong>Event Venue: <?php echo $object->venue;?></strong><br/>
		<strong><?php echo ($object->register_on_off)?'Registration required<br/>':'';?></strong>
		<strong><?php echo ($object->fee)?'Registration Fee: $'.$object->fee.'<br/>':'';?></strong>
		<?php echo nl2br($object->long_description);?>
		<div class="event_detail_footer"><a href="<?php echo make_url('events');?>">&larr;&nbsp;back to events</a>
	</div>
</div>
<?php  ?>