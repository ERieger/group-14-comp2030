
function getTime()
{
    var dt = new Date();
document.getElementById("time").innerHTML = dt.toLocaleTimeString();
}
window.onload= function(){

getTime();
setInterval(getTime,1000);
};
