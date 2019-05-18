var video = document.querySelector("#webcam");
var canvas = document.getElementById("canvas");
var button = document.getElementById("selectimg");
var miniatures = document.getElementById("miniatures");
var fileimport = document.getElementById("importpic");
var pickFile = document.getElementById("pickFile");
var offCam = document.getElementById("webcam_is_off");
var cam = document.getElementById("cam");
var smoke = document.getElementById("smoke");
var kitty = document.getElementById("kitty");

var cameraAvailable = false;

var promisifiedOldGUM = function (limitation) {
    var getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia);
    if (!getUserMedia) {
        return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
    }

    return new Promise(function (resolve, reject) {
        getUserMedia.call(navigator, limitation, resolve, reject);
    });
}

if (navigator.mediaDevices === undefined) {
    navigator.mediaDevices = {};
}

if (navigator.mediaDevices.getUserMedia === undefined) {
    navigator.mediaDevices.getUserMedia = promisifiedOldGUM;
}

var limitation = {video: true}
navigator.mediaDevices.getUserMedia(limitation)
        .then(videoprocess)
        .catch(videoError);

function videoprocess(stream) {
    video.src = stream;
    cameraAvailable = true;
    video.style.display = "block";
    offCam.style.display = "none";
    button.onclick = function () {
        var image = new Image();
        canvas.style.display = "none";
        pickFile.style.display = "none";
        image.addEventListener("load", function () {
            if (file === "frame.png") {
                canvas.getContext("2d").drawImage(image, 0, 0, 1024, 768, 0, 0, 640, 480);
            } else if (file === "smoke.png") {
                canvas.getContext("2d").drawImage(image, 0, 0, 1024, 768, 100, 200, 240, 180);
            } else {
                canvas.getContext("2d").drawImage(image, 0, 0, 1024, 768, 180, 0, 240, 180);
            }
        }, false);
        image.src = document.querySelector('input[name="img"]:checked').value;
        var split = image.src.split("/");
        var file = split[split.length - 1];
        canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
        var img = canvas.toDataURL("image/png");
        make_ajax_request("./framework/assembly.php",
                "img=" + "../img/" + file + "&f=" + img,
                function (responseText) {
                    var imgnew = document.createElement("IMG");
                    imgnew.className = "icon removable";
                    imgnew.src = "assembly/" + responseText;
                    imgnew.onclick = function (event) {
                        var imgdir = event.srcElement.src;
                        var arfsrc = imgdir.split('/');
                        var src = arfsrc[arfsrc.length - 1];
                        make_ajax_request("./framework/removeassembly.php",
                                "src=" + src,
                                function () {
                                    miniatures.removeChild(event.srcElement);
                                },
                                function () {
                                    alert("Error");
                                });
                    };
                    miniatures.appendChild(imgnew);
                },
                function () {
                    alert("Error, unable to display video");
                });
    };
}

function videoError(e) {
    cameraAvailable = false;
    video.style.display = "none";
    offCam.style.display = "block";
}

function camcheck(checkbox) {
    if (cameraAvailable) {
        button.style.display = "block";
        if (checkbox.id === "frame.png") {
            cam.style.display = "block";
            smoke.style.display = "none";
            kitty.style.display = "none";
        } else if (checkbox.id === "smoke.png") {
            cam.style.display = "none";
            smoke.style.display = "block";
            kitty.style.display = "none";
        } else {
            cam.style.display = "none";
            smoke.style.display = "none";
            kitty.style.display = "block";
        }
    }
    fileimport.style.display = "block";
    if (fileimport.files.length) {
        var image = new Image();
        var img = new Image();
        image.addEventListener("load", function () {
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
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
        image.src = window.URL.createObjectURL(fileimport.files[0]);
    }
}

function makeassembl(imgData64, imglimit) {
    make_ajax_request("./framework/assembly.php",
            "img=" + "../img/" + imglimit + "&f=" + imgData64,
            function (responseText) {
                var imgnew = document.createElement("IMG");
                imgnew.className = "icon removable";
                imgnew.src = "assembly/" + responseText;
                imgnew.onclick = function (event) {
                    var imgdir = event.srcElement.src;
                    var arfsrc = imgdir.split('/');
                    var src = arfsrc[arfsrc.length - 1];
                    make_ajax_request("./framework/removeassembly.php",
                            "src=" + src,
                            function () {
                                miniatures.removeChild(event.srcElement);
                            },
                            function () {
                                alert("Error");
                            });
                };
                miniatures.appendChild(imgnew);
            },
            function () {
                alert("Error, unable to display assambley");
            });
}
