var modal = document.getElementById('modal');
var assemblpic = document.getElementsByClassName("icon");
var span = document.getElementsByClassName("close")[0];
var imgModal = document.getElementById('img-modal');
var send = document.getElementById('send-comment');
var comment = document.getElementById('comment');

var imageSelected = null;

for (var i=0; i < assemblpic.length; i++) {
  assemblpic[i].onclick = showModal;
}

function showModal(event) {
  modal.style.display = "block";
  imgModal.src = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
  imageSelected = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
}

// When the user clicks on the button, open the modal
assemblpic.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

send.onclick = function (event) {
    var com = comment.value;
    if (com == "" || com == null) {
        return;
    }

    var tmp = imageSelected.split('/');
    var imagePath = tmp[tmp.length - 1];

    make_ajax_request("./framework/comment.php",
            "img=" + imagePath + "&comment=" + com,
            function (responseText) {
                var div = document.querySelectorAll("[data-img='" + imagePath + "']")[0];
                var span = document.createElement('span');
                span.innerHTML = responseText + ": " + escapeHtml(com);
                span.setAttribute("class", "comment");
                div.appendChild(span);
                comment.value = "";
                modal.style.display = "none";
            },
            function () {
                alert("Error, unable to add comment");
                comment.value = "";
                modal.style.display = "none";
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
