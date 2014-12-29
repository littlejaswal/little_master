<!-- / Main navigation-->
<nav class="mainnav l">
        <ul id="mainnav" class="sf_menu clearfix">
                <li>
                    <a href="<?php echo make_admin_url('home', 'list', 'list');?>" title="Dashboard"><img src="images/icons/helloadmin/dashboard.png" alt="" /><span>Dashboard</span></a>
                </li>
               
                <li><a href="#" title="Primary Modules"><img src="images/icons/helloadmin/layouts.png" alt="" /><span>Primary Modules</span></a>
                        <ul>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/content.php');?>
                             </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/gallery.php');?>
                             </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/news.php');?>
                             </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/content_navigation.php');?>
                             </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/banner.php');?>
                             </li>
                            <!-- <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/keywords_management.php');?>
                             </li>-->
                             <li class="last">
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/admin.php');?>
                             </li>
                              
                         </ul>
                </li>
                <li><a href="#" title="Addtional Modules"><img src="images/icons/helloadmin/modules.png" alt="" /><span>Additional Modules</span></a>
                       <!--  <ul>
                            
                            <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/event.php');?>
                            </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/jobposting.php');?>
                            </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/videos.php');?>
                            </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/directory.php');?>
                            </li>

                            <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/links.php');?>
                            </li>
                             <li>
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/meet_the_team.php');?>
                            </li>
                             <li class="last">
                                <?php include_once(DIR_FS_SITE.ADMIN_FOLDER.'/top/faq.php');?>
                            </li>
                        </ul>-->
                </li>
                <li>
                    <a href="<?php echo make_admin_url('setting', 'list', 'list');?>" title="Settings"><img src="images/icons/helloadmin/features.png" alt="" /><span>Settings</span></a>
                        
                </li>
        </ul>
</nav>
<!-- / End main navigation-->