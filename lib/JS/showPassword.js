function Show() {
    var x = document.getElementById("ShowPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }