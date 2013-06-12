<?php 
//截取utf8字符串 
function utf8Substr($str, $from, $len) 
{ 
return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. 
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', 
'$1',$str); 
} 

//该函数用于递归删除文件夹
function delDir($path){
	if(!$hande = @opendir($path)){
		return false;
	}
	while(false !== ($file = readdir($hande))){
		if($file != "." && $file != ".."){
			$tmppath = $path."/".$file;
			if(is_dir($tmppath)){
				delDir($tmppath);
				rmdir($tmppath);
			}
			if(is_file($tmppath)){
				unlink($tmppath);
			}
		}
	}
	closedir($hande);
}
?>