// Shpagin Kirill 

// Объявления
var msg = document.querySelector(".msg");
var gsapMsg = gsap.to(".msg", 0.25, {autoAlpha: 1,y: -40,ease: Expo.inOut, paused: true});
var arrInput = document.querySelectorAll('.aInput');

// Функция отправки сообщения
function send(event, php){
event.preventDefault ? event.preventDefault() : event.returnValue = false;
for (var i = 0,count=arrInput.length; i<count; i++) {arrInput[i].classList.remove("inputerror");}
event.target.querySelector("button").disabled = true;

if (window.navigator.onLine) {
showMsg("Подождите. Идёт отправка сообщения", "#b1b1b1");
} else {
showMsg("Нет подключения к Интернету", "red");
}

var req = new XMLHttpRequest();
req.open('POST', php, true);
req.onload = function() {
event.target.querySelector("button").disabled = false;
    if (req.status >= 200 && req.status < 400) {
        json = JSON.parse(this.response); // Ебанный internet explorer 11
        console.log(json);

        // ЗДЕСЬ УКАЗЫВАЕМ ДЕЙСТВИЯ В СЛУЧАЕ УСПЕХА ИЛИ НЕУДАЧИ
        if (json.result == "success") {
            // если сообщение отправлено
            showMsg("Сообщение успешно отправлено", "#36AE46");
            console.log("Сообщение отправлено");
            // event.target.reset();
event.target.querySelector("button").disabled = true;			
jQuery(document).ready(function($) {
  document.getElementById( "iput1" ).style = "border: 1px solid inherit";
  document.getElementById( "iput2" ).style = "border: 1px solid inherit";
  document.getElementById( "iput3" ).style = "border: 1px solid inherit";
  localStorage.setItem('dte', document.getElementById("dte").value);
});
        } else if(json.result == "email") {
            // Если указан неверный email
            showMsg("Ошибка. Неверно указан Email", "#DC352F");
            console.log("Ошибка. Неверно указан Email");
            document.querySelector("#email").classList.add("inputerror");
        } else {
            // Если произошла ошибка
            showMsg("Ошибка. Сообщение не отправлено", "#DC352F");
            console.log("Ошибка. Сообщение не отправлено");
        }

    // Если не удалось связаться с php файлом
    } else {showMsg("Ошибка сервера. Номер: "+req.status, "#DC352F");}}; 

// Если не удалось отправить запрос. Стоит блок на хостинге
req.onerror = function() {showMsg("Ошибка отправки запроса", "#DC352F");};
req.send(new FormData(event.target));
}

// Функция появления статуса отправки сообщения
function showMsg(message, color) {
msg.innerText = message;
msg.style.background = color;
gsapMsg.restart();
}

// Анимация input text
for (var i = 0, count = arrInput.length; i < count; i++) {
arrInput[i].addEventListener("focus", function() {
this.nextElementSibling.classList.add("active");
});
arrInput[i].addEventListener("blur", function() {
if (this.value == false) 
this.nextElementSibling.classList.remove("active");
});
}

// Анимация появления блоков
window.onload = function() {
var loadPage = gsap.timeline();
loadPage.to("#form", 0.7, {autoAlpha: 1,y: 0, ease: Expo.inOut});
loadPage.to(".link", 0.7, {autoAlpha: 1,y: 0, ease: Expo.inOut}, 0);
loadPage.to(".input-wrap", 0.5, {stagger: 0.15, autoAlpha: 1,y: 0, ease: Expo.inOut}, 0.35);
loadPage.to(".file-wrap, .button", 0.5, {stagger: 0.15, autoAlpha: 1,x: 0, ease: Expo.inOut}, 0.6);
}