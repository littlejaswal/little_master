<?
foreach ($form as $k=>$v):
	echo '<input type="hidden" name="'.$k.'" value="'.$v.'">';
endforeach;
?>