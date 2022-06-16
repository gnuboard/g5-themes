<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

set_cart_id(0);
$tmp_cart_id = get_session('ss_cart_id');
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 0);

?>
<?php if ($is_admin) {  ?>
<div class="hd-admin">
    <span><strong>관리자</strong>로 접속하셨습니다.</span>
    <a href="<?php echo G5_THEME_ADM_URL ?>" target="_blank">테마관리</a>
    <a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" target="_blank">관리자</a>
</div>
<?php } ?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
     } ?>

    <div id="hd_wrapper">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a></div>
        
        <?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>


        <ul id="hd_tnb">
            <li>
                <button type="button" class="tnb_btn"><i class="fa fa-search"></i></button>
                <div id="hd_sch" class="tnb_con">
                    <h2>쇼핑몰 검색</h2>
                    <form name="frmsearch1" id="qk_search" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

                    <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" class="frm_input" required>
                    <button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>

                    </form>
                    <script>
                    function search_submit(f) {
                        if (f.q.value.length < 2) {
                            alert("검색어는 두글자 이상 입력하십시오.");
                            f.q.select();
                            f.q.focus();
                            return false;
                        }
                        return true;
                    }
                    </script>
                    <?php
                    $save_file = G5_DATA_PATH.'/cache/theme/cosmetic/keyword.php';
                    if(is_file($save_file))
                        include($save_file);

                    if(!empty($keyword)) {
                    ?>
                    <div id="ppl_word">
                        <h4>인기검색어</h4>
                        <ol class="slides">
                        <?php
                        $seq = 1;
                        foreach($keyword as $word) {
                        ?>
                            <li><span class="word-rank word-rank<?php echo $seq; ?>"><?php echo $seq; ?></span><a href="<?php echo G5_SHOP_URL; ?>/search.php?q=<?php echo urlencode($word); ?>"><?php echo get_text($word); ?></a></li>
                        <?php
                            $seq++;
                        }
                        ?>
                        </ol>

                    </div>
                    <?php } ?>
                     <button type="button" class="btn_close"><i class="fa fa-times"></i><span class="sound_only">나의정보 닫기</span></button>
                </div>
            </li>
            <li><button type="button" class="tnb_btn"><i class="fa fa-user"></i></button><?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?> </li>
            <li>
                <button type="button" class="tnb_btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span> <span class="cart-num"> <?php echo get_cart_count($tmp_cart_id); ?></span></button>
                <?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
            </li>

        </ul>
    </div>

</div>

<script>
$(window).scroll(function() {
  var header = $(document).scrollTop();
  var headerHeight = $("#hd").outerHeight();
  if (header > headerHeight) {
    $("body").addClass("fixed");
  } else {
    $("body").removeClass("fixed");
  }
});

$("#hd_tnb .btn_close").click(function(e) {
     $(".tnb_con").hide();
});

$("#hd_tnb .tnb_btn:not(:only-child)").click(function(e) {
    $(this).siblings(".tnb_con").toggle();

    $(".tnb_con").not($(this).siblings()).hide();
    e.stopPropagation();

    $("#wrapper").on("click", function() {
        $(".tnb_con").hide();
    });
});
</script>


<div id="wrapper">

    <!-- 콘텐츠 시작 { -->
    <div id="container" class="container">
        <?php if (!defined("_INDEX_")) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>
        <!-- 글자크기 조정 display:none 되어 있음 시작 { -->
        <div id="text_size">
            <button class="no_text_resize" onclick="font_resize('container', 'decrease');">작게</button>
            <button class="no_text_resize" onclick="font_default('container');">기본</button>
            <button class="no_text_resize" onclick="font_resize('container', 'increase');">크게</button>
        </div>
        <!-- } 글자크기 조정 display:none 되어 있음 끝 -->