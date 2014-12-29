<!-- Begin shortcut menu -->



<ul id="shortcut">

    <li>  <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">

            <img src="images/shortcut/setting.png" alt="setting"/><br/>

            <strong>Setting</strong>

          </a>

        </li>

  

   

    <?php if($section=='insert' or $section=='update'):?>

            <li>

                <a href="<?php echo make_admin_url('content', 'list', 'list', 'parent_id='.$parent_id);?>" id="shortcut_posts" title="Back To Pages Listing">

                <img src="images/shortcut/back.png" alt="posts"/><br/>

                <strong>Listing</strong>

            </a>

            </li>

     <?php

     elseif(isset($parent_id) && $parent_id):

           $bobject=get_object('content', $parent_id);

         ?>

            <li>

                <a href="<?php echo make_admin_url('content', 'list', 'list', 'parent_id='.$bobject->parent_id);?>" id="shortcut_posts" title="Back To Pages Listing">

                    <img src="images/shortcut/back.png" alt="posts"/><br/>

                    <strong>Listing</strong>

                </a>

            </li>

      <?php endif;?>









     <?php

     if($section!='insert' && $section!='update'):

    ?>

     <li>

    <a href="<?php echo make_admin_url('content', 'list', 'insert', 'parent_id='.$parent_id);?>" id="shortcut_posts" title="Add New Page">

    <img src="images/shortcut/posts.png" alt="posts"/><br/>

    <strong>New</strong>

    </a>

    </li>

    <?php endif;?>

    

</ul>

<!-- End shortcut menu -->



<!-- Begin shortcut notification -->



<!--<div id="shortcut_notifications">

        <span class="notification" rel="shortcut_home">10</span>

        <span class="notification" rel="shortcut_contacts">5</span>

        <span class="notification" rel="shortcut_posts">1</span>

</div>

<!-- End shortcut noficaton -->

<!--<br class="clear"/>-->

<br class="clear"/>

<?php

#handle sections here.



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

                          echo 'Content Pages';

                      endif;

                ?>

                </span>

         </div>

        <br class="clear"/>

        <div class="content">



         <form id="form_data" name="form_data" action="<?=make_admin_url('content', 'update2', 'list', 'id='.$id.'&page='.$page)?>" method="post" >

	      <table width="100%" cellspacing="0" cellpadding="0" class="data">

                    <thead>

                        <tr>

                            <!--<td width="5%"  >Sr.</td>-->

                            <th width="25%"  align="left">Page Name</th>

                          

                            <th width="15%"  align="center">Publish Status</th>

                            <th width="20%"  align="center">Action</th>

                        </tr>

                    </thead>

                    <tbody>

			<?php $sr=1;?>

			<?php if($QueryObj->GetNumRows()):?>

			<?php while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>

                        <tr>

                            <td  align="left" width="25%"><?php echo $QueryObj1->page_name;?></td>

                            <td  align="center" width="15%">
							<?php if($QueryObj1->is_preview):?>
<a href="<?php echo make_admin_url('content', 'status', 'status', 'id='.$QueryObj1->id.'&status=0&page='.$page);?>" title="click to set status on"><?php echo get_control_icon('off');?></a>
					<?php else:?>
<a href="<?php echo make_admin_url('content', 'status', 'status', 'id='.$QueryObj1->id.'&status=1&page='.$page);?>" title="click to set status off"><?php echo get_control_icon('on');?></a>
					<?php endif;?>
							
							<?php //echo is_published($QueryObj1->id)?'Published':'Not published'?>
							
							
							</td>

                            <td align="center" width="20%">

                                <a class="help" href="<?php echo make_admin_url('content', 'update', 'update', 'id='.$QueryObj1->id.'&page='.$page)?>" title="Click here to edit this page"  ><?php echo get_control_icon('icon_edit')?></a>&nbsp;&nbsp;

                           
  <a class="help" href="<?php echo make_admin_url('content', 'delete', 'view',' parent_id='.$parent_id.'&id='.$QueryObj1->id.'&page='.$page)?>" title="Click here to delete this page" onclick="return confirm('Are you sure? You are deleting this page.');" ><?php echo get_control_icon('icon_delete')?></a></td>

                        </tr>

			<?php endwhile;?>

			<?php else:?>

			<tr>

				<td colspan="3" align="center">No Page Found.</td>

			</tr>

			<?php endif;?>

		     </tbody>

		</table>

        </form>

            <?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=content&parent_id='.$parent_id, 2);?>

        </div>

        </div>

		<?

		#html code here.

		break;

	case 'view':

		?>

		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">

				<tr>

					<td valign="middle" width="10%" ><a href="<?php echo make_admin_url('content')?>">&laquo;Back To Page Listing</a></td>

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

		#html code here.

		break;

	case 'update':

		?>

        <form id="form-data" action="<?php echo make_admin_url('content', 'update', 'list', 'id='.$id.'&parent_id='.$page_cotent->parent_id.'&page='.$page)?>" method="POST" name="content">

                <div class="onecolumn">

                

                

                    <div class="header">

                            <span>Edit Page</span>

                    </div>

                    <br class="clear"/>

                    <div class="content">

        

		

                        <p>

                            <label>Page Name</label><br/>

                            <input type="text" name="page_name" value="<?php echo $page_cotent->page_name;?>" size="60" tabindex="1">

                        </p><br/>

                        <p>

                            <label>Page Heading</label><br/>

                            <input type="text" name="page_heading" value="<?php echo $page_cotent->page_heading;?>" size="60" tabindex="1">

                        </p><br/>						
						

                                <p>

                            <label>Page Slug</label><br/>

                            <input type="text" name="urlname" size="60" value="<?=$page_cotent->urlname?>" tabindex="2" />

                        </p><br/>

                        <p>

                            <label>Left Page Contents</label> <br/>

<textarea id="wysiwygD" name="page" tabindex="3" cols="65" rows="25"><?php echo html_entity_decode($page_cotent->page);?></textarea>

                        </p><br/>

               

				<br/>

			

		

                           </div>

                         </div>



                         <div class="twocolumn">

                             <div class="column_left">

                             <div class="header"><span>Page Information</span></div>

                             <br class="clear" />

                             <div class="content">

                                <p>

                                    <label>Page Title</label><br/>

                                    <input type="text" name="name" value="<?php echo $page_cotent->name;?>" size="60" tabindex="4">

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

                                 <textarea cols="50" rows="1"  tabindex="7" ><?php echo make_url('content', 'id='.$page_cotent->id);?></textarea>





                             </div>

                             </div>

                             <div class="column_right">

                                 <div class="header"><span>Assign to Menu</span></div>

                                  <br class="clear" />

                                  <div class="content">

                            <p>

                                <label>Menu Title </label> <br>

                                    <input type="text" name="menu_title"  tabindex="8" value="<?php echo (isset($nObj)&& is_object($nObj))?$nObj->navigation_title:'';?>" size="40" />

                                    </br>

                            </p><br/>
						<!--
                            <p>

                                <label>

                                    Select Page Parent</label><br/>

                                    <select name="menu_parent" size="10" style="width:200px;" tabindex="9" >

                                        <?php// echo get_navigation_options((isset($nObj)&& is_object($nObj))?$nObj->parent_id:'0');?>

                                    </select>

                                    

                            </p><br/>
								
						
                            <?php// if(isset($nObj) && is_object($nObj)):?>

                            <p>

                                

                             <input type="checkbox" value="<?php// echo $nObj->id?>" name="remove_menu" />&nbsp;<label>Remove this item from menu</label>

                                

                                

                            </p><br/>

                            <?php// endif;?>

                            <p>

                                <label>To manage menus please <a href="<?php// echo make_admin_url('content_navigation');?>">click here</a></label>

                                

                            </p>

                        

                                   <br/>

                              -->        

                                      

                                      <p>

                                    <input type="submit" name="save" value="Save" tabindex="10" />

                                    <input type="submit" name="publish" value="Publish" tabindex="11" />

                                </p><br/><br/>



                                  </div>



                             </div>



                         </div>

                         </form>

                         

		<?

		#html code here.

		break;

	case 'insert':

		?>

         <form id="form-data"  action="<?php echo make_admin_url('content', 'insert', 'list', 'parent_id='.$parent_id)?>" method="POST" name="content">

         <div class="onecolumn">

            

        

          <div class="header">

             <span>Add New Page</span>

          </div>

          <br class="clear"/>

           <div class="content">

         

			<input type="hidden" name="parent_id" value="<?php echo $parent_id?>"/>

				<p>

					<label>Page Name</label><br/>

					<input type="text" name="page_name"  size="60" tabindex="1" />

				</p><br/>
				
				<p>

					<label>Page Heading</label><br/>

					<input type="text" name="page_heading"  size="60" tabindex="2" />

				</p><br/>				
				

                                <p>

					<label>Page Slug</label><br/>

					<input type="text" name="urlname" size="60" tabindex="3" />

				</p><br/>
                                  
                                
                                
				<p>

					<label>Left Page Contents</label></label> <br/>

                    <textarea id="wysiwygD" name="page" tabindex="4" cols="65" rows="25"   ></textarea>

				</p>

				<br class="clear">

               

				<br class="clear">
                                
                              
                            </div>

                         </div>

        <div class="twocolumn">

            

                         <div class="column_left" style="margin-bottom:20px;">

                             <div class="header">

                                <span>Page Information</span>

                             </div>

                             <br class="clear" />

                             <div class="content">

                                             <p>

                                    <label>Page Title</label><br/>

                                    <input type="text" name="name"  size="60" tabindex="5">

                                </p><br/>

                                

                                <p>

                                    <label>Keywords</label><br/>

                                    <input type="text" name="meta_keyword" size="60" tabindex="6">

                                    

                                </p><br/>

                               <p>

                                    <label>Description</label><br/>

                                    <textarea name="meta_description" cols="50" rows="5" tabindex="7"></textarea>

                                </p> <br/>

                                <br class="clear" />

                             </div>

                         </div>

                        <div class="column_right">

                            <div class="header"><span>Add This Page To Menu</span></div>

                             <br class="clear" />

                             <div class="content">
							
                                        <p>

                                            <label>Menu Title </label> <br/>

                                            <input type="text" name="menu_title" tabindex="8" value="<?php (isset($nObj)&& is_object($nObj))?$nObj->navigation_title:'';?>" size="40" />

                                              
                                        </p>

                                         <!--
                                        <p>
                                            <label>Select Page Parent</label> <br/>

                                                <select name="menu_parent" size="10" style="width:200px;"  tabindex="9" >

                                                    <?php// echo get_navigation_options((isset($nObj)&& is_object($nObj))?$nObj->navigation_query:'0');?>

                                                </select>

                                            <br/>
                                        </p> 
									-->	
                                        <br class="clear" /> <br class="clear" />

                               <p>

                                 <input type="submit" name="save" value="Save" tabindex="10" /> &nbsp;&nbsp; <input type="submit" name="publish" value="Publish" tabindex="10" />

                               </p>

                                 <br class="clear" />

                             </div>

                        </div>

                     </div>

         </form>



		<?

		#html code here.

		break;

	default:break;

endswitch;

?>

        

        