<?php 
function get_events_bycatmy($id, $year, $month)
{
	$date=date("Y-m-d");
	$query= new query('event');
	$query->Field="*, DAY(event_date) as day";
	if($id=='all'):
		$query->Where="where MONTH(event_date)='$month' and YEAR(event_date)='$year' order by id";
	else:
		$query->Where="where event_type='$id' and  MONTH(event_date)='$month' and YEAR(event_date)='$year' order by id";
	endif;
	#$query->print=1;
	$query->DisplayAll();
	return get_all_in_object($query);			
}
function expire_year($total=20, $selected='')
	{
		$year=date("Y");
		echo '<option value="">Select Year</option>';
		for($i=0;$i<$total;$i++):
			if($i==$selected):
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


function get_today_events(){
	$date=date("Y-m-d");
	$query= new query('event');
	$query->Where="where  CAST('$date' as date)=event_date";
	$query->DisplayAll();
	return get_all_in_object($query);
}

#utitlity functions
function get_all_in_object($object, $type='object'){
	$obj_array=array();
	if($object->GetNumRows()):
		if($type=='object'):
			while($obj=$object->GetObjectFromRecord()):
				$obj_array[]=$obj;
			endwhile;
		else:
			while($obj=$object->GetArrayFromRecord()):
				$obj_array[]=$obj;
			endwhile;
		endif;
	endif;
	return $obj_array;
}
/*
function limit_text($text, $limit=100)
{
	if(strlen($text)>$limit):
		return substr($text, 0, strpos($text, ' ', $limit));
	else:
		return $text;
	endif;
}
*/
$events=array();
$event_id='';
if(isset($_GET['event_id'])):
	$event_id=$_GET['event_id'];
	$events=get_events_bycat($event_id);
else:
	$events=get_today_events();
endif;

#filters
(isset($_GET['year']))?$year=$_GET['year']:$year=date("Y");
(isset($_GET['month']))?$month=$_GET['month']:$month=date("m");
(isset($_GET['category']) && $_GET['category']!='')?$category=$_GET['category']:$category='all';

$day=date("w", mktime("0", "0", "0", $month, 1, $year));
$days=date("t", mktime("0", "0", "0", $month, 1, $year));
$events=get_events_bycatmy($category, $year, $month);
$eve=array();
foreach ($events as $k=>$v):
	$eve[$v->day][]=$v;
endforeach;
?>