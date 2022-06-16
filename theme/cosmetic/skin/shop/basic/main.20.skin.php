<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>
<div class="stc_20_wr">
<!-- 상품진열 20 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {
    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = 'sct_clear';
    }

    if ($i == 1) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"sct sct_20\">\n";
        }
    }

    echo "<li class=\"sct_li {$sct_last} \"><div class=\"sct_li_wr\"><span class=\"rank rank_{$i}\">{$i}</span>\n";

    echo "<div class=\"sct_img\">\n";

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }


    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/facebook.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/twitter.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/gplus.png');
        echo "</div>\n";
    }

    echo "</div>\n";


    echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"sct_info\"><span class=\"sct_info_wr\">\n";

    if ($this->view_it_id) {
        echo "<span class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</span>\n";
    }

    if ($this->href) {
        echo "<span class=\"sct_txt\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</span>\n";
    }

    if ($this->view_it_basic && $row['it_basic']) {
        echo "<span class=\"sct_basic\">".stripslashes($row['it_basic'])."</span>\n";
    }

    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<span class=\"sct_cost\">\n";

        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
        }

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        echo "</span>\n";

    }

    if ($this->view_it_icon) {
        echo "<span class=\"sct_icon\">".item_icon($row)."</span>\n";
    }

    echo "</span></a>\n";
    
    echo "</div></li>\n";
}

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 20 끝 -->
</div>

<script>
jQuery(function($){
    $('.sct_20').show().bxSlider({
        maxSlides: 5,
        moveSlides:5,
        slideWidth: 215,
        slideMargin: 20,
        auto: true,
        pager:false
    });
});
</script>