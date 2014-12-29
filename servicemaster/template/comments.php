<form action="<?=make_url('blog-post');?>" method="POST" id="new-comment-form" >

<div id="comments">
<div>	Name	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="name" value="" size="32"  />
</div>

<div>	Email
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="email" value="" size="32"  />
</div>
<div>
Comment
</div>
<div>
		<textarea name="comment" cols="38" rows="3" tabindex="7"></textarea>
		<input name="post_id" type="hidden" value="<?php echo $content->id?>"/>
</div>
<div id="viewcommentbutton">
		<input type="submit" name="post" value="post" tabindex="9" /> 
</div>
</div>
</form>
