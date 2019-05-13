var editphoto = document.getElementById('editphoto');
var assemblpic = document.getElementsByClassName("icon");
var span = document.getElementsByClassName("exit")[0];
var imgeditphoto = document.getElementById('img-editphoto');
var send = document.getElementById('send-comment');
var comment = document.getElementById('comment');

var imageSelected = null;

for (var i = 0; i < assemblpic.length; i++) {
    assemblpic[i].onclick = displframe;
}

function displframe(event) {
    editphoto.style.display = "block";
    imgeditphoto.src = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
    imageSelected = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
}

assemblpic.onclick = function () {
    editphoto.style.display = "block";
}

span.onclick = function () {
    editphoto.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == editphoto) {
        editphoto.style.display = "none";
    }
}

send.onclick = function (event) {
    var com = comment.value;
    if (com == "" || com == null) {
        return;
    }

    var tmp = imageSelected.split('/');
    var imgdire = tmp[tmp.length - 1];
    make_ajax_request("./framework/comment.php",
            "img=" + imgdire + "&comment=" + com,
            function (responseText) {
                var div = document.querySelectorAll("[data-img='" + imgdire + "']")[0];
                var span = document.createElement('span');
                span.innerHTML = responseText + ": " + escapeHtml(com);
                span.setAttribute("class", "comment");
                div.appendChild(span);
                comment.value = "";
                editphoto.style.display = "none";
            },
            function () {
                alert("Error, unable to add comment");
                comment.value = "";
                editphoto.style.display = "none";
            });
}

function escapeHtml(unsafe) {
    return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
}
