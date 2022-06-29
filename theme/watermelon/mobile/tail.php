<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
    return;
}

?>
    </div>
</div>

<aside id="aside">
    <?php echo outlogin('theme/basic'); // 외부 로그인 ?>
    <?php echo poll('theme/basic'); // 설문조사 ?>
    <?php echo visit('theme/basic'); // 방문자수 ?>
    <ul id="hd_qnb">
        <li><a href="<?php echo G5_BBS_URL ?>/faq.php"><i class="fa fa-question" aria-hidden="true"></i><span>FAQ</span></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/qalist.php"><i class="fa fa-comments" aria-hidden="true"></i><span>1:1문의</span></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/current_connect.php" class="visit"><i class="fa fa-users" aria-hidden="true"></i><span>접속자</span><strong class="visit-num"><?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></strong></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/new.php"><i class="fa fa-history" aria-hidden="true"></i><span>새글</span></a></li>
        <?php if(G5_COMMUNITY_USE) { ?>
        <li class="tnb_left tnb_shop"><a href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-bag" aria-hidden="true"></i>쇼핑몰</a></li>
        <li class="tnb_left tnb_community"><a href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i>커뮤니티</a></li>
        <?php } ?>
    </ul>
</aside>

<div id="ft">
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
            <?php
            if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
            <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
            <?php
            }

            if ($config['cf_analytics']) {
                echo $config['cf_analytics'];
            }
            ?>        
        </div>
        Copyright &copy; <b>소유하신 도메인.</b> All rights reserved.<br>
    </div>
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>

</div>



<script>
jQuery(function($) {

    $( document ).ready( function() {
        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
    });

    //상단으로
    $("#top_btn").on("click", function() {
        $("html, body").animate({scrollTop:0}, '500');
        return false;
    });
});

//상단고정
$(window).scroll(function(){
var sticky = $('.top'),
    scroll = $(window).scrollTop();

if (scroll >= 50) sticky.addClass('fixed');
else sticky.removeClass('fixed');
});

//상단으로
$(function() {
    $("#top_btn").on("click", function() {
        $("html, body").animate({scrollTop:0}, '500');
        return false;
    });
});
</script>
<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>