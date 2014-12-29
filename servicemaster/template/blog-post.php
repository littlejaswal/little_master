<div class="blog_post">
	<div class="blog_post_head"><?php echo ucwords($object->page_name);?></div>
	<div class="blog_post_content">
		<?php echo limit_text(html_entity_decode(strip_tags($object->page)), 200);?>
	   <div class="blog_post_read"><a href="<?php echo make_url('blog-post', 'id='.$object->id.'&pn='.$object->urlname);?>">read more...</a></div>
	</div>
	<div class="blog_post_footer"><b>Post Date:</b> <?php echo $object->publish_date;?>&nbsp;&nbsp;</div>
</div>