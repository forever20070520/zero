<?php
/*
 * .---------------------------------------------------------------------------.
 * @(#) db_mysql.class.php 
 * @Version 1.0.0
 * @Author DingYong 2013/02/17
 * @Copyright (c) 2012-2013, DingYong.All Rights Reserved.
 * =======================================================
 * History
 * 	2013/02/17 Version 1.0.0 简单增删改查，直接使用SQL语句作为参数，Check、日志及事务不支持
 * 	
 * .---------------------------------------------------------------------------.
*/

require_once('./conf/db.ini.php');

class DbUtil{
	
	private $link = false;
	
	/**
	 * 构造函数
	 * @param string $host 主机名
	 * @param string $port 端口
	 * @param string $dbname 数据库名
	 * @param string $dbuser 用户名
	 * @param string $dbpwd 用户密码
	 * @return none
	 */
	function __construct($host = DBHOST,$port = DBPORT,$dbname = DBNAME,$dbuser = DBUSER,$dbpwd = DBPWD){
		
		if($this->link){
			
			exit();
		}else{
			// 连接数据库服务器
			$this->link = @mysql_connect($host.":".$port,$dbuser,$dbpwd);
			
			// 连接错误输出
			if(!$this->link){
				
				echo mysql_errno().":".mysql_error()."\n";
				
				exit();
			}
			
			// 选择数据库
			if(!mysql_select_db($dbname,$this->link)){
				
				echo mysql_errno().":".mysql_error()."\n";
			}
		}
	}
	
	/**
	 * 插入记录
	 * @param string $sql SQL语句
	 * @return false | integer
	 */
	public function insert($sql){
		
		if(!mysql_query($sql,$this->link)){
			
			echo mysql_errno().":".mysql_error()."\n";
			
			return false;
		}else{
			return mysql_affected_rows($this->link);
		}
	}
	
	/**
	 * 删除记录
	 * @param string $sql SQL语句
	 * @return false | integer
	 */
	public function delete($sql){
		
		if(!mysql_query($sql,$this->link)){
			
			echo mysql_errno().":".mysql_error()."\n";
			
			return false;
		}else{
			return mysql_affected_rows($this->link);
		}	
	}
	
	/**
	 * 更新记录
	 * @param string $sql SQL语句
	 * @return false | integer
	 */
	public function update($sql){
		
		if(!mysql_query($sql,$this->link)){
			
			echo mysql_errno().":".mysql_error()."\n";
			
			return false;
		}else{
			return mysql_affected_rows($this->link);
		}
	}
	
	/**
	 * 查找记录
	 * @param string $sql SQL语句
	 * @param $result_style 查询结果数组类型
	 * @return mixed
	 */
	public function select($sql,$result_style = MYSQL_BOTH){
		
		$result = mysql_query($sql,$this->link);
		
		$theResult = array();
		
		if(!$result){
			
			echo mysql_errno().":".mysql_error()."\n";
			
			return false;
		}else{
			while($row = mysql_fetch_array($result,$result_style)){
				
				$theResult[] = $row;
			}
			
			mysql_free_result($result);
			
			return $theResult;
		}
	}
	
	/**
	 * 查找第一条记录
	 * @param string $sql SQL语句
	 * @param $result_style 查询结果数组类型
	 * @return mixed
	 */
	public function getOneRow($sql,$result_style = MYSQL_BOTH){
		
		$result = mysql_query($sql,$this->link);
		
		$theResult = array();
		
		if(!$result){
			
			echo mysql_errno().":".mysql_error()."\n";
			
			return false;
		}else{
				
			$theResult = mysql_fetch_array($result,$result_style);
			
			mysql_free_result($result);
			
			return $theResult;
		}
	}
	
	/**
	 * 取得上一步 INSERT 操作产生的 ID 
	 * @param resource $link_id 服务器连接资源号
	 * @return integer
	 */
	public function insertID($link_id = ''){
		
		if($link_id == ''){
			
			$link_id = $this->link;
		}
		return mysql_insert_id($link_id);
	}
	
	/**
	 * 关闭 MySQL连接
	 * @param resource $link_id 服务器连接资源号
	 * @return boolean
	 */
	public function dbClose($link_id = ''){
		if($link_id == ''){
			
			$link_id = $this->link;
		}
		
		if(!mysql_close($link_id)){
			echo mysql_errno().":".mysql_error()."\n";
			
			return false;
		}else{
			
			return true;
		}
	}
}
?>
