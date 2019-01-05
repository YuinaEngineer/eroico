var box = document.getElementsByTagName("vimeo");
for (var i = box.length - 1; i >= 0; i--) {
    var _video = box[i].getAttribute("src");
    var __video = _video.match(/https:\/\/vimeo.com(.*)\/([0-9]+)/);
    video = __video[2];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://player.vimeo.com/video/" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("youtube");
for (var i = box.length - 1; i >= 0; i--) {
    var _video = box[i].getAttribute("src");
    var __video = _video.match(/\?v=(.*)/);
    video = __video[1];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://www.youtube.com/embed/" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("pornhub");
for (var i = box.length - 1; i >= 0; i--) {
  var _video = box[i].getAttribute("src");
  var __video = _video.match(/\?viewkey=([0-9a-zA-Z-_]+)/);
  video = __video[1];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://pornhub.com/embed/" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("xvideos");
for (var i = box.length - 1; i >= 0; i--) {
  var _video = box[i].getAttribute("src");
  var __video = _video.match(/video([0-9]+)/);
  video = __video[1];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://www.xvideos.com/embedframe/" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("tube8");
for (var i = box.length - 1; i >= 0; i--) {
  var _video = box[i].getAttribute("src");
  var __video = _video.match(/https:\/\/www\.tube8\.com\/(.*)/);
  video = __video[1];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://www.tube8.com/embed/" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("xhamster");
for (var i = box.length - 1; i >= 0; i--) {
  var _video = box[i].getAttribute("src");
  var __video = _video.match(/-([0-9]+)|-([0-9]+)\?/);
  video = __video[1];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://xhamster.com/embed/" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("javynow");
for (var i = box.length - 1; i >= 0; i--) {
  var _video = box[i].getAttribute("src");
  var __video = _video.match(/([0-9]+)/);
  video = __video[0];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://javynow.com/player/" + video+"/");
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("erovideo");
for (var i = box.length - 1; i >= 0; i--) {
  var _video = box[i].getAttribute("src");
  var __video = _video.match(/\?mcd=([a-zA-Z0-9]+)/);
  video = __video[1];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://ero-video.net/blogframe/?mcd=" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("fc2");
for (var i = box.length - 1; i >= 0; i--) {
  var video = box[i].getAttribute("src");
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://phml.tech/fc2?url=" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
var box = document.getElementsByTagName("nicovideo");
for (var i = box.length - 1; i >= 0; i--) {
    var _video = box[i].getAttribute("src");
    var __video = _video.match(/watch\/(.*)/);
    video = __video[1];
    var width = box[i].getAttribute("width");
    var height = box[i].getAttribute("height");
    if (width == undefined && height == undefined) {
        width = 640;
        height = 360;
    }else if(width != undefined && height == undefined){
        height = (width/16)*9;
    }else if(width == undefined && height != undefined){
        width = (height/9)*16;
    }
    var _class = box[i].getAttribute("class");
    var _id = box[i].getAttribute("id");
    if(_class == null){
        _class="";
    }
    if(_id == null){
        _id="";
    }
    var change = document.createElement("iframe");
    change.setAttribute("src", "https://phml.tech/nicovideo/" + video);
    change.setAttribute("width", width);
    change.setAttribute("height", height);
    change.setAttribute("frameborder", "0");
    change.setAttribute("allowfullscreen", "true");
    change.setAttribute("data-phml", "nicovideo");
    change.setAttribute("class", _class);
    change.setAttribute("id", _id);
    box[i].parentNode.replaceChild(change, box[i])
}
