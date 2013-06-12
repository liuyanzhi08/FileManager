<?php
class opmysql{
	private $host = 'localhost';			//登陆服务器地址
	private $name = 'root';					//登陆账号
	private $pwd = 'root';					//登陆秒
	private $dBase = 'db_reglog';			//数据库名称
	private $conn = '';						//数据库连接资源
	private $result = '';					//结果集
	private $msg = '';						//返回结果
	private $fields;						//返回字段
	private $fieldsNum = 0;					//返回字段数
	private $rowsNum = 0;					//返回结果数
	private $rowsRst = '';					//返回单条记录的字段数组
	private $filesArray = array();			//返回字段数组
	private $rowsArray = array();			//返回结果数组
	
	function __construct($host='', $name='', $pwd='', $dBase=''){
		if($host != ''){
			$this->host = $host;
		}
		if($name != ''){
			$this->name = $name;
		}
		if($pwd != ''){
			$this->pwd = $pwd;
		}
		if($dBase != ''){
			$this->dBase = $dBase;
		}
	}
	
	//连接数据库
	function  init_conn(){
		$this->conn = @mysql_connect($this->host, $this->name, $this->pwd);
		@mysql_select_db($this->dBase, $this->conn);
		mysql_query("set names utf8");		//设置编码
	}
	
	//查询结果
	function mysql_query_rst($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		
		$this->result = @mysql_query($sql, $this->conn);
	}
	
	function getRowsNum($sql){
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			return @mysql_num_rows($this->result);
		}else{
			return '';
		}
	}
	
	function getRowsRst($sql){
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			$this->rowsRst = mysql_fetch_array($this->result, MYSQL_ASSOC);
			return $this->rowsRst;
		}else{
			return '';
		}
	}
	
	//取得记录数组（多条记录）
	function getRowsArray($sql){
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			while($row = mysql_fetch_array($this->result, MYSQL_ASSOC)){
				$this->rowsArray[] = $row;
			}
			return $this->rowsArray;
		}else{
			return '';
		}
	}
	
	function getFields($sql, $index){
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			$row = mysql_fetch_array($this->result, MYSQL_NUM);
			return $row[$index];
		}else{
			return '';
		}
	}
	
	function uidRst($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		$this->result = @mysql_query($sql);
		$this->rowsNum = @mysql_affected_rows();
		if(mysql_errno() == 0){
			return $this->rowsNum;
		}else{
			return '';
		}
	}
	
	function close_rst(){
		mysql_free_result($this->result);
		$this->msg = '';
		$this->fieldsNum = 0;
		$this->rowsNum = 0;
		$this->filesArray = '';
		$this->rowsArray = '';
	}
	
	//关闭数据库
	function close_conn(){
		$this->close_rst();
		mysql_close($this->conn);
		$this->conn = '';
	}
}
$conne = new opmysql();
?>