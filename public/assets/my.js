function markRead(){
    $.get("/markAsRead")
}
setTimeout(()=>{
    var alertId = document.getElementById('remove')
    alertId.classList.add('modal')
},3000);