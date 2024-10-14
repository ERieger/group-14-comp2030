
function getTime()
{
    var dt = new Date();
document.getElementById("time").innerHTML = dt.toLocaleTimeString();
}
window.onload= function(){

getTime();
setInterval(getTime,1000);
};


document.addEventListener('DOMContentLoaded', function() {
    // Handle panel toggle
    const buttons = document.querySelectorAll('.new'); // Changed .btn to .new
    buttons.forEach(function(button) {
      button.addEventListener('click', function() {
        const panelID = this.getAttribute('data-panel');
        const panel = document.querySelector(`.${panelID}`);
        if (panel) {
          panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        }
      });
    });
  
    // Handle navigation hover
    const navigationItems = document.querySelectorAll('.navigation li');
    navigationItems.forEach(function(item) {
      item.addEventListener('mouseenter', function() {
        const subMenu = this.querySelector('ul');
        if (subMenu) {
          subMenu.style.display = 'block';
        }
      });
      item.addEventListener('mouseleave', function() {
        const subMenu = this.querySelector('ul');
        if (subMenu) {
          subMenu.style.display = 'none';
        }
      });
    });
  });
  
  