<h3>Manage Products</h3>
<ul class="nav">
	<?php if($Page=='product'):?>
		<li><a href="<?php echo make_admin_url('product', 'insert', 'insert', 'id='.$id);?>">New Product</a></li>
	<?php elseif($Page=='category'):?>
		<li><a href="<?php echo make_admin_url('category', 'insert', 'insert', 'id='.$id);?>">New Category</a></li>
	<?php endif;?>
	<li class="last"><a href="<?php echo make_admin_url('category', 'list', 'list');?>">Categories</a></li>
	<li><a href="<?php echo make_admin_url('product_search', 'list', 'list');?>">Search Product</a></li>
</ul>

