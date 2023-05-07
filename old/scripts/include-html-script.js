function includeHTML() {
  const allTags = document.getElementsByTagName("*");

  for (i = 0; i < allTags.length; i++) {

    const currentTag = allTags[i];
    const file = currentTag.getAttribute("include-html-tag");

    if (file) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {currentTag.innerHTML = this.responseText;}
          if (this.status == 404) {currentTag.innerHTML = "Error loading form. We are trying to fix it. Sorry((";}
          currentTag.removeAttribute("include-html-tag");
          includeHTML();
        }
      }
      xhttp.open("GET", file, true);
      xhttp.send();
      return;
    }
  }
}