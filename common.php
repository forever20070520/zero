<?php
/*
 * .---------------------------------------------------------------------------.
 * @(#) common.php 
 * @Version 1.0.0
 * @Author DingYong 2013/02/18
 * @Copyright (c) 2012-2013, DingYong.All Rights Reserved.
 * =======================================================
 * History
 *   
 * 	
 * .---------------------------------------------------------------------------.
*/

class common{
	
	/**
	 * 设置Session
	 * @param string $name Session名
	 * @param mixed $value Session值
	 * @return none
	 */
	static public function setSession($name,$value){
		
		$_SESSION[$name] = $value;
	}
	
	/**
	 * 获取Session值
	 * @param string $name Session名
	 * @return mixed
	 */
	static public function getSession($name){
		
		return $_SESSION[$name];
	}
	
	/**
	 * 删除Session
	 * @param string $name Session名
	 * @return none
	 */
	static public function deleteSession($name){
		
		unset($_SESSION[$name]);
	}
	
	/**
	 * 删除所有Session
	 * @return none
	 */
	static public function deleteAllSession(){
		
		session_unset();
	}
	
	static public function setCookie($name,$value,$time){
		
		
	}
}
?>
