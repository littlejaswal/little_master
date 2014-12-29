<?
class user_validation
{
	var $para1;
	var $para2;
	var $validation_type;
	var $validation_on;
	var $valid=array();
	
	function add($validation_on, $validation_type, $para1=null, $para2=null)
	{
		$arr=array('on'=>$validation_on, 'type'=>$validation_type, 'p1'=>$para1, 'p2'=>$para2);
		array_push($this->valid, $arr);
		return true;
	}
	
	function get()
	{
		return $this->valid;
	}
	
	function clean()
	{
		$this->valid=array();
	}	

};
?>