<div class="blog_post_detail">
	<div class="blog_head_detail"><?php echo ucwords($content->page_name);?></div>
	<div class="blog_content_detail">
		<?php echo html_entity_decode($content->page);?>
		<div class="share">
			<p style="float:left;width:100px;"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-via="cwebconsultants" data-related="cwebconsultants:Follow our official account ">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></p>
			<p style="float:left;width:370px;"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fexample.com%2Fpage%2Fto%2Flike&amp;layout=standard&amp;show_faces=false&amp;width=350&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:35px;" allowTransparency="true"></iframe></p>
			<div style="clear:both;"></div>
		</div>
		<b>Post Date:</b> <?php echo $content->publish_date;?>&nbsp;&nbsp;</div>
	<div class="blog_keyword_detail"><?php echo $content->meta_keyword;?></div>
	<div class="blog_footer_detail"></div>
</div>
