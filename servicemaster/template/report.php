<div class="left-margin-25">
	<form action="<?php echo make_url('reports')?>" method="POST">
		<label for="name">Name:</label>
		<div class="input"><input tabindex="1" type="text" name="name" id="name" size="30"></div>
		<br/>
		<label for="email">Email Address:</label>
		<div class="input"><input tabindex="2" type="text" name="email" id="email" size="30"></div>
		<br/>
		<label for="phone">Phone Number:</label>
		<div class="input"><input tabindex="3" type="text" name="phone" id="phone" size="30"></div>
		<br/>
		<label for="comments">Comments:</label>
		<div class="input"><textarea name="comments" id="comments" rows="10" cols="24" tabindex="4"></textarea></div>
		<br/>
		
		<input type="hidden" name="report_name" value="<?php echo $content->page_name;?>" />
		<input type="hidden" name="report_id" value="<?php echo $content->id;?>" />
		
		<label for="comments">Validate Yourself:</label>
		<div class="input"><?php echo recaptcha_get_html($publickey, $error='');?></div>
		<br/>
		<div class="submit"><input tabindex="5" type="submit" name="submit" value="Submit"/></div>
	</form>
</div>