function common(){

    if (window.XMLHttpRequest) {    // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {     // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }


    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            //console.log(xmlhttp.responseText);
            if (xmlhttp.responseText == 1) {
                //console.log(xmlhttp.responseText);
                //console.log("hello");
                donate();
            } else {
                alert("Not in community");
            }
        }
    }
    
    xmlhttp.open("POST", "donate1.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send((window.location.search).substring(1));
    
}

function donate(){
    var amount = -1;

    while (amount < 0) {
        amount = window.prompt("Please enter amount: ", 0);
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
            
        }
    }

    xmlhttp.open("POST", "donate.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send((window.location.search).substring(1) + "&amount=" + amount);

}

