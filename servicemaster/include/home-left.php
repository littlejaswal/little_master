<div id="leftpanel">
    <div id="ourservicepanel">
      <div id="ourservicetop">
        <div id="ourservicestext">Our Services</div>
      </div>
      <div id="ourservicesmiddle">
        <div id="restorationpanel">
          <div id="restorationtext">Restoration</div>
       
       <div id="writtentext">
           	<?php
	$services_pages=array();
	$services_pages=get_content_children('8', 0, array('page_name', 'id', 'urlname'));
	?>
	
	<?	 foreach ($services_pages as $sk=>$sv):	?>
	<li>
		<a href="<?php echo make_url('content', 'id='.$sv->id.'&pn='.$sv->urlname);?>"><?php echo $sv->page_name;?></a>
	</li>
	<?   endforeach;?>
    </div>
        </div>
        
        
        <div id="cleaningpanel">
          <div id="cleaningtext">Cleaning</div>
          <div id="cleaningtext1">
          
        
           	<?php
	$services_pages=array();
	$services_pages=get_content_children('9', 0, array('page_name', 'id', 'urlname'));
	?>
	
	<?	 foreach ($services_pages as $sk=>$sv):	?>
	<li>
		<a href="<?php echo make_url('content', 'id='.$sv->id.'&pn='.$sv->urlname);?>"><?php echo $sv->page_name;?></a>
	</li>
	<?   endforeach;?>
    </div>
        </div>
      </div>
      <div id="ourservicesbottom"></div>

  
  <div id="leftdownpanel">
    <div id="pressroomtop"></div>
    <div id="pressmiddl">
      <div id="pressroompanel">
        <div id="pressroomtext">Press Room</div>
        <div id="pic1"></div>
        <div id="presstextwritten">
         <?php echo limit_text(strip_tags(html_entity_decode($content1->page)), 200);?> ...
        <div id="viewmore1"> <a href="<?php echo make_url('press-room-detail');?>">View More &gt;&gt;</a></div>
        </div>
      </div>
      <div id="socialresponsiblepanel">
        <div id="socialresponsibility">Social Responsibility</div>
        <div id="pic2"></div>
        <div id="socialtext">
         <?php echo limit_text(strip_tags(html_entity_decode($content2->page)),200);?> ...
<div id="viewmore2"> <a href="<?php echo make_url('social-responsibility-detail');?>">View More &gt;&gt;</a></div>
        </div>
      </div>
    </div>
    <div id="pressbottom"></div>
  </div> 
  
    <div id="servicemasterlogobottom">
    <div id="logobottom"></div>
    <div id="logobottom1"></div>
  </div>
  </div></div>

  