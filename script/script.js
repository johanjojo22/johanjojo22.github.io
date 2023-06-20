function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("sidebar").style.marginLeft = "0px";
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("cls").style.display = "block";
    document.getElementById("opn").style.display = "none";
  }
  
  function closeNav() {
    document.getElementById("sidebar").style.marginLeft = "-250px";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("opn").style.display = "block";
    document.getElementById("cls").style.display = "none";
  }
  
  