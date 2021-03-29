function notification() {
    var div = document.getElementById('note');
    div.innerHTML = 'Añadido Correctamente';
    document.getElementById("note").style.zIndex = "101";
    setTimeout(function () {
        document.getElementById("note").style.zIndex = "-1";
        closeNot()
    }, 1000)
    
}
function closeNot(){
    var div = document.getElementById('note');
    div.innerHTML = '';
}