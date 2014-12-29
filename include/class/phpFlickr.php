<?php
/* phpFlickr Class 3.1
 * Written by Dan Coulter (dan@dancoulter.com)
 * Project Home Page: http://phpflickr.com/
 * Released under GNU Lesser General Public License (http://www.gnu.org/copyleft/lgpl.html)
 * For more information about the class and upcoming tools and toys using it,
 * visit http://www.phpflickr.com/
 *
 *	 For installation instructions, open the README.txt file packaged with this
 *	 class. If you don't have a copy, you can see it at:
 *	 http://www.phpflickr.com/README.txt
 *
 *	 Please submit all problems or questions to the Help Forum on my Google Code project page:
 *		 http://code.google.com/p/phpflickr/issues/list
 *
 */ 
if ( !class_exists('phpFlickr') ) {
	if (session_id() == "") {
		@session_start();
	}

	class phpFlickr {
		var $api_key;
		var $secret;
		
		var $rest_endpoint = 'http://api.flickr.com/services/rest/';
		var $upload_endpoint = 'http://api.flickr.com/services/upload/';
		var $replace_endpoint = 'http://api.flickr.com/services/replace/';
		var $req;
		var $response;
		var $parsed_response;
		var $cache = false;
		var $cache_db = null;
		var $cache_table = null;
		var $cache_dir = null;
		var $cache_expire = null;
		var $cache_key = null;
		var $last_request = null;
		var $die_on_error;
		var $error_code;
		Var $error_msg;
		var $token;
		var $php_version;
		var $custom_post = null, $custom_cache_get = null, $custom_cache_set = null;

		/*
		 * When your database cache table hits this many rows, a cleanup
		 * will occur to get rid of all of the old rows and cleanup the
		 * garbage in the table.  For most personal apps, 1000 rows should
		 * be more than enough.  If your site gets hit by a lot of traffic
		 * or you have a lot of disk space to spare, bump this number up.
		 * You should try to set it high enough that the cleanup only
		 * happens every once in a while, so this will depend on the growth
		 * of your table.
		 */
		var $max_cache_rows = 1000;

		function phpFlickr ($api_key, $secret = NULL, $die_on_error = false) {
			//The API Key must be set before any calls can be made.  You can
			//get your own at http://www.flickr.com/services/api/misc.api_keys.html
			$this->api_key = $api_key;
			$this->secret = $secret;
			$this->die_on_error = $die_on_error;
			$this->service = "flickr";

			//Find the PHP version and store it for future reference
			$this->php_version = explode("-", phpversion());
			$this->php_version = explode(".", $this->php_version[0]);
		}

		function enableCache ($type, $connection, $cache_expire = 600, $table = 'flickr_cache') {
			// Turns on caching.  $type must be either "db" (for database caching) or "fs" (for filesystem).
			// When using db, $connection must be a PEAR::DB connection string. Example:
			//	  "mysql://user:password@server/database"
			// If the $table, doesn't exist, it will attempt to create it.
			// When using file system, caching, the $connection is the folder that the web server has write
			// access to. Use absolute paths for best results.  Relative paths may have unexpected behavior
			// when you include this.  They'll usually work, you'll just want to test them.
			if ($type == 'db') {
				if ( preg_match('|mysql://([^:]*):([^@]*)@([^/]*)/(.*)|', $connection, $matches) ) {
					//Array ( [0] => mysql://user:password@server/database [1] => user [2] => password [3] => server [4] => database ) 
					$db = mysql_connect($matches[3], $matches[1], $matches[2]);
					mysql_select_db($matches[4], $db);
					
					/*
					 * If high performance is crucial, you can easily comment
					 * out this query once you've created your database table.
					 */
					mysql_query("
						CREATE TABLE IF NOT EXISTS `$table` (
							`request` CHAR( 35 ) NOT NULL ,
							`response` MEDIUMTEXT NOT NULL ,
							`expiration` DATETIME NOT NULL ,
							INDEX ( `request` )
						) TYPE = MYISAM
					", $db);
					
					$result = mysql_query("SELECT COUNT(*) FROM $table", $db);
					$result = mysql_fetch_row($result);
					if ( $result[0] > $this->max_cache_rows ) {
						mysql_query("DELETE FROM $table WHERE expiration < DATE_SUB(NOW(), INTERVAL $cache_expire second)", $db);
						mysql_query('OPTIMIZE TABLE ' . $this->cache_table, $db);
					}
					$this->cache = 'db';
					$this->cache_db = $db;
					$this->cache_table = $table;
				}
			} elseif ($type == 'fs') {
				$this->cache = 'fs';
				$connection = realpath($connection);
				$this->cache_dir = $connection;
				if ($dir = opendir($this->cache_dir)) {
					while ($file = readdir($dir)) {
						if (substr($file, -6) == '.cache' && ((filemtime($this->cache_dir . '/' . $file) + $cache_expire) < time()) ) {
							unlink($this->cache_dir . '/' . $file);
						}
					}
				}
			} elseif ( $type == 'custom' ) {
				$this->cache = "custom";
				$this->custom_cache_get = $connection[0];
				$this->custom_cache_set = $connection[1];
			}
			$this->cache_expire = $cache_expire;
		}

		function getCached ($request)
		{
			//Checks the database or filesystem for a cached result to the request.
			//If there is no cache result, it returns a value of false. If it finds one,
			//it returns the unparsed XML.
			foreach ( $request as $key => $value ) {
				if ( empty($value) ) unset($request[$key]);
				else $request[$key] = (string) $request[$key];
			}
			//if ( is_user_logged_in() ) print_r($request);
			$reqhash = md5(serialize($request));
			$this->cache_key = $reqhash;
			$this->cache_request = $request;
			if ($this->cache == 'db') {
				$result = mysql_query("SELECT response FROM " . $this->cache_table . " WHERE request = '" . $reqhash . "' AND DATE_SUB(NOW(), INTERVAL " . (int) $this->cache_expire . " SECOND) < expiration", $this->cache_db);
				if ( mysql_num_rows($result) ) {
					$result = mysql_fetch_assoc($result);
					return $result['response'];
				} else {
					return false;
				}
			} elseif ($this->cache == 'fs') {
				$file = $this->cache_dir . '/' . $reqhash . '.cache';
				if (file_exists($file)) {
					if ($this->php_version[0] > 4 || ($this->php_version[0] == 4 && $this->php_version[1] >= 3)) {
						return file_get_contents($file);
					} else {
						return implode('', file($file));
					}
				}
			} elseif ( $this->cache == 'custom' ) {
				return call_user_func_array($this->custom_cache_get, array($reqhash));
			}
			return false;
		}

		function cache ($request, $response)
		{
			//Caches the unparsed response of a request.
			unset($request['api_sig']);
			foreach ( $request as $key => $value ) {
				if ( empty($value) ) unset($request[$key]);
				else $request[$key] = (string) $request[$key];
			}
			$reqhash = md5(serialize($request));
			if ($this->cache == 'db') {
				//$this->cache_db->query("DELETE FROM $this->cache_table WHERE request = '$reqhash'");
				$result = mysql_query("SELECT COUNT(*) FROM " . $this->cache_table . " WHERE request = '" . $reqhash . "'", $this->cache_db);
				$result = mysql_fetch_row($result);
				if ( $result[0] ) {
					$sql = "UPDATE " . $this->cache_table . " SET response = '" . str_replace("'", "''", $response) . "', expiration = '" . strftime("%Y-%m-%d %H:%M:%S") . "' WHERE request = '" . $reqhash . "'";
					mysql_query($sql, $this->cache_db);
				} else {
					$sql = "INSERT INTO " . $this->cache_table . " (request, response, expiration) VALUES ('$reqhash', '" . str_replace("'", "''", $response) . "', '" . strftime("%Y-%m-%d %H:%M:%S") . "')";
					mysql_query($sql, $this->cache_db);
				}
			} elseif ($this->cache == "fs") {
				$file = $this->cache_dir . "/" . $reqhash . ".cache";
				$fstream = fopen($file, "w");
				$result = fwrite($fstream,$response);
				fclose($fstream);
				return $result;
			} elseif ( $this->cache == "custom" ) {
				return call_user_func_array($this->custom_cache_set, array($reqhash, $response, $this->cache_expire));
			}
			return false;
		}
		
		function setCustomPost ( $function ) {
			$this->custom_post = $function;
		}
		
		function post ($data, $type = null) {
			if ( is_null($type) ) {
				$url = $this->rest_endpoint;
			}
			
			if ( !is_null($this->custom_post) ) {
				return call_user_func($this->custom_post, $url, $data);
			}
			
			if ( !preg_match("|http://(.*?)(/.*)|", $url, $matches) ) {
				die('There was some problem figuring out your endpoint');
			}
			
			if ( function_exists('curl_init') ) {
				// Has curl. Use it!
				$curl = curl_init($this->rest_endpoint);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($curl);
				curl_close($curl);
			} else {
				// Use sockets.
				foreach ( $data as $key => $value ) {
					$data[$key] = $key . '=' . urlencode($value);
				}
				$data = implode('&', $data);
			
				$fp = @pfsockopen($matches[1], 80);
				if (!$fp) {
					die('Could not connect to the web service');
				}
				fputs ($fp,'POST ' . $matches[2] . " HTTP/1.1\n");
				fputs ($fp,'Host: ' . $matches[1] . "\n");
				fputs ($fp,"Content-type: application/x-www-form-urlencoded\n");
				fputs ($fp,"Content-length: ".strlen($data)."\n");
				fputs ($fp,"Connection: close\r\n\r\n");
				fputs ($fp,$data . "\n\n");
				$response = "";
				while(!feof($fp)) {
					$response .= fgets($fp, 1024);
				}
				fclose ($fp);
				$chunked = false;
				$http_status = trim(substr($response, 0, strpos($response, "\n")));
				if ( $http_status != 'HTTP/1.1 200 OK' ) {
					die('The web service endpoint returned a "' . $http_status . '" response');
				}
				if ( strpos($response, 'Transfer-Encoding: chunked') !== false ) {
					$temp = trim(strstr($response, "\r\n\r\n"));
					$response = '';
					$length = trim(substr($temp, 0, strpos($temp, "\r")));
					while ( trim($temp) != "0" && ($length = trim(substr($temp, 0, strpos($temp, "\r")))) != "0" ) {
						$response .= trim(substr($temp, strlen($length)+2, hexdec($length)));
						$temp = trim(substr($temp, strlen($length) + 2 + hexdec($length)));
					}
				} elseif ( strpos($response, 'HTTP/1.1 200 OK') !== false ) {
					$response = trim(strstr($response, "\r\n\r\n"));
				}
			}
			return $response;
		}
		
		function request ($command, $args = array(), $nocache = false)
		{
			//Sends a request to Flickr's REST endpoint via POST.
			if (substr($command,0,7) != "flickr.") {
				$command = "flickr." . $command;
			}

			//Process arguments, including method and login data.
			$args = array_merge(array("method" => $command, "format" => "php_serial", "api_key" => $this->api_key), $args);
			if (!empty($this->token)) {
				$args = array_merge($args, array("auth_token" => $this->token));
			} elseif (!empty($_SESSION['phpFlickr_auth_token'])) {
				$args = array_merge($args, array("auth_token" => $_SESSION['phpFlickr_auth_token']));
			}
			ksort($args);
			$auth_sig = "";
			$this->last_request = $args;
			if (!($this->response = $this->getCached($args)) || $nocache) {
				foreach ($args as $key => $data) {
					if ( is_null($data) ) {
						unset($args[$key]);
						continue;
					}
					$auth_sig .= $key . $data;
				}
				if (!empty($this->secret)) {
					$api_sig = md5($this->secret . $auth_sig);
					$args['api_sig'] = $api_sig;
				}
				$this->response = $this->post($args);
				$this->cache($args, $this->response);
			}
			
			/*
			 * Uncomment this line (and comment out the next one) if you're doing large queries
			 * and you're concerned about time.  This will, however, change the structure of
			 * the result, so be sure that you look at the results.
			 */
			//$this->parsed_response = unserialize($this->response);
			$this->parsed_response = $this->clean_text_nodes(unserialize($this->response));
			if ($this->parsed_response['stat'] == 'fail') {
				if ($this->die_on_error) die("The Flickr API returned the following error: #{$this->parsed_response['code']} - {$this->parsed_response['message']}");
				else {
					$this->error_code = $this->parsed_response['code'];
					$this->error_msg = $this->parsed_response['message'];
					$this->parsed_response = false;
				}
			} else {
				$this->error_code = false;
				$this->error_msg = false;
			}
			return $this->response;
		}

		function clean_text_nodes ($arr) {
			if (!is_array($arr)) {
				return $arr;
			} elseif (count($arr) == 0) {
				return $arr;
			} elseif (count($arr) == 1 && array_key_exists('_content', $arr)) {
				return $arr['_content'];
			} else {
				foreach ($arr as $key => $element) {
					$arr[$key] = $this->clean_text_nodes($element);
				}
				return($arr);
			}
		}

		function setToken ($token) {
			// Sets an authentication token to use instead of the session variable
			$this->token = $token;
		}


		function getErrorMsg () {
			// Returns the error message of the last call.  If the last call did not
			// return an error. This will return a false boolean.
			return $this->error_msg;
		}

		/* These functions are front ends for the flickr calls */

		function buildPhotoURL ($photo, $size = "Medium") {
			//receives an array (can use the individual photo data returned
			//from an API call) and returns a URL (doesn't mean that the
			//file size exists)
			$sizes = array(
				"square" => "_s",
				"thumbnail" => "_t",
				"small" => "_m",
				"medium" => "",
				"medium_640" => "_z",
				"large" => "_b",
				"original" => "_o"
			);
			
			$size = strtolower($size);
			if (!array_key_exists($size, $sizes)) {
				$size = "medium";
			}
			
			if ($size == "original") {
				$url = "http://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['originalsecret'] . "_o" . "." . $photo['originalformat'];
			} else {
				$url = "http://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['secret'] . $sizes[$size] . ".jpg";
			}
			return $url;
		}


		function people_findByUsername ($username) {
			/* http://www.flickr.com/services/api/flickr.people.findByUsername.html */
			$this->request("flickr.people.findByUsername", array("username"=>$username));
			return $this->parsed_response ? $this->parsed_response['user'] : false;
		}
		function photos_search ($args = array()) {			
			$this->request("flickr.photos.search", $args);
			return $this->parsed_response ? $this->parsed_response['photos'] : false;
		}
		

		
	}
}

?>
