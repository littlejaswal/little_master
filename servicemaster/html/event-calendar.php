<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style', 'layout'));?>
		<?php js($array=array('jquery-1.2.6.min', 'maxheight'));?>
		<style>
		#container{
			width:548px;
			height:auto;
			background:#FFFFFF;
			border:solid 1px #484039;
			margin:0px;
		}
		
		#calendar{
			margin:auto;
		}
		
		.head{
			width:76px;
			height:30px;
			text-align:center;
			font-weight:bold;
			float:left;
			background:#808080;
			color:#ffffff;
			margin:1px;
			line-height:30px;
			text-transform:uppercase;
		}
		
		.box{
			width:76px;
			height:100px;
			text-align:center;
			font-weight:bold;
			float:left;
			background:#C0C0C0;
			margin:1px;
		}
		#filters{
			height:40px;
			width:540px;
			margin:0px;
		}
		
		#filters #month{
			float:right;
			width:30%;
			padding-top:5px;	
			padding-right:5px;	
			text-align:right;
		}
		
		#filters #year{
			float:right;
			width:30%;
			text-align:right;
			padding-top:5px;	
			padding-left:5px;
		}
		#filters #cat{
			float:left;
			width:38%;
			padding-top:5px;	
			text-align:left;
		}
		.dark{
			background:#607041;
		}
		.eve{
			height:auto;
			width:200px;
			border:solid 2px #484039;
			background:#f5f5f5;
			padding:5px;
		}
		
		.box ul{
			margin:0px;
			padding:0px;
			list-style:none;
		}
		
		.box ul li{
			background:#DFCF99;
			padding:2px;
			margin:2px 0px 2px 0px;
		}
		
		.box ul li a{
			color:#FFFFFF;
			text-decoration:none;
		}
		
		.box ul li a:hover{
			color:#FFFFFF;
			text-decoration:underline;
		}
		
	</style>
	<script>
		$("document").ready(function(){
//			$("#calendar .dark").mouseover(function(){
//				var v=$(this).attr("rel");
//				var x=$(this).offset().left-50;
//				var y=$(this).offset().top+50;
//				$("#"+v).css('display','block');
//				$("#"+v).css('position','absolute');
//				$("#"+v).css('top',y);
//				$("#"+v).css('left',x);
//			});
			
			$(".elink").mouseover(function(){
				var v=$(this).attr("rel");
				var x=$(this).offset().left+50;
				var y=$(this).offset().top;
				$("#"+v).css('display','block');
				$("#"+v).css('position','absolute');
				$("#"+v).css('top',y);
				$("#"+v).css('left',x);
			});
			
			
			$(".elink").mouseout(function(){
				var v=$(this).attr("rel");
				$("#"+v).css('display','none');
			});
		});
	</script>
	</head>
<?php 
#include the top portion of your website  here.
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Events</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">
	
		<div id="textbox">

                    <div id="breadcrumb">
                <a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;Event on calendar
            </div>
                    <div style=" float:right; margin-bottom:20px;"><a href="<?php echo make_url('events');?>"><img src="<?php echo DIR_Ws_SITE_GRAPHIC?>Events_on_list.png" border="0" /></a></div><br />
 	<?php echo display_form_error();?>
								                   	<form action="<?php echo make_url('event-calendar')?>" method="GET">
									                   	<div style="height:auto;padding:10px 3px 2px 3px;margin:10px 0px 2px 0px;">
										                   	
										                   	<div id="filters">
										                   		<div id="year">
										                   			<select name="year" class="Textbox">
										                   				<?php echo expire_year($year);?>
										                   			</select>
										                   			<input type="submit" name="submit" value="Go" style="width:40px;" />
										                   		</div>
										                   		<input type="hidden" name="page" value="event-calendar" />
										                   		<div id="month"> 
										                   			<select name="month" class="Textbox">
										                   				<?php echo expire_month($month);?>
										                   			</select>
										                   			
										                   		</div>
										                   	</div>
									                   	</div>
								                   	</form>
								                    <div id="container">
														<div id="calendar">
															<div class="head">Sun</div>		
															<div class="head">Mon</div>			
															<div class="head">Tue</div>			
															<div class="head">Wed</div>			
															<div class="head">Thu</div>			
															<div class="head">Fri</div>			
															<div class="head">Sat</div>			
															<div style="clear:both;"></div>
															<?php 
																if(count($events)):
																	for($i=1;$i<=$days;$i++):
																		echo '<div class="box">'.$i.'<br/>';
																		foreach ($eve as $k=>$v):
																			if($k==$i):
																				echo '<ul>';
																				foreach ($v as $kk=>$vv):
																					//echo '<li><a href="'.make_url('event-detail', 'id='.$vv->id).'" rel="e'.$vv->id.'" class="elink">'.limit_text($vv->name, 2).'</a></li>';
																				endforeach;		
																				echo '</ul>';
																			endif;
																		endforeach;
																		echo '</div>';
																	endfor;
																else:
																	for($i=1;$i<=$days;$i++):
																		echo '<div class="box">'.$i.'</div>';
																	endfor;
																endif;							
															?>
															<div style="clear:both;"></div>
															<div class="head">Sun</div>	
															<div class="head">Mon</div>			
															<div class="head">Tue</div>			
															<div class="head">Wed</div>			
															<div class="head">Thu</div>			
															<div class="head">Fri</div>			
															<div class="head">Sat</div>			
															<div style="clear:both;"></div>
														</div>
													</div>
													<div id="events">
														<?php
															foreach ($events as $k=>$v):
																echo '<div id="e'.$v->id.'" style="display:none;" class="eve">';
																		echo '<span style="font-weight:bold">'.$v->name.'</span><br/>';
																		echo '<span style="color:#FF0000">@'.$v->venue.'</span><br/>';
																		echo '<span style="color:#FF0000">'.$v->event_date.'</span>';
																echo '</div>';
																echo '<div style="clear:both;"></div>';
															endforeach;
														?>
													</div> <br />                	
             
            </div>
            </div>
         
        </div>
    </div>
      <div id="ourservicesbottom21"></div>
    </div>
  </div>
        
<?php
include_once(DIR_FS_SITE_INCLUDE.'right.php');
include_once(DIR_FS_SITE_INCLUDE.'bottom.php');
?>