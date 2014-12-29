<?
	function EncodeString($String)
	{
		return base64_encode($String);
	}

	function DecodeString($String)
	{
		return base64_decode($String);
	}

	function authenticate()
	{
		header( 'WWW-Authenticate: Basic realm="Please enter the user information.."' );
	   	header( 'HTTP/1.0 401 Unauthorized' );
	    	echo "<H1>Authorization Required</H1>
				This server could not verify that you
				are authorized to access the document
				requested.  Either you supplied the wrong
				credentials (e.g., bad password), or your
				browser doesn't understand how to supply
				the credentials required.<P>
				<P>Additionally, a 404 Not Found
				error was encountered while trying to use an ErrorDocument to handle the request.
				<HR>
				<ADDRESS>Apache/1.3.33 Server at www.".SITE_NAME.".com Port 80</ADDRESS>";
	    exit;
	}

	function sendToHost($host,$method,$path,$data,$useragent=0)
	{
	    // Supply a default method of GET if the one passed was empty
	    $buf="";
	    if (empty($method)) {
	        $method = 'GET';
	    }
	    $method = strtoupper($method);
	    $fp = fsockopen($host, 80);
	    if ($method == 'GET') {
	        $path .= '?' . $data;
	    }
	    fputs($fp, "$method $path HTTP/1.1\r\n");
	    fputs($fp, "Host: $host\r\n");
	    fputs($fp,"Content-type: application/x-www-form- urlencoded\r\n");
	    fputs($fp, "Content-length: " . strlen($data) . "\r\n");
	    if ($useragent) {
	        fputs($fp, "User-Agent: MSIE\r\n");
	    }
	    fputs($fp, "Connection: close\r\n\r\n");
	    if ($method == 'POST') {
	        fputs($fp, $data);
	    }

	    while (!feof($fp)) {
	        $buf .= fgets($fp,128);
	    }
	    fclose($fp);
	    $buf = strstr($buf,"<html>");
	    return $buf;
	}
?>