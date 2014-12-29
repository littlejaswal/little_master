<script>
	$("document").ready(function(){
		$("#newsletter_box").focus(function(){
			if($(this).val()=='Enter Your Email Address'){
				$(this).val('');
			}
		});
		
		$("#newsletter_box").blur(function(){
			if($(this).val()==''){
				$(this).val('Enter Your Email Address');
			}
		});
	});
</script>
<div id="newslettertext" >
	<form action="<?php echo make_url('newsletter')?>" method="POST">
		
	    	<div id="newslettertext1">Please enter your email address</div>
	      <input name="email" type="text" value="Enter Your Email Address" size="28" id="newsletter_box" /><br />
	       <input type="submit" name="submit" value="Sign Up" id="Newsletter" style="margin-right:18px; font-size:16px;"  />
	    </div>
	</form>
	<div style="clear:both;"></div>
</div>