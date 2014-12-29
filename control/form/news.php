<script type="text/javascript">
	$("document").ready(function() {
		$("#date_show").datepicker();
	});
	
</script>

<!-- Begin shortcut menu -->

<ul id="shortcut">
    <li>  <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">
            <img src="images/shortcut/setting.png" alt="setting"/><br/>
            <strong>Setting</strong>
          </a>
        </li>
  
   
    <?php if($section=='insert' or $section=='update'):?>
            <li>
                <a href="<?php echo make_admin_url('news', 'list', 'list');?>" id="shortcut_posts" title="Back to listing">
                <img src="images/shortcut/back.png" alt="posts"/><br/>
                <strong>Listing</strong>
            </a>
            </li>
    <?php endif;?>




     <?php
     if($section!='insert' && $section!='update'):
    ?>
     <li>
    <a href="<?php echo make_admin_url('news', 'list', 'insert');?>" id="shortcut_posts" title="Add New News">
    <img src="images/shortcut/posts.png" alt="posts"/><br/>
    <strong>New</strong>
    </a>
    </li>
    <?php endif;?>
    
</ul>

<br class="clear"/>

<?php

display_message(1);
switch ($section):
	case 'list':
	
		?>
 
        <div class="onecolumn">
        <div class="header">
                <span>
                  Manage Issues
                </span>
         </div>
        <br class="clear"/>
        <div class="content">
        <form id="form" action="<?=make_admin_url('news', 'update2', 'list', 'page='.$page.'&id='.$id)?>" method="post" name="">
      
		
				
				
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data" >
                    <thead>
			<tr>
				<td width="25%" class="table_head">Title</td>
				<td width="15%" align="center" class="table_head">Issue Date</td>
                                <td width="15%" align="center" class="table_head">Position</td>
				<td width="15%" align="center" class="table_head">Status</td>
				<td width="25%" class="table_head" align="center">Action</td>
			</tr>
                    </thead>
                    <tbody>
			<?$sr=1;while($news=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="25%" align="left" ><?=$news->name?></td>
				<td width="15%" align="center" ><?=$news->date_show;?></td>
                                <td align="center" width="15%" ><input type="text" name="position[<?php echo $news->id?>]" value="<?=$news->position;?>" size="3" /></td>
				<td align="center" width="15%" ><input type="checkbox" name="is_active[<?php echo $news->id?>]" <?php echo ($news->is_active=='on')?'checked':'';?> /></td>
				<td align="center" width="25%">
                                        <?=make_admin_link(make_admin_url('news', 'update', 'update', 'id='.$news->id), get_control_icon('edit'), 'Edit News', 'help');?>&nbsp;&nbsp;
                                        <a href="<?php echo make_admin_url('news', 'delete', 'list', 'id='.$news->id); ?>" onclick="return confirm('Are you sure? You are deleting this page.');" class="help" title="Delete News" > <?php echo get_control_icon('cancel');?></a>
                                        
				</td>
			</tr>
			<? endwhile; ?>
          
            <tr>
                <td></td>
                <td align="center" valign="middle"></td>
                <td align="center"><input type="submit" name="submit_position" value="Update"></td>
                <td align="center"><input type="submit" name="submit" value="Update"></td>
                <td align="right" style="padding-right:10px;">
              
                </td>
			</tr>
                         </tbody>
		</table>
            <br/>
            <?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=news', 2);?>
            <br/>
        </form>
        </div>
        </div>
 
            
		<?
		break;
	case 'insert':
		
		?>
		<form id="news_insert" action="<?=make_admin_url('news', 'insert', 'list')?>" method="post" name="news_insert" enctype="multipart/form-data">
                      <div class="twocolumn">
            
                         <div class="column_left" style="margin-bottom:20px;">
                             <div class="header">
                                <span>Add Issue</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
				<p>
					<label>Title</label></br>
					<input type="text" name="name" size="24" tabindex="1" />
				</p> <br class="clear"/>
				  <p>
                                        <label>Image</label> <br/>
                                        <input type="file" name="image" size="16" tabindex="2" />
                                </p>
                                <br class="clear"/>
				<p>
					<label>Issue Date</label></br>
					<td align="left" valign="middle"><input type="text" name="date_show" id="date_show" size="24" tabindex="3" />
				</p><br class="clear"/>
               
				<p>
					<label>Status</label></br>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="on" tabindex="4" />
				</p><br class="clear"/>
                              <p>
                                  <label>Position</label></br>
                                  <input type="text" name="position" value="0" size="4" tabindex="5"/>
                                </p><br class="clear"/>
				<p>
                                    <label>Short Description</label></br>
				    <textarea name="short_description" rows="4" cols="47" tabindex="6"></textarea>
					
				</p><br class="clear"/>
				<p>
                                    <label>Long Description</label></br>
					 <textarea id="wysiwyg" name="long_description" rows="4" cols="47" tabindex="6"></textarea>
						
					
				</p><br class="clear"/>
				
			
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

                                    <input type="text" name="meta_keyword" size="24" tabindex="4">

                                </p><br/>

                                <p>

                                    <label>Meta Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="6"></textarea>

                                </p><br/>

                             </div>
                           
                             </div>
                      <div class="column_right">
                             <div class="header">
                                <span>Action</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                                 <input type="submit" name="submit" value="Submit" tabindex="7" />
                                 
                             </div>
                          
                          
                          
                      </div>
                </div>
                    		</form>

		<?
		break;
	case 'update':
		
		?>
		<form id="news_insert" action="<?=make_admin_url('news', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert" enctype="multipart/form-data">
                    <div class="twocolumn">
            
                         <div class="column_left" style="margin-bottom:20px;">
                             <div class="header">
                                <span>Edit Issue</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                    
				<p>
                                    <label>Title</label> <br class="clear" />
				    <input type="text" name="name" size="24" tabindex="1" value="<?=$news->name?>"/>
				</p><br class="clear" />
				<p>
					<label>Image</label></br>
					<input type="file" name="image" size="16" tabindex="2" />
                                        	</p> <br class="clear"/>
				<p>
					<label>News Date</label><br class="clear" />
					<input type="text" name="date_show" id="date_show" size="24" tabindex="3" value="<?=$news->date_show;?>"/>
				</p><br class="clear" />
             
				<p>
					<label>Status</label><br class="clear" />
					<input type="checkbox" name="is_active" tabindex="4" <?=($news->is_active=='on')?'checked':'';?>/>
				</p><br class="clear" />
                  <p>
				<label>Position</label><br class="clear" />
				<input type="text" name="position" size="4" tabindex="5" value="<?=$news->position?>"/>
			</p><br class="clear" />
				<p>
					<label>Short Description</label><br class="clear" />
					<textarea name="short_description" rows="4" cols="47" tabindex="6"><?=$news->short_description?></textarea>
				</p><br class="clear" />
				<p>
					<label>Long Description</label><br class="clear" />
					
                                            <textarea id="wysiwyg"  name="long_description" rows="4" cols="47" tabindex="6"><?=$news->long_description;?></textarea>		
					
				
					
				</p><br class="clear" />
                             </div>
                         </div>
                         <div style="margin-bottom:30px;"  class="column_right">
                             <div class="header">
                                <span>Edit Issue Image</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                                 <?php if($news->image):?>
                                    <?php if(file_exists(DIR_FS_SITE.'upload/photo/gallery/large/'.$news->image)):?>
                                        <img src="<?=get_thumb('gallery', $news->image);?>"> <br class="clear" />
                                    <?php else:?>
                                        <img src="<?php echo DIR_WS_SITE_GRAPHIC?>nonews.jpg" width="200px" /> <br class="clear" />
                                    <?php endif;?>
                                <?php else:?>
                                        <img src="<?php echo DIR_WS_SITE_GRAPHIC?>nonews.jpg" width="200px" /> <br class="clear" />
                                    <?php endif;?>        
            <a href="<?php echo make_admin_url('news', 'delete_image', 'delete_image', 'id='.$news->id);?>" onclick="return confirm('Image shall be permanently deleted. Are you sure?');">delete this image </a>
            <br class="clear" /><br class="clear" />
                                 
                                 
                             </div>
                          
                          
                          
                      </div>
                        <div style="margin-bottom:30px;" class="column_right">

                             <div class="header"><span>SEO Information</span></div>

                             <br class="clear" />

                             <div class="content">

                                <p>

                                    <label>Meta Title</label><br/>

                                    <input type="text" name="meta_name" value="<?=$news->meta_name;?>"  size="24" tabindex="4">

                                </p><br/>
                                    <p>

                                    <label>Page Slug</label><br/>

                                    <input type="text" name="urlname" value="<?=$news->urlname;?>" size="24" tabindex="4">

                                </p><br/>
                                <p>

                                    <label>Meta Keywords</label><br/>

                                    <input type="text" name="meta_keyword" value="<?=$news->meta_keyword;?>" size="24" tabindex="4">

                                </p><br/>

                                <p>

                                    <label>Meta Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="6"><?=$news->meta_description;?></textarea>

                                </p><br/>

                             </div>
                           
                             </div>
                        <div style="margin-bottom:30px;" class="column_right">

                             <div class="header"><span>Action</span></div>

                             <br class="clear" />

                             <div class="content">
                                 
                                <input type="submit" name="submit" value="Submit" tabindex="7" /> 
                             </div>
                        </div>
                        
                    </div>
		</form>
		<?
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
