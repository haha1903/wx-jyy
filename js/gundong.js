var current = 0;
var count;
$(function() {
    var interval = 4500;
    count = $(".ad").size();
    $(".ad").each(function(i) {
        var icon = $("<div class='icon'>" + (i + 1) + "</div>");
        var ad = $(this);
        icon.click(function() {
            nextTo(i);
        });
        $(".ads .icons").append(icon);
    });
    $(".ad:first").clone().appendTo($(".adBox"));
    var si = setInterval("next()", interval);
    $(".ads").hover(function() {
        clearInterval(si);
    }, function() {
        si = setInterval("next()", interval);
    });
    next();
});
function next() {
    if(current > count)
        current = 1;
    nextTo(current++);
}
function nextTo(i) {
    $(".ads .icons .icon").removeClass("on");
    $(".ads .icons .icon").eq(i >= count ? 0 : i).addClass("on");
    if($(".adBox").position().top + $(".adBox").height() <= 350) {
        $(".adBox").offset({top: 0});
        $(".adBox").offset({top: -$(".adBox").position().top});
    }
    if(i > 0) {
        $(".adBox").animate({
            top: "-=350"
        }, 1000);
    }
}
