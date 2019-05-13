var likes = document.getElementsByClassName("button-like");
var dislikes = document.getElementsByClassName("button-dislike");

var clientLikes = [];
var clientDislikes = [];

for (var i = 0; i < likes.length; i++) {
    likes[i].onclick = function (event) {
        var src = (event.srcElement && event.srcElement.getAttribute('data-image') || event.target.getAttribute('data-image'));
        make_ajax_request("./framework/like.php",
                "img=" + src + "&type=L",
                function (responseText) {
                    if (responseText == "ADD LIKE") {
                        addlikeuser(src);
                    } else if (responseText == "LIKE CHANGE") {
                        clientDislikes[src] = true;
                        addlikeuser(src);
                    }
                },
                function () {
                    alert("Error, unable to add like");
                });
    }
}

for (var i = 0; i < dislikes.length; i++) {
    dislikes[i].onclick = function (event) {
        var src = (event.srcElement && event.srcElement.getAttribute('data-image') || event.target.getAttribute('data-image'));
        make_ajax_request("./framework/like.php",
                "img=" + src + "&type=D",
                function (responseText) {
                    if (responseText == "ADD LIKE") {
                        adddisluser(src);
                    } else if (responseText == "LIKE CHANGE") {
                        clientLikes[src] = true;
                        adddisluser(src);
                    }
                },
                function () {
                    alert("Error, unable to add like");
                });
    }
}

function adddisluser(src) {
    clientDislikes[src] = true;
    var span = document.querySelectorAll("[data-src='" + src + "']")[1];
    var buff = span.innerHTML;
    span.innerHTML = eval(buff * 1 + 1);
    if (clientLikes == [] || clientLikes[src] == undefined || clientDislikes[src] == null) {
        return;
    }

    var span = document.querySelectorAll("[data-src='" + src + "']")[0];
    var buff = span.innerHTML;
    span.innerHTML = eval(buff * 1 - 1);
    clientLikes[src] = null;
}

function addlikeuser(src) {
    clientLikes[src] = true;
    var span = document.querySelectorAll("[data-src='" + src + "']")[0];
    var buff = span.innerHTML;
    span.innerHTML = eval(buff * 1 + 1);

    if (clientDislikes == [] || clientDislikes[src] == undefined || clientDislikes[src] == null) {
        return;
    }

    var span = document.querySelectorAll("[data-src='" + src + "']")[1];
    var buff = span.innerHTML;
    span.innerHTML = eval(buff * 1 - 1);
    clientDislikes[src] = null;
}
