<?
class query  extends Connection 
{
	var $TableName;
	var $Data;
	var $Where;
	var $Field='*';
	var $print=0;
	var $filter=1;
	var $restricted_words_in_where;
		
	function query($tablename='')
	{
		$this->TableName=$tablename;
		$this->Field='*';
		$this->Data=array();
		$this->Where='';
		$this->print=0;
		$this->restricted_words_in_where=array('insert', 'update', 'delete','--');
		$this->filter=1;
	}	
	
	function Insert()
	{
		$query1="INSERT INTO ".$this->TableName." SET ";
		foreach ($this->Data as $key=>$value):
			if($value!=''):
				$query1.=$key."="."'".mysql_escape_string($value)."'".', ';
			endif;
		endforeach;
		$query=substr($query1,0,strlen($query1)-2);
		$this->Query=$query;
		if($this->print):
			echo $this->Query;exit;
		endif;
		if($this->ExecuteQuery($query)):
			return true;
		else:
			return false;
		endif;
	}
	
	function Delete()
	{
		$query="DELETE FROM ".$this->TableName." 
		             WHERE id='$this->id'";
		$this->Query=$query;
		if($this->print):
			echo $this->Query;exit;
		endif;
		if($this->ExecuteQuery($query)):
			return true;
		else:
			return false;
		endif;
	}
	
	function Delete_where()
	{
		$query="DELETE FROM ".$this->TableName." $this->Where";
		$this->Query=$query;
		if($this->print):
			echo $this->Query;exit;
		endif;
		if($this->ExecuteQuery($query)):
			return true;
		else:
			return false;
		endif;
	}
	
	function DisplayAll()
	{
		if($this->filter):
			if(!$this->filter_data()):
				echo 'Invalid data submission detected. Please try again.';
				exit;
			endif;
		endif;
		$query="SELECT $this->Field FROM ".$this->TableName." $this->Where";
		$this->Query=$query;
		if($this->print):
			echo $query;
			exit;
		endif;
		if($this->ExecuteQuery($query)):
			return true;
		else:
			return false;
		endif;
	}
	
	function DisplayOne($type='object')
	{
		if($this->filter):
			if(!$this->filter_data()):
				echo 'Invalid data submission detected. Please try again.';
				exit;
			endif;
		endif;
		
		$query="SELECT $this->Field FROM ".$this->TableName." $this->Where"; 
		$this->Query=$query;
		if($this->print):
			echo $this->Query;exit;
		endif;
		if($this->ExecuteQuery($query)):
			if($this->GetNumRows()>0 && $type=='object'):
				return $this->GetObjectFromRecord();
			elseif($this->GetNumRows()>0 && $type!='object'):
				return $this->GetArrayFromRecord();
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	
	function Update()
	{
		if($this->filter):
			if(!$this->filter_data()):
				echo 'Invalid data submission detected. Please try again.';
				exit;
			endif;
		endif;

		$query1="UPDATE ".$this->TableName." SET ";
		foreach ($this->Data as $key=>$value):
			if($key!='id'):
				$query1.=$key."="."'".mysql_escape_string($value)."'".', ';
			elseif($key=='id'):
				$ID=$value;
			endif;
		endforeach;
		$query=substr($query1,0,strlen($query1)-2);
		$query.=' WHERE id='.$ID;
		$this->Query=$query;
		if($this->print):
			echo $this->Query;exit;
		endif;
		if($this->ExecuteQuery($query)):
			return true;
		else:
			return false;
		endif;
	}
	
	function UpdateCustom()
	{
		$query1="UPDATE ".$this->TableName." SET ";
		foreach ($this->Data as $key=>$value):
			if($key!='id'):
				$query1.=$key."="."'".mysql_escape_string($value)."'".', ';
			else:
				$ID=$value;
			endif;
		endforeach;
		$query=substr($query1,0,strlen($query1)-2);
		$query.=$this->Where;
		$this->Query=$query;
		if($this->ExecuteQuery($query)):
			return true;
		else:
			return false;
		endif;
	}
	
	function GetMaxId()
	{
		$query="select Max(id) as id from ".$this->TableName;
		$this->Query=$query;
		if($this->ExecuteQuery($query)):
			if($this->GetNumRows()==1):
				$row=$this->GetObjectFromRecord();
				return $row->id;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	
	function InitilizeSQL()
	{
		$this->TableName = "";
		$this->Data = "";
		$this->Where = "";
		$this->Fields = "*";
		$this->print=0;
		
	}
	
	function count()
	{
		$query="select count(*) as total from ".$this->TableName.' '.$this->Where;
		if($this->ExecuteQuery($query)):
			if($this->GetNumRows()>0):
				$row=$this->GetObjectFromRecord();
				return $row->total;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	
	function filter_data()
	{
		# Convert all applicable characters to html entities:
		if(is_array($this->Data)):
			foreach ($this->Data as $k=>$v):
				if($v!=''):
					$this->Data[$k]=htmlentities($v);
				endif;
			endforeach;
		endif;
		
		# Check where statement for restricted words:
		$array=explode(' ', $this->Where);
		foreach ($array as $k=>$v):
			if(in_array($v, $this->restricted_words_in_where)):
				return false;
			endif;
		endforeach;
		return true;
	}
	
	function empty_table()
	{
		$query="truncate table `".$this->TableName."`";
		if($this->print):
			echo $query;exit;
		endif;
		if($this->ExecuteQuery($query)):
			return true;
		else:
			return false;
		endif;
	}

        function ListOfAllRecords()
        {
                $list=array();
                if($this->filter):
			if(!$this->filter_data()):
				echo 'Invalid data submission detected. Please try again.';
				exit;
			endif;
		endif;
		$query="SELECT $this->Field FROM ".$this->TableName." $this->Where";
		$this->Query=$query;
		if($this->print):
			echo $query;
			exit;
		endif;
		if($this->ExecuteQuery($query)):
			if($this->GetNumRows()):
                              while($obj=$this->GetArrayFromRecord()):
                                  array_push($list, $obj);
                              endwhile;
                        endif;
		endif;
                return $list;
        }

        


};
$QueryObj= new query();

# Functions to be added.
# 1. Print query - add query to the basic class as attribute. 
# 2. 
?>