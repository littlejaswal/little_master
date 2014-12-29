<script src="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/js/popup.js"></script>
<script>
$("document").ready(function(){
	<?php $val=(isset($product->file_type) && $product->file_type!='')?$product->file_type:'upload';?>	
	$("#upload").hide();
	$("#url").hide();
	val='<?php echo $val;?>';
	$('#'+val).show();
	$("#file_type").change(function(){
		var val;
		$("#upload").hide();
		$("#url").hide();
		val=$("#file_type").val();
		$('#'+val).show();
	});
});
</script>
<?
#handle sections here.

display_message(1);
switch ($section):
	case 'list':
		#html code here.
		?>
		<form action="<?=make_admin_url('product', 'list_ops', 'list', 'id='.$id)?>" method="post">
		<table width="100%" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="table">
			<tr >
				<td colspan="5"  align="left"><?=make_admin_link(make_admin_url('category', 'list', 'list', 'id='.$cate->parent_id), $cate->name)?>&nbsp;::&nbsp;Products</td>
				<td colspan="4"  align="right">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="9"  style="border-top:solid 1px #dcdcdc;" align="left"><?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=product&id='.$id, 2);?></td>
			</tr>
		</table>
		<br/>
		<table width="100%" cellspacing="1" cellpadding="3" style="border:solid 1px #dcdcdc;" class="table">
			<tr>
				<td width="18%" class="table_head" align="left">Name</td>
				<td width="13%" class="table_head" align="center">Stock</td>
				<td width="8%" class="table_head" align="center">Position</td>
				<td width="13%" class="table_head" align="center">Price</td>
				<td width="13%" class="table_head" align="center">Active</td>
				<td width="11%" class="table_head" align="center">Operations</td>
				<td width="6%" colspan="2" align="center" class="table_head">Controls</td>
			</tr>
		</table><br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" id="zebra" class="table">
			<?$sr=1;while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr id="<?php $QueryObj1->id?>">
				<td width="20%" align="left"><?=$QueryObj1->name;?></td>
			  <td width="10%" align="center"><input type="text" name="stock[<?php echo $QueryObj1->id?>]" value="<?php echo $QueryObj1->stock;?>" size="3"></td>
		      <td width="9%" align="center"><input type="text" name="position[<?php echo $QueryObj1->id?>]" value="<?php echo $QueryObj1->position;?>" size="3"></td>
				<td width="12%" align="center"><?=number_format($QueryObj1->price,2);?></td>
				<td width="16%" align="center" style="padding-left:5px;">
					<label id="<?=$QueryObj1->id?>a"><input type="radio" name="status[<?=$QueryObj1->id?>]" value="1" <?=($QueryObj1->is_active==1)?'checked':'';?>>Y</label>&nbsp;&nbsp;
					<label id="<?=$QueryObj1->id?>d"><input type="radio" name="status[<?=$QueryObj1->id?>]" value="0" <?=($QueryObj1->is_active==0)?'checked':'';?>>N</label>
			  </td>
				<td width="9%" align="center"><?=make_admin_link(make_admin_url('product', 'more_op', 'more_op', 'id='.$QueryObj1->id), get_control_icon('zoom'));;?></td>
				<td width="12%" align="center"><?=make_admin_link(make_admin_url('product', 'update', 'update', 'id='.$id.'&pro_id='.$QueryObj1->id), get_control_icon('edit'));;?></td>
				<td width="6%" align="center"><?=make_admin_link(make_admin_url('product', 'delete', 'list', 'id='.$id.'&pro_id='.$QueryObj1->id), get_control_icon('cancel'));?></td>
			</tr>
			<?endwhile;?>
			<tr>
				<td colspan="2"  style="border-top:solid 1px #dcdcdc;">&nbsp;</td>
				<td  align="center" style="border-top:solid 1px #dcdcdc;"><input type="submit" name="stock_update" value="Update"></td>
				<td  align="center" style="border-top:solid 1px #dcdcdc;"><input type="submit" name="position_update" value="Update"></td>
				<td  align="center" style="border-top:solid 1px #dcdcdc;">&nbsp;</td>
				<td  align="center" style="border-top:solid 1px #dcdcdc;"><input type="submit" name="status_update" value="Update"></td>
				<td colspan="3"  style="border-top:solid 1px #dcdcdc;">&nbsp;</td>
			</tr>
		</table>
		</form>
		<?
		break;
	case 'insert':
		#html code here.
		?>
		<h2>Add new product - Step 1 of 2</h2>
		<form id="new_product" action="<?=make_admin_url('product', 'insert', 'list', 'id='.$id);?>" method="post" name="new_product" enctype="multipart/formdata">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="align-left">
				<tr>
					<td colspan="2" ><?=make_admin_link(make_admin_url('product', 'list', 'list', 'id='.$id), 'Back to prodcut listing')?></td>
				</tr>
				<tr>
					<td colspan="2" align="center" class="table_head">Add New Product</td>
				</tr>
				<tr>
					<td width="30%" >Name</td>
					<td width="5%"><input type="text" name="name" size="60" tabindex="1" /></td>
				</tr>
				<tr>
					<td width="30%" >URL Name</td>
					<td width="5%"><input type="text" name="urlname" size="60" tabindex="2" /></td>
				</tr>
				<tr>
					<td width="30%" >Price</td>
					<td width="5%"><input type="text" name="price" size="15" tabindex="3" /></td>
				</tr>
				<tr>
					<td width="30%" >Stock</td>
					<td width="5%"><input type="text" name="stock" size="15" tabindex="4" /></td>
				</tr>
				<tr>
					<td width="30%" >Override product stock by attribute stock</td>
					<td width="5%"><input type="checkbox" name="is_stock" value="1" tabindex="7" /></td>
				</tr>
				<tr>
					<td width="30%" >Position</td>
					<td width="5%"><input type="text" name="position" size="15" tabindex="5" /></td>
				</tr>
				<!--<tr>
					<td width="30%" >Status</td>
					<td width="5%"><input type="checkbox" name="is_active" value="1" tabindex="5" /></td>
				</tr>-->
				<tr>
					<td width="30%" >Override product price by attribute price</td>
					<td width="5%"><input type="checkbox" name="is_override" value="1" tabindex="6" /></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Description</td>
					<td width="5%">
					<?
						$oFCKeditor = new FCKeditor('description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->ToolbarSet	= 'Basic';
						$oFCKeditor->Height		=200;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td width="30%" >Product type</td>
					<td width="5%">
						<select name="product_type">
							<option value="file">Downloadable</option>
							<option value="product" selected="selected">Non-Downloadable</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%" >File type</td>
					<td width="5%">
						<select name="file_type" id="file_type">
							<option value="upload" selected="selected">Upload File</option>
							<option value="url" >Enter URL</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%" >File</td>
					<td width="5%">
						<input type="file" name="product_file" size="30" id="upload" />
						<input type="text" name="product_file" size="50" id="url" />
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2" class="table_head"> <b>Please enter the following information for SEO on your website.</b></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Page Title</td>
					<td width="5%"><input name="meta_title" value="" type="text" size="53"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Page Keywords</td>
					<td width="5%"><input name="meta_keyword" value="" type="text" size="53"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Meta Description</td>
					<td width="5%"><textarea name="meta_desc" rows="4" cols="40" tabindex="8"></textarea></td>
				</tr>
				<tr>
					<td width="30%" ></td>
					<td width="5%"><input type="submit" name="new_product" value="Submit" tabindex="9" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
		case 'insert2':
		?>
		<h2>Add new product - Step 2 of 2</h2>
		<div align="right">
		<?if($product->is_active):?>
			<a href="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'&event=activate&make_active=no');?>" class="makelink">Deactivate Product</a>
		<?else:?>
			<a href="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'&event=activate&make_active=yes');?>" class="makelink">Activate Product</a>
		<?endif;?>
		</div>
		<!-- FOR RELATED PRODUCTS CODE-->
		<?php if(USE_RELATED_PRODUCT):?>
		<form action="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id)?>" method="POST">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table align-left">
			<tr>
				<td class="table_head_title" colspan="2">Related Products</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php echo product_drop_down($product_list, 'rp_id[]', $selected_r_pro);?>
				</td>
			</tr>
			<tr>
				<td align="left"><input type="submit" name="related_product" value="Submit" style="width:100px;"></td>
				<td align="left"  style="padding-right:200px;"><input type="submit" name="delete_related_product" value="Clear All"  style="width:100px;"></td>
			</tr>
		</table>
		</form><br/>
		<?endif;?>

		<!-- PRODUCT ATTRIBUTE CODE-->
		<?if(USE_PRODUCT_ATTRIBUTE):?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table align-left"  style="border:solid 1px #dcdcdc;">
			<tr>
				<td class="table_head_title"><span id="attributes">Manage Attributes</span></td>
			</tr>
			<tr>
			  <td>Here you can create drop down menus to appear as additional options for your customers to select when purchasing this product. For example different sizes and colours. To begin with please create the "Attribute Name" (for example size, colour). Once the attribute name has been added (or if it already exists) click on the word "Values" to move to the next step.</td>
		  	</tr>
		  	<tr>
		  		<td align="right"><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&add_attribute=1')?>">Add new Attribute</a></td>
		  	</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
						<tr>
							<td width="5%" class="table_head">Sr.</td>
							<td width="25%" class="table_head">Name</td>
							<td align="center" width="15%" class="table_head">Is Paid</td>
							<td align="center" width="15%" class="table_head">Values</td>
							<td align="center" width="15%" class="table_head">Edit</td>
							<td align="center" class="table_head">Delete</td>
						</tr>
					 </table>
					<?php
					$a_sr=1;
					while($att_object= $attribute->GetObjectFromRecord()):
						if($att_id==$att_object->id && $att_edit):
						?>
						<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
							 <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
								<tr>
									<td width="5%" align="center">&nbsp;</td>
									<td width="25%" align="left"><input type="text" name="name" value="<?php echo $att_object->name;?>" size="32"></td>
									<td width="15%" align="center"><input type="checkbox" name="is_paid" value="1" <?php echo ($att_object->is_paid)?'checked':'';?>></td>
									<td width="15%" align="center"> - </td>
									<td width="15%" align="center"> - </td>
									<td align="center">
									<input type="hidden" name="product_id" value="<?php echo $id?>">
									<input type="hidden" name="id" value="<?php echo $att_object->id?>">
									<input type="submit" name="edit_attribute" value="Done"></td>
								</tr>
							</table>
							</form>
						<?else:?>
							<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
								<tr>
									<td width="5%" align="center"><?php echo $a_sr++;?>.</td>
									<td width="25%" align="left"><?php echo ucfirst($att_object->name);?></td>
									<td width="15%" align="center"><?php echo ($att_object->is_paid)?'Paid':'FREE';?></td>
									<td width="15%" align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_value=1&id='.$id.'#attributes').'">Values</a>';?></td>
									<td width="15%" align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_edit=1&id='.$id.'#attributes').'">Edit</a>';?></td>
									<td align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_delete=1&id='.$id.'#attributes').'">Delete</a>';?></td>
								</tr>
							</table>
						<?endif;?>
					<?endwhile;?>
					<?php if(isset($_GET['add_attribute']) &&  $_GET['add_attribute']==1):?>
					<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
					 <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
						<tr>
							<td colspan="5" class="	table_head" style="padding-left:10px;">Add New Attribute</td>
						</tr>
					 	<tr>
							<td width="5%" align="center">Name</td>
							<td width="25%" align="left"><input type="text" name="name" value="" size="32"></td>
						</tr>
						<tr>
							<td width="5%" align="center">Is Paid</td>
							<td width="25%" align="left"><input type="checkbox" name="is_paid" value="1"></td>
						</tr>
						<tr>
							<td colspan="2" style="padding-left:150px;">
							<input type="hidden" name="product_id" value="<?php echo $id?>">
							<input type="submit" name="new_attribute" value="Done"></td>
						</tr>
					</table>
					</form>
					<?php endif;?>
					<?php if($att_value):?>
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" class="table">
						<tr>
							<td colspan="4"><?php echo $att_detail->name;?> &gt;&gt; Values</td>
							<td align="right"><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_detail->id.'&id='.$id.'&att_value=1'.'&add_value=1'.'#attributes')?>">Add New Value</a></td>
						</tr>
						<tr>
							<td width="5%" class="table_head">Sr.</td>
							<td width="30%" class="table_head">Value</td>
							<td width="20%" class="table_head">Stock</td>
							<td width="20%" class="table_head">Price</td>
							<td class="table_head">Controls</td>
						</tr>
						<?php
						$sr=1;
						while($obj= $attribute_values->GetObjectFromRecord()):?>
						<tr>
							<td><?php echo $sr++;?></td>
							<td><?php echo $obj->name;?></td>
							<td><?php echo $obj->stock;?></td>
							<td><?php echo $obj->price;?></td>
							<td><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_id='.$att_detail->id.'&delete_att_val=1&att_val_id='.$obj->id.'#attributes')?>">Delete</a> </td>
						</tr>
						<?php endwhile;?>
					</table>
					<p style="clear:both;"></p>
					<?php if(isset($_GET['add_value']) &&  $_GET['add_value']==1):?>
					<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_value=1&att_id='.$att_detail->id)?>" method="POST">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="right">
						<tr>
							<td colspan="5" class="	table_head" style="padding-left:10px;">Add New Value</td>
						</tr>
						<tr>
							<td width="10%">Name</td>
						  <td width="90%" align="left"><input type="text" name="name" size="25" tabindex="1"/></td>
						</tr>
						<tr>
							<td width="10%">Stock</td>
						  <td width="90%" align="left"><input type="text" name="stock" size="5" tabindex="2" /></td>
						</tr>
						<tr>
							<td width="10%">Price</td>
						  <td width="90%" align="left"><input type="text" name="price" size="5" tabindex="3" /></td>
						</tr>
						<tr>
							<td colspan="2" style="padding-left:70px;"><input type="hidden" name="attribute_id" value="<?php echo $att_id?>">
							<input type="submit" name="attribute_value" value="Done" tabindex="6" /></td>
						</tr>
					</table>
					</form>
					<?php endif;?>
					<?php 
					endif;?>

				</td>
			</tr>
			</table>
			<?endif;?>
	
			<!-- PRODUUCT IMAGES CODE -->
			<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table align-left">
			<tr>
				<td class="table_head"><span id="images">Images</span></td>
			</tr>
			<tr>
				<td>
				    <form action="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id)?>" method="post">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
	 				    <tr>
							<td width="20%" class="table_head">Thumbnail</td>
							<td width="29%" class="table_head" align="center">Main Image</td>
							<td width="37%" class="table_head" align="center">Position</td>
							<td width="14%" class="table_head">Controls</td>
						</tr>
						<?while($img = $pimages->GetObjectFromRecord()):?>
						<tr>
							<td width="20%"><img src="<?php get_thumb('product', $img->image);?>"></td>
							<td width="31%" align="center"><input type="radio" name="main_image[i]" value="<?php echo $img->id?>" <?=($img->main_image==1)?'checked':'';?>>
							<td width="37%" align="center"><input type="text" name="position[<?php echo $img->id?>]"  value="<?php echo $img->position?>"size="3"></td>
							<td><a href="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'&delete_image=1&delete='.$img->id)?>">Delete</a></td>
						</tr>
						<?php endwhile;?>
						<tr>
							<td width="20%" class="table_head">&nbsp;</td>
							<td width="29%" class="table_head" align="center"><input name="image_update" value="Update" type="submit"></td>
							<td width="37%" class="table_head" align="center"><input name="image_position" value="Update" type="submit"></td>
							<td class="table_head">&nbsp;</td>
						</tr>
					</table>
					</form>

					<form id="images" action="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id)?>" method="post" name="images" enctype="multipart/form-data">
						<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
							<tr>
								<td width="30%"></td>
								<td width="50%"><input type="file" name="image" size="52" /></td>
								<td><input type="submit" name="image_upload" value="Upload" size="52" /></td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<br />
			<form id="images" action="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id)?>" method="post" name="images">
				<table class="table" style="border: 1px solid rgb(204, 204, 204);" width="100%" align="center" border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td class="table_head_title">The Final Step</td>
							</tr>
							<tr>
							  <td colspan="2"><table width="100%" border="0" cellpadding="5" cellspacing="0">
							    <tbody><tr>
							      <td style="border-right:solid 1px #dcdcdc;">Click below to view a preview of the product</td>
							      <td>Click below to confirm and apply all changes you have made.</td>
						        </tr>
							    <tr>

							      <td style="border-right:solid 1px #dcdcdc;"><a href="javascript:popUp('<?php echo make_url('product_preview','id='.$id)?>')"><img src="image/preview.jpg" width="50" border="0" height="19"></a></td>
							      <td><a href="<?php echo make_admin_url('product', 'list', 'list', 'id='.$product->parent_id);?>"><img src="image/iamdone.jpg" width="65" border="0" height="19"></a></td>
						        </tr>
						      </tbody></table></td>
						  </tr>
						</table>
					</form>
			<p>&nbsp;</p>
		<?
		break;
		case 'update':
		#html code here.
		?>
		<form id="new_product" action="<?=make_admin_url('product', 'update', 'list', 'id='.$id);?>" method="post" name="new_product" enctype="multipart/formdata">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="align-left">
				<tr>
					<td colspan="2" ><?=make_admin_link(make_admin_url('product', 'list', 'list', 'id='.$id), 'Back to prodcut listing')?></td>
				</tr>
				<tr>
					<td colspan="2" align="center" class="table_head">Update Product</td>
				</tr>
				<tr>
					<td width="30%" >Name</td>
					<td width="5%"><input type="text" name="name" size="24" tabindex="1" value="<?=$product->name?>" /></td>
				</tr>
				<tr>
					<td width="30%" >URL Name</td>
					<td width="5%"><input type="text" name="urlname" size="60" tabindex="2" value="<?=$product->urlname?>"/></td>
				</tr>
				<tr>
					<td width="30%" >Price</td>
					<td width="5%"><input type="text" name="price" size="15" tabindex="2" value="<?=$product->price?>"/></td>
				</tr>
				<tr>
					<td width="30%" >Stock</td>
					<td width="5%"><input type="text" name="stock" size="15" tabindex="3" value="<?=$product->stock?>"/></td>
				</tr>
				<tr>
					<td width="30%" >Override product stock by attribute stock</td>
					<td width="5%"><input type="checkbox" name="is_stock" value="1" tabindex="7" <?=($product->is_stock)?'checked':''?>/></td>
				</tr>
				<tr>
					<td width="30%" >Position</td>
					<td width="5%"><input type="text" name="position" size="15" tabindex="4" value="<?=$product->position?>" /></td>
				</tr>
				<tr>
					<td width="30%" >Status</td>
					<td width="5%"><input type="checkbox" name="is_active" value="1" tabindex="5"  <?=($product->is_active)?'checked':''?>/></td>
				</tr>
				<tr>
					<td width="30%" >Override product price by attribute price</td>
					<td width="5%"><input type="checkbox" name="is_override" value="1" tabindex="6" <?=($product->is_override)?'checked':''?>/></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Description</td>
					<td width="5%">
					<?
						$oFCKeditor = new FCKeditor('description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($product->description);
						$oFCKeditor->ToolbarSet	= 'Basic';
						$oFCKeditor->Height		=200;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td width="30%" >Product type</td>
					<td width="5%">
						<select name="product_type">
							<option value="file" <?php echo ($product->product_type=='file')?'selected':'';?>>Downloadable</option>
							<option value="product" <?php echo ($product->product_type=='product')?'selected':'';?>>Non-Downloadable</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%" >File type</td>
					<td width="5%">
						<select name="file_type" id="file_type">
							<option value="upload" <?php echo ($product->file_type=='upload')?'selected':'';?>>Upload File</option>
							<option value="url"  <?php echo ($product->file_type=='url')?'selected':'';?>>Enter URL</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%" >File</td>
					<td width="5%">
						<input type="text" name="product_file" size="50" id="url" />
						<input type="file" name="product_file" size="30" id="upload" />
						<br/>
						Already uploaded file:  
						(
						<?php 
						if($product->file_type=='upload' or $product->file_type==''):
							echo $product->product_file!=''?'<a href="'.DIR_WS_SITE.'upload/file/product/'.$product->product_file.'">'.$product->product_file.'</a>':'File Not Uploaded';
						elseif($product->file_type=='url'):
							echo $product->product_file!=''?'<a href="'.$product->product_file.'">'.$product->product_file.'</a>':'File Not Uploaded';							
						endif;
						?>
						)
					</td>
				</tr>
				
				
				<tr>
					<td valign="top" colspan="2" class="table_head"> <b>Please enter the following information for SEO on your website.</b></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Page Title</td>
					<td width="5%"><input name="meta_title" value="<?=$product->meta_title;?>" type="text" size="53"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Page Keywords</td>
					<td width="5%"><input name="meta_keyword" value="<?=$product->meta_keyword;?>" type="text" size="53"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%" >Meta Description</td>
					<td width="5%"><textarea name="meta_desc" rows="4" cols="40" tabindex="8"><?=$product->meta_desc;?></textarea></td>
				</tr>
				<input type="hidden" name="id" value="<?=$product->id?>">
				<tr>
					<td width="30%" ></td>
					<td width="5%"><input type="submit" name="update_product" value="Submit" tabindex="9" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'delete':
		#html code here.
		break;
	case 'more_op':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" class="align-left">
				<tr>
					<td colspan="2" ><?=make_admin_link(make_admin_url('product', 'list', 'list', 'id='.$product->parent_id), 'Back to prodcut listing')?></td>
				</tr>
				<tr>
					<td colspan="2" align="left" class="table_head">Product Operations</td>
				</tr>
		</table>
		<!-- FOR RELATED PRODUCTS CODE-->
		<?php if(USE_RELATED_PRODUCT):?>
		<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
			<tr>
				<td class="table_head_title" colspan="2">Related Products</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php echo product_drop_down($product_list, 'rp_id[]', $selected_r_pro);?>
				</td>
			</tr>
			<tr>
				<td align="left"><input type="submit" name="related_product" value="Submit" style="width:100px;"></td>
				<td align="left"  style="padding-right:200px;"><input type="submit" name="delete_related_product" value="Clear All"  style="width:100px;"></td>
			</tr>
		</table>
		</form><br/>
		<?endif;?>

		<!-- PRODUCT ATTRIBUTE CODE-->
		<?if(USE_PRODUCT_ATTRIBUTE):?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td class="table_head_title"><span id="attributes">Manage Attributes</span></td>
			</tr>
			<tr>
			  <td>Here you can create drop down menus to appear as additional options for your customers to select when purchasing this product. For example different sizes and colours. To begin with please create the "Attribute Name" (for example size, colour). Once the attribute name has been added (or if it already exists) click on the word "Values" to move to the next step.</td>
		  	</tr>
		  	<tr>
		  		<td align="right"><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&add_attribute=1')?>">Add new Attribute</a></td>
		  	</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
						<tr>
							<td width="5%" class="table_head">Sr.</td>
							<td width="25%" class="table_head">Name</td>
							<td align="center" width="15%" class="table_head">Is Paid</td>
							<td align="center" width="15%" class="table_head">Values</td>
							<td align="center" width="15%" class="table_head">Edit</td>
							<td align="center" class="table_head">Delete</td>
						</tr>
					 </table>
					<?php
					$a_sr=1;
					while($att_object= $attribute->GetObjectFromRecord()):
						if($att_id==$att_object->id && $att_edit):
						?>
						<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
							 <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
								<tr>
									<td width="5%" align="center">&nbsp;</td>
									<td width="25%" align="left"><input type="text" name="name" value="<?php echo $att_object->name;?>" size="32"></td>
									<td width="15%" align="center"><input type="checkbox" name="is_paid" value="1" <?php echo ($att_object->is_paid)?'checked':'';?>></td>
									<td width="15%" align="center"> - </td>
									<td width="15%" align="center"> - </td>
									<td align="center">
									<input type="hidden" name="product_id" value="<?php echo $id?>">
									<input type="hidden" name="id" value="<?php echo $att_object->id?>">
									<input type="submit" name="edit_attribute" value="Done"></td>
								</tr>
							</table>
							</form>
						<?else:?>
							<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
								<tr>
									<td width="5%" align="center"><?php echo $a_sr++;?>.</td>
									<td width="25%" align="left"><?php echo ucfirst($att_object->name);?></td>
									<td width="15%" align="center"><?php echo ($att_object->is_paid)?'Paid':'FREE';?></td>
									<td width="15%" align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_value=1&id='.$id.'#attributes').'">Values</a>';?></td>
									<td width="15%" align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_edit=1&id='.$id.'#attributes').'">Edit</a>';?></td>
									<td align="center"><?php echo '<a href="'.make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_object->id.'&att_delete=1&id='.$id.'#attributes').'">Delete</a>';?></td>
								</tr>
							</table>
						<?endif;?>
					<?endwhile;?>
					<?php if(isset($_GET['add_attribute']) &&  $_GET['add_attribute']==1):?>
					<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="POST">
					 <table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" id="zebra">
						<tr>
							<td colspan="5" class="	table_head" style="padding-left:10px;">Add New Attribute</td>
						</tr>
					 	<tr>
							<td width="5%" align="center">Name</td>
							<td width="25%" align="left"><input type="text" name="name" value="" size="32"></td>
						</tr>
						<tr>
							<td width="5%" align="center">Is Paid</td>
							<td width="25%" align="left"><input type="checkbox" name="is_paid" value="1"></td>
						</tr>
						<tr>
							<td colspan="2" style="padding-left:150px;">
							<input type="hidden" name="product_id" value="<?php echo $id?>">
							<input type="submit" name="new_attribute" value="Done"></td>
						</tr>
					</table>
					</form>
					<?php endif;?>
					<?php if($att_value):?>
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" class="table">
						<tr>
							<td colspan="4"><?php echo $att_detail->name;?> &gt;&gt; Values</td>
							<td align="right"><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'att_id='.$att_detail->id.'&id='.$id.'&att_value=1'.'&add_value=1'.'#attributes')?>">Add New Value</a></td>
						</tr>
						<tr>
							<td width="5%" class="table_head">Sr.</td>
							<td width="30%" class="table_head">Value</td>
							<td width="20%" class="table_head">Stock</td>
							<td width="20%" class="table_head">Price</td>
							<td class="table_head">Controls</td>
						</tr>
						<?php
						$sr=1;
						while($obj= $attribute_values->GetObjectFromRecord()):?>
						<tr>
							<td><?php echo $sr++;?></td>
							<td><?php echo $obj->name;?></td>
							<td><?php echo $obj->stock;?></td>
							<td><?php echo $obj->price;?></td>
							<td><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_id='.$att_detail->id.'&delete_att_val=1&att_val_id='.$obj->id.'#attributes')?>">Delete</a> </td>
						</tr>
						<?php endwhile;?>
					</table>
					<p style="clear:both;"></p>
					<?php if(isset($_GET['add_value']) &&  $_GET['add_value']==1):?>
					<form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_value=1&att_id='.$att_detail->id)?>" method="POST">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="right">
						<tr>
							<td colspan="5" class="	table_head" style="padding-left:10px;">Add New Value</td>
						</tr>
						<tr>
							<td width="10%">Name</td>
						  <td width="90%" align="left"><input type="text" name="name" size="25" tabindex="1"/></td>
						</tr>
						<tr>
							<td width="10%">Stock</td>
						  <td width="90%" align="left"><input type="text" name="stock" size="5" tabindex="2" /></td>
						</tr>
						<tr>
							<td width="10%">Price</td>
						  <td width="90%" align="left"><input type="text" name="price" size="5" tabindex="3" /></td>
						</tr>
						<tr>
							<td colspan="2" style="padding-left:70px;"><input type="hidden" name="attribute_id" value="<?php echo $att_id?>">
							<input type="submit" name="attribute_value" value="Done" tabindex="6" /></td>
						</tr>
					</table>
					</form>
					<?php endif;?>
					<?php 
					endif;?>

				</td>
			</tr>
			</table>
			<?endif;?>
			<p></p>
			<!-- PRODUUCT IMAGES CODE -->
			<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td class="table_head_title"><span id="images">Images</span></td>
			</tr>
			<tr>
				<td>
				    <form action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="post">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
	 				    <tr>
							<td width="20%" class="table_head">Thumbnail</td>
							<td width="31%" class="table_head" align="center">Main Image</td>
							<td width="36%" class="table_head" align="center">Position</td>
							<td width="13%" class="table_head">Controls</td>
						</tr>
						<?while($img = $pimages->GetObjectFromRecord()):?>
						<tr>
							<td width="20%"><img src="<?php get_thumb('product', $img->image);?>"></td>
							<td width="31%" align="center"><input type="radio" name="main_image[i]" value="<?php echo $img->id?>" <?=($img->main_image==1)?'checked':'';?>></td>
							<td width="36%" align="center"><input type="text" name="position[<?php echo $img->id?>]"  value="<?php echo $img->position?>"size="3"></td>
							<td><a href="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&delete_image=1&delete='.$img->id)?>">Delete</a></td>
						</tr>
						<?endwhile;?>
						<tr>
							<td width="20%" class="table_head">&nbsp;</td>
							<td width="31%" class="table_head" align="center"><input name="image_update" value="Update" type="submit"></td>
							<td width="36%" class="table_head" align="center"><input name="image_position" value="Update" type="submit"></td>
							<td class="table_head">&nbsp;</td>
						</tr>
					</table>
					</form>

					<form id="images" action="<?php echo make_admin_url('product', 'more_op', 'more_op', 'id='.$id)?>" method="post" name="images" enctype="multipart/form-data">
						<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table">
							<tr>
								<td width="30%"></td>
								<td width="50%"><input type="file" name="image" size="52" /></td>
								<td><input type="submit" name="image_upload" value="Upload" size="52" /></td>
							</tr>
						</table>
					</form>
								
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
			<br/>
			<form id="images" action="<?php echo make_admin_url('product', 'insert2', 'insert2', 'id='.$id)?>" method="post" name="images">
				<table class="table" style="border:solid 1px #dcdcdc;" width="100%" align="center" border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td class="table_head_title">The Final Step</td>
							</tr>
							<tr>
							  <td colspan="2"><table width="100%" border="0" cellpadding="5" cellspacing="0">
							    <tbody><tr>
							      <td style="border-right:solid 1px #dcdcdc;">Click below to view a preview of the product</td>
							      <td>Click below to confirm and apply all changes you have made.</td>
						        </tr>
							    <tr>

							      <td style="border-right:solid 1px #dcdcdc;"><a href="javascript:popUp('<?php echo make_url('product_preview','id='.$id)?>')"><img src="image/preview.jpg" width="50" border="0" height="19"></a></td>
							      <td><a href="<?php echo make_admin_url('product', 'list', 'list', 'id='.$product->parent_id);?>"><img src="image/iamdone.jpg" width="65" border="0" height="19"></a></td>
						        </tr>
						      </tbody></table></td>
						  </tr>
						</table>
					</form>
			<p>&nbsp;</p>
		<?php
		break;
	default: break;
endswitch;
?>
