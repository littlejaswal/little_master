
<?
#handle sections here.

display_message(1);?><br/><br/>
<?
switch ($section):
	case 'list':
		?>
		<b>Note:</b> You cannot move the top level category.When you will move the sub-category ,make sure that there will be no products in the destination category otherwise it will hide those products.
		<h2>Move category - Step 1 of 2</h2>
		<form id="category_move" action="<?=make_admin_url('category_move', 'insert', 'insert');?>" method="post" name="category_move">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="center" class="table_head">Select Category to Move</td>
				</tr>
				<tr>
					<td width="100%" align="left" valign="top" >
	                     <div class="laftNav">
	                    	<ul id="menu1" style="list-style:none;">
	                    	 <?php while($cat=$query->GetObjectFromRecord()):?>
		                        <li>
		                        	<li class="product_heading">
						              	&raquo;&nbsp;<?php echo $cat->name;?>
						            </li>
		                           <?php $query1= new query('category');
			                        $query1->Where="where parent_id='$cat->id' and is_active=1";
			                        $query1->DisplayAll();
			                        if(!$query1->GetNumRows()):
		                             	echo '</li>';
			                        endif;
			                         					                
			                        if($query1->GetNumRows()):
				                        echo '<ul style="list-style:none;">';
					                        while($sub_cat=$query1->GetObjectFromRecord()):?>  
					                          <li>
					                          	<font color="#FF7E00"><input type="checkbox" name="move_category[]" value="<?php echo $sub_cat->id;?>" /><?php echo $sub_cat->name?></font>
								              </li>
								              <?php 
								              $query2 = new query('category');
								              $query2->Where="where parent_id='$sub_cat->id' and is_active=1";
			                       			  $query2->DisplayAll();
			                        			if(!$query2->GetNumRows()):
		                							echo '</li>';
			                        			endif;
			                        			if($query2->GetNumRows()):
				                        			echo '<ul style="list-style:none;">';
					                       			while($sub_subcat=$query2->GetObjectFromRecord()):?>  
					                          			<li>
					                          			  <font color="#41A9AF"><input type="checkbox" name="move_category[]" value="<?php echo $sub_subcat->id;?>" /><?php echo $sub_subcat->name?></font>
								              			</li>
								              		<?php endwhile;
				                  					echo '</ul>';
				                  				endif;
					                  	 endwhile;
				                  		echo '</ul>';
			                  		endif;?>                   
		 
	                  			<?php endwhile;?>
	                    	</ul>
	                	</div>
	            	</td>
				</tr>
				<tr>
					<td width="30%" ></td>
					<td width="5%"><input type="submit" name="submit" value="Next Step" tabindex="9" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'insert':
		?>
		<h2>Move category - Step 2 of 2</h2>
		<form id="category_move" action="<?=make_admin_url('category_move', 'insert', 'insert');?>" method="post" name="category_move">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="center" class="table_head">Category to Move</td>
				</tr>
				<tr>
					<td width="100%" align="left" valign="top" >
					  <?php   	
					  foreach ($_POST['move_category'] as $key=>$value):
					  	$query = new query('category');
						$query->Where="where id=$value";
						$category=$query->DisplayOne();
						echo $category->name;?></br>
					 <?php endforeach;?>        
	            	</td>
				</tr>
				<tr>
					<td colspan="2" align="center" class="table_head">Select Destination Category to Move Category</td>
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
				                             <?php 
								              $query2 = new query('category');
								              $query2->Where="where parent_id='$sub_cat->id' and is_active=1";
			                       			  $query2->DisplayAll();
			                        			if(!$query2->GetNumRows()):
		                							echo '</li>';
			                        			endif;
			                        			if($query2->GetNumRows()):
				                        			echo '<ul style="list-style:none;">';
					                       			while($sub_subcat=$query2->GetObjectFromRecord()):?>  
					                          			<li><input type="radio" name="move_to" value="<?php echo $sub_subcat->id;?>" />
				                             			<font color="#41A9AF"><?php echo $sub_subcat->name?></font>
				                             			</li>
								              		<?php endwhile;
				                  					echo '</ul>';
				                  				endif;
				                    endwhile;
			                  		echo '</ul>';
		                  		endif;?>      
		                  		
		                		<?php endwhile;?>
		                    	</ul>
	                    	</div>
	            	</td>
				</tr>
				<tr>
					<?php  foreach ($_POST['move_category'] as $key=>$value):?>
						<td><input type="hidden" name="cat_id[]" value="<?php echo $value?>" /></td>
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