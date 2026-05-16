var current = 0;
var count;
var t;
$(function() {
    var interval = 5000;
    count = $(".info").size();
    $(".info").each(function(i) {
        var icon = $("<div class='icon'>" + (i + 1) + "</div>");
        icon.click(function() {
            nextTo(i);
        });
        $(".infos .icons").append(icon); 
    });
    $(".info:first").clone().appendTo($(".infoBox"));
    var si = setInterval("next()", interval);
    $(".infos").hover(function() {
        clearInterval(si);
    }, function() {
        si = setInterval("next()", interval);
    });
    t = $(".infoBox").position().top;
    next();
});
function next() {
    if(current > count)
        current = 1;
    nextTo(current++);
}
function nextTo(i) {
    $(".infos .icons .icon").removeClass("on");
    $(".infos .icons .icon").eq(i >= count ? 0 : i).addClass("on");
    if($(".infoBox").position().top + $(".infoBox").height() <= 350) {
        $(".infoBox").offset({top: 0});
        $(".infoBox").offset({top: -$(".infoBox").position().top});
    }
    $(".infoBox").animate({
        top: t - 350 * i
    }, 1000);
}
