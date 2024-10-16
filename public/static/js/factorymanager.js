
function deleteMachine(button)
{   if (confirm("Are you sure you want to delete this machine?")) {
    let row= button.parentNode.parentNode;
    row.parentNode.removeChild(row);
    }
}

const add_button = document.getElementById("newmach");
add_button.addEventListener("click", function(){
  
}
  
  