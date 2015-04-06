function display(){

    if (window.XMLHttpRequest) {    // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {     // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            //console.log(xmlhttp.responseText);
            postResults(xmlhttp.responseText);
        }
    }

    xmlhttp.open("POST", "getprofile.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("value=1");
}

function postResults(response){
    var res = JSON.parse(response);
    var projects = res.projects;
    var friends = res.friends;
    console.log(projects);
    console.log(friends);
}