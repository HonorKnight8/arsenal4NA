
// 打开侧栏，修改侧栏宽度，主体左跨度、背景透明度
function openNav() {
    document.getElementById("sidenav").style.width = "190px";
    document.getElementById("main").style.marginLeft = "190px";
    document.getElementById("topbar").style.marginLeft = "190px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}
// 关闭侧栏，恢复原始侧栏宽度，主体左跨度、背景透明度
function closeNav() {
    document.getElementById("sidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("topbar").style.marginLeft = "0";
    document.body.style.backgroundColor = "white";
}