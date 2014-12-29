<?php 
$array=array(
	 'content'=>'content',
         'gallery'=>'gallery',
	 'event'=>'event',
	 'news'=>'news',
         'videos'=>'videos',
         'directory'=>'directory',
         'links'=>'links',
         'meet_the_team'=>'meet_the_team',
         'faq'=>'faq',
         'jobposting'=>'jobposting',
	 'minutes'=>'minutes',
         'admin'=>'admin',
         'banner'=>'banner',
         'setting'=>'setting'
);
?>

<!-- Begin left panel -->
<a href="javascript:;" id="show_menu">&raquo;</a>
<div id="left_menu">
        <a href="javascript:;" id="hide_menu">&laquo;</a>
        <ul id="main_menu">
            <? if($PageAccess=='*'):?>
                 <li><a href="<?php echo make_admin_url('home', 'list', 'list');?>"><img src="images/icon_home.png" alt="Home"/>Home</a></li>
               
                <li>
                    <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/content.php');
                    //echo DIR_FS_SITE.ADMIN_FOLDER;
                    ?>
                </li>                
                  <!-- 
				 <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/event.php');?>
                </li>
                 <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/news.php');?>
                </li>
               <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/videos.php');?>
                </li>			
                 <li>
                    <?php //include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/directory.php');?>
                </li>
				<!--                
				<li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/meet_the_team.php');?>
                </li>
				
                 <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/faq.php');?>
                </li>
                 
				 <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/jobposting.php');?>
                </li>
				
                 <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/minutes.php');?>
                </li>
				
				  <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/banner.php');?>
                </li>
				 <li>
                    <?php// include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/gallery.php');?>
                </li>
				-->
                 <li>
                    <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/links.php');?>
                </li>				
                <li>
                    <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/admin.php');?>
                </li>           
                
                 <li>
                    <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/setting.php');?>
                </li>
                <?php else:?>
                 <li><a href="<?php echo make_admin_url('home', 'list', 'list');?>"><img src="images/icon_home.png" alt="Home"/>Home</a></li>
               
               <?php foreach($array as $kkk=>$vvv):?>
                 <?php foreach($PageAccess as $kk=>$vv):?>
                    <?php if($vv==$vvv):?>
                <li>
                    <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/left/'.$kkk.'.php');
                   
                    ?>
                </li>
                <?php endif;?>
                <?php endforeach;?>
                <?php endforeach;?>
                <?php endif;?>
        </ul>
        <br class="clear"/>
        <!-- Begin left panel calendar -->
        <div id="calendar"></div>
        <!-- End left panel calendar -->
        <br class="clear">
</div>
<!-- End left panel -->
