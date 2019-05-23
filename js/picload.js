var views = document.getElementById('views');
var buttonLoad = document.getElementById('load-more');

var editphoto = document.getElementById('editphoto');
var imgeditphoto = document.getElementById('img-editphoto');

var last = null;

function loadMore(lastapicId, imagePerPages) {
    if (last != null) {
        lastapicId = last;
    }
    make_ajax_request("./framework/getassemblpic.php",
            "id=" + lastapicId + "&nb=" + imagePerPages,
            function (responseText) {
                if (responseText === "KO") {
                    return;
                }
                var responseJSON = JSON.parse(responseText);
                last = responseJSON[responseJSON.length - 1]['id'];
                for (var i = 0; responseJSON[i]; i++) {
                    var div = document.createElement("div");
                    var commentsHTML = "";
                    for (var j = 0; responseJSON[i]['comments'] != null && responseJSON[i]['comments'][j] != null; j++) {
                        commentsHTML += "<span class=\"comment\">" + escapeHtml(responseJSON[i]['comments'][j]['username']) + ": " + escapeHtml(responseJSON[i]['comments'][j]['comment']) + "</span>";
                    }
                    div.innerHTML =
                            "<img onclick=\"displframe2(\'" + responseJSON[i]['img'] + "\');\" class=\"icon removable\" src=\"assembly/" + responseJSON[i]['img'] + "\"></img>" +
                            "<div id=\"buttons-like\">" +
                            "<img onclick=\"onLike(this);\" class=\"button-like\" src=\"img/like.png\" data-image=\"" + responseJSON[i]['img'] + "\"></img>" +
                            "<span class=\"nb-like\" data-src=\"" + responseJSON[i]['img'] + "\">" + responseJSON[i]['likes'] + "</span>" +
                            "<img onclick=\"onDislike(this);\" class=\"button-dislike\" src=\"img/dislike.png\" data-image=\"" + responseJSON[i]['img'] + "\"></img>" +
                            "<span class=\"nb-dislike\" data-src=\"" + responseJSON[i]['img'] + "\">" + responseJSON[i]['dislikes'] + "</span>" +
                            commentsHTML +
                            "</div>";
                    div.className = "img";
                    div.setAttribute("data-img", responseJSON[i]['img']);
                    views.appendChild(div);
                }
                if (typeof (responseJSON['more']) === 'undefined') {
                    buttonLoad.style.display = "none";
                }
            },
            function () {
                alert("Error, unable to load file");
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

function displframe2(src) {
    editphoto.style.display = "block";
    imgeditphoto.src = 'assembly/' + src;
    imageSelected = 'assembly/' + src;
}

function onLike(srcElement) {
    var src = srcElement.getAttribute('data-image');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "ADD LIKE") {
            addlikeuser(src);
        } else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "LIKE CHANGE") {
            clientDislikes[src] = true;
            addlikeuser(src);
        }
    };
    xhr.open("POST", "./framework/like.php?XDEBUG_SESSION_START=netbeans-xdebug", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("img=" + src + "&type=L");
}

function onDislike(srcElement) {
    var src = srcElement.getAttribute('data-image');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "ADD LIKE") {
            adddisluser(src);
        } else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "LIKE CHANGE") {
            clientLikes[src] = true;
            adddisluser(src);
        }
    };
    xhr.open("POST", "./framework/like.php?XDEBUG_SESSION_START=netbeans-xdebug", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("img=" + src + "&type=D");
}
