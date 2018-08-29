

  function ConfirmExternVisitor()
  {
var x = confirm("Are you sure to store this information?");
  if (x)
    return true;
  else
    return false;
  }


             function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                 x[i].style.display = "none";  
             }
             myIndex++;
             if (myIndex > x.length) {myIndex = 1}    
                x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}


function downloadCanvas(link, canvasId, filename) {
    link.href = document.getElementById(canvasId).toDataURL();
    link.download = filename;
}

function ConfirmDelete(){
var x = confirm("Are you sure to delete this?");
  if (x)
    return true;
  else
    return false;




}




   
