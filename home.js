function displayRegForm() {
    category = "createNew";  
    changeDisplay();
}

function displayProgress() {
    category = "progress";
    changeDisplay ();
}

function training() {
    category = "training";
    changeDisplay ();
}
function regSignature() {
    category = "regSignature";
    changeDisplay ();
}
function userManagement() {
    category = "userManagement";
    changeDisplay ();
}

var category=[];

function changeDisplay() {
    var x = document.getElementById("main");
    var y = document.getElementById("progress");
    var z = document.getElementById("training");
    var xy = document.getElementById("regsignature");
    var xz = document.getElementById("usermanagement");

    if (category==="createNew") {
          y.style.display = "none";
          z.style.display = "none";
          xy.style.display = "none";
          xz.style.display = "none";
          x.style.display = "flex";
       
      }
    else if (category==="progress") {
          x.style.display = "none";
          z.style.display = "none";
          xy.style.display = "none";
          xz.style.display = "none";
          y.style.display = "flex";
      }
    else if (category==="training") {
          y.style.display = "none";
          x.style.display = "none";
          xy.style.display = "none";
          xz.style.display = "none"; 
          z.style.display = "flex";
      }
    else if (category==="regSignature") {
          x.style.display = "none";
          y.style.display = "none";
          z.style.display = "none";
          xz.style.display = "none"; 
          xy.style.display = "flex";
      }
    else if  (category==="userManagement") {
          x.style.display = "none";
          y.style.display = "none";
          z.style.display = "none";
          xy.style.display = "none"; 
          xz.style.display = "flex";
      }
    }




