$(function () {

    $(document).on("click", ".btn_wish", function() {
        add_wishitem(this);
    });
});

function add_wishitem(el)
{
    var $el   = $(el);
    var it_id = $el.data("it_id");

    if(!it_id) {
        alert("상품코드가 올바르지 않습니다.");
        return false;
    }

    $.post(
        g5_theme_shop_url + "/ajax.wishupdate.php",
        { it_id: it_id },
        function(error) {
            if(error != "OK") {
                alert(error.replace(/\\n/g, "\n"));
                return false;
            }

            alert("상품을 위시리스트에 담았습니다.");
            return;
        }
    );
}

// php chr() 대응
if(typeof chr == "undefined") {
    function chr(code)
    {
        return String.fromCharCode(code);
    }
}