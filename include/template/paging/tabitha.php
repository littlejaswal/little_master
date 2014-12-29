<span class="paginationResults">(<?=$totalRecords?> Results)</span>
<span class="selector"><a href="<?=make_url($url)?>p=<?=$Pp?>&<?=$querystring?>" title="Previous Page"><?echo"&lt;&lt; Previous Page"?></a>&nbsp;|
	<?
	for($i=$begin;$i<=$totalPages && $i<=$end;$i++):
		if($i==$page):
			echo display_url($i, $url, 'p='.$i.'&'.$querystring,'paginationSelected'); echo'&nbsp;&nbsp;';
		else:
			echo display_url($i, $url, 'p='.$i.'&'.$querystring,$LClass);echo'&nbsp;&nbsp;';
		endif;					
	endfor;
	?>
| <a href="<?=make_url($url)?>p=<?=$Np?>&<?=$querystring?>" class="pnp" title="Next Page"><?echo"Next Page &gt;&gt;"?></a>
</span>
