<html>
<head>
<title><?php echo SITE_NAME?></title>
	<style>
	/* email formatting */
	
	#email_header{
	height:40px;
	width:100%;
	color:#FFFFFF;
	background:#cecece;
	text-align:center;
	line-height:40px;
	margin:10px 0px 10px 0px;
	}
	
	#email_center_content{
	padding:10px 10px 10px 10px;
	text-align:left;
	margin:0px 0px 0px 5px;
	background:#FFFFFF;
	color:#cecece;
	line-height:20px;
	font-weight:bold;
	}
	
	#email_footer{
	text-align:left;
	line-height:20px;
	font-weight:bold;
	margin:10px 0px 10px 10px;
	margin:0px 0px 0px 5px;
	}
	
	#container{
		border:solid 1px #dcdcdc;
		padding:5px;
		width:90%;
	}
	</style>

</head>
	<body>
	
	
		<div id="container">
			<div id="email_header" align="center" style="height:24px;line-height:24px;background:#dcdcdc;padding:0px 5px 0px 5px;margin:0px 0px 10px 0px;"><h3><?php echo $header;?></h3></div>
			<div style="clear:both">
			<div id="email_center_content"><b><?php echo $center_content;?></b></div>
			<div style="clear:both">
			<div id="email_footer"><?php echo $footer;?></div>
		</div>
	</body>
</html>



