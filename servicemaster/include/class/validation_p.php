<?
# All the validation functions will be added here.
class valid
{
	var $error= array();
	
	function validate($arr, $varr)
	{
		foreach ($arr as $key=>$value)
		{
			foreach ($varr as $k=>$v):
				if($v['on']==$key):	
					$this->$v['type']($key,$value,$v);
				endif;
			endforeach;
		}
		if(count($this->error)>0)
		{return false;}
		else
		{return true;}
		
	}
	
	function req($key, $value, $v)   # required 
	{
		if(empty($value)):
			$this->error[]='You cannot leave <b> '.$key.'</b> field blank.';
			return false;
		else:
			return true;
		endif;	
	}
	
	
	function alphanum($key, $value, $v)
	{
		if(!ctype_alnum($value)):
			$this->error[]= '<b> '.$key.'</b> field has to be alpha-numeric.';
		endif;
		return true;
	}
	
	function num($key, $value, $v)
	{
		if(!is_numeric($value)):
			$this->error[]= '<b> '.$key.'</b> field has to be numeric.';
		endif;
		return true;
	}
	
	function maxlength($key, $value, $v)
	{
		if(strlen($value)>$v['p1']):
			$this->error[]= '<b> '.$key.'</b> field cannot be longer than '.$v['p1'].' characters.';
		endif;
		return true;
	}
	
	function minlength($key, $value, $v)
	{
		if(strlen($value)<$v['p1']):
			$this->error[]= '<b> '.$key.'</b> field cannot be shorter than '.$v['p1'].' characters.';
		endif;
		return true;
	}
	
	function alpha($key, $value, $v)
	{
		if(!ctype_alpha($value)):
			$this->error[]= '<b> '.$key.'</b> field has to be alphabetic.';
		endif;
		return true;
	}
	
	function email($key, $value, $v)
	{
		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $value)):
			$this->error[]= 'Please use correct <b>Email</b> format: <b>user@domain.com</b>.';
		endif;
		return true;
	}
	function compare($key, $value, $v)
	{
		if($value!=$v['p1']):
			$this->error[]='<b>'.$key.'<b>'.' does not match.';
		endif;
		return true;
	}
	
	function icompare($key, $value, $v)
	{
		if(strtolower($value)!=strtolower($v['p1'])):
			$this->error[]='<b>'.$key.'<b>'.' does not match.';
		endif;
		return true;
	}
};

	
	