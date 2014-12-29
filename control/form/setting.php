<?php
echo display_message(1);
#handle sections here.
switch ($section):
	case 'list':
            
		#html code here.
		?>
          <!-- Begin one column window -->
                <div class="onecolumn"> 
                    <div class="header">
                        <span>Website Settings</span>

                    </div>
                    <div class="content">
                        <div id="threecolumn" class="threecolumn ui-sortable">
			<?php $sr=1;
                 while ($object= $QueryObj->GetObjectFromRecord()):?>
                 
              
                    
                                <?php if($object->name!=$name):?>
                                <?php $ob=getSettingsByName($object->name);
                                if(count($ob)):?>

                            <div class="threecolumn_each" style="margin-bottom:10px;">
                                   <form action="<?php echo make_admin_url('setting', 'update', 'list');?>" method="POST" name="form_data" class="onecol">
                                          <div class="header">
                                            <span><?php echo ucfirst($object->name);?> settings</span>
                                            <?php $name=$object->name;?>
                                          </div>
                                          <br class="clear" />
                                          <div class="content">
                                          <?php
                                            foreach($ob as $kk=>$vv):
					?>
                                        <p>
                                                <label ><?php echo ucfirst($vv['title']);?></label><br />
                                                <?php echo get_setting_control($vv['id'], $vv['type'], $vv['value']);?>
                                        </p>
                                        <br class="clear" />
                                      <?php endforeach;?>
                                        </div>
                                        <p>
                                            <div style=" width:90%; text-align:right; " >
                                                <label>&nbsp;</label>
                                                <input type="submit" name="Submit" value="Update">
                                            </div>
                                        </p>
                                    </form><br class="clear" />
                     		</div>
                            <?php endif;?>
                              <?php endif;?>
                    
                    
			<?php endwhile;?>
                        </div><br class="clear" />
		</div>
                    </div>
            
		<?
		break;
	case 'insert':
		#html code here.
		break;
	case 'update':
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
