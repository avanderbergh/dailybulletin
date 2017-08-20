var elem = document.getElementById("main");
var fs_link = document.getElementById("fsBtn")

fs_link.onclick = function() {
    req = elem.requestFullScreen || elem.webkitRequestFullScreen || elem.mozRequestFullScreen;
    req.call(elem);
}