<?php

function get_events_bycat($id)
{
	$date=date("Y-m-d");
	$query= new query('event');
	$query->Where="where event_type='$id' and (CAST('$date' as date) <= event_date_show) and is_active='1' order by event_date_show";
     
	$query->DisplayAll();
	return get_all_in_object($query);			
}

function get_events_bycatmy($year, $month, $id='all')
{
	$date=date("Y-m-d");
	$query= new query('event');
	$query->Field="*, DAY(event_date_show) as day, DAY (event_end_date) as eday, MONTH(event_date_show) as month, MONTH(event_end_date) as emonth";
	if($id=='all'):
                $query->Where="where (MONTH(event_date_show)<='$month' AND MONTH(event_end_date)>='$month') AND (YEAR(event_date_show)<='$year' AND YEAR(event_end_date)>='$year') and is_active='1' order by id";
        else:
		$query->Where="where event_type='$id' and  MONTH(event_date_show)='$month' and YEAR(event_date_show)='$year' and is_active='1' order by id";
	endif;
	//$query->print=1;
	$query->DisplayAll();
	return get_all_in_object($query);			
}

function get_today_events(){
        $date=date("Y-m-d");
        $query= new query('event');
	$query->Where="where  CAST('$date' as date)=event_date_show and is_active='1'";
        $query->DisplayAll();
	return get_all_in_object($query);
}

function event_type($selected=''){
	global $eventType;
	$array=$eventType;
	foreach ($array as $k=>$v):
		if($v==$selected):
			echo '<option value="'.$v.'" selected>'.ucwords($v).'</option>';
		else:
			echo '<option value="'.$v.'">'.ucwords($v).'</option>';
		endif;
	endforeach;
}

        
function expire_year($total=20, $selected='')
{
$year=date("Y");
echo '<option value="">Select Year</option>';
for($i=0;$i<$total;$i++):
if($i+$year==$selected):
echo '<option value="'.($year+$i).'" selected>'.($year+$i).'</option>';
else:
echo '<option value="'.($year+$i).'">'.($year+$i).'</option>';
endif;
endfor;
}
	
function expire_month($selected='')
{
	$month=array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun', '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');
	echo '<option value="">Select Month</option>';
	for($i=1;$i<13;$i++):
		if($i==$selected):
			echo '<option value="'.$i.'" selected>'.$month[$i].'</option>';
		else:
			echo '<option value="'.$i.'">'.$month[$i].'</option>';
		endif;
	endfor;
}
?>
