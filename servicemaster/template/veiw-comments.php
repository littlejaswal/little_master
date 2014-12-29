<div ><div><h2>Comments</h2></div>
<?php 
	$query= new query('comments');
	$query->DisplayAll();
	while($comments=$query->GetObjectFromRecord())
	{
	?>
    <div class="viewcomment" >
    <div ><?php echo $comments->comment;?></div>
	<div class="viewcommentname">--&nbsp;&nbsp;<?php echo $comments->name;?></div>
   
    </div>
    <br />
	<?php 
	}
	?>
 <br />
</div>