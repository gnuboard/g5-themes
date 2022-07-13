<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
$q = isset($_GET['q']) ? clean_xss_tags($_GET['q'], 1, 1) : '';
?>

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

    <div id="tnb">
        <h2>회원메뉴</h2>
        <ul>

            <?php if ($is_member) { ?>

            <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
            <?php } else { ?>
            <li><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>로그인</b></a></li>
            <?php } ?>
            <li class="left"><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
            <li class="left"><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
            <li class="left"><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
            <li class="left"><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a></li>
            <li class="left"><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
        </ul>
    </div>
    <div id="hd_wr">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/mobile_logo_img" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>
        <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>
            <div id="hd_sch">
                <button type="button" class="btn_close"><i class="fa fa-times"></i></button>
                <div class="hd_sch_wr">
                    <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
                
                    <div class="sch_inner">
                        <h2>상품 검색</h2>
                        <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                        <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required placeholder="검색어를 입력해주세요">
                        <button type="submit"  class="sch_submit"><span class="sound_only"> 검색</span></button>
                    </div>
                    </form>
                </div>
            </div>
            <div id="hd_btn">
                <button type="button" id="btn_user" class="btn_icon"><span class="sound_only">마이메뉴</span></button>

                <button type="button" id="btn_sch" class="btn_icon"><span class="sound_only">검색열기</span></button>
                <a href="<?php echo G5_SHOP_URL; ?>/cart.php" id="btn_cartop" class="btn_icon"><span class="sound_only">장바구니</span><span class="cart-count"><?php echo get_boxcart_datas_count(); ?></span></a>
                <button type="button" id="btn_cate" class="btn_icon"><span class="sound_only">분류열기</span></button>
    
                <?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>

            </div>
        </div>

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

    <?php if ($is_admin) { ?><div class="hd_admin"><a href="<?php echo G5_ADMIN_URL; ?>" target="_blank">관리자</a></div> <?php } ?>
    <script>
    $( document ).ready( function() {
        var jbOffset = $( '#hd_wr' ).offset();
        $( window ).scroll( function() {
            if ( $( document ).scrollTop() > jbOffset.top ) {
                $( '#hd_wr' ).addClass( 'fixed' );
            }
            else {
                $( '#hd_wr' ).removeClass( 'fixed' );
            }
        });
    });

    $("#btn_cate").on("click", function() {
        $("#category").show();
    });

    $(".menu_close").on("click", function() {
        $(".menu").hide();
    });
     $(".cate_bg").on("click", function() {
        $(".menu").hide();
    });

     $("#btn_user").on("click", function() {
        $(".ol").show();
    });

     $(".ol .btn_close").on("click", function() {
        $(".ol").hide();
    });

    $("#btn_sch").on("click", function() {
        $("#hd_sch").show();
    });

     $("#hd_sch .btn_close").on("click", function() {
        $("#hd_sch").hide();
    });
   </script>
</header>

<?php if (!defined('_INDEX_')) { ?><h1 id="container_title"><span><?php echo $g5['title'] ?></span></h1><?php } ?>
<div id="container" class="container">
