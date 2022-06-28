<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
?>

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

    <?php if ($is_admin) {  ?>
    <div class="hd-admin">
        <span><strong>관리자</strong>로 접속하셨습니다.</span>
        <a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" target="_blank">관리자</a>
        <a href="<?php echo G5_THEME_ADM_URL ?>" target="_blank">테마관리</a>
    </div>
    <?php } ?>

    <div id="hd_tnb">
        <ul>
            <?php if(G5_COMMUNITY_USE) { ?>
            <li class="tnb_left tnb_community"><a href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i><span class="sound_only">커뮤니티</span></a></li>
            <li class="tnb_left tnb_shop"><a href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">쇼핑몰</span></a></li>
            <?php } ?>

            <?php if ($is_member) {  ?>
            <li class="bg"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <li><span class="niname"><?php echo get_member_profile_img($member['mb_id']); ?> <strong><?php echo $member['mb_id'] ? $member['mb_name'] : '비회원'; ?></strong> 님 </span> </li>
            <?php } else {  ?>
            <li class="bg"><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>

        <?php }  ?>
        </ul>
    </div>

    <div id="hd_wr">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/mobile_logo_img" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>
        <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>
        <div id="hd_btn">
            <button type="button" id="btn_hdcate"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">분류</span></button>
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span><span class="cart-count"><?php echo get_boxcart_datas_count(); ?></span></a>
            <button type="button" id="sch_open" ><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only"> 검색열기</span></button>

        </div>
         <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
        <aside id="hd_sch">
            <div class="sch_inner">
                <h2>상품 검색</h2>
                <button type="submit" value="검색" class="sch_submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required  placeholder="검색어를 입력해주세요">
            </div>
            <button type="button" id="sch_close"><i class="fa fa-times-circle"></i><span class="sound_only">닫기</span></button>

        </aside>
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

    </div>

             
    <script>

    $("#btn_hdcate").on("click", function() {
        $("#gnb").show();
    });

    $(".hd_closer").on("click", function() {
        $("#gnb").hide();
    });

    $("#sch_open").on("click", function() {
        $("#hd_sch").show();
    });

    $("#sch_close").on("click", function() {
        $("#hd_sch").hide();
    });
    

   </script>
</header>

<div id="wrapper">
    <div id="container">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>
