function update() {
    var query = document.forms["searchform"]["search"].value;
    console.log(document.forms["searchform"]["searchBy"].value)

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

    xmlhttp.open("POST", "search3.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("search=" + query + "&searchBy=Title");
}

function postResults(response){
    var data = JSON.parse(response);
    console.log("found " + data.length + " results");
    var ul = document.getElementById("results");

    removeChildren(ul);

    var i = 0;
    while (i < data.length) {
        var li = document.createElement('li');
        var anchor = document.createElement('a');

        anchor.appendChild(document.createTextNode(data[i].title));
        anchor.setAttribute('href', "viewproject.php?pid=" + data[i].pid);

        li.appendChild(anchor);
        ul.appendChild(li);
        i++;
    }
}

function removeChildren(elem){
    while (elem.hasChildNodes()) {
        removeChildren(elem.lastChild)
        elem.removeChild(elem.lastChild);
    }
}
//<li><h1>UID: $uid</h1><h2>Title: $title</h2><p>Details: $details</p</br>$deadline Goal: $goal</li>"