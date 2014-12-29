
<ul id="shortcut">
    <li>  
        <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">
            <img src="images/shortcut/setting.png" alt="setting"/><br/>
            <strong>Setting</strong>
          </a>
    </li>
	   
	<?php  if($section=='list'):
    ?>
     <li>
    <a href="<?php echo make_admin_url('links', 'list', 'insert');?>" id="shortcut_posts" title="Add New Links">
    <img src="images/shortcut/posts.png" alt="posts"/><br/>
    <strong>New</strong>
    </a>
    </li>
	
    <?php
	else: ?>
	<li>

        <a href="<?php echo make_admin_url('links', 'list', 'list');?>" id="shortcut_posts" title="Manage Links ">

        <img src="images/shortcut/back.png" alt="posts"/><br/>

        <strong>Back</strong>

        </a>

      </li>
	
<?php
	endif;?>
   
    
</ul>
<br class="clear" />

<?php

#handle sections here.
switch ($section):
	case 'list':
		
		#html code here.
		?>
<div class="onecolumn">

        <div class="header">

                <span>Manage Properties</span>

        </div>

        <br class="clear"/>

        <div class="content">
                <form action="<?php echo make_admin_url('links', 'update2', 'list', 'id='.$id);?>" method="post" id="form_data" name="form_data" >
		<table width="100%" border="0" cellspacing="1" cellpadding="1" class="data" >
	          <thead>
                          
			<tr>
				<th align="center" valign="middle" width="10%" class="table_head">Sr.</th>
				<th width="35%" class="table_head">Name</th>
                                <th width="15%" align="center" class="table_head">Position</th>
				<th width="10%" class="table_head">Status</th>
				<th class="table_head" align="center">Action</th>
			</tr>
                  </thead>
			<?php $sr=1;while($news=$QueryObj->GetObjectFromRecord()):?>
	          <tbody>
			<tr>
				<td align="center" valign="middle" width="10%" ><?=$sr++?>.</td>
				<td width="35%" ><a href="http://<?php echo $news->url;?>" target="_blank"><?php echo $news->name?></a></td>
                                <td align="center" width="15%" ><input type="text" name="position[<?php echo $news->id?>]" value="<?=$news->position;?>" size="3" /></td>
				<td width="10%" > 
				
				<!--<input type="checkbox" name="is_active[<?//=$news->id;?>]" <?//=$news->is_active=='1'?'checked':''?>  style="border:none;" /> -->
				<?php if($news->is_active):?>
				<a href="<?php echo make_admin_url('links', 'status', 'status', 'id='.$news->id.'&status=0&page='.$page);?>" title="click to set status off"><?php echo get_control_icon('on');?></a>
									<?php else:?>
				<a href="<?php echo make_admin_url('links', 'status', 'status', 'id='.$news->id.'&status=1&page='.$page);?>" title="click to set status on"><?php echo get_control_icon('off');?></a>
					<?php endif;?>
				
				</td>
				<td align="center">
				<?php echo make_admin_link(make_admin_url('links', 'update', 'update', 'id='.$news->id), get_control_icon('edit'));?>&nbsp;
				
				 <a href="<?php echo make_admin_url('links', 'delete', 'list', 'id='.$news->id); ?>"onclick="return confirm('Are you sure? You are deleting this .');" > <?php echo get_control_icon('cancel');?></a>
				
			</tr>
                        
		 </tbody>
                        
			<?php endwhile;?>
                                   <tr>

                                <td  ></td>

                                
                                      <td  ></td>
                                <td align="center"><input type="submit" name="submit_position" value="Update"></td>
				<td align="left" valign="middle"   ></td>
                  

				<td class="" align="center"></td>

			</tr>
                   <tr>
		       <td colspan="5">
				<?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=links', 2);?>
		       </td>
	         </tr>
	</table></form>
        </div>
</div>
		<br/>
		<br/>
   
		<?php
		break;
	case 'insert': ?>
		<form id="method" action="<?php echo make_admin_url('links', 'insert', 'list', 'id='.$id)?>" method="post" name="payment-method" enctype="multipart/form-data" class="data">
		
	  
                 <div class="twocolumn">
                    <div class="column_left">
                       <div class="header"><span>Add New Link</span></div>
                       <br class="clear"/>
                       <div class="content">
            
				
                                <label>Name</label><br/>
					<input type="text" name="name" size="40" tabindex="1" />
				<br/><br/>                           
                               
				<label>Link  http://www.</label><br/>
					<input type="text" name="url" size="40" tabindex="2" value=""/>
				<br/><br/>   
				<p>

                                    <label>Description</label><br/>

                                    <textarea name="text_description" cols="50" rows="5" tabindex="3"></textarea>

                                </p>
			       <br/><br/> 
                            
                              <p>
                                  <label>Position</label></br>
                                  <input type="text" name="position" value="0" size="4" tabindex="4"/>
                                </p><br/><br/>
				 <label>Status</label><br/>
                                 <input type="checkbox" name="is_active" value="yes" size="40" tabindex="5" />
                                  <br/><br/>     
                            </p><br/><br/>
                            <p>
                                 <label></label>
			 
				
                </p>
			
		
		    </div>
                    </div>
                     <div style="margin-bottom:30px;" class="column_right">

                             
                        
                           <div class="header"><span>Action</span></div>
                           <br class="clear"/>
                           <div class="content">
								<p>
					
							Upload Photo</td>
								<input type="file" name="image" class="input_type_file" tabindex="6" /><br/><br/>
                               <input type="submit" name="submit" value="Submit" tabindex="7" />

                           </div>
                        </div>
                       
                       
                </div>
	</form>	
		
		
		<?php
		break;
	case 'update':
		#html code here.
		?>
			<form id="method" action="<?php echo make_admin_url('links', 'update', 'list')?>" method="post" name="payment-method"  enctype="multipart/form-data" class="data">
			 <div class="column_left">
                    <div class="header">
                            <span>Edit Property</span>
                    </div>
                    <br class="clear"/>
                    <div class="content">
                  <p>
                      <label>Name</label> <br class="clear"/>
					<input type="text" name="name" size="40" tabindex="1" value="<?php echo $news->name?>"/>
                                        		</p> <br class="clear"/>
                  
				   <p>
		       <label>Link</label> <br class="clear"/>
					<input type="text" name="url" size="40" tabindex="2" value="<?php echo $news->url?>"/>
                  
                  </p><br class="clear"/>
				  <p> 
					<label>Discription</label><br/>
                            <textarea name="text_description" cols="50" rows="5" tabindex="3"><?=$news->text_description;?></textarea>
                   
                  </p> <br class="clear"/>
                 
				<label>Position</label><br class="clear" />
				<input type="text" name="position" size="4" tabindex="4" value="<?=$news->position?>"/>
			</p>
			<br class="clear" />
                  <p>
			 <label>Status</label> <br class="clear"/>
					<input type="checkbox" name="is_active" value="yes" size="40" tabindex="5" <?php echo (isset($news->is_active) && $news->is_active=='1')?'checked':''?> />
								
			                      		</p> <br class="clear"/>
                  	    </div>
                         </div>
                       
                     <div style="margin-bottom:30px;" class="column_right" >

      
                            
                       
                                <div class="header"><span>Action</span></div>
                                <br class="clear" />
                           <div class="content">
									<input type="file" name="image" class="input_type_file" tabindex="6" /><?php if($news->image){?> <br /><br /><img src="<?php echo get_thumb('links', $news->image); ?>"  /><br/><br/><a href="<?php echo make_admin_url('links', 'delete_image', 'delete_image', 'id='.$id)?>" onclick="return confirm('Are you sure? You are deleting this Image.')" >Delete Image</a><?php } else {}?>
								<br/><br/>
                                  <input type="submit" name="submit" value="Update" tabindex="7" />
			
			           <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
	                  </div>
                      </div>
 </div>
		</form>
		<?php 
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
