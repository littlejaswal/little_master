<ul id="shortcut">        <li>            <a href="<?php echo make_admin_url('content', 'list', 'list');?>" id="shortcut_posts" title="Content Pages">            <img src="images/shortcut/home.png" alt="posts"/><br/>            <strong>Content</strong>        </a>        </li>    <?php if($section=='insert' or $section=='update'):?>            <li>                <a href="<?php echo make_admin_url('content_navigation', 'list', 'list', 'parent_id='.$parent_id);?>" id="shortcut_posts" title="Back to listing">                <img src="images/shortcut/back.png" alt="posts"/><br/>                <strong>Listing</strong>            </a>            </li>     <?php endif;?>                 <?php if($parent_id):            $naobj=get_object('navigation', $parent_id);         ?>            <li>                <a href="<?php echo make_admin_url('content_navigation', 'list', 'list', 'parent_id='.$naobj->parent_id);?>" id="shortcut_posts" title="Back to listing">                <img src="images/shortcut/back.png" alt="posts"/><br/>                <strong>Listing</strong>            </a>            </li>     <?php endif;?>     <?php     if($section!='insert' && $section!='update'):    ?>     <li>    <a href="<?php echo make_admin_url('content_navigation', 'list', 'insert', 'parent_id='.$parent_id);?>" id="shortcut_posts" title="Add New Navigation">    <img src="images/shortcut/posts.png" alt="posts"/><br/>    <strong>New</strong>    </a>    </li>    <?php endif;?>                </ul><!-- End shortcut menu --><!-- Begin shortcut notification --><!--<div id="shortcut_notifications">        <span class="notification" rel="shortcut_home">10</span>        <span class="notification" rel="shortcut_contacts">5</span>        <span class="notification" rel="shortcut_posts">1</span></div><!-- End shortcut noficaton --><!--<br class="clear"/>--><br class="clear"/><?phpdisplay_message(1);#handle sections here.switch ($section):	case 'list':		#html code here.		?> <div class="onecolumn">        <div class="header">                <span>Manage Content Navigation</span>        </div>        <br class="clear"/>        <div class="content">        <form action="<?php echo make_admin_url('content_navigation', 'update2', 'list', 'parent_id='.$parent_id);?>" method="post" id="form_data" name="form_data" >        <table width="100%" border="0" cellspacing="1" cellpadding="1" class="data" >                 		            		 <thead>       			<tr>                <td width="13%" class="table_head" align="left">Title</td>                <td width="20%"  align="center" class="table_head">Subnav</td>               	<td width="20%"  align="center" class="table_head">Position</td>				<td align="center" width="20%" class="table_head center">Status</td>				<td class="table_head" align="center" width="15%">Action</td>			</tr> </thead>                        <tbody>           			<? if($QueryObj->GetNumRows()!=0):?>			<? $sr=1;while($navigation=$QueryObj->GetObjectFromRecord()):?>			<tr >				<td width="13%" align="left" ><?=$navigation->navigation_title;?></td>                <td width="20%"  align="center" ><a href="<?php echo make_admin_url('content_navigation', 'list', 'list', 'parent_id='.$navigation->id);?>">Subnav</a></td>                <td width="20%"  align="center"class="center"><input type="text" name="position[<?php echo $navigation->id?>]" value="<?=$navigation->position;?>" size="3"/></td>				<td align="center" width="20%">                 <input type="checkbox" name="is_active[<?=$navigation->id;?>]" <?=$navigation->is_active=='1'?'checked':''?>  style="border:none;" />				</td>								<td align="center" width="15%">					<?=make_admin_link(make_admin_url('content_navigation', 'update', 'update', 'id='.$navigation->id), get_control_icon('edit'), 'edit', 'help');?>&nbsp;                                        <a class="help" href="<?php echo make_admin_url('content_navigation', 'delete', 'list', 'id='.$navigation->id.'&parent_id='.$navigation->parent_id);?>" onclick="return confirm('Are you sure? You are deleting this page.');" title="delete" > <?php echo get_control_icon('cancel');?></a>								</td>			</tr>			<? endwhile; ?>            </tbody>            <tr>                <td  ></td>                 <td  ></td>                <td align="center" valign="middle" width="20%" ><input type="submit" name="update_position" value="Update" /></td>				<td align="center" valign="middle"   ><input type="submit" name="submit" value="update"></td>				<td class="" align="center"></td>			</tr>			<?php			else:?>				<tr>					<td>&nbsp;&nbsp;</td>				</tr>				<tr>					<td align="center" valign="middle" colspan="6">Sorry no record found.</td>				</tr>			<?endif;?>					</table>        </form>        </div> </div>		<?		break;	case 'insert':		?>		<form id="video_insert" action="<?=make_admin_url('content_navigation', 'insert', 'insert');?>" method="post" name="team_insert" enctype="multipart/form-data">               <div class="twocolumn">                                     <div class="column_left" style="margin-bottom:20px;">                     <div class="header">                         <span>Add New Navigation</span>                     </div>                     <br class="clear"/>                     <div class="content">                    					<? //make_admin_link(make_admin_url('content_navigation', 'list', 'list'), 'Back to  Nanigation listing');?>								<p>					<label>Title</label><br/>					<input type="text" name="navigation_title"  class="input_type" tabindex="1" />											</td>				</p>                                <input type="hidden" name="parent_id" value="<?php echo $parent_id?>" />                <p>					<label>Page</label><br/>					<input type="text" name="navigation_link" id="navigation_link" class="input_type" tabindex="1" />				</p>                <p>					<label>Query</label><br/>					<input type="text" name="navigation_query" id="navigation_query" class="input_type" tabindex="1" />				</p>                 			                <p>					<label>Small Description</label><br/>					<textarea name="small_description" id="small_description" class="input_type" rows="4" cols="47" tabindex="6" /></textarea>				</p>                               <p>					<label>Position</label><br/>					<input type="text" size="4" name="position" tabindex="6" />				</p>                  <p>					<label>Status</label><br/>					<input type="checkbox" name="is_active" value="1" tabindex="5" />				</p></div>                         </div>                   <div class="column_right">                       <div class="header">                           <span>Actions</span>                       </div>                       <br class="clear"/>                        <div class="content">                            <p><input type="submit" name="submit" value="Submit" tabindex="7" /></p>                        </div>                   </div>               </div>                   </form>		<?		#html code here.		break;	case 'update':		#html code here.		?>		<form id="video_update" action="<?=make_admin_url('content_navigation', 'update', 'update', 'id='.$id)?>" method="post" name="team_update" enctype="multipart/form-data">                                         <div class="twocolumn">                                     <div class="column_left" style="margin-bottom:20px;">                     <div class="header">                         <span>Edit Navigation</span>                     </div>                     <br class="clear"/>                     <div class="content">                                        							                <? //make_admin_link(make_admin_url('content_navigation', 'list', 'list', 'parent_id='.$navigation->parent_id), 'Back to Navigation listing');?>				               								<p>					<label>Title</label><br/>					<input type="text" name="navigation_title" id="date" class="input_type" tabindex="1" value="<?=$navigation->navigation_title;?>" />				</p> <br class="clear"/>				<input type="hidden" name="parent_id" value="<?php echo $navigation->parent_id?>" />              <p>					<label>Page</label><br/>					<input type="text" name="navigation_link" id="date" class="input_type" tabindex="1" value="<?=$navigation->navigation_link;?>" />				</p> <br class="clear"/>                <p>					<label>Query </label><br/>					<input type="text" name="navigation_query" id="navigation_query" class="input_type" tabindex="1" value="<?=$navigation->navigation_query;?>" />				</p> <br class="clear"/>                  <p>					<label>Small Description</label><br/><textarea name="small_description" id="small_description" class="input_type" rows="4" cols="47" tabindex="6" /><?=$navigation->small_description;?></textarea>				</p>                       <p>					<label>Position</label><br/>					<input type="text" size="4" name="position" value="<?=$navigation->position?>"   tabindex="6" />				</p> <br class="clear"/>                <p>					<label>Status</label><br/>					<input type="checkbox" name="is_active" value="1" tabindex="5" <?=($navigation->is_active)?'checked':'';?>/>				</p> <br class="clear"/>				<p>					<label></label><br/>					<td align="left"></td>				</p>                     </div>                         </div>			 <div class="column_right" style="margin-left:20px;">                             <div class="header">                                <span>Action</span>                             </div>                            <br class="clear"/>                            <div class="content">                                <p><input type="submit" name="submit" value="Submit" tabindex="7" /></p>                            </div>                         </div>                     </div>		</form>		<?		break;	case 'delete':		#html code here.		break;	default:break;endswitch;?>