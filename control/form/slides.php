<ul id="shortcut">
    <li>  
        <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">
            <img src="images/shortcut/setting.png" alt="setting"/><br/>
            <strong>Setting</strong>
          </a>
    </li>
    <li>
        <a href="<?php echo make_admin_url('banner', 'list', 'list');?>" id="shortcut_posts" title="Back to Slider listing">
            <img src="images/shortcut/back.png" alt="posts"/><br/>
            <strong>Sliders</strong>
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
                     
                        <br class="clear"/>
                       <div class="content">
                                <form action="<?=make_admin_url('slides', 'update_default', 'list', 'id='.$id)?>" method="POST">
                                        <?while($image=$QueryObj->GetObjectFromRecord()):?>
                                                 <div style="width:280px;height:300px;float:left;background: #f5f5f5;margin:10px 5px;padding:10px;">
                                                      <div style="clear:both;width:280px;height:200px;overflow:hidden;text-align: center;">
                                                               <img src="<?php echo get_thumb('gallery', $image->image);?>" border="0" /> <br />
                                                      </div>
                                                      <div style="clear:both;padding:10px 0px 10px 0px;text-align: center;">
                                         <?=make_admin_link(make_admin_url('slides', 'update', 'update', 'slideshow_id='.$id.'&cat_id='.$image->id), get_control_icon('edit'));?> &nbsp;&nbsp;
                                                        <a class="help" href="<?php echo make_admin_url('slides', 'delete', 'list', 'slideshow_id='.$id.'&delete='.$image->id);?>" onclick="return confirm('Are you sure? You are deleting this slide.');" title="delete" > <?php echo get_control_icon('cancel');?></a>
                                                      </div>
                                                 </div>
                                        <?endwhile;?>
                                </form>
                           <br class="clear"/>
                       </div>
                        <br class="clear"/>
                </div>
                <br class="clear"/>
                <div class="twocolumn">
                    <div class="column_left">
                       <div class="header"><span>Upload New Slide</span></div>
                       <br class="clear"/>
                       <div class="content">
                           <form action="<?=make_admin_url('slides', 'insert', 'list', 'slideshow_id='.$id)?>" method="POST" enctype="multipart/form-data">
                         
                             
                                <p>
                                        
                                        <label>Title</label><br/><input type="text" name="title" size="24" tabindex="2" />
                                       <br/>
                                       <label>Short Description</label><br/><textarea name="short_description" rows="4" cols="40" tabindex="9"></textarea>
                                       <br/>
                                       <label>Link</label><br/><input type="text" name="link" size="24" tabindex="2" />
                                       <br/>
                                       <label>Image </label><br/><input  type="file" name="image"/>
                                       <br/>
                                       
                                            <label>Position</label><br/><input  type="text" name="position" value="" size="3"/><br/>
                                       <label>Status</label><br/><input type="checkbox" name="is_active" value="on" tabindex="5" />
                                       <br/><br/></p>
                                  <br class="clear"/>
                             
                                    <p>   
                                        <label></label>
                                        <input type="submit" name="submit" value="Upload" class="Bn">	
                                    </p>
                            </form>
                       </div>
                    </div>
                        <div class="column_right" style="margin-bottom:20px;">
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
                       
                       
                </div>

		<?
		#html code here.
		break;
	case 'update':
		#html code here.
            ?>
               <form action="<?=make_admin_url('slides', 'update', 'list', 'slideshow_id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
                    <div class="twocolumn">
                    <div class="column_left">
                    <div class="header"><span>Edit Slide</span></div>
                    <br class="clear" />
                         <div class="content">
       			<p>
                            <label>Title</label> <br class="clear" />
                        <input type="text" name="title" value="<?=$category->title;?>" tabindex="4" />  
                        </p>
                        <br class="clear" />
                        <p>
                                <label>Slide Image</label><br class="clear" />
                                <input type="file" name="image" size="16" tabindex="2" />
                        </p>
                        <br class="clear" />
                        <p>
                                <label>Short Description</label><br class="clear" />
                                <textarea name="short_description" rows="4" cols="30" tabindex="6" id="description" ><?=$category->short_description;?></textarea>
                        </p>
                        <br class="clear" />
                        <p>
                            <label>Link</label> <br class="clear" />
                        <input type="text" name="link" value="<?=$category->link;?>" tabindex="4" />  
                        </p>
                        <br class="clear" />
                        <p>
                                <label>Position</label><br class="clear" />
                                <input type="text" name="position" value="<?=$category->position;?>" tabindex="4" size="3"/>
                        </p>
                       <input type="hidden" name="id" value="<?=$category->id;?>"/>
                        <br class="clear" />
                        <p>
                                <label>Status</label><br class="clear" />
                                <input type="checkbox" name="is_active" value="1" tabindex="4" <?=($category->is_active=='1')?'checked':'';?>/>
                        </p>
                        
                 
			
		
                    </div>
                 </div>
            <div class="column_right">
            <div class="header"><span>Slide Image</span></div>
                <br class="clear" />
                <div class="content">
                    <?php if(file_exists(DIR_FS_SITE.'upload/photo/gallery/large/'.$category->image)):?>
                <img src="<?=get_thumb('gallery', $category->image);?>"> <br class="clear" />
                    <?php else:?>
                    <img src="<?php echo DIR_WS_SITE_GRAPHIC?>pic.jpg" width="200px" /> <br class="clear" />
                <?php endif;?>
                <a href="<?php echo make_admin_url('slides', 'delete_image', 'delete_image', 'slideshow_id='.$id.'&del='.$category->id);?>" onclick="return confirm('Image shall be permanently deleted. Are you sure?');">delete this image </a>
                <br class="clear" /><br class="clear" />
            <input type="submit" name="update_category" value="Submit" tabindex="7" />
        </div>
        </div>
        </div></form>
	<?
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
