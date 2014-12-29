<ul id="shortcut">
    <li>  
        <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">
            <img src="images/shortcut/setting.png" alt="setting"/><br/>
            <strong>Setting</strong>
          </a>
    </li>

    <?php if($section=='update'):?>
    <li>
        <a href="<?php echo make_admin_url('gallery', 'list', 'list');?>" id="shortcut_posts" title="Back to gallery listing">
            <img src="images/shortcut/back.png" alt="posts"/><br/>
            <strong>Gallery</strong>
        </a>
    </li>
     <?php endif;?>

     <?php if($section!='insert' && $section!='update'):?>
     <li>
    <a href="<?php echo make_admin_url('gallery', 'list', 'list', '#newgallery');?>" id="shortcut_posts" title="Add New Gallery">
        <img src="images/shortcut/posts.png" alt="posts"/><br/>
        <strong>New</strong>
    </a>
    </li>
    <?php endif;?>

</ul>
<br class="clear" />


<?php
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
    <div class="onecolumn">
       <div class="header"><span><?=category_chain($id, 'gallery')?></span></div>
        <br class="clear"/>
       <div class="content">
           
		<?
			$sr=1;
			while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
                               <div style="width:280px;height:300px;float:left;background: #f5f5f5;margin:10px 5px;padding:10px;">
                                   <div style="clear:both;width:280px;height:200px;overflow:hidden;text-align: center;">
                                  <a href="<?=make_admin_url('gallery_image', 'list', 'list', 'id='.$QueryObj1->id);?>">
                                    <?php if(file_exists(DIR_FS_SITE.'upload/photo/gallery/thumb/'.$QueryObj1->image)):?>

                            <img src="<?php echo get_thumb('gallery', $QueryObj1->image);?>" title="<?php echo $QueryObj1->description;?>" >
                        <?php else:?>
                    <img src="<?php echo DIR_WS_SITE?>graphic/noimage.jpg" title="<?php echo $QueryObj1->description;?>" width="250px" >
                                <?php endif;?>
                                </a>

                                   </div>
                                    <div style="clear:both;padding:10px 0px 10px 0px;text-align: center;font-size: 14px;">
                                        <?php echo $QueryObj1->name;?>
                                    </div>
                                    <div style="clear:both;padding:10px 0px 10px 0px;text-align: center;">
                                        <a href="<?=make_admin_url('gallery_image', 'list', 'list', 'id='.$QueryObj1->id);?>">Pictures</a> &nbsp;&nbsp;
                                        <?=make_admin_link(make_admin_url('gallery', 'update', 'update', 'id='.$id.'&cat_id='.$QueryObj1->id), get_control_icon('edit'));?> &nbsp;&nbsp;
                                      <a onclick="return confirm('Gallery shall be permanently deleted. Are you sure?');" href="<?=make_admin_url('gallery', 'delete', 'list', 'id='.$id.'&cat_id='.$QueryObj1->id);?> "><?php echo get_control_icon('cancel')?></a> &nbsp;&nbsp;
                                    </div>
                               </div>
			<?endwhile;?>
			 <br class="clear" />
           <?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=gallery', 2);?>
           <br class="clear" />
       </div>
    </div>
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
 <div class="twocolumn" id="newgallery">
         <form id="add_category" action="<?=make_admin_url('gallery', 'insert', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data" class="data">
	
       <div class="column_left" style="margin-bottom:20px;">
       <div class="header"><span>Add New Gallery</span></div>
       <br class="clear"/>
       <div class="content">
   	<p>
                        <label>Name</label> <br/>
                        <input type="text" name="name" size="24" tabindex="1" />
                </p>
                <br class="clear"/>
                <p>
                        <label>Image</label> <br/>
                        <input type="file" name="image" size="16" tabindex="2" />
                </p>
                <br class="clear"/>
                <p>
                        <label>Status</label> <br/>
                        <input type="checkbox" name="is_active" value="1" tabindex="4" />
                </p>
                 
                <br class="clear"/>
                <p>
                        <label>Description</label> <br/>
                        <textarea name="description" rows="4" cols="30" tabindex="6" id="description"></textarea>
                </p>
               
			
		
           <br class="clear"/>
       </div>
       </div>
    
      <div style="margin-bottom:30px;" class="column_right">

                             <div class="header"><span>SEO Information</span></div>

                             <br class="clear" />

                             <div class="content">

                                <p>

                                    <label>Meta Title</label><br/>

                                    <input type="text" name="meta_name"   size="24" tabindex="4">

                                </p><br/>
                                   <p>

                                    <label>Page Slug</label><br/>

                                    <input type="text" name="urlname"  size="24" tabindex="4">

                                </p><br/>
                                <p>

                                    <label>Meta Keywords</label><br/>

                                    <input type="text" name="meta_keyword"  size="24" tabindex="4">

                                </p><br/>

                                <p>

                                    <label>Meta Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="6"></textarea>

                                </p><br/>
                                <br class="clear"/>
                
                             </div>
                           
              </div>
               <div style="margin-bottom:30px;clear:both;" class="column_right">

                             <div class="header"><span>Action</span></div>

                             <br class="clear" />

                             <div class="content">
                                <p>
                        <label></label>
                        <input type="submit" name="new_category" value="Submit" tabindex="7" />
                </p> 
                             </div>
               </div>               
     </form>
 </div>
        <br class="clear"/>
 </div>



		<?
		break;
	case 'insert':
		#html code here.
		?>
		<form id="add_category" action="<?=make_admin_url('gallery', 'insert', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
                     <div class="twocolumn">
            
                         <div class="column_left" style="margin-bottom:20px;">
                             <div class="header">
                                <span>Add New Gallery</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
			
			<p>
					<label>Name</label></br>
					<input type="text" name="name" size="24" tabindex="1" />
                                        	</p> <br class="clear"/>
			<p>
					<label>Image</label></br>
					<input type="file" name="image" size="16" tabindex="2" />
                                        	</p> <br class="clear"/>
			<p>
					<label>Status</label></br>
                        <input type="checkbox" name="is_active" value="1" tabindex="4" />
                        	</p> <br class="clear"/>
                       
                        <p>
					<label>Description</label></br>
                       <textarea name="description" rows="4" cols="30" tabindex="6" id="description"></textarea>
                       	</p> <br class="clear"/>
                       
			
                                  </div>
                   
            </div>
                            <div class="column_left">
                             <div class="header">
                                <span>Action</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                              <input type="submit" name="new_category" value="Submit" tabindex="7" />
                                 
                             </div>
                          
                          
                          
                      </div>
                </div>
		</form>
		<?
		break;
	case 'update':
		#html code here.
		?>
<form  class="data" id="add_category" action="<?=make_admin_url('gallery', 'update', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
<div class="twocolumn">
    <div class="column_left">
        <div class="header"><span>Edit Gallery</span></div>
        <br class="clear" />
        <div class="content">
       			<p>
                            <label>Gallery Name</label> <br class="clear" />
                            <textarea  name="name" rows="1" cols="30" tabindex="1"><?=$category->name;?></textarea>
                        </p>
                        <br class="clear" />
                        <p>
                                <label>Gallery Image</label><br class="clear" />
                                <input type="file" name="image" size="16" tabindex="2" />
                        </p>
                        <br class="clear" />
                        <p>
                                <label>Should it appear on gallery page?</label><br class="clear" />
                                <input type="checkbox" name="is_active" value="1" tabindex="4" <?=($category->is_active=='1')?'checked':'';?>/>
                        </p>
                        <br class="clear" />
                       
                        <br class="clear" />
                        <p>
                                <label>Gallery Description</label><br class="clear" />
                                <textarea name="description" rows="4" cols="30" tabindex="6" id="description" ><?=$category->description;?></textarea>
                        </p>
                        <br class="clear" />

                        <input type="hidden" name="id" value="<?=$_GET['cat_id']?>"/>
			
		
        </div>
    </div>
 <div class="column_right">
        <div class="header"><span>Gallery Photo</span></div>
        <br class="clear" />
        <div class="content">
            <?php if(file_exists(DIR_FS_SITE.'upload/photo/gallery/large/'.$category->image)):?>
                <img src="<?=get_thumb('gallery', $category->image);?>"> <br class="clear" />
            <?php else:?>
                <img src="<?php echo DIR_WS_SITE_GRAPHIC?>noimage.jpg" width="200px" /> <br class="clear" />
            <?php endif;?>
            <a href="<?php echo make_admin_url('gallery', 'delete_image', 'delete_image', 'id='.$category->id);?>" onclick="return confirm('Image shall be permanently deleted. Are you sure?');">delete this image </a>
            <br class="clear" /><br class="clear" />
            <input type="submit" name="update_category" value="Submit" tabindex="7" />
        </div>
 </div>
     <div style="margin-bottom:30px;clear:both;" class="column_right">

                             <div class="header"><span>SEO Information</span></div>

                             <br class="clear" />

                             <div class="content">

                                <p>

                                    <label>Meta Title</label><br/>

                                    <input type="text" name="meta_name" value="<?=$category->meta_name;?>"  size="24" tabindex="4">

                                </p><br/>
                                   <p>

                                    <label>Page Slug</label><br/>

                                    <input type="text" name="urlname" value="<?=$category->urlname;?>" size="24" tabindex="4">

                                </p><br/>
                                <p>

                                    <label>Meta Keywords</label><br/>

                                    <input type="text" name="meta_keyword" value="<?=$category->meta_keyword;?>" size="24" tabindex="4">

                                </p><br/>

                                <p>

                                    <label>Meta Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="6"><?=$category->meta_description;?></textarea>

                                </p><br/>

                             </div>
                           
                             </div>
                       <div style="margin-bottom:30px;clear:both;" class="column_right">

                             <div class="header"><span>Action</span></div>

                             <br class="clear" />

                             <div class="content">
                                <p>
                        <label></label>
                         <input type="submit" name="update_category" value="Submit" tabindex="7" />
                </p> 
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