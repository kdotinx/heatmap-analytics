$(document).ready(function () {
    var param1var = getQueryVariable("domain_name");
    getRemote(param1var);
    d = document.createElement('div');
    document.body.appendChild(d);
    d.innerHTML = window.location.href;
    $(d).css({
        position: 'absolute', bottom: 0,
        margin: 'auto',
        width: '400px',
        height: '20px', left: 0,
        background: 'gray', opacity: 0.5
    })
    $(d).addClass("domain-name");
})
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    alert('Query Variable ' + variable + ' not found');
}
function getRemote(domain) {
    var url = "../controller/get_location.php?domain_name=" + domain;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        success: function (result) {
            //alert(result);
            var objarr = JSON.parse(result);
            var img = document.getElementById("theImg");
            var cnvs = document.getElementById("myCanvas");
            cnvs.style.position = "absolute";
            cnvs.style.left = img.offsetLeft + "px";
            cnvs.style.top = img.offsetTop + "px";
            var ctx = cnvs.getContext("2d");
            for (var i = 0; i < objarr.length; i++) {
                if (i != 0) {
                    var a = objarr[i - 1].x - objarr[i].x;
                    var b = objarr[i - 1].y - objarr[i].y;
                    var d = Math.sqrt(a * a + b * b);
                    if (d < 20) {
                        Draw(ctx, objarr[i].x, objarr[i].y, 'red');
                    } else {
                        Draw(ctx, objarr[i].x, objarr[i].y, 'orange');
                    }
                }
            }
        }
    });
}
function Draw(ctx, x, y, color, d) {
    d = document.createElement('div');
    document.body.appendChild(d);

    $(d).css({
        position: 'absolute',
        margin: 'auto',
        width: '2px',
        height: '2px', left: x + 'px', top: y + 'px',
        background: color, 'border-radius': '100%',
        'z-index': '1000', 'box-shadow': '2px 2px 100px 10px red'
    })
    pulsate($(d), x);
}
function pulsate(element, i) {
    $(element || this).delay(i).fadeOut(500).delay(i).fadeIn(500, pulsate);
}


