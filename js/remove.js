var assemblpic = document.getElementsByClassName("removable");
var parent = document.getElementById("miniatures");

for (var i = 0; i < assemblpic.length; i++) {
    assemblpic[i].onclick = function (event) {
        var imgdir = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
        var arfsrc = imgdir.split('/');
        var src = arfsrc[arfsrc.length - 1];
        make_ajax_request("./framework/removeassembly.php",
                "src=" + src,
                function (responseText) {
                    if (responseText === "OK")
                        parent.removeChild(event.srcElement || event.target);
                },
                function () {
                    alert("Error");
                });
    }
}