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

function removeChildren(elem){
    while (elem.hasChildNodes()) {
        removeChildren(elem.lastChild)
        elem.removeChild(elem.lastChild);
    }
}

function postResults(response){
    console.log(response);

    var res = JSON.parse(response);
    //console.log(res);

    var projects = res[0].projects;
    var friends = res[0].friends;
    //console.log(projects);
    //console.log(friends);

    var div = document.getElementById("extras");
    removeChildren(div);

    var projList = document.createElement('ul');
    projList.appendChild(document.createTextNode("My projects:"));

    var countProj = 0;
    while (countProj < projects.length){
        var li = document.createElement('li');
        var anchor = document.createElement('a');

        anchor.appendChild(document.createTextNode(projects[countProj].title));
        anchor.setAttribute('href', "viewproject.php?pid=" + projects[countProj].pid);

        li.appendChild(anchor);
        projList.appendChild(li);
        countProj++;
    }

    div.appendChild(projList);

    var friendsList = document.createElement('ul');
    friendsList.appendChild(document.createTextNode("My friends:"));

    var friendCount = 0;
    while (friendCount < friends.length) {
        var li = document.createElement('li');

        li.appendChild(document.createTextNode(friends[friendCount].friend));

        friendsList.appendChild(li);
        friendCount++;
    }

    div.appendChild(friendsList);
}