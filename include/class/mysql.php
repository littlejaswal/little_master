<?php
class Connection
{
	var $Recordset, $Query;
	var $PageSize=0, $AllowPaging=false, $PageNo, $TotalRecords=0,$TotalPages=0;
	
	function Connection()
	{
		global $DBHostName, $DBUserName, $DBPassword, $DBDataBase;
		if(mysql_connect($DBHostName,$DBUserName,$DBPassword) or die("Connection close"))
		{
				
			if(!mysql_select_db($DBDataBase))
			{
				$ParameterArray = array("Host" => $DBHostName, 
										"User" => $DBUserName, 
										"Password" => $DBPassword,
										"DataBase" =>$DBDataBase);
			
				$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
				die(ERROR_MESSAGE);
			}
		}
		else 
		{
			$ParameterArray = array("Host" => $DBHostName, 
									"User" => $DBUserName, 
									"Password" => $DBPassword,
									"DataBase" =>$DBDataBase);
			
			$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
			die(ERROR_MESSAGE);
		}
	}
	
	function ExecuteQuery($Query)
	{
		$this->Query = $Query;
		
		if ($this->Recordset = mysql_query($Query)) 
		{
			if($this->AllowPaging and $this->PageSize > 0 and $this->GetNumRows() > 0)
			{
				$this->TotalRecords = $this->GetNumRows();
				$this->TotalPages = intval($this->TotalRecords/$this->PageSize);
				
				$this->TotalPages = ($this->TotalRecords%$this->PageSize) > 0 ? $this->TotalPages+1:$this->TotalPages;
				$this->PageNo = (empty($this->PageNo) or $this->PageNo==0) ? 1:$this->PageNo;
				$this->Query .= " LIMIT ".($this->PageNo-1)*$this->PageSize.",".$this->PageSize;
				if ($this->Recordset = mysql_query($this->Query)) 
					return true;		
				else 
				{
					$ParameterArray = array("Query" => $Query,
											"FunctionName"=>"ExecuteQuery");
					$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
					die(ERROR_MESSAGE);
				}
			}
			else
				return true;
		}
		else 
		{
			$ParameterArray = array("Query" => $Query,
									"FunctionName"=>"ExecuteQuery");
			$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
			die(ERROR_MESSAGE);
		}
	}
	
	
	function GetPagingLinks($URL,$PagingFormat,$LinkClass="click",$PrefixText="")
	{
		$Text = "";
		$CurrentPageNo = $this->PageNo;
		
		$CurrentPageNo = (empty($CurrentPageNo) or $CurrentPageNo == 0) ? 1:$CurrentPageNo;
		if($this->AllowPaging and $this->PageSize > 0 and $this->GetNumRows() > 0 and $this->TotalPages > 1)
		{
			$Text .= $PrefixText;
			if($PagingFormat==PAGING_FORMAT_PREVNEXT)
			{
				for ($i=1; $i<=$this->TotalPages;$i++)
				{
					if($i == 1)
					{
						if($CurrentPageNo == 1)
							$Text .= "&laquo;&nbsp;Prev&nbsp;";
						else 
							$Text .= " <a href='$URL".($CurrentPageNo-1)."' class='$LinkClass'>&laquo;&nbsp;Prev</a>&nbsp;";
						$Text .= "<select name='ddlPager' onChange='document.location.href = value'>";
					}
					
					$Text .= "<option value='$URL$i'".($i==$CurrentPageNo ? " selected":"").">$i</option>";
					if($i == $this->TotalPages)
					{
						$Text .= "</select>";
						if($CurrentPageNo == $this->TotalPages)
							$Text .= "&nbsp;Next&nbsp;&raquo;";
						else 
							$Text .= "&nbsp;<a href='$URL".($CurrentPageNo+1)."' class='$LinkClass'>Next&nbsp;&raquo;</a>";
					}
					
				}
			}
			elseif($PagingFormat==PAGING_FORMAT_BOTH)
			{
				$InitialLoop= ceil($CurrentPageNo/10)*10 -9;
				$EndLoop = $this->TotalPages >=$InitialLoop+9?$InitialLoop+9:$this->TotalPages;
				$PreviousPage = $InitialLoop - 1;
				$NextPage = $EndLoop + 1;
				$Text ="<table border='0' width='100%'><tr><td width='23%' valign='bottom' align='left' style='padding-top:10px;'>";
				if($PreviousPage ==0)
					$Text .="&laquo;Previous Page";
				else
					$Text .="<a href='$URL$PreviousPage' class='$LinkClass'>&laquo;Previous Page</a>";
					
					$Text .="</td><td align='center'>";
				
				$Text .= "".$PrefixText;
				for ($i=$InitialLoop; $i<= $EndLoop;$i++)
				{
					if($i == $CurrentPageNo)
						$Text .= "<font color='gray'><b>$i</b></font>, ";
					else 
						$Text .= "<a href='$URL$i' class='$LinkClass'>$i</a>, ";
				}
				
				$Text = substr($Text, 0, strlen($Text)-2);
				
				$Text .="</td><td width='23%' align='right'>";
				if($this->TotalPages == $NextPage-1)
					$Text .="Next Page&raquo;";
				else 
					$Text .="<a href='$URL$NextPage' class='$LinkClass'>Next Page&raquo;</a>";
					
					$Text .="</td></tr></table>";
				
				
			}
			
			else 
			{
				for ($i=1; $i<= $this->TotalPages;$i++)
				{
					if($i == $CurrentPageNo)
						$Text .= "<font color='gray'><b>$i</b></font>, ";
					else 
						$Text .= "<a href='$URL$i' class='$LinkClass'>$i</a>, ";
				}
				$Text = substr($Text, 0, strlen($Text)-2);
			}
		}
		return $Text;
	}
	
	
	function GetObjectFromRecord()
	{
		if($this->Recordset)
		{
			if(mysql_num_rows($this->Recordset)>0)
			{
				return mysql_fetch_object($this->Recordset);
			}
			return false;
		}
		else 
		{
			$ParameterArray = array("Query" => $this->Query, 
									"FunctionName"=>"GetObjectFromRecord");
			$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
			die(ERROR_MESSAGE);
		}
	}
	
	function GetArrayFromRecord()
	{
		if ($this->Recordset) 
		{
			if (mysql_num_rows($this->Recordset)>0) 
			{
				return mysql_fetch_assoc($this->Recordset);	
			}
			else 
			{
				$ParameterArray = array("Query" => $this->Query, 
										"FunctionName"=>"GetArrayFromRecord");
				$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
				die(ERROR_MESSAGE);
			}
		}
	}
	
	function GetNumRows()
	{
		if($this->Recordset)
		{
			return mysql_num_rows($this->Recordset);
		}
		else 
		{
			$ParameterArray = array("Query" => $this->Query, 
									"FunctionName"=>"GetNumRows");
			$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
			die(ERROR_MESSAGE);
		}
	}
	
	function MoveTo($RowNo=0)
	{
		if($this->Recordset)
		{
			return mysql_data_seek($this->Recordset,$RowNo);
		}
		else 
		{
			$this->SendErrorMail(ERROR_EMAIL,mysql_error(),"Move row pointer to : ".$RowNo);
			die(ERROR_MESSAGE);
		}
	}
	
	
	function SendErrorMail($EmailAddress,$MySQLError,$SupportParms)
	{
		echo "<font color='Maroon'>$MySQLError</font><br>";
		$Body = "";
		foreach ($SupportParms as $key => $value) 
		{
			$Body .= $key."===========".$value."<br>"; 	
		}
		if(!SendEmail($MySQLError,ERROR_EMAIL,ADMIN_EMAIL,SITE_NAME,$Body))
			echo $Body."<br><br>".$MySQLError;
	}
};
$conn= new Connection();
?>