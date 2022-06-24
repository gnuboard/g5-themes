<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


<div id="my_info">
    <?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>

    <ul id="hd_tnb">
        <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
        <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문내역</a></li>
        <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
        <li class="bd"><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
        <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">세일상품</a></li>
    </ul> 
<?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
</div>
