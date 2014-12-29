
<?
#handle sections here.

display_message(1);
switch ($section):
	case 'list':
		?>
		<h2>Move product - Step 1 of 2</h2>
		<form id="product_move" action="<?=make_admin_url('product_move', 'insert', 'insert');?>" method="post" name="product_move">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="center" class="table_head">Select Product to Move</td>
				</tr>
				<tr>
					<td width="100%" align="left" valign="top" >
	                     <div class="laftNav">
	                    	<ul id="menu1" style="list-style:none;">
	                    	 <?php while($cat=$query->GetObjectFromRecord()):?>
		                        <li>
		                        <b><?php echo $cat->name;?></b>
			                        <?php $query1= new query('category');
			                        $query1->Where="where parent_id='$cat->id' and is_active=1";
			                        $query1->DisplayAll();
			                        if(!$query1->GetNumRows()):
		                    	        $query2= new query('product');
				                        $query2->Where="where parent_id='$cat->id'";
				                        $query2->DisplayAll();
				                        if(!$query2->GetNumRows()):
				                        	echo '</li>';
				                        endif;
				                        
				                        if($query2->GetNumRows()):
					                        echo '<ul style="list-style:none;">';
						                        while($pro=$query2->GetObjectFromRecord()):?>  
						                             <li class="product_heading">
						                             	<input type="checkbox" name="move_product[]" value="<?php echo $pro->id;?>"/><?php echo $pro->name?>
						                             </li>
						                  <?php endwhile;
					                  		echo '</ul>';
				                  		endif;
						                  		
			                        	echo '</li>';
			                        endif;
	                        
			                        if($query1->GetNumRows()):
				                        echo '<ul style="list-style:none;">';
					                        while($sub_cat=$query1->GetObjectFromRecord()):?>  
					                             <li><font color="#FF7E00"><b><?php echo $sub_cat->name?></b></font>
								                <?php 
						                        $query2= new query('product');
						                        $query2->Where="where parent_id='$sub_cat->id'";
						                        $query2->DisplayAll();
						                        if(!$query2->GetNumRows()):
						                        	echo '</li>';
						                        endif;
						                        
						                        if($query2->GetNumRows()):
							                        echo '<ul style="list-style:none;">';
								                        while($pro=$query2->GetObjectFromRecord()):?>  
								                             <li class="product_heading">
								                             <input type="checkbox" name="move_product[]" value="<?php echo $pro->id;?>" /><?php echo $pro->name?>
								                             </li>
								                  <?php endwhile;
							                  		echo '</ul>';
						                  		endif;?>
					                             <!--</li>-->
					                  <?php endwhile;
				                  		echo '</ul>';
			                  		endif;?>      
	                  			<?php endwhile;?>
	                    	</ul>
	                	</div>
	            	</td>
				</tr>
				<tr>
					<td width="30%" ></td>
					<td width="5%"><input type="submit" name="submit" value="Submit" tabindex="9" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'insert':
		?>
		<h2>Move product - Step 2 of 2</h2>
		<form id="product_move" action="<?=make_admin_url('product_move', 'insert', 'insert');?>" method="post" name="product_move">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="center" class="table_head">Products to Move</td>
				</tr>
				<tr>
					<td width="100%" align="left" valign="top" >
					  <?php   	
					  foreach ($_POST['move_product'] as $key=>$value):
					  	$query = new query('product');
						$query->Where="where id=$value";
						$product=$query->DisplayOne();
						
					  	$query1 = new query('category');
					  	$query1->Where="where id=$product->parent_id";
					  	$query1->DisplayAll();
					  		while($cat_details= $query1->GetObjectFromRecord()):
						  		if($cat_details->parent_id == '0'): 
							  		echo $cat_details->name;?> => <?php echo $product->name;?><br/>
							  	<?php else:
							  		$query2 = new query('category');
							  		$query2->Where="where id =$cat_details->parent_id";
							  		$cat_name=$query2->DisplayOne();		
							  		echo $cat_name->name;?> => <?php echo $cat_details->name;?> => <?php echo $product->name;?><br/>
						  		<?php endif;
					  		endwhile;	
					  endforeach;?>        
	            	</td>
				</tr>
				<tr>
					<td colspan="2" align="center" class="table_head">Select Destination Category to Move Product</td>
				</tr>
				<tr>
					<td width="100%" align="left" valign="top" >
	                     <div class="laftNav">
	                    	<ul id="menu" style="list-style:none;">
	                    	<?php 
	                          while($cat=$queryObj1->GetObjectFromRecord()):                       
	                        ?>
	                        <li class="leftNav">
	                         <input type="radio" name="move_to" value="<?php echo $cat->id;?>" /><?php echo $cat->name?>
	                         <?php 
		                        $query1= new query('category');
		                        $query1->Where="where parent_id='$cat->id' and is_active=1";
		                        $query1->DisplayAll();
		                        if(!$query1->GetNumRows()):
		                        	echo '</li>';
		                        endif;
		                        
		                        if($query1->GetNumRows()):
			                        echo '<ul style="list-style:none;">';
				                        while($sub_cat=$query1->GetObjectFromRecord()):?>  
				                             <li><input type="radio" name="move_to" value="<?php echo $sub_cat->id;?>" />
				                             <font color="#FF7E00"><?php echo $sub_cat->name?></font>
				                             </li>
				                  <?php endwhile;
			                  		echo '</ul>';
		                  		endif;?>      
		                  		
		                		<?php endwhile;?>
		                    	</ul>
	                    	</div>
	            	</td>
				</tr>
				<tr>
					<?php  foreach ($_POST['move_product'] as $key=>$value):?>
						<td><input type="hidden" name="pid[]" value="<?php echo $value?>" /></td>
					<?php endforeach;?>	
					<td width="5%"><input type="submit" name="move" value="Submit" tabindex="9" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'update':
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>