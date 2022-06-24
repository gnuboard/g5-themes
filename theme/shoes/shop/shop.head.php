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
        
        <ul id="hd_gnb">
            <?php
            // 1단계 분류 판매 가능한 것만
            $hsql = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where length(ca_id) = '2' and ca_use = '1' order by ca_order, ca_id ";
            $hresult = sql_query($hsql);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
            for ($i=0; $row=sql_fetch_array($hresult); $i++)
            {
                $gnb_zindex -= 1; // html 구조에서 앞선 gnb_1dli 에 더 높은 z-index 값 부여
                // 2단계 분류 판매 가능한 것만
                $sql2 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where LENGTH(ca_id) = '4' and SUBSTRING(ca_id,1,2) = '{$row['ca_id']}' and ca_use = '1' order by ca_order, ca_id ";
                $result2 = sql_query($sql2);
                $count = sql_num_rows($result2);
            ?>
            <li class="" style="z-index:<?php echo $gnb_zindex; ?>">
                <a href="<?php echo G5_SHOP_URL.'/list.php?ca_id='.$row['ca_id']; ?>"><?php echo $row['ca_name']; ?></a>
            </li>
            <?php } ?>
        </ul>

        <ul id="hd_tnb">
            <?php if ($is_member) { ?>
            <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>

            <?php } else { ?>
            <li class="tnb_join"><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입 <?php if ($config['cf_register_point']) { ?><span class="join-point"><span class="hover"><?php echo $config['cf_register_point'] ?> P</span></span><?php }  ?></a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>로그인</b></a></li>
            <?php } ?>
            <li class="tnb_cart"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span> <span class="cart-num"> <?php echo get_cart_count($tmp_cart_id); ?></span></a></li>

        </ul>
    </div>

</div>




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