
// 打开侧栏，修改侧栏宽度，主体左跨度、背景透明度
function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
    document.getElementById("main").style.marginLeft = "180px";
    // document.getElementById("div_contants").style.marginLeft = "180px";
    document.getElementById("topbar").style.marginLeft = "180px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}
// 关闭侧栏，恢复原始侧栏宽度，主体左跨度、背景透明度
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    // document.getElementById("div_contants").style.marginLeft = "0px";
    document.getElementById("topbar").style.marginLeft = "0";
    document.body.style.backgroundColor = "white";
}