var xmlhttp;
if(window.XMLHttpRequest){
	xmlhttp = new XMLHttpRequest;
}else if(window.ActiveXObject){
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

function createXMLHttp(){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest;
	}else if(window.ActiveXObject){
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}
