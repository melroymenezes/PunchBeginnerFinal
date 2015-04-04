function donate(){
    var amount = -1;
    if (isSameCommunity()) { //same community probably do an xmlhttprequest
        while (amount < 0) {
            amount = window.prompt("Please enter amount: ", 0);
        }
    } else {
        window.alert("not in community");
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
            }
            //postResults(xmlhttp.responseText);
        }
    }

    xmlhttp.open("POST", "donate.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send((window.location.search).substring(1) + "&amount=" + amount);

}

function isSameCommunity(){
    return true;
}