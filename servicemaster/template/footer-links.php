<div id="footerservicelink">
 	 <span id="footer_title">Our Services & Service Areas:</span>
		<?php $cities=get_all_cities();?>
		<?php if(count($cities)):?>
	<div id="cities">
		<?php foreach ($cities as $k=>$v):?>
			<div class="city"><strong><?php echo $v->caption?></strong>:&nbsp;<?php echo $v->description;?></div><br />
		<?php endforeach;?>
	</div>
		<?php endif;?>
		<?php $services=get_all_services();?>
		<?php if(count($services)):?>
	<div id="services">
		<?php foreach ($services as $k=>$v):?>
	<div class="city">
        <a href="http://<?php echo $v->description;?>" target="_parent" style="color:#000;"><strong ><?php echo $v->caption?></strong></a>
     </div>
		<?php endforeach;?>
	</div>
		<?php endif;?><br /><br />
</div>
