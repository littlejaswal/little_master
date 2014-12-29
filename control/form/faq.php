<script language="javascript">
$("document").ready(function(){
    $("#selectall").click(function(){
       if($(this).is(":checked")){
            $("#form_data input:checkbox").each(function(){
               $(this).attr("checked", true);
            });
       }
       else {
             $("#form_data input:checkbox").each(function(){
               $(this).attr("checked", false);
            });
       }
    });
});
</script>
<ul id="shortcut">
    <li>  
        <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Edit chalet">
            <img src="images/shortcut/setting.png" alt="setting"/><br/>
            <strong>Setting</strong>
          </a>
    </li>

    <?php if($section=='update'):?>
    <li>
        <a href="<?php echo make_admin_url('faq', 'list', 'list');?>" id="shortcut_posts" title="Back to faq listing">
            <img src="images/shortcut/back.png" alt="posts"/><br/>
            <strong>FAQ</strong>
        </a>
    </li>
     <?php endif;?>
    <?php if($section=='insert'):?>
     <li>
    <a href="<?php echo make_admin_url('faq', 'list', 'list');?>" id="shortcut_posts" title="Back to faq listing">
       <img src="images/shortcut/back.png" alt="posts"/><br/>
        <strong>FAQ</strong>
    </a>
    </li>
    <?php endif;?>

     <?php if($section!='insert' && $section!='update'):?>
     <li>
    <a href="<?php echo make_admin_url('faq', 'list', 'insert');?>" id="shortcut_posts" title="Add new faq">
        <img src="images/shortcut/posts.png" alt="posts"/><br/>
        <strong>New</strong>
    </a>
    </li>
    <?php endif;?>

</ul>
<br class="clear" />
<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
        <div class="onecolumn">
        <div class="header">

                <span>

                Frequently Asked Question

                </span>

         </div>

        <br class="clear"/>
          <div class="content">
        <form id="form_data" action="<?=make_admin_url('faq', 'update2', 'list', 'page='.$page.'&id='.$id)?>" method="post" name="">
       <table width="100%" cellspacing="0" cellpadding="0" class="data">
          <thead>
			<tr>
				<th width="40%" class="table_head">Question</th>
                <th align="center" width="15%" class="table_head">Position</th>
				<th align="center" width="15%" class="table_head">Status</th>
				<th class="table_head" align="center" width="25%">Action
                 <input type="checkbox" value="1" name="selectall" id="selectall"  style="margin:0px;padding:0px; vertical-align:middle; margin-left:35px;">
                </th>
			</tr>
           </thead>
            <tbody>
           <?$sr=1;while($faq=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="40%" align="left"><?=stripslashes($faq->question)?></td>
                 <td align="center" width="15%" >
                  <input type="text" name="position[<?php echo $faq->id?>]" value="<?=$faq->position;?>" size="3" />
                   </td>
				<td align="center" width="15%">
                <input type="checkbox" name="is_active[<?=$faq->id;?>]" <?=$faq->is_active=='1'?'checked':''?>  style="border:none;" />
                </td>
				<td align="center" width="25%">
				<?=make_admin_link(make_admin_url('faq', 'update', 'update', 'id='.$faq->id), get_control_icon('edit'));?>&nbsp;&nbsp;
                
                  <a href="<?php echo make_admin_url('faq', 'delete', 'list', 'id='.$faq->id); ?>"onclick="return confirm('Are you sure? You are deleting this page.');" > <?php echo get_control_icon('cancel');?></a>
				  <input type="checkbox" value="1" id="multiopt[<?php echo $faq->id?>]" name="multiopt[<?php echo $faq->id?>]" class="selected" style="margin:0px;padding:0px; vertical-align:middle; margin-left:35px;" >
				</td>
			</tr>
			<?php endwhile;?>
			<tr><td></td><td align="center" valign="middle">
            <input type="submit" name="update_position" value="Update" /></td>
				  <td align="center" ><input type="submit" name="submit" value="update"></td>
                   <td align="center">
                <select name="multiopt_action">
                        <option value="delete">Delete</option>
                 </select><input type="submit" name="multiopt_go" value="Go"  onclick="return confirm('Are you sure?');" />
                </td>
			</tr>
            </tbody>
		</table>
		</form>
        <?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=faq', 2);?>
        </div>
        </div>
		<?
		break;
	case 'insert':
		#html code here.
		?>
        
       <form id="news_insert" action="<?=make_admin_url('faq', 'insert', 'list')?>" method="post" name="news_insert">

           <div class="twocolumn">

            <div class="column_left" style="margin-bottom:20px;">

                             <div class="header">

                                <span>Add New FAQ</span>

                             </div>

                             <br class="clear" />

                             <div class="content">
					<p>
					<label>Question</label><br/>
					<input type="text"  name="question" size="60" />

				</p><br/>

                                <p>

					<label>Answer</label><br/>

					 <textarea id="wysiwygD" name="answer" cols="50" rows="5" ></textarea>

				</p><br/>
                <p>

					<label>Position</label> <br/>

                  <input type="text" name="position" value="" size="4" tabindex="3"/>

				</p><br />

				<p>

					<label>Status</label></label> <br/>

                   <input type="checkbox" name="is_active" value="1" tabindex="2" />

				</p>

					<br/>

				

				<br class="clear">
                
                
                <br class="clear" />

                             </div>

                         </div>

                        <div class="column_right">

                            <div class="header"><span>Action</span></div>

                             <br class="clear" />

                             <div class="content">
                
                					<input type="submit" name="submit" value="Submit" tabindex="4" />
                
                
                </div></div>
                </div>
         </form>
        
		
		<?
		break;
	case 'update':
		#html code here.
		?>
        <form id="news_insert" action="<?=make_admin_url('faq', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert">

           <div class="twocolumn">

            <div class="column_left" style="margin-bottom:20px;">

                             <div class="header">

                                <span>Edit FAQ</span>

                             </div>

                             <br class="clear" />

                             <div class="content">

					<label>Question</label><br/>
					<input type="text"  name="question" size="60" value="<?=$news->question?>" />

				</p><br/>

                                <p>

					<label>Answer</label><br/>

					 <textarea id="wysiwygD" name="answer" cols="50" rows="5" ><?=$news->answer?></textarea>

				</p><br/>
                <p>

					<label>Position</label> <br/>

                  <input type="text" name="position" value="<?=$news->position?>" size="4" tabindex="3"/>

				</p><br />

				<p>

					<label>Status</label></label> <br/>

                   <input type="checkbox" name="is_active" value="1" <?=($news->is_active)?'checked':'';?> tabindex="2" />

				</p>

					<br/>

				

				<br class="clear">
                
                
                <br class="clear" />

                             </div>

                         </div>

                        <div class="column_right">

                            <div class="header"><span>Action</span></div>

                             <br class="clear" />

                             <div class="content">
                
                					<input type="submit" name="submit" value="Submit" tabindex="4" />
                
                
                </div></div>
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
