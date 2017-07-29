try{
var docEl = document.documentElement,
resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
	recalc = function () {
		var clientWidth = docEl.clientWidth;
		if (!clientWidth) return;
		if(clientWidth>=750){
		docEl.style.fontSize = '100px';
		 // docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
	}else{
	  docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
	}
	// recalc();
};

if (document.addEventListener){
window.addEventListener(resizeEvt, recalc, false);
document.addEventListener('DOMContentLoaded', recalc, false);
}
} catch (e) {}


var show_info=function(data){
  layer.open({
    content: data
    ,skin: 'msg'
    ,time: 2 //2秒后自动关闭
  });	
}


var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth; 
if(w<500){
	 alert("横屏观看效果更佳哟~");
}