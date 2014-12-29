<?php
function PageControl($page,$totalPages,$totalRecords,$url,$querystring='',$type=1,$Class='pad',$tdclass='',$Title='Records',$LClass='cat')
	{
			# $Pp-previous page
			# $Np- next page
			($page>=$totalPages)?$Np=$totalPages:$Np=$page+1;
			($page<=1)?$Pp=1:$Pp=$page-1;
			if($totalPages>3):
				if(($page+3) <=$totalPages):
					$end=$page+3;
					$begin=$page;
				else:
					$begin=$totalPages-3;
					$end=$totalPages;
				endif;
			else:
				$begin=1;
				$end=$totalPages;
			endif;
			?>
					<div class="pagination">
                                            <a href="<?=$url?>?page=<?=$Pp?>&<?=$querystring?>" title="Previous Page">&laquo;</a>
						<?php for($i=$begin;$i<=$totalPages && $i<=$end;$i++):?>
								<?php if($i==$page):?>
								<a href="<?=$url?>?page=<?=$i?>&<?=$querystring?>" class="active" title="Page No: <?=$i?>"><?=$i?></a>
								<?php else:?>
								<a href="<?=$url?>?page=<?=$i?>&<?=$querystring?>"  title="Page No: <?=$i?>"><?=$i?></a>
								<?php endif;?>

						<?php endfor;?>
                                                                <a href="<?=$url?>?page=<?=$Np?>&<?=$querystring?>" title="Next Page">&raquo;</a>
					</div>
			<?php


	}


	function PageControl_front($page,$totalPages,$totalRecords,$url,$querystring='',$type=1,$Class='pad',$tdclass='',$Title='Records',$LClass='cat')
{
	if($type==1):
		?>
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?=$Class?>">
			<tr>
				<td class="<?=$tdclass?>" width="30%" align="left">Total&nbsp;<?=$Title?>:&nbsp;&nbsp;<?=$totalRecords?></td>
				<td align="right" >Pages:&nbsp;&nbsp;
				<?php for($i=1;$i<=$totalPages;$i++):?>
					<?php if($i==$page):?>
						<?=display_url($i, $url, 'p='.$i.'&'.$querystring,'blockselected');?>
					<?php else: ?>
						<?=display_url($i, $url, 'p='.$i.'&'.$querystring,$LClass);?>
					<?php endif;?>
				<?php endfor;?>
				</td>
			</tr>
		</table>
		<?
	elseif($type==2):
		# $Pp-previous page
		# $Np- next page
		($page>=$totalPages)?$Np=$totalPages:$Np=$page+1;
		($page<=1)?$Pp=1:$Pp=$page-1;
		if($totalPages>3):
			if(($page+3) <=$totalPages):
				$end=$page+3;
				$begin=$page;
			else:
				$begin=$totalPages-3;
				$end=$totalPages;
			endif;
		else:
			$begin=1;
			$end=$totalPages;
		endif;
		?>
	
                <div class="news_buttens">
				<div class="news_but"><a href="<?=make_url($url, 'p='.$Pp.'&'.$querystring)?>" title="Previous Page"><?php echo "<"." PREV"?></a></div>
				<?
				for($i=$begin;$i<=$totalPages && $i<=$end;$i++):
					if($i==$page):?>
						  <div class="news_butt_2"> <?php echo  display_url($i, $url, 'p='.$i.'&'.$querystring,'blockselected'); ?></div><div class="news_line"><img src="<?php echo DIR_WS_SITE_GRAPHIC?>line_news.png" /></div>
					<?php else: ?>
						<div class="news_butt_1"> <?php echo display_url($i, $url, 'p='.$i.'&'.$querystring,$LClass);?></div><div class="news_line"><img src="<?php echo DIR_WS_SITE_GRAPHIC?>line_news.png" /></div>
					<?php endif;					
				endfor;
				?>
				<div class="news_but"><a href="<?=make_url($url, 'p='.$Np.'&'.$querystring)?>"  title="Next Page"  >&nbsp;<?php echo " NEXT"." >"?></a></div>
		</div><br/>
               
		<?
	endif;
}	

?>