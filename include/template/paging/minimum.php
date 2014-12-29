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