<?
	function PageControl($page,$totalPages,$totalRecords,$url,$querystring='',$type=1,$Class='pad',$tdclass='',$Title='Records',$LClass='cat')
{
	if($type==1):
		?>
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?=$Class?>">
			<tr>
				<td class="<?=$tdclass?>" width="30%" align="left">Total&nbsp;<?=$Title?>:&nbsp;&nbsp;<?=$totalRecords?></td>
				<td align="right" >Pages:&nbsp;&nbsp;
				<?for($i=1;$i<=$totalPages;$i++):?>
					<?if($i==$page):?>
						<a href="<?=$url?>?page=<?=$i?>&<?=$querystring?>" class="blockselected" title="Page No: <?=$i?>"><?=$i?></a>&nbsp;
					<?else:?>
						<a href="<?=$url?>?page=<?=$i?>&<?=$querystring?>" class="<?=$LClass;?>" title="Page No: <?=$i?>"><?=$i?></a>&nbsp;
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
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?=$Class?>">
			<tr>
				<td width="30%" class="<?=$tdclass?>" align="left">Total&nbsp;<?=$Title?> :&nbsp;&nbsp;<?=$totalRecords?></td>
				<td width="25%" class="<?=$tdclass?>">Total Pages:&nbsp;&nbsp;<?=$totalPages?></td>
				<td align="right" >
				<a href="<?=$url?>?page=<?=$Pp?>&<?=$querystring?>" class="pnp" title="Previous Page"><?php echo get_control_icon('prev');?></a>&nbsp;
				<?for($i=$begin;$i<=$totalPages && $i<=$end;$i++):?>
					<?if($i==$page):?>
					<a href="<?=$url?>?page=<?=$i?>&<?=$querystring?>" class="blockselected" title="Page No: <?=$i?>"><?=$i?></a>&nbsp;
					<?else:?>
					<a href="<?=$url?>?page=<?=$i?>&<?=$querystring?>" class="<?=$LClass;?>" title="Page No: <?=$i?>"><?=$i?></a>&nbsp;
					<?endif;?>
					
				<?endfor;?>
				<a href="<?=$url?>?page=<?=$Np?>&<?=$querystring?>" class="pnp" title="Next Page"><?php echo get_control_icon('next');?></a>
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
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?=$Class?>">
			<tr>
				<td class="<?=$tdclass?>" width="30%" align="left">Total&nbsp;<?=$Title?>:&nbsp;&nbsp;<?=$totalRecords?></td>
				<td align="right" >Pages:&nbsp;&nbsp;
				<?for($i=1;$i<=$totalPages;$i++):?>
					<?if($i==$page):?>
						<?=display_url($i, $url, 'p='.$i.'&'.$querystring,'blockselected');?>
					<?else:?>
						<?=display_url($i, $url, 'p='.$i.'&'.$querystring,$LClass);?>
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
		<table width="100%" cellspacing="1" cellpadding="2" align="center" class="<?=$Class?>">
			<tr>
				<td width="30%" class="<?=$tdclass?>" align="left">Total&nbsp;<?=$Title?> :&nbsp;&nbsp;<?=$totalRecords?></td>
				<td width="25%" class="<?=$tdclass?>">Total Pages:&nbsp;&nbsp;<?=$totalPages?></td>
				<td align="right" >
				<a href="<?=make_url($url)?>p=<?=$Pp?>&<?=$querystring?>" class="pnp" title="Previous Page"><?echo"<<"?></a>&nbsp;
				<?
				for($i=$begin;$i<=$totalPages && $i<=$end;$i++):
					if($i==$page):
						echo display_url($i, $url, 'p='.$i.'&'.$querystring,'blockselected'); echo'&nbsp;&nbsp;';
					else:
						echo display_url($i, $url, 'p='.$i.'&'.$querystring,$LClass);echo'&nbsp;&nbsp;';
					endif;					
				endfor;
				?>
				<a href="<?=make_url($url)?>p=<?=$Np?>&<?=$querystring?>" class="pnp" title="Next Page"><?echo">>"?></a>
				</td>
			</tr>
		</table>
		<?
	endif;
}	

?>