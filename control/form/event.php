<script type="text/javascript">
	$("document").ready(function() {
		$("#event_date_show").datepicker();
	});
	
</script>
<script type="text/javascript">
	$("document").ready(function() {
		$("#event_end_date").datepicker();
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
                <a href="<?php echo make_admin_url('event', 'list', 'list');?>" id="shortcut_posts" title="Back to listing">
                <img src="images/shortcut/back.png" alt="posts"/><br/>
                <strong>Listing</strong>
            </a>
            </li>
    <?php endif;?>




     <?php
     if($section!='insert' && $section!='update'):
    ?>
     <li>
    <a href="<?php echo make_admin_url('event', 'list', 'insert');?>" id="shortcut_posts" title="Add New Event">
    <img src="images/shortcut/posts.png" alt="posts"/><br/>
    <strong>New</strong>
    </a>
    </li>
    <?php endif;?>
    
</ul>



<br class="clear"/>
<?

switch ($section):
	case 'list':
		
		
display_message(1);
            ?>
  <div class="onecolumn">

        <div class="header">

                <span>Manage Events</span>

        </div>

        <br class="clear"/>

        <div class="content">
<form id="event_insert" action="<?=make_admin_url('event', 'update2', 'list');?>" method="post" name="event_insert">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="data">
			
			<? if($QueryObj->GetNumRows()!=0):?>
                         <thead>
			<tr>
				<th align="center" valign="middle" width="5%" class="table_head">Sr.</th>
				<th width="20%" class="table_head"><strong>Name</strong></td>
				<th align="center" valign="middle" width="10%" class="table_head">Venue</th>
				<th align="center" valign="middle" width="20%" class="table_head">Event Start Date</th>
				<th align="center" valign="middle" width="10%" class="table_head">Status</th>
				
				<th class="table_head" align="center">Controls</th>
			</tr>
                        </thead>
                        
                        
			<?$sr=1;while($event=$QueryObj->GetObjectFromRecord()):?>
                        <tbody>
			<tr>
				<td width="5%"  align="center"><?=$sr++?>.</td>
				<td width="20%" ><?=$event->name?></td>
				<td width="10%"  align="center"><?=$event->venue?></td>
				<td width="20%"  align="center"><?=$event->event_date_show?></td>
				<td width="10%"  align="center"><input type="checkbox" name="is_active[<?=$event->id;?>]" <?=$event->is_active=='1'?'checked':''?>  style="border:none;" /></td>
				
				<td align="center">
					<?=make_admin_link(make_admin_url('event', 'update', 'update', 'id='.$event->id), get_control_icon('edit'));?>&nbsp;&nbsp;
				
          <a href="<?php echo make_admin_url('event', 'delete', 'list', 'id='.$event->id); ?>" onclick="return confirm('Are you sure? You are deleting this page.');" class="help" title="Delete event" > <?php echo get_control_icon('cancel');?></a>                                
				</td>
			</tr>  
                        
                         

			<?endwhile;?>
                          <tr>

                                <td  ></td>

                                  <td  ></td>
                                    <td></td>
                                      <td  ></td>
                    
				<td align="center" valign="middle"   ><input type="submit" name="submit" value="update"></td>
                  

				<td class="" align="center"></td>

			</tr>
			<?else:?>
				<tr>
					<td>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="6">Sorry no event found.</td>
				</tr>
			<?endif;?>
                                   <tr>
                                       <td colspan="6">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=event', 2);?>
                                       </td></tr>
			</tbody>
                     
		</table>
   
				
			
</form>
        </div>
  </div>
		<?
		break;
	case 'insert':
		?>
<div class="twocolumn">

            

		<form id="event_insert" action="<?=make_admin_url('event', 'insert', 'insert');?>" method="post" name="event_insert" enctype="multipart/form-data">
		
                         <div class="column_left" style="margin-bottom:20px;">

                     <div class="header">

                         <span>Add New Event</span>

                     </div>

                     <br class="clear"/>

                     <div class="content">	
              <p>
                  <label>Title  </label>   <br class="clear"/>
				
					<input type="text" name="name" size="24" tabindex="1" />
              </p><br class="clear"/>	
              <p>
                  <label>Venue </label>   <br class="clear"/>	
					<input type="text" name="venue" size="24" tabindex="2" />
		</p><br class="clear"/>
              <p>
                        <label>Event Image</label><br class="clear" />
                        <input type="file" name="image" size="16" tabindex="2" />
                </p>
                <br class="clear" />
              <p>
                  <label>Event Start Date  </label>   <br class="clear"/>	
					<input type="text" name="event_date_show" id="event_date_show" size="24" tabindex="4" />
		</p><br class="clear"/>
              <p>
                  <label>Event End Date </label>   <br class="clear"/>		
				<input type="text" name="event_end_date" id="event_end_date" size="24" tabindex="4" />
				
		</p><br class="clear"/>		
                
              <p>
                  <label> Status </label>   <br class="clear"/>              
					<input type="checkbox" name="is_active"  tabindex="6" />
	      </p><br class="clear"/>
            <!--  <p>
                  <label>Short Description </label>   <br class="clear"/>		
                        <textarea name="short_description" rows="4" cols="40" tabindex="9"></textarea>
		</p><br class="clear"/>-->
              <p>
                  <label>Short Description</label>   <br class="clear"/>		
					<textarea id="wysiwyg" name="short_description" rows="4" cols="40" tabindex="10"></textarea>
               </p><br class="clear"/>                         
			
			
                        </div></div>
                         <div style="margin-bottom:30px;" class="column_right">

                             <div class="header"><span>SEO Information</span></div>

                             <br class="clear" />

                             <div class="content">

                                <p>

                                    <label>Meta Title</label><br/>

                                    <input type="text" name="meta_title"  size="24" tabindex="4">

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
                              
                              <div class="column_right" style="margin-bottom: 20px;">
                             <div class="header">
                                <span>Action</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                                <input type="submit" name="submit" value="Submit" tabindex="11" />
			   </div>
                         </div>   
                        
                        
		</form>
        </div>

		<?
		
		break;
	case 'update':
		
		?>
  <div class="twocolumn">
		<form id="event_update" action="<?=make_admin_url('event', 'update', 'update', 'id='.$id)?>" method="post" name="event_update" enctype="multipart/form-data">
                      

            

                         <div class="column_left" style="margin-bottom:20px;">

                     <div class="header">

                         <span>Edit Event</span>

                     </div>

                     <br class="clear"/>

                     <div class="content">
			
			     <p>
                  <label>Title </label>   <br class="clear"/>	
					<input type="text" name="name" size="24" tabindex="1"  value="<?=$event->name;?>"/>
                             </p>   <br class="clear"/>       
			     <p>
                  <label>Venue </label>   <br class="clear"/>	
				<input type="text" name="venue" size="24" tabindex="2"  value="<?=$event->venue;?>"/>
                                 </p>   <br class="clear"/>  
                <p>
                        <label>Event Image</label><br class="clear" />
                        <input type="file" name="image" size="16" tabindex="2" />
                </p>
                <br class="clear" />               
			     <p>
                  <label>Event Start Date </label>   <br class="clear"/>	
					<input type="text" name="event_date_show" id="event_date_show" size="24" tabindex="4" value="<?=$event->event_date_show;?>" />
			    </p>   <br class="clear"/>  
                            <p>
                  <label>Event End Date</label>   <br class="clear"/>	
                                <input type="text" name="event_end_date" id="event_end_date" size="24" tabindex="4" value="<?=$event->event_end_date;?>" />
			 </p>   <br class="clear"/>  
                         <p>
                  <label>Status </label>   <br class="clear"/>
					<input type="checkbox" name="is_active" value="1" tabindex="6" <?=($event->is_active=='1')?'checked':'';?> />
				
			 </p> 
                         <!--
                         <br class="clear"/>  
                         <p>
                  <label>Short Description </label>   <br class="clear"/>	
				<textarea name="short_description" rows="4" cols="40" tabindex="9"><?=$event->short_description;?></textarea>
			   </p> 
                         -->
                         <br class="clear"/>  
                           <p>
                  <label>Short Description </label>   <br class="clear"/>
					<textarea id="wysiwyg" name="short_description" rows="4" cols="40" tabindex="10"><?=$event->short_description;?></textarea>
                            </p>   <br class="clear"/>               
			
			     </div></div>
                              <div class="column_right" style="margin-bottom: 20px;">
                             <div class="header">
                                <span>Edit Event Image</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                                 <?php if($event->image):?>
                                        <?php if(file_exists(DIR_FS_SITE.'upload/photo/gallery/large/'.$event->image)):?>
                                            <img src="<?=get_thumb('gallery', $event->image);?>"> <br class="clear" />
                                                <?php else:?>
                                                <img src="<?php echo DIR_WS_SITE_GRAPHIC?>noevent.jpg" width="200px" /> <br class="clear" />
                                        <?php endif;?>
                                    <?php else:?>
                                        <img src="<?php echo DIR_WS_SITE_GRAPHIC?>noevent.jpg" width="200px" /> <br class="clear" />
                                    <?php endif;?>             
                <a href="<?php echo make_admin_url('event', 'delete_image', 'delete_image', 'del='.$event->id);?>" onclick="return confirm('Image shall be permanently deleted. Are you sure?');">delete this image </a>
                <br class="clear" />
			   </div>
                         </div>	
                      <div style="margin-bottom:30px;" class="column_right">

                             <div class="header"><span>SEO Information</span></div>

                             <br class="clear" />

                             <div class="content">

                                <p>

                                    <label>Meta Title</label><br/>

                                    <input type="text" name="meta_name" value="<?=$event->meta_name;?>"  size="24" tabindex="4">

                                </p><br/>
                                   <p>

                                    <label>Page Slug</label><br/>

                                    <input type="text" name="urlname" value="<?=$event->urlname;?>" size="24" tabindex="4">

                                </p><br/>
                                <p>

                                    <label>Meta Keywords</label><br/>

                                    <input type="text" name="meta_keyword" value="<?=$event->meta_keyword;?>" size="24" tabindex="4">

                                </p><br/>

                                <p>

                                    <label>Meta Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="6"><?=$event->meta_description;?></textarea>

                                </p><br/>

                             </div>
                           
                             </div>
                    <div style="margin-bottom:30px;" class="column_right">

                             <div class="header"><span>Action</span></div>

                             <br class="clear" />

                             <div class="content">
                             
                <input type="submit" name="submit" value="Submit" tabindex="11" /> 
                                 
                             </div>
                    </div>
                    
		</form>
        
</div>
		<?
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
