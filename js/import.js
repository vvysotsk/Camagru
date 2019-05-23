var fileInput = document.getElementById("importpic");
var canvas = document.getElementById("canvas");
var miniatures = document.getElementById("miniatures");
var pickFile = document.getElementById("pickFile");

fileInput.onchange = function (event) {
    var file = this.files[0];
    var image = new Image();
    var img = new Image();
    var data64Img = null;

    canvas.style.display = "block";

    image.addEventListener("load", function (e) {
        canvas.getContext("2d").drawImage(image, 0, 0, image.width, image.height, 0, 0, 640, 480);
        var data64Img = canvas.toDataURL(image.type);
        window.URL.revokeObjectURL(file);

        img.src = document.querySelector('input[name="img"]:checked').value;
        var split = img.src.split("/");
        var file = split[split.length - 1];

        if (file === "frame.png") {
            canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 0, 0, 640, 480);
        } else if (file === "smoke.png") {
            canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 100, 200, 240, 180);
        } else {
            canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 180, 0, 240, 180);
        }

        pickFile.onclick = function () {
            makeassembl(data64Img, file);
        }
    }, false);

    image.src = window.URL.createObjectURL(this.files[0]);
    pickFile.style.display = "block";
}

function makeassembl(imgData64, imglimit) {
    make_ajax_request("./framework/assembly.php",
            "img=" + "../img/" + imglimit + "&f=" + imgData64,
            function (responseText) {
                var imgnew = document.createElement("IMG");
                imgnew.className = "icon removable";
                imgnew.src = "assembly/" + responseText;
                imgnew.onclick = function (event) {
                    var imgdir = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
                    var arfsrc = imgdir.split('/');
                    var src = arfsrc[arfsrc.length - 1];
                    make_ajax_request("./framework/removeassembly.php",
                            "src=" + src,
                            function () {
                                miniatures.removeChild(event.srcElement || event.target);
                            },
                            function () {
                                alert("Error");
                            });
                }
                miniatures.appendChild(imgnew);
            },
            function () {
                alert("Error, unable to import file");
            });
}