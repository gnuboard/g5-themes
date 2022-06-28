<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

if(!defined('G5_IS_ADMIN'))
    include_once(G5_THEME_LIB_PATH.'/theme.lib.php');

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

set_cart_id(0);
$tmp_cart_id = get_session('ss_cart_id');
$q = isset($_GET['q']) ? clean_xss_tags($_GET['q'], 1, 1) : '';
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
     } ?>
    <?php if ($is_admin) {  ?>
    <div class="hd-admin">
        <span><strong>관리자</strong>로 접속하셨습니다.</span>
        <a href="<?php echo G5_THEME_ADM_URL ?>" target="_blank">테마관리</a>
        <a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" target="_blank">관리자</a>
    </div>
    <?php } ?>
    <div id="hd_wrapper">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a></div>

        <div id="hd_sch">
            <h3>쇼핑몰 검색</h3>
            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required>
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
            $save_file = G5_DATA_PATH.'/theme/watermelon/keyword.php';
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
                    <li><a href="<?php echo G5_SHOP_URL; ?>/search.php?q=<?php echo urlencode($word); ?>"><?php echo get_text($word); ?></a></li>
                <?php
                    $seq++;
                }
                ?>
                </ol>

            </div>
            <?php } ?>
        </div>
        <div id="tnb">
            <h3>회원메뉴</h3>
            <ul>
                <?php if ($is_member) { ?>

               <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><i class="fa fa-user"></i>마이페이지</a></li>
               <?php } else { ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><i class="fa fa-user"></i>마이페이지</a></li>
                <?php } ?>
                <li class="tnb_cart"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 장바구니 <span class="cart-count"><?php echo get_cart_count($tmp_cart_id); ?></span></a></li>            
            </ul>
        </div>

    </div>

    <div id="hd_menu">
        <ul class="hd_mn_ul">
            <li class="al_ct"><button type="button" id="menu_open"><i class="fa fa-bars" aria-hidden="true"></i> 전체카테고리</button><?php include_once(G5_THEME_SHOP_PATH.'/category.php'); // 분류 ?> </li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>

        </ul>
    </div>

    

</div>

<div id="side_menu">
    <button type="button" id="btn_sidemenu" class="btn_sidemenu_cl"><i class="fa fa-outdent" aria-hidden="true"></i><span class="sound_only">사이드메뉴버튼</span></button>
    <div class="side_menu_wr">
        <?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
        <?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
        <ul id="hd_qnb">
           <li><a href="<?php echo G5_BBS_URL; ?>/faq.php"><i class="fa fa-question" aria-hidden="true"></i><span>FAQ</span></a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php"><i class="fa fa-comments" aria-hidden="true"></i><span>1:1문의</span></a>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php"><i class="fa fa-credit-card"></i><span>개인결제</span></a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php"><i class="fa fa-pencil"></i><span>사용후기</span></a></li>
            <?php if(G5_COMMUNITY_USE) { ?>
            <li class="tnb_left tnb_shop"><a href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-bag" aria-hidden="true"></i> 쇼핑몰</a></li>
            <li class="tnb_left tnb_community"><a href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i> 커뮤니티</a></li>
            <?php } ?>
        </ul>
    </div>
</div>


<script>
$(function (){

    $(".btn_sidemenu_cl").on("click", function() {
        $(".side_menu_wr").toggle();
        $(".fa-outdent").toggleClass("fa-indent")
    });
});
</script>


<div id="wrapper" class="wrapper">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>

<!-- } 상단 끝 -->
