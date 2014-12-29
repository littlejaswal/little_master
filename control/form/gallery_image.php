<ul id="shortcut">
    <li>  
        <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">
            <img src="images/shortcut/setting.png" alt="setting"/><br/>
            <strong>Setting</strong>
          </a>
    </li>
    <li>
        <a href="<?php echo make_admin_url('gallery', 'list', 'list');?>" id="shortcut_posts" title="Back to gallery listing">
            <img src="images/shortcut/back.png" alt="posts"/><br/>
            <strong>Gallery</strong>
        </a>
    </li>
    
</ul>
<br class="clear" />
<?php
display_message(1);
switch ($section):
	case 'list':
		?>

                <div class="onecolumn">
                       <div class="header"><span><?=category_chain($id, 'gallery')?></span></div>
                        <br class="clear"/>
                       <div class="content">
                                <form action="<?=make_admin_url('gallery_image', 'update_default', 'list', 'id='.$id)?>" method="POST">
                                        <?while($image=$QueryObj->GetObjectFromRecord()):?>
                                                 <div style="width:280px;height:300px;float:left;background: #f5f5f5;margin:10px 5px;padding:10px;">
                                                      <div style="clear:both;width:280px;height:200px;overflow:hidden;text-align: center;">
                                                          <?php if(file_exists(DIR_FS_SITE.'upload/photo/gallery/large/'.$image->image)):?>
                                                               <img src="<?php echo get_thumb('gallery', $image->image);?>" border="0" /> <br />
                                                              <?php else:?>
                                                               <img src="<?php echo DIR_WS_SITE_GRAPHIC?>noimage.jpg" width="200px" /> <br />
                                                           <?php endif;?>    
                                                      </div>
                                                      <div style="clear:both;padding:10px 0px 10px 0px;text-align: center;">
                                                          <strong><?php echo $image->caption?></strong><br/>
                                                        <?=make_admin_link(make_admin_url('gallery_image', 'update', 'update','id='.$id. '&cat_id='.$image->id), get_control_icon('edit'));?> &nbsp;&nbsp;
                                                        <a class="help" href="<?php echo make_admin_url('gallery_image', 'delete', 'list', 'id='.$id.'&delete='.$image->id);?>" onclick="return confirm('Are you sure? You are deleting this image.');" title="delete" > <?php echo get_control_icon('cancel');?></a>
                                                      </div>
                                                 </div>
                                        <?endwhile;?>
                                </form>
                           <br class="clear"/>
                       </div>
                        <br class="clear"/>
                </div>
              
                <div class="twocolumn">
                       <div class="onecolumn" style="margin-bottom:20px;">
                           <div class="header"><span>Instructions</span></div>
                           <br class="clear"/>
                           <div class="content">

                               <ul style="margin-left:20px;">
                                   <li><strong>Image Size:</strong>&nbsp; <br />Ideal Image size for upload should be few hundered KBs like 200KB or so. And it should never ever exceed 1 MB</li>
                                   <li><strong>Image Format:</strong>&nbsp; <br />Although, you can upload PNG/GIF/JPG images to image gallery. The Ideal Image format is JPG Format.</li>
                                   <li><strong>Image Dimensions:</strong>&nbsp; <br />For best results, never let the image dimensions exceed 600px in height & 600px in width.</li>
                               </ul>

                           </div>
                        </div>
                    <div class="onecolumn">
                       <div class="header"><span>Upload New Images</span></div>
                       <br class="clear"/>
                       <div class="content">
                           <form action="<?=make_admin_url('gallery_image', 'insert', 'list', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
                                <?php for($i=1;$i<6;$i++):?>
                                    <p>
                                        <label>Image <?php echo $i;?></label>&nbsp;&nbsp;<input  type="file" name="pic[]" >&nbsp;&nbsp;
                                        <label>Caption</label>&nbsp;&nbsp;<input  type="text" name="caption[]" value="" size="20">&nbsp;&nbsp;
                                        <label>Position</label>&nbsp;&nbsp;<input  type="text" name="position[]" value="" size="3">&nbsp;&nbsp;
                                        <label>Status</label>&nbsp;&nbsp;<input type="checkbox" name="is_active[]" value="1" tabindex="5" checked />
                                    </p> <br class="clear"/>
                                <?php endfor;?>
                                    <p>   
                                        <label></label>
                                        <input type="submit" name="submit" value="Upload" class="Bn">	
                                    </p>
                            </form>
                       </div>
                    </div>
             </div>
             
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form action="<?=make_admin_url('gallery_image', 'insert', 'list', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
				<table width="100%" cellpadding="2" cellspacing="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td class="table_cell" colspan="3" ><?=make_admin_link(make_admin_url('gallery_image', 'list', 'list', 'id='.$id), 'Image Listing');?></td>
					</tr>
					<tr>
						<td class="table_head" colspan="3" align="left" >Upload New Image</td>
					</tr>
					<tr>
						<td align="left" width="20%">Image</td>
						<td align="left" width="50%"><input  type="file" name="pic" ></td>
						<td></td>
					</tr>
					<tr>
						<td align="left" width="20%">Position</td>
						<td align="left" width="50%"><input  type="text" name="position" value="" size="3"></td>
						<td></td>
					</tr>
                                      <tr>
						<td align="left" width="20%">Status</td>
                                                   <td align="left" width="50%">
					<input type="checkbox" name="is_active" value="1" tabindex="5" />

					<td></td>
					</tr>

                                        
					
					<tr>
						<td align="left" width="20%">&nbsp;</td>
						<td align="left" width="50%"><input type="submit" name="submit" value="Upload" class="Bn"></td>
						<td ></td>
					</tr>
				</table>
			</form>
		<?
	
		break;
	case 'update':
		?>
                       <form action="<?=make_admin_url('gallery_image', 'update', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
                    <div class="twocolumn">
                    <div class="column_left">
                    <div class="header"><span>Edit Image</span></div>
                    <br class="clear" />
                         <div class="content">
       			<p>
                            <label>Caption</label> <br class="clear" />
                        <input type="text" name="caption" value="<?=$category->caption;?>" tabindex="4" />  
                        </p>
                        <br class="clear" />
                        <p>
                                <label>Image</label><br class="clear" />
                                <input type="file" name="image" size="16" tabindex="2" />
                        </p>
                        <br class="clear" />
                     
                        <br class="clear" />
                        <p>
                                <label>Position</label><br class="clear" />
                                <input type="text" name="position" value="<?=$category->position;?>" tabindex="4" size="3"/>
                        </p>
                       <input type="hidden" name="id" value="<?=$category->id;?>"/>
                        <br class="clear" />
                        <p>
                                <label>Status</label><br class="clear" />
                                <input type="checkbox" name="is_active"  tabindex="4" <?=($category->is_active=='1')?'checked':'';?>/>
                        </p>
                        
                
			
		
                    </div>
                 </div>
            <div class="column_right">
            <div class="header"><span>Uploaded Image</span></div>
                <br class="clear" />
                <div class="content">
                    <?php if(file_exists(DIR_FS_SITE.'upload/photo/gallery/large/'.$category->image)):?>
                <img src="<?=get_thumb('gallery', $category->image);?>"> <br class="clear" />
                    <?php else:?>
                    <img src="<?php echo DIR_WS_SITE_GRAPHIC?>noimage.jpg" width="200px" /> <br class="clear" />
                <?php endif;?>
                <a href="<?php echo make_admin_url('gallery_image', 'delete_image', 'delete_image', 'id='.$id.'&del='.$category->id);?>" onclick="return confirm('Image shall be permanently deleted. Are you sure?');">delete this image </a>
                <br class="clear" /><br class="clear" />
            <input type="submit" name="update_category" value="Submit" tabindex="7" />
        </div>
        </div>
        </div></form>
                <?
		break;
	case 'delete':
		
		break;
	default:break;
endswitch;
?>
