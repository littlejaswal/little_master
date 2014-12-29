<!-- Begin shortcut menu -->



<ul id="shortcut">

    <li>  <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">

            <img src="images/shortcut/setting.png" alt="setting"/><br/>

            <strong>Setting</strong>

          </a>

        </li>

  

   

    <?php if($section=='insert' or $section=='update'):?>

            <li>

                <a href="<?php echo make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id.'&type='.$type);?>" id="shortcut_posts" title="Back to pages listing">

                <img src="images/shortcut/back.png" alt="posts"/><br/>

                <strong>Listing</strong>

            </a>

            </li>

     <?php

     elseif(isset($parent_id) && $parent_id):

           $bobject=get_object('content', $parent_id);

         ?>

            <li>

                <a href="<?php echo make_admin_url('content', 'list', 'list', 'parent_id='.$bobject->parent_id.'&type='.$type);?>" id="shortcut_posts" title="Back to pages listing">

                    <img src="images/shortcut/back.png" alt="posts"/><br/>

                    <strong>Listing</strong>

                </a>

            </li>

      <?php endif;?>









     <?php

     if($section!='insert' && $section!='update'):

    ?>

     <li>

    <a href="<?php echo make_admin_url('content', 'list', 'insert', 'parent_id='.$parent_id.'&type='.$type);?>" id="shortcut_posts" title="Add New Page">

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

        <!-- Begin one column window -->

        <div class="onecolumn">

        <div class="header">

                <span>

                <?php if($parent_id):

                        $pobj= get_object('content', $parent_id);

                        echo $pobj->page_name;

                      else:

                          echo ' Manage '.get_section_name($type).' Pages';

                      endif;

                ?>

                </span>

         </div>

        <br class="clear"/>

        <div class="content">



         <form id="form_data" name="form_data" action="<?=make_admin_url('content', 'update2', 'list', 'id='.$id.'&page='.$page.'&type='.$type)?>" method="post" >

	      <table width="100%" cellspacing="0" cellpadding="0" class="data">

                    <thead>

                        <tr>

                            <th width="20%"  align="left">Page Name</th>
                            <th width="20%"  align="center">Publish Status</th>
                            <th width="20%"  align="center">Position</th>
                            <th width="20%"  align="center">Show in Right Menu</th>
                            <th width="20%"  align="center">Action</th>

                        </tr>

                    </thead>

                    <tbody>

			<?php $sr=1;?>

			<?php if($QueryObj->GetNumRows()):?>

			<?php while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>

                        <tr>

                            <td  align="left" width="20%"><?php echo $QueryObj1->page_name;?></td>
                            <td  align="center" width="20%"><?php echo is_published($QueryObj1->id)?'Published':'Not published'?></td>
                            <td  align="center" width="20%"><input type="text" name="position[<?php echo $QueryObj1->id?>]" value="<?=$QueryObj1->position;?>" size="3" /></td>
                            <td align="center" width="20%"><input type="checkbox" name="show_in_menu[<?=$QueryObj1->id;?>]" <?=$QueryObj1->show_in_menu=='1'?'checked':''?>  style="border:none;" /></td>
                            <td align="center" width="20%">
                              <?php  $section_object=  get_object('section', $type);
                                     $section_slug=$section_object->section_slug;
                                ?>
                                <?php if($QueryObj1->page_type=='content'&& $QueryObj1->link_type=='internal'):?>
                                    <a class="help" href="<?php echo make_admin_url('content', 'update', 'update', 'id='.$QueryObj1->id.'&page='.$page.'&type='.$type)?>" title="Click here to edit this page"  ><?php echo get_control_icon('icon_edit')?></a>&nbsp;&nbsp;
                                    <a class="help" href="<?php echo make_url($section_slug, 'id='.$QueryObj1->id)?>" title="View this page" target="_blank" ><?php echo get_control_icon('zoom')?></a>&nbsp;&nbsp;
                                    <?php if($QueryObj1->id>144):?>
                                      <a class="help" href="<?php echo make_admin_url('content', 'delete', 'view',' parent_id='.$parent_id.'&id='.$QueryObj1->id.'&page='.$page.'&type='.$type)?>" title="Click here to delete this page" onclick="return confirm('Are you sure? You are deleting this page.');" ><?php echo get_control_icon('icon_delete')?></a></td>
                                    <?php endif ;?>
                               <?php endif ?>
                        </tr>

			<?php endwhile;?>
                         <tr>
                            <td></td>
                            <td></td>
                            <td align="center"><input type="submit" name="update_position" value="Update"></td>
                            <td align="center"><input type="submit" name="submit" value="update"></td>
                            <td></td>
                       </tr>

			<?php else:?>

			<tr>

				<td colspan="5" align="center">No Page Found.</td>

			</tr>

			<?php endif;?>

		     </tbody>

		</table>

        </form>

     
        </div>

        </div>

		<?


		break;

	case 'view':

		?>

		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">

				<tr>

					<td valign="middle" width="10%" ><a href="<?php echo make_admin_url('content')?>">&laquo;Back to page listing</a></td>

				</tr>

				<tr>

					<td valign="middle" width="10%" ><?php echo $page_cotent->name;?></td>

				</tr>

				<tr>

					<td align="left" valign="middle" width="10%" >

						<?php echo html_entity_decode($page_cotent->page);?>

					</td>

				</tr>

		</table>

		<?


		break;

	case 'update':

		?>

        <form id="form-data" action="<?php echo make_admin_url('content', 'update', 'list', 'id='.$id.'&parent_id='.$page_cotent->parent_id.'&page='.$page.'&type='.$type)?>" method="POST" name="content">

                <div class="onecolumn">

                

                

                    <div class="header">

                            <span>Edit<?php echo " ".get_section_name($type)." "?> Page</span>

                    </div>

                    <br class="clear"/>

                    <div class="content">

        

		

                        <p>

                            <label>Page Name</label><br/>

                            <input type="text" name="page_name" value="<?php echo $page_cotent->page_name;?>" size="60" tabindex="1">

                        </p><br/>

                                <p>

                            <label>Page Slug</label><br/>

                            <input type="text" name="urlname" size="60" value="<?=$page_cotent->urlname?>" tabindex="4" />

                        </p><br/>
                        
                        <p>

                            <label>Page Contents</label> <br/>

                             <textarea id="wysiwygD" name="page" tabindex="2" cols="65" rows="25"><?php echo html_entity_decode($page_cotent->page);?></textarea>

                        </p><br/>

                        

			

		

                           </div>

                         </div>



                         <div class="twocolumn">

                             <div class="column_left">

                             <div class="header"><span>SEO Information</span></div>

                             <br class="clear" />

                             <div class="content">

                                <p>

                                    <label>Page Title</label><br/>

                                    <input type="text" name="name" value="<?php echo $page_cotent->name;?>" size="60" tabindex="3">

                                </p><br/>

                                   <input type="hidden" name="parent_id" value="<?php echo $page_cotent->parent_id?>">

                                

                                <p>

                                    <label>Keywords</label><br/>

                                    <input type="text" name="meta_keyword" value="<?php echo $page_cotent->meta_keyword;?>" tabindex="5" size="60">

                                </p><br/>

                                <p>

                                    <label>Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="6"><?php echo $page_cotent->meta_description;?></textarea>

                                </p><br/>

                                

                                 <h3>Page Link</h3>

                                 <textarea cols="50" rows="1"><?php echo make_url('content', 'id='.$page_cotent->id);?></textarea>





                             </div>

                             </div>

                             <div class="column_right">

                                 <div class="header"><span>Action</span></div>

                                  <br class="clear" />

                                  <div class="content">
                                       
                                       <p>
                              <label> Show in Right menu </label>            
                                                    <input type="checkbox" name="show_in_menu" tabindex="6" <?=($page_cotent->show_in_menu=='1')?'checked':'';?> />
                         </p><br class="clear"/>
                                       <p>
                                         
                                    <input type="hidden" name="section" value="<?php echo $type?>"/>
                                    <input type="submit" name="save" value="Save" tabindex="7" />

                                    <input type="submit" name="publish" value="Publish" tabindex="8" />

                                </p><br/>

                                      
                                  </div>
                             </div>



                         </div>

                         </form>

                         

		<?

		
		break;

	case 'insert':

		?>

         <form id="form-data"  action="<?php echo make_admin_url('content', 'insert', 'list', 'parent_id='.$parent_id.'&type='.$type)?>" method="POST" name="content">

         <div class="onecolumn">

            

        

          <div class="header">

             <span>Add New <?php echo " ".get_section_name($type)." "?> Page</span>

          </div>

          <br class="clear"/>

           <div class="content">

         

			<input type="hidden" name="parent_id" value="<?php echo $parent_id?>"/>

				<p>

					<label>Page Name</label><br/>

					<input type="text" name="page_name"  size="60" tabindex="1" />

				</p><br/>

                                <p>

					<label>Page Slug</label><br/>

					<input type="text" name="urlname" size="60" tabindex="4" />

				</p><br/>
                              

				<p>

					<label>Page Contents</label></label> <br/>

                    <textarea id="wysiwygD" name="page" tabindex="2" cols="65" rows="25"></textarea>

				</p>

				<br class="clear">

               
                            </div>

                         </div>

        <div class="twocolumn">

            

                         <div class="column_left" style="margin-bottom:20px;">

                             <div class="header">

                                <span>SEO Information</span>

                             </div>

                             <br class="clear" />

                             <div class="content">

                                             <p>

                                    <label>Page Title</label><br/>

                                    <input type="text" name="name"  size="60" tabindex="3">

                                </p><br/>

                                

                                <p>

                                    <label>Keywords</label><br/>

                                    <input type="text" name="meta_keyword" size="60" tabindex="5">

                                    

                                </p><br/>

                                <p>

                                    <label>Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="6"></textarea>

                                </p> <br/>

                                <br class="clear" />

                             </div>

                         </div>

                            <div class="column_right">

                                 <div class="header"><span>Action</span></div>

                                  <br class="clear" />

                                  <div class="content">
                                     
                                    <p>
                              <label> Show in Right menu </label>             
                                                    <input type="checkbox" name="show_in_menu" value="1" tabindex="6"/>
                         </p><br class="clear"/> 
                               <p>
                            
                                   <input type="hidden" name="section" value="<?php echo $type?>"/>
                                 <input type="submit" name="save" value="Save" tabindex="7" /> &nbsp;&nbsp; <input type="submit" name="publish" value="Publish" tabindex="8" />

                               </p>

                                      
                                  </div>
                             </div>


                     </div>

         </form>



		<?

		break;

	default:break;

endswitch;

?>

        

        