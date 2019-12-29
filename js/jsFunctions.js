

// Some javascript functions used by the application.
// Most of these are 'wrapped' by PHP functions. i.e. called by PHP functions of the same name
// and with the same parameters.

function addNavBarLink (txt, url, isActive, id){
        var el = document.getElementById("navBar");
        var link = document.createElement("a");
        link.innerText = txt;
        if (isActive){
                link.setAttribute('class', 'active');
        }
        link.setAttribute('href', url);
        link.setAttribute('id', id);
     //   link.setAttribute('style', 'border-radius: 25px;padding-right:25px;');
        el.appendChild(link);
}

function setLink(id, attr, val){
        var link = document.getElementById(id);
        link.setAttribute(attr, val);
        
}

function removeElement(elementId) {
        // Removes an element from the document
        var element = document.getElementById(elementId);
        element.parentNode.removeChild(element);
}



function goBack() {
        window.history.back();
}


function refreshPage(){
        var url = document.referrer;
        location.href = url;
   
}

function toggleHide(elementId) {
        var x = document.getElementById(elementId);
        if (x.style.display == "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      
}