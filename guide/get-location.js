var pos = {x: -1, y: -1}
var url = location.href;
$(window).click(function (event) {
    pos.x = event.pageX;
    pos.y = event.pageY;
    $("title").text(pos.x);
    getRemote(pos, url);
});

function getRemote(pos, domain) {
    var url = "http://heat.dike.io/controller/save_location.php?x=" + pos.x + "&y=" + pos.y + "&domain_name=" + domain;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        success: function (result, status) {
           // alert(status);
        }
    });
}
