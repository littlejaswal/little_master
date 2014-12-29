<?php 
/* Modules names */
$array=array(
         'Home'=>'home',
	 'content'=>'content',
         'gallery'=>'gallery',
         'Gallery Image'=>'gallery_image',
	 'event'=>'event',
	 'news'=>'news',
         'videos'=>'videos',
         'Business Category'=>'business_category',
         'Business'=>'directory',
         'Links Heading'=>'link_heading',
         'links'=>'links',
         'Departments'=>'department',
         'team'=>'meet_the_team',
         'faq'=>'faq',
         'jobposting'=>'jobposting',
	 'minutes'=>'minutes',
         'admin'=>'admin',
         'sliders'=>'banner',
         'setting'=>'setting',
         'Logout'=>'logout'
);
?>

<!-- Begin shortcut menu -->
<ul id="shortcut">
    <li>  <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit Settings">
            <img src="images/shortcut/setting.png" alt="setting"/><br/>
            <strong>Setting</strong>
          </a>
        </li>


    <?php if($section=='insert' or $section=='update'):?>
       
    <li>
        <a href="<?php echo make_admin_url('admin', 'list', 'list');?>" id="shortcut_posts" title="Back to User Listing">
        <img src="images/shortcut/posts.png" alt="posts"/><br/>
        <strong>Listing</strong>
    </a>
    </li>
    <?php
    endif;
     if($section=='list'):
    ?>
     <li>
    <a href="<?php echo make_admin_url('admin', 'list', 'insert');?>" id="shortcut_posts" title="Add New User">
    <img src="images/shortcut/posts.png" alt="posts"/><br/>
    <strong>New</strong>
    </a>
    </li>
    <?php endif;?>

</ul>
<br class="clear" />
<script language="javascript">
$("document").ready(function(){
    $("#selectall").click(function(){
       if($(this).is(":checked")){
            $("#form input:checkbox").each(function(){
               $(this).attr("checked", true);
            });
       }
       else {
             $("#form input:checkbox").each(function(){
               $(this).attr("checked", false);
            });
       }
    });
});
</script>
<script language="javascript" src="<?=DIR_WS_SITE_JAVASCRIPT?>gen_validatorv2.js"></script>
<?
display_message(1);
switch ($section):
	case 'list':
		?>
        <div class="onecolumn">
         <form id="form" action="<?=make_admin_url('admin', 'update2', 'list', 'page='.$page.'&id='.$id)?>" method="post" name="">
        <div class="header">
        <span>Users</span>
          </div>
         <br class="clear"/>
         <div class="content">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data">
		<p></p>
		<thead>
            <tr>
				<th class="table_head" width="25%" align="left">Username</th>
				<th class="table_head" width="25%" align="left">Password</th>
               <th class="table_head" width="20%" align="center">Status</th>
				<th class="table_head" align="center" width="30%" >Action
                </th>
			</tr>
             </thead>
        <tbody>
		<?$sr=1;
			while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td class="table_cell" align="left" width="25%" ><?php echo $QueryObj1->username;?></td>
				<td class="table_cell" align="left" width="25%" ><?php echo $QueryObj1->password;?></td>
               <td align="center" width="20%" >
               <?php if($QueryObj1->is_active):?>
							<a href="<?php echo make_admin_url('admin', 'status', 'status', 'id='.$QueryObj1->id.'&status=0&page='.$page);?>" class="help" title="click to set status off"><?php echo "On";?></a>
					<?php else:?>
							<a href="<?php echo make_admin_url('admin', 'status', 'status', 'id='.$QueryObj1->id.'&status=1&page='.$page);?>" class="help" title="click to set status on"><?php echo "Off";?></a>
					<?php endif;?>
            
               </td>
				<td align="center" width="30%">
					<a href="<?php echo make_admin_url('admin', 'update', 'update', 'id='.$QueryObj1->id)?>" class="help" title="click here to edit this record"><?php echo get_control_icon('edit')?></a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?php echo make_admin_url('admin', 'delete', 'list', 'id='.$QueryObj1->id.'&delete=1')?>" onclick="return confirm('Are you sure? You are deleting this Record.');" class="help" title="click here to delete this record" ><?php echo get_control_icon('cancel')?></a>
               
                    </td>
				</tr>
			<?endwhile;?>
		</tbody>
        </table>
        <br class="clear" />
           <?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=admin ', 2);?>
        </div>
        </form>
        </div>
		<br/>
		
		<?
		break;
	case 'insert':
		?>
        <div class="twocolumn">
                   <form action="<?php echo make_admin_url('admin', 'insert', 'list')?>" method="POST" enctype="multipart/form-data" id="register">
                 <div class="column_left">
                    <div class="header">
                            <span>Add New User</span>
                    </div>
                    <br class="clear"/>
                    <div class="content">
        		<p>
					<label>Username</label> <br class="clear"/>
					<input type="text" name="username" size="30" tabindex="1" />
				</p> <br class="clear"/>
              <p>
					<label> Password</label> <br class="clear"/>
					<input type="password" name="password" size="30" tabindex="2" />
				</p> <br class="clear"/>
               <p>
					<label>Status</label><input type="checkbox" name="is_active" value="1" tabindex="3" />

				</p> <br class="clear"/>
				 <p>
					<label>All Permissions</label>
						<input type="checkbox" name="allow_pages_all" value="*" tabindex="4" />
						
				</p> <br class="clear"/>
				
				
				<p>
                                <lable><strong>Grant Permissions</strong></lable><br class="clear"/><br class="clear"/>
                                <table style="width:270px;margin:0px;padding:0px;">
                                    <?php foreach($array as $kkk=>$vvv):?>
                                    <tr>
                                        <td style="line-height: 30px;"><strong><?php echo ucfirst($kkk);?></strong></td>
                                        <td style="line-height: 30px;"><input type="checkbox" name="allow_pages[<?php echo $kkk?>]" value="<?php echo $vvv ?>"/></td>
                                    </tr>
                                     <?php endforeach;?>
                                </table>
                              </p>
			 
                         </div>
                         </div>
                         <div class="column_right" style="margin-bottom: 20px;">
                             <div class="header">
                                <span>Options</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                                <input type="submit" name="submit" value="Submit" tabindex="4" /><br class="clear"/><br class="clear"/>
                                 <input type="submit" name="cancel" value="Cancel" tabindex="7" /><br class="clear"/>
                             </div>
                         </div>
                      
                    </form>
               </div>
      
		<?
		break;
	case 'update':
	?>
    <div class="twocolumn">
                   <form action="<?php echo make_admin_url('admin', 'update', 'list','id='.$page_cotent->id)?>" method="POST" enctype="multipart/form-data" id="register">
                 <div class="column_left">
                    <div class="header">
                            <span>Edit User</span>
                    </div>
                    <br class="clear"/>
                    <div class="content">
        		<p>
					<label>Username</label> <br class="clear"/>
					<input type="text" name="username" value="<?php echo $page_cotent->username;?>" size="30" tabindex="1" />
				</p> <br class="clear"/>
              <p>
					<label> Password</label> <br class="clear"/>
					<input type="password" value="<?php echo $page_cotent->password;?>" name="password" size="30" tabindex="2" />
				</p> <br class="clear"/>
               <p>
					<label>Status</label><input type="checkbox" name="is_active" value="1" tabindex="3" <?php echo ($page_cotent->is_active)?'checked':'';?> />
					<input type="hidden" name="id" value="<?php echo $page_cotent->id?>">
				</p> <br class="clear"/>
                               
                                <p>
					<label>All Permissions</label>
						<input type="checkbox" name="allow_pages_all" value="*" tabindex="4" <?php echo ($page_cotent->allow_pages=='*')?'checked':'';?>  />
						
				</p> <br class="clear"/>
                               
                                <p>
                                <lable><strong>Grant Permissions</strong></lable><br class="clear"/><br class="clear"/>
                                <table style="width:270px;margin:0px;padding:0px;">
                                    <?php $grant=explode("@@",($page_cotent->allow_pages));?>
                                    <?php foreach($array as $kkk=>$vvv):?>
                                    <tr>
                                        <td style="line-height: 30px;"><strong><?php echo ucfirst($kkk);?></strong></td>
                                        <td style="line-height: 30px;">
                                            <?php if(in_array($vvv, $grant)):?>
                                                        <input type="checkbox" name="allow_pages[<?php echo $kkk?>]" value="<?php echo $vvv ?>" checked/>
                                                <?php else:?>
                                                        <input type="checkbox" name="allow_pages[<?php echo $kkk?>]" value="<?php echo $vvv ?>" />
                                                <?php endif;?>
                                        </td>
                                    </tr>
                                     <?php endforeach;?>
                                </table>
                              </p>
                            </div>
                         </div>
                         <div class="column_right" style="margin-bottom: 20px;">
                             <div class="header">
                                <span>Options</span>
                             </div>
                             <br class="clear" />
                             <div class="content">
                                <input type="submit" name="submit" value="Submit" tabindex="4" /><br class="clear"/><br class="clear"/>
                                 <input type="submit" name="cancel" value="Cancel" tabindex="7" /><br class="clear"/>
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
