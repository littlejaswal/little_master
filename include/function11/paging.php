<?
function PageControl($page,$totalPages,$totalRecords,$url,$querystring='',$type=1,$Class='pad',$tdclass='',$Title='Records',$LClass='cat')
{
	if($type==1):
		?>
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?php echo $Class?>">
			<tr>
				<td class="<?php echo $tdclass?>" width="30%" align="left">Total&nbsp;<?php echo $Title?>:&nbsp;&nbsp;<?php echo $totalRecords?></td>
				<td align="right" >Pages:&nbsp;&nbsp;
				<?for($i=1;$i<=$totalPages;$i++):?>
					<?if($i==$page):?>
						<a href="<?php echo $url?>?page=<?php echo $i?>&<?php echo $querystring?>" class="blockselected" title="Page No: <?php echo $i?>"><?php echo $i?></a>&nbsp;
					<?else:?>
						<a href="<?php echo $url?>?page=<?php echo $i?>&<?php echo $querystring?>" class="<?php echo $LClass;?>" title="Page No: <?php echo $i?>"><?php echo $i?></a>&nbsp;
					<?endif;?>
				<?endfor;?>
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
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?php echo $Class?>">
			<tr>
				<td width="30%" class="<?php echo $tdclass?>" align="left">Total&nbsp;<?php echo $Title?> :&nbsp;&nbsp;<?php echo $totalRecords?></td>
				<td width="25%" class="<?php echo $tdclass?>">Total Pages:&nbsp;&nbsp;<?php echo $totalPages?></td>
				<td align="right" >
				<a href="<?php echo $url?>?page=<?php echo $Pp?>&<?php echo $querystring?>" class="pnp" title="Previous Page"><?php echo get_control_icon('prev');?></a>&nbsp;
				<?for($i=$begin;$i<=$totalPages && $i<=$end;$i++):?>
					<?if($i==$page):?>
					<a href="<?php echo $url?>?page=<?php echo $i?>&<?php echo $querystring?>" class="blockselected" title="Page No: <?php echo $i?>"><?php echo $i?></a>&nbsp;
					<?else:?>
					<a href="<?php echo $url?>?page=<?php echo $i?>&<?php echo $querystring?>" class="<?php echo $LClass;?>" title="Page No: <?php echo $i?>"><?php echo $i?></a>&nbsp;
					<?endif;?>
					
				<?endfor;?>
				<a href="<?php echo $url?>?page=<?php echo $Np?>&<?php echo $querystring?>" class="pnp" title="Next Page"><?php echo get_control_icon('next');?></a>
				</td>
			</tr>
		</table>
		<?
	endif;
}	

function PageControl_front($page,$totalPages,$totalRecords,$url,$querystring='',$type=1,$Class='pad',$tdclass='',$Title='Records',$LClass='cat')
{
	if($type==1):
		?>
		<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" class="<?php echo $Class?>">
			<tr>
				<td class="<?php echo $tdclass?>" width="30%" align="left">Total &nbsp;<?php echo $Title?>:&nbsp;&nbsp;<?php echo $totalRecords?></td>
				<td align="right">Pages:&nbsp;
				<?for($i=1;$i<=$totalPages;$i++):?>
					<?if($i==$page):?>
						<?php echo display_url($i, $url, 'p='.$i.'&'.$querystring,'blockselected');?>
					<?else:?>
						<?php echo display_url($i, $url, 'p='.$i.'&'.$querystring,$LClass);?>
					<?endif;?>
				<?endfor;?>
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
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?php echo $Class?>">
			<tr>
				<td width="30%" class="<?php echo $tdclass?>" align="left">Total&nbsp;<?php echo $Title?> :&nbsp;&nbsp;<?php echo $totalRecords?></td>
				<td width="25%" class="<?php echo $tdclass?>">Total Pages:&nbsp;&nbsp;<?php echo $totalPages?></td>
				<td align="right" >
				<a href="<?php echo '?page='.$url?>&p=<?php echo $Pp?>&<?php echo $querystring?>" class="pnp" title="Previous Page"><?echo"<<"?></a>&nbsp;
				<?
				for($i=$begin;$i<=$totalPages && $i<=$end;$i++):
					if($i==$page):
						echo display_url($i, $url, 'p='.$i.'&'.$querystring,'blockselected'); echo'&nbsp;&nbsp;';
					else:
						echo display_url($i, $url, 'p='.$i.'&'.$querystring,$LClass);echo'&nbsp;&nbsp;';
					endif;					
				endfor;
				?>
				<a href="<?php echo '?page='.$url?>&p=<?php echo $Np?>&<?php echo $querystring?>" class="pnp" title="Next Page"><?echo">>"?></a>
				</td>
			</tr>
		</table>
		<?
	endif;
}	

?>