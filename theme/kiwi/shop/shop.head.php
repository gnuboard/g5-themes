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
?>
<div class="al_wr">
<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
     } ?>

    <div id="hd_wrapper">

        <div id="hd_sch">
            <h3>쇼핑몰 검색</h3>
            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required placeholder="검색어를 입력해주세요">
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
        </div>
        <div id="tnb">
            <h3>회원메뉴</h3>
            <ul>
                <?php if(G5_COMMUNITY_USE) { ?>
                <li class=" tnb_shop"><a href="<?php echo G5_SHOP_URL; ?>/">쇼핑몰</a></li>
                <li class=" tnb_community"><a href="<?php echo G5_URL; ?>/">커뮤니티</a></li>
                <?php } ?>
                <li class="tnb_cart"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"> 장바구니</a></li>            
                <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
                <?php if ($is_member) { ?>

                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
                <?php if ($is_admin) {  ?>
                <li class="tnb_admin"><a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/"><b>관리자</b></a></li>
                <?php }  ?>
                <?php } else { ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>로그인</b></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

</div>



<div id="wrapper">

    <div id="aside">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a></div>

        <?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
    </div>
<!-- } 상단 끝 -->

    <!-- 콘텐츠 시작 { -->
    <div id="container">
        <?php if (!defined('_INDEX_')) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>
        <!-- 글자크기 조정 display:none 되어 있음 시작 { -->
        <div id="text_size">
            <button class="no_text_resize" onclick="font_resize('container', 'decrease');">작게</button>
            <button class="no_text_resize" onclick="font_default('container');">기본</button>
            <button class="no_text_resize" onclick="font_resize('container', 'increase');">크게</button>
        </div>
        <!-- } 글자크기 조정 display:none 되어 있음 끝 -->