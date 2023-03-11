//DATE
var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
document.getElementById('date').innerHTML = date;

//CLOCK
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h +  " : " + m + " : " + s;
    var t = setTimeout(startTime, 500);
};
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}

