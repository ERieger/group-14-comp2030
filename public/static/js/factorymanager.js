function getTime()
{
    var dt = new Date();
document.getElementById("time").innerHTML = dt.toLocaleTimeString();
}
getTime();