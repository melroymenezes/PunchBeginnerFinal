function like(){
    sendLike(true);
}

function dislike(){
    sendLike(false);
}

function sendLike(status){
    
    if (!isSameCommunity()) {
        return;
    }

    if (window.XMLHttpRequest) {    // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {     // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            //console.log(xmlhttp.responseText);

            if (xmlhttp.responseText == "success") {
                window.location.reload(true);
            } else if (xmlhttp.responseText == "Already liked") {
                alert(xmlhttp.responseText);
            } else {
                console.log(xmlhttp.responseText);
            }


        }
    }

    xmlhttp.open("POST", "like.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (status){
        xmlhttp.send((window.location.search).substring(1) + "&like=1");
    } else {
        xmlhttp.send((window.location.search).substring(1) + "&like=0");
    }
}

function isSameCommunity(){
    return true;
}