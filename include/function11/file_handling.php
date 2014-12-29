<?

function uploadfile($file, $allowed_mime_types, $to_upload_path)
	{
		global $error;
		if($file['error']==0):
			if(in_array($file['type'], $allowed_mime_types)):
				if(move_uploaded_file($file['tmp_name'], $to_upload_path.$file['name'])):
					return true;
				else:
					$error='unable to upload!!';
					return false;
				endif;
			else:
				$error='Wrong file format.';
				return false;
			endif;
			
		else:
			$error=file_upload_error_codes($file['error']);
			return false;
		endif;
	}
	
function file_upload_error_codes($code)
{
	switch ($code):
		case '1':#UPLOAD_ERR_INI_SIZE
			return 'File size limit exceeds. Max file size: 2MB.';
			break;
		case '2': #UPLOAD_ERR_FORM_SIZE
			return 'Max file size limit set in page has crossed.';
			break;
		case '3': #UPLOAD_ERR_PARTIAL 
			return 'File was only partially uploaded';
			break;
		case '4': #UPLOAD_ERR_NO_FILE
			return 'No file was uploaded';
			break;
		default: return 'No Message Found!';
	endswitch;
}

function download_file($file)
	{
		if (!is_file($file))
			   			{
			   				 die("<b>404 File not found!</b>");
			   			}


			  //Gather relevent info about file
			$len = filesize($file);
			$filename = basename($file);
			$file_extension = strtolower(substr(strrchr($filename,"."),1));

			//This will set the Content-Type to the appropriate setting for the file
			switch( $file_extension )
				 {
 				case "pdf": $ctype="application/pdf"; break;
					case "exe": $ctype="application/octet-stream"; break;
					case "zip": $ctype="application/zip"; break;
					case "doc": $ctype="application/msword"; break;
					case "xls": $ctype="application/vnd.ms-excel"; break;
					case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
					case "gif": $ctype="image/gif"; break;
					case "png": $ctype="image/png"; break;
					case "jpeg":
					case "jpg": $ctype="image/jpg"; break;
					case "mp3": $ctype="audio/mpeg"; break;
					case "wav": $ctype="audio/x-wav"; break;
					case "mpeg":
					case "mpg":
					case "mpe": $ctype="video/mpeg"; break;
					case "mov": $ctype="video/quicktime"; break;
					case "avi": $ctype="video/x-msvideo"; break;

					//The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
					case "php":
					case "htm":
					case "html":
					case "txt":die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;

					default: $ctype="application/force-download";
				}
				ob_clean();
				//Begin writing headers
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: public");
				header("Content-Description: File Transfer");

				//Use the switch-generated Content-Type
				header("Content-Type: $ctype");

				//Force the download
				$header="Content-Disposition: attachment; filename=".$filename.";";
				header($header );
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".$len);
				@readfile($file);
				exit;
		}

function backupFile($backup_file,$MemberArray)
	{

		$fp = fopen($backup_file, "w");
		foreach ($MemberArray as $Value)
		     fputs($fp,$Value."\n");

     		fclose($fp);
	}

?>