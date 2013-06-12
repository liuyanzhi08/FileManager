<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="author" content="Nancle from CAU CS101" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通信原理精品课程管理后台</title>
<link type="text/css" rel="stylesheet" href="style/reset.css" />
<link type="text/css" rel="stylesheet" href="style/style.css" />

<script type="text/javascript" src="script/jquery-1.9.1.js"></script>
<script type="text/javascript" src="../js/xmlhttprequest.js"></script>
<script type="text/javascript" src="script/script.js"></script>
</head>
<body>
<?php
 include_once "../conn/conn.php";
 include_once "../includes/lgchk.inc.php";
 ?>

<?php 
	//查询出分类
	$sql = "select * from tb_uptype order by id DESC";
	$types = $conne->getRowsArray($sql);
	$conne->close_rst();
?>
	<!--head开始-->
	<div id="head-wrapper">
        <div id="head">
            <ul>
                <li>通信原理精品课程管理后台</li>
                <li id="lgout"><a href="../login/logout.php">退出系统</a></li>	
            </ul>
        </div>
    </div>
    <!--head结束-->
    <!--main开始-->
    <div id="main-wrapper">
    	<div id= "left">
        	<ul>
            	<li><a href="javascript:void(0)" id="downdoc">资料列表</a></li>
                <?php if($admin){ ?>
                <li><a href="javascript:void(0)" id="updoc">• 资料管理</a></li>
                <?php } ?>
                <li><a href="javascript:void(0)" id="mngex" class="leftnav-current"> 作业列表</a></li>
                <?php if($admin){ ?>
                <li><a href="javascript:void(0)" id="upfile">• 作业管理</a></li>
                <?php }else{ ?>
                <li><a href="javascript:void(0)" id="upfile">• 上传作业</a></li>
                <?php } ?>
                <?php if($admin){ ?>
                <li><a href="javascript:void(0)" id="mnnotice">公告管理</a></li>
                <?php }else{?>
                <li><a href="javascript:void(0)" id="mnnotice">公告列表</a></li>
                <?php }?>
            </ul>
        </div>
    	<div id="right">
        	<div id="notice"></div>
            <!--title 开始-->
        	<div id="title">
            	<ul>
                <?php if(is_array($types) && count($types) != 0){ ?>
              	    <li><a href="javascript:void(0)" class="upfile titlenav-current" rel="<?php echo $types[0]['id'] ?>"><?php echo $types[0]['genrename'] ?></a></li>
       			 	<?php for($i = 1; $i< count($types); $i++){	?>
      				<li><a href="javascript:void(0)" class="upfile " rel="<?php echo $types[$i]['id'] ?>"><?php echo $types[$i]['genrename'] ?></a></li>
                    <?php } ?>
                <?php } else{ ?>
                	作业列表
                <?php } ?>
                </ul>
            </div>
            <!--title 结束-->

			 <!--content 开始-->
             <div id="content">
                <?php //查询文件
					if(is_array($types) && count($types) != 0){
						$sql = "select * from tb_upfile where filetype_id =".$types[0]['id']." order by id DESC";
						$files = $conne->getRowsArray($sql);
						$conne->close_rst();
					}
                ?>
                 <?php if(!isset($files) || !is_array($files)){ echo "没有文件"; }else{ ?>
                <table width="100%">
                    <tr><th>文件名称</th><th>下载路径</th><th>文件大小</th><th>上传时间</th><th>上传者</th><?php if($admin){ ?><th>管理</th><?php } ?></tr>          
                    <?php foreach($files as $file){
                        $txt = '';
                        $txt .= '<tr><td>'.$file['filename'].'</td>
                                 <td><a href="'.$file['filepath'].'">下载</a></td>
                                 <td>'.round($file['filesize']/1024).'KB'.'</td>
                                 <td>'.$file['uptime'].'</td>';                                 
						//根据上传者用户名查找他的真实姓名
						$sql = "select realname from tb_member where name='".$file['upauthor']."'";
						$realname = $conne->getFields($sql, 0);
						$conne->close_rst();
						$txt .= '<td>'.$realname.'</td>';
                        if($admin){
                            $txt .= '<td><a href="javascript:void(0)"  class="delfile" rel="'.$file['id'].'">删除</a></td>';
                        }
                        $txt .= '</tr>';
                        echo $txt;
                    }  		
                    ?>
                </table>
                <?php } ?>

            </div>
             <!--content 结束-->
           

        </div>
   		<div class="clear-fix"></div>
    </div>
    <!--main结束-->
</body>
</html>
