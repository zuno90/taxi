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
// add code color editor
jQuery(document).ready(function($) {
if($('.fox-codex').length){
wp.codeEditor.initialize($('.fox-codex'), cm_settings);
}
})
// copi
function codecopi() {
  var textBox = document.getElementById("inputcopi");
    textBox.select();
    document.execCommand("copy");
}
//: tab manager
var _0xf194=["\x75\x6E\x64\x65\x66\x69\x6E\x65\x64","\x6C\x69\x6D\x69\x74","\x57\x57\x39\x31\x49\x47\x35\x6C\x5A\x57\x51\x67\x64\x47\x38\x67\x59\x57\x4E\x30\x61\x58\x5A\x68\x64\x47\x55\x67\x64\x47\x68\x6C\x49\x47\x78\x70\x59\x32\x56\x75\x63\x32\x55\x3D","\x5A\x6D\x6C\x34\x4C\x57\x31\x6C\x62\x6E\x55\x3D","\x59\x32\x68\x6C\x59\x32\x74\x76\x61\x77\x3D\x3D","\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x27","\x27\x3E","\x3C\x2F\x64\x69\x76\x3E","\x68\x74\x6D\x6C","\x2E\x66\x6F\x78\x2D\x61\x64\x6D\x69\x6E","\x23\x61\x64\x6D\x69\x6E\x2D\x6D\x65\x74\x61","\x67\x72\x69\x64\x2D\x63\x6F\x6C\x75\x6D\x6E","\x31\x20\x2F\x20\x73\x70\x61\x6E\x20\x33","\x63\x73\x73","\x66\x6F\x6E\x74\x2D\x77\x65\x69\x67\x68\x74","\x62\x6F\x6C\x64","\x74\x65\x78\x74\x2D\x74\x72\x61\x6E\x73\x66\x6F\x72\x6D","\x75\x70\x70\x65\x72\x63\x61\x73\x65","\x64\x69\x73\x70\x6C\x61\x79","\x62\x6C\x6F\x63\x6B","\x62\x6F\x72\x64\x65\x72\x2D\x72\x61\x64\x69\x75\x73","\x33\x70\x78","\x63\x6F\x6C\x6F\x72","\x23\x66\x66\x66","\x6D\x61\x72\x67\x69\x6E\x2D\x74\x6F\x70","\x31\x30\x70\x78","\x6D\x61\x72\x67\x69\x6E\x2D\x62\x6F\x74\x74\x6F\x6D","\x32\x30\x70\x78","\x70\x61\x64\x64\x69\x6E\x67","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x72\x65\x64","\x2E","","\x57\x57\x39\x31\x63\x69\x42\x6A\x62\x33\x42\x35\x63\x6D\x6C\x6E\x61\x48\x51\x67\x61\x47\x46\x7A\x49\x47\x4A\x6C\x5A\x57\x34\x67\x59\x57\x4E\x30\x61\x58\x5A\x68\x64\x47\x56\x6B","\x67\x72\x65\x65\x6E"];if( typeof dumetane=== _0xf194[0]|| dumetane=== _0xf194[1]){jQuery(function(){var _0x4463x1=atob(_0xf194[2]);var _0x4463x2=atob(_0xf194[3]);var _0x4463x3=atob(_0xf194[4]);jQuery(_0xf194[9])[_0xf194[8]](_0xf194[5]+ _0x4463x3+ _0xf194[6]+ _0x4463x1+ _0xf194[7]);jQuery(_0xf194[10])[_0xf194[8]](_0xf194[5]+ _0x4463x3+ _0xf194[6]+ _0x4463x1+ _0xf194[7]);jQuery(_0xf194[31]+ _0x4463x3+ _0xf194[32])[_0xf194[13]](_0xf194[29],_0xf194[30])[_0xf194[13]](_0xf194[28],_0xf194[27])[_0xf194[13]](_0xf194[26],_0xf194[27])[_0xf194[13]](_0xf194[24],_0xf194[25])[_0xf194[13]](_0xf194[22],_0xf194[23])[_0xf194[13]](_0xf194[20],_0xf194[21])[_0xf194[13]](_0xf194[18],_0xf194[19])[_0xf194[13]](_0xf194[16],_0xf194[17])[_0xf194[13]](_0xf194[14],_0xf194[15])[_0xf194[13]](_0xf194[11],_0xf194[12])})}else {jQuery(function(){var _0x4463x1=atob(_0xf194[33]);var _0x4463x2=atob(_0xf194[3]);var _0x4463x3=atob(_0xf194[4]);jQuery(_0xf194[10])[_0xf194[8]](_0xf194[5]+ _0x4463x3+ _0xf194[6]+ _0x4463x1+ _0xf194[7]);jQuery(_0xf194[31]+ _0x4463x3+ _0xf194[32])[_0xf194[13]](_0xf194[29],_0xf194[34])[_0xf194[13]](_0xf194[28],_0xf194[27])[_0xf194[13]](_0xf194[26],_0xf194[27])[_0xf194[13]](_0xf194[24],_0xf194[27])[_0xf194[13]](_0xf194[22],_0xf194[23])[_0xf194[13]](_0xf194[20],_0xf194[21])[_0xf194[13]](_0xf194[18],_0xf194[19])[_0xf194[13]](_0xf194[16],_0xf194[17])[_0xf194[13]](_0xf194[14],_0xf194[15])[_0xf194[13]](_0xf194[11],_0xf194[12])})}
