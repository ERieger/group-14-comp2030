
function deleteMachine(button)
{   if (confirm("Are you sure you want to delete this machine?")) {
    let row= button.parentNode.parentNode;
    row.parentNode.removeChild(row);
    }
}

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
  
  