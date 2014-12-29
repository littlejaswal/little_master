<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once "base_facebook.php";

/**
 * Extends the BaseFacebook class with the intent of using
 * PHP sessions to store user ids and access tokens.
 */
class Facebook extends BaseFacebook
{
  /**
   * Identical to the parent constructor, except that
   * we start a PHP session to store the user ID and
   * access token if during the course of execution
   * we discover them.
   *
   * @param Array $config the application configuration.
   * @see BaseFacebook::__construct in facebook.php
   */
   var $connection;  
    
   public function __construct($config, $database) {
    
	/* setup global variables */
	global $DBHostName;
	global $DBDataBase;
	global $DBUserName;
	global $DBPassword;
	
	/* establish connection */
	$this->connection = mysql_connect($DBHostName, $DBUserName, $DBPassword) or die('can\'t connect to database');
	mysql_select_db($DBDataBase, $this->connection) or die('can\'t select database');
	
	/* call parent */	
	parent::__construct($config);
  }

  protected static $kSupportedKeys =
    array('state', 'code', 'access_token', 'user_id');

  /**
   * Provides the implementations of the inherited abstract
   * methods.  The implementation uses PHP sessions to maintain
   * a store for authorization codes, user ids, CSRF states, and
   * access tokens.
   */
  protected function setPersistentData($key, $value) {
    if (!in_array($key, self::$kSupportedKeys)) {
      self::errorLog('Unsupported key passed to setPersistentData.');
      return;
    }

    $session_var_name = $this->constructSessionVariableName($key);
	$this->setDbData($session_var_name, $value);
	
	#$_SESSION[$session_var_name] = $value;
  }

  protected function setDbData($key, $value){
	
	/*
	$key=mysql_real_escape_string($key);
	$value=mysql_real_escape_string($value);
	*/
	$query="select * from social_media where `key`='$key'";
	$result =mysql_query($query, $this->connection);
	
	
	if($result && mysql_num_rows($result)){
		$query='update social_media SET `value`="'.$value.'" where `key`="'.$key.'"';
		mysql_query($query, $this->connection);
	}
	else
	{
		$query='insert into social_media set `key`="'.$key.'", `value`="'.$value.'"';
		mysql_query($query, $this->connection);
	}
  }
    
  protected function getPersistentData($key, $default = false) {
    if (!in_array($key, self::$kSupportedKeys)) {
      self::errorLog('Unsupported key passed to getPersistentData.');
      return $default;
    }

    $session_var_name = $this->constructSessionVariableName($key);
	return $this->getDBData($session_var_name, $default);
    //return isset($_SESSION[$session_var_name]) ?
     // $_SESSION[$session_var_name] : $default;
  }

   protected function getDBData($key, $default){
	
   	    $query="select `value` from social_media where `key`='$key'";
		$result=mysql_query($query, $this->connection);
		if(isset($result) && $result){
			if(mysql_num_rows($result)){
				$row=mysql_fetch_assoc($result);
				return $row['value'];
			}
			else{
				return $default;
			}
		}
		else{
			return $default;
		}
		
    }


  public function clearPersistentData($key) {
    if (!in_array($key, self::$kSupportedKeys)) {
      self::errorLog('Unsupported key passed to clearPersistentData.');
      return;
    }

    $session_var_name = $this->constructSessionVariableName($key);
	$this->clearDbData($session_var_name);
	#unset($_SESSION[$session_var_name]);
  }

  protected function clearDbData($key){
	$query="delete from social_media where `key`='$key'";
	mysql_query($query, $this->connection);
  }
  
  
  protected function clearAllPersistentData() {
    foreach (self::$kSupportedKeys as $key) {
      $this->clearPersistentData($key);
    }
  }

  protected function constructSessionVariableName($key) {
    return implode('_', array('fb',
                              $this->getAppId(),
                              $key));
  }
}
