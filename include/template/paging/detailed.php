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