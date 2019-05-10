function make_ajax_request(dest, param, success_callback, error_callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if ((xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
                success_callback(xhr.responseText);
            } else
                error_callback();
        }
    }
    xhr.open("POST", dest + "?XDEBUG_SESSION_START=netbeans-xdebug", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(param);
}