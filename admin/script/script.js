//选项卡
$(function(){
	var $win = $(window);
	var $body = $("body");
	var $downdoc = $("#downdoc");
	var $updoc = $("#updoc");
	var $title = $("#title");
	var $mngex = $("#mngex");
	var $mainwra = $("#main-wrapper");
	var $leftli = $("#left ul li");
	var $titlea = $("#title li a");
	var winhei = $win.innerHeight();
	var winwid = $win.width();
	var liclr = $leftli.css("background-color");
	var liclr2 = $titlea.last().css("background-color");
	var $ctn = $("#content");
	var $right = $("#right")
	
	
	//调整mainwrrapper的高度，使窗口不出现滚动条
	$("#left").css("height", winhei-40);
	$("#content").css("height", winhei - 110);
	
	
	
	//右侧资料管理分类导航
	$right.on("change", "#title #doctypelist", function(){
		if($(this).val() !== "请选择分类"){
			var typeid = $(this).val();
			var url = "getdocs_chk.php?typeid=" + typeid;
			var xmlhttp8 = createXMLHttp();
			xmlhttp8.open("GET", url, true);
			xmlhttp8.onreadystatechange = function(){
				if(xmlhttp8.readyState == 4 && xmlhttp8.status == 200){
					var txt = xmlhttp8.responseText;
					$ctn.html(txt);
				}
			}
			xmlhttp8.send();
		}
		
	})
	
	//右侧作业分类导航
	$right.on("mouseenter", "#title li", function(){
		$(this).css("background", "#e5e5e5");
	})
	
	$right.on("mouseout", "#title li", function(){
		$(this).css("background", liclr2);
	})
	
	$right.on("click", "#title a.upfile", function(){
		//修改current-nav
		$(this).parent().siblings().children("a").removeClass("titlenav-current");
		$(this).addClass("titlenav-current");
		//改变content
		var typeid = $(this).attr("rel");
		var url = "getfiles_chk.php?typeid=" + typeid;
		var xmlhttp3 = createXMLHttp();
		xmlhttp3.open("GET", url, true);
		xmlhttp3.onreadystatechange = function(){
			if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200){
				var txt = xmlhttp3.responseText;
				$ctn.html(txt);
			}
		}
		xmlhttp3.send();
	})
	//改变左侧导航
	$leftli.hover(function(){
		$(this).css("background", "#999")
	}, function(){
		$(this).css("background", liclr)
	});
	$("#left li").click(function(){
		$(this).siblings().children("a").removeClass("leftnav-current");
		$(this).children("a").addClass("leftnav-current");
	})

	
	//上传资料
	$updoc.click(function(){
		$title.html('<span>资料管理</span>');
		var xmlhttp5 = createXMLHttp();
		url = "gettyslcs.php?sid="+Math.random();
		xmlhttp5.open("GET", url, true);
		xmlhttp5.onreadystatechange = function(){
			if(xmlhttp5.readyState == 4 && xmlhttp5.status == 200){
				var txt = xmlhttp5.responseText;
				$ctn.html(txt);
			}
		}
		xmlhttp5.send();
	})
	
	//添加多个上传文件
	$right.on("click", "#addmorefile", function(){
		var $this = $(this);
		$(".filerow").first().clone().insertBefore($this.parent().parent());
	})
	
	//上传作业提交
	$right.on("click", "#upfilesub", function(){
		if($("#filetypelist").val() == "请选择"){
			$("#notice").html("请在下拉菜单中选择上传到的分类");	
			$("#notice").fadeIn().delay(1000).fadeOut();	
			return false;
		}
		if($("#upfilefile").val() == ""){
			$("#notice").html("请选择文件");	
			$("#notice").fadeIn().delay(1000).fadeOut();	
			return false;
		}
	})
	//上传资料提交
	$right.on("click", "#updocsub", function(){
		if($("#uptypelist").val() == "请选择"){
			$("#notice").html("请在下拉菜单中选择上传资料的分类");	
			$("#notice").fadeIn().delay(1000).fadeOut();	
			return false;
		}
		var empty = false;
		$(".filerow input").each(function(){
			if($(this).val() == ""){
				empty = true;
			};
		})
		if(empty == true){
			$("#notice").html("请选择文件");	
			$("#notice").fadeIn().delay(1000).fadeOut();	
			return false;
		}
	})
	
	//左侧导航资料列表
	$downdoc.click(function(){
		//改变title
		var url = "getdoctypes_chk.php?sid="+Math.random();
		var xmlhttp7 = createXMLHttp();
		xmlhttp7.open("GET", url, true);
		xmlhttp7.onreadystatechange = function(){
			if(xmlhttp7.readyState == 4 && xmlhttp7.status ==  200){
				var txt = xmlhttp7.responseText;
				$("#title").html(txt);
				$("#title li a").first().addClass("titlenav-current");
			}
		}
		xmlhttp7.send();
		//改变content
		var url = "gettype1docs_chk.php?sid="+Math.random();
		var xmlhttpc = createXMLHttp();
		xmlhttpc.open("GET", url, true);
		xmlhttpc.onreadystatechange = function(){
			if(xmlhttpc.readyState == 4 && xmlhttpc.status ==  200){
				var txt = xmlhttpc.responseText;
				$ctn.html(txt);
			}
		}
		xmlhttpc.send();
	})
	
	//左侧上传作业
	$("#upfile").click(function(){
		$title.html("作业管理");
		//改变content
		var url = "getfileform_chk.php?sid="+Math.random();
		var xmlhttpa = createXMLHttp();
		xmlhttpa.open("GET", url, true);
		xmlhttpa.onreadystatechange = function(){
			if(xmlhttpa.readyState == 4 && xmlhttpa.status ==  200){
				var txt = xmlhttpa.responseText;
				$ctn.html(txt);
			}
		}
		xmlhttpa.send();		
	})
	//左侧导航作业管理
	$mngex.click(function(){
		//改变title
		var url = "getfiletypes_chk.php?sid="+Math.random();
		xmlhttp.open("GET", url, true);
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status ==  200){
				var txt = xmlhttp.responseText;
				$("#title").html(txt);
				$("#title li a").first().addClass("titlenav-current");
			}
		}
		xmlhttp.send();
		
		xmlhttp1 = createXMLHttp();
		url = "gettype1files_chk.php?sid="+Math.random();
		xmlhttp1.open("GET", url, true);
		xmlhttp1.onreadystatechange = function(){
			if(xmlhttp1.readyState == 4 && xmlhttp1.status ==  200){
				var txt = xmlhttp1.responseText;
				//改变content
				$("#content").html(txt);
			}
		}
		xmlhttp1.send();
	})

	//添加作业分类
	$right.on("click", "#addfiletypesub", function(){
		if($("#type").val() == ""){
			$("#notice").html("请输入分类名称");
			$("#notice").fadeIn().delay(1000).fadeOut();
			return false;
		}
		if($("#description").val() == ""){
			$("#notice").html("请输入分类描述");
			$("#notice").fadeIn().delay(1000).fadeOut();
			return false;
		}
		if($("#deadline").val() == ""){
			$("#notice").html("请输入作业提交截止时间 , 格式如下（2013-5-20 00:00:00）");
			$("#notice").fadeIn().delay(1000).fadeOut();
			return false;
		}

		var type = encodeURIComponent($("#type").val());
		var description = encodeURIComponent($("#description").val());
		var deadline = $("#deadline").val();
		var xmlhttpb = createXMLHttp();
		url = "addfiletp_chk.php?type=" + type + "&description=" + description +"&deadline=" + deadline + "&sid=" + Math.random();
		xmlhttpb.open("GET", url , true);
		xmlhttpb.onreadystatechange = function(){
			if(xmlhttpb.readyState == 4 && xmlhttpb.status == 200){
				$("#notice").html("作业分类添加成功！");
				$("#notice").fadeIn().delay(500).fadeOut();
				var txt = xmlhttpb.responseText;
				$("#deadlinetb").children("tbody").children("tr:first").after(txt);
			}
		}
		xmlhttpb.send();
		return false;
	})
	
	//增加资料分类
	$right.on("click", "#addtypesub", function(){
		if($("#typelist").val() == "请选择"){
			$("#notice").html("请在下拉菜单中选择要添加到的上级分类");
			$("#notice").fadeIn().delay(1000).fadeOut();
			return false;
		}
		if($("#typename").val() == ""){
			$("#notice").html("请输入分类名称");	
			$("#notice").fadeIn().delay(1000).fadeOut();	
			return false;
		}
		var typeid = $("#typelist").val();
		var typename = encodeURIComponent($("#typename").val());
		var xmlhttp6 = createXMLHttp();
		url = "adddoctp_chk.php?typeid=" + typeid + "&typename=" + typename + "&sid=" + Math.random();
		xmlhttp6.open("GET", url , true);
		xmlhttp6.onreadystatechange = function(){
			if(xmlhttp6.readyState == 4 && xmlhttp6.status == 200){
				$("#notice").html("分类添加成功！");
				$("#notice").fadeIn().delay(500).fadeOut();
				var txt = xmlhttp6.responseText;
				$ctn.html(txt);
			}
		}
		xmlhttp6.send();
		return false;
	})
	
	//删除资料
	$right.on("click", "a.deldoc", function(){
		$this = $(this);
		var fileid = $this.attr("rel");
		var c = confirm("确认删除？");
		if(c == true){
			url = "deldocs_chk.php?id=" +  fileid;
			var xmlhttp9 = createXMLHttp();
			xmlhttp9.open("GET", url, true);
			xmlhttp9.onreadystatechange = function(){
				if(xmlhttp9.readyState == 4 && xmlhttp9.status == 200){
					$this.parent().parent().remove();
				}
			}
			xmlhttp9.send();
		}
	})
	//删除文件
	$right.on("click", "a.delfile", function(){
		$this = $(this);
		var fileid = $this.attr("rel");
		var c = confirm("确认删除？");
		if(c == true){
			url = "delfile_chk.php?id=" +  fileid;
			var xmlhttp4 = createXMLHttp();
			xmlhttp4.open("GET", url, true);
			xmlhttp4.onreadystatechange = function(){
				if(xmlhttp4.readyState == 4 && xmlhttp4.status == 200){
					$this.parent().parent().remove();
				}
			}
			xmlhttp4.send();
		}
	})
	
	//公告管理
	$("#mnnotice").click(function(){
		$title.html("<span>" + $("#mnnotice").html() + "</span>");
		//改变content
		var url = "getnotice_chk.php?sid="+Math.random();
		var xmlhttpd = createXMLHttp();
		xmlhttpd.open("GET", url, true);
		xmlhttpd.onreadystatechange = function(){
			if(xmlhttpd.readyState == 4 && xmlhttpd.status ==  200){
				var txt = xmlhttpd.responseText;
				$ctn.html(txt);
				$('#notice-content').focus();
			}
		}
		xmlhttpd.send();
		$ctn.html();
	})
	//发布公告
	$right.on("click", "#addnoticesub", function(){
		if($("#notice-content").val() == ""){
			$("#notice").html("请输入公告内容");
			$("#notice").fadeIn().delay(500).fadeOut();
		}else{
			var xmlhttpe = createXMLHttp();
			var content = encodeURIComponent($("#notice-content").val());
			url = "addnotice_chk.php?content=" + content + "&sid=" + Math.random();
			xmlhttpe.open("GET", url , true);
			xmlhttpe.onreadystatechange = function(){
				if(xmlhttpe.readyState == 4 && xmlhttpe.status == 200){
					$("#notice").html("公告添加成功！");
					$("#notice").fadeIn().delay(1000).fadeOut();
					var txt = xmlhttpe.responseText;
					$("#noticetb").children("tbody").children("tr").eq(1).after(txt);
				}
			}
			xmlhttpe.send();
		}
		return false;
	})
	//删除公告
	$right.on("click", ".delnotice", function(){
		var $this = $(this);
		var c = confirm("确认删除？");
		if(c == true){
			var xmlhttpf = createXMLHttp();
			var id = $(this).attr("rel");
			url = "delnotice_chk.php?id=" + id + "&sid=" + Math.random();
			xmlhttpf.open("GET", url , true);
			xmlhttpf.onreadystatechange = function(){
				if(xmlhttpf.readyState == 4 && xmlhttpf.status == 200){
					$("#notice").html("公告删除成功！");
					$("#notice").fadeIn().delay(1000).fadeOut();
					$this.parent().parent().remove();
				}
			}
			xmlhttpf.send();
		}
	})
	//删除作业分类
	$right.on("click", ".delfiletype", function(){
		//发出删除请求
		var c = confirm("确认删除？");
		if(c == true){
			var xmlhttpg = createXMLHttp();
			var $this = $(this);
			var id = $this.attr("rel");
			url = "delfiletype_chk.php?id=" + id + "&sid=" + Math.random();
			xmlhttpg.open("GET", url , true);
			xmlhttpg.onreadystatechange = function(){
				if(xmlhttpg.readyState == 4 && xmlhttpg.status == 200){
					$("#notice").html("作业分类删除成功！");
					$("#notice").fadeIn().delay(1000).fadeOut();
					$this.parent("td").parent("tr").remove();
				}
			}
			xmlhttpg.send();
		}
	})
	//删除资料分类
	$right.on("change", "#deltypelist", function(){
		var $this = $(this);
		if($this.val() != "请选择" && $this.val() != 1){
			var c = confirm("确定删除该分类吗？删除该分类将一并删除其下属分类");
				if(c == true){
				//发出删除请求
				var xmlhttph = createXMLHttp();
				var $this = $(this);
				url = "deldoctype_chk.php?id=" + $this.val() + "&sid=" + Math.random();
				xmlhttph.open("GET", url , true);
				xmlhttph.onreadystatechange = function(){
					if(xmlhttph.readyState == 4 && xmlhttph.status == 200){
						$("#notice").html("资料分类删除成功！");
						$("#notice").fadeIn().delay(1000).fadeOut();
						//找到删除类的分类前缀， 如 |----
						$ctn.html(xmlhttph.responseText);
					}
				}
				xmlhttph.send();
			}
		}
		return false;
	})
})