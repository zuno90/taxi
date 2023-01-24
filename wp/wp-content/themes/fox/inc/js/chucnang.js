// che do dark mode
if(document.getElementById("icontheme") != null){
document.addEventListener('DOMContentLoaded', function () {
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');
var icondark = '<i class="fa-regular fa-moon"></i>';
var iconlight = '<i class="fa-regular fa-brightness"></i>';
if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
		document.getElementById("icontheme").innerHTML = iconlight;
    } else {
		document.getElementById("icontheme").innerHTML = icondark;
	}
}

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
		document.getElementById("icontheme").innerHTML = iconlight;
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
		document.getElementById("icontheme").innerHTML = icondark;
    }
}
toggleSwitch.addEventListener('change', switchTheme, false);
});
}
// back to top
window.onscroll = () => {
  toggleTopButton();
}
function scrollBackToTop(){
  window.scrollTo({top: 0, behavior: 'smooth'});
}
function toggleTopButton() {
  if (document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20) {
    document.getElementById('backtop').classList.remove('d-none');
  } else {
    document.getElementById('backtop').classList.add('d-none');
  }
}
// tab share
function getStyle(x, styleProp) {
    if (x.currentStyle) {
        var y = x.currentStyle[styleProp];
    }
    else if (window.getComputedStyle) {
        var y = document.defaultView.getComputedStyle(x, null).getPropertyValue(styleProp);
    }
    return y;
}
function share(e, div_name) {
    var el = document.getElementById(div_name);
    var display = el.style.display || getStyle(el, 'display');
    el.style.display = (display == 'none') ? 'block' : 'none';
    share.el = el;
    if (e.stopPropagation) e.stopPropagation();
    e.cancelBubble = true;
    return false;
}
// hien thi popup
function momodal(div_name){
document.getElementById(div_name).classList.toggle("active");
}
// back to top
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
 
if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
document.getElementById("backtop").style.display = "block";
} else {
document.getElementById("backtop").style.display = "none";
}
}
// chuc nang tao tab
function openrank(evt, rankname) {
  var i, x, ranktab;
  x = document.getElementsByClassName("rank");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  ranktab = document.getElementsByClassName("ranktab");
  for (i = 0; i < x.length; i++) {
    ranktab[i].className = ranktab[i].className.replace(" rank-ac", "");
  }
  document.getElementById(rankname).style.display = "block";
  evt.currentTarget.className += " rank-ac";
}
// hien thi menu icon
function taomenuicon() {
  document.getElementById("hienmenuicon").classList.toggle("hienthiicon");
}
window.onclick = function(event) {
  if (!event.target.matches('.nuticon')) {
    var menuicons = document.getElementsByClassName("menuicon-content");
    var i;
    for (i = 0; i < menuicons.length; i++) {
      var openmenuicon = menuicons[i];
      if (openmenuicon.classList.contains('hienthiicon')) {
        openmenuicon.classList.remove('hienthiicon');
      }
    }
  }
}

// cookie thông báo
var cookiebox = document.getElementById("cookiebox");
if(cookiebox != null){
const cookieBox = document.querySelector(".cookiebox"),
    acceptBtn = cookieBox.querySelector("button");
    acceptBtn.onclick = ()=>{
      document.cookie = "CookieBy=Cookiefox; max-age="+60*60*24*30;
      if(document.cookie){ 
        cookieBox.classList.add("hide"); 
      }else{ 
        alert("Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
      }
    }
    let checkCookie = document.cookie.indexOf("CookieBy=Cookiefox"); 
    checkCookie != -1 ? cookieBox.classList.add("hide") : cookieBox.classList.remove("hide");
}
// auto go key
var sloganspan = document.querySelector(".author-slogan span");
if(sloganspan != null){
var textArr = sloganspan.getAttribute("data-text").split(", "); 
var maxTextIndex = textArr.length; 
var sPerChar = 0.15; 
var sBetweenWord = 1.5;
var textIndex = 0; 
typing(textIndex, textArr[textIndex]); 
function typing(textIndex, text) {
    var charIndex = 0; 
    var maxCharIndex = text.length - 1; 
    var typeInterval = setInterval(function () {
        sloganspan.innerHTML += text[charIndex]; 
        if (charIndex == maxCharIndex) {
            clearInterval(typeInterval);
            setTimeout(function() { deleting(textIndex, text) }, sBetweenWord * 1000); 
            
        } else {
            charIndex += 1; 
        }
    }, sPerChar * 1000); 
}
function deleting(textIndex, text) {
    var minCharIndex = 0; 
    var charIndex = text.length - 1; 
    var typeInterval = setInterval(function () {
        sloganspan.innerHTML = text.substr(0, charIndex); 
        if (charIndex == minCharIndex) {
            clearInterval(typeInterval);
            textIndex + 1 == maxTextIndex ? textIndex = 0 : textIndex += 1; 
            setTimeout(function() { typing(textIndex, textArr[textIndex]) }, sBetweenWord * 1000); 
        } else {
            charIndex -= 1; 
        }
    }, sPerChar * 1000); 
}
}
// comment tab
function opencomen(evt, coname) {
  var i, x, cotabtab;
  x = document.getElementsByClassName("comments-area");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  cotabtab = document.getElementsByClassName("cotabtab");
  for (i = 0; i < x.length; i++) {
    cotabtab[i].className = cotabtab[i].className.replace(" cotab-ac", "");
  }
  document.getElementById(coname).style.display = "block";
  evt.currentTarget.className += " cotab-ac";
}