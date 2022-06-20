<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
    <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>
    <?php include_once(G5_THEME_MSHOP_PATH.'/myinfo.php'); // 분류 ?>
</div><!-- container End -->

<div id="ft">
    
    <h2><?php echo $config['cf_title']; ?> 정보</h2>



    <div id="ft_company">
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보</a>
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a>
        <?php
        if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
        <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전</a>
        <?php
        }

        if ($config['cf_analytics']) {
            echo $config['cf_analytics'];
        }
        ?>
    </div>
    
    <div id="ft_cs">
        <h3>CS CENTER</h3>
        <div>
            <?php
            $save_file = G5_DATA_PATH.'/theme/cosmetic/footerinfo.php';
            if(is_file($save_file))
                include($save_file);
            ?>
            <strong class="cs_tel"><?php echo get_text($footerinfo['tel']); ?></strong>
            <p class="cs_info"><?php echo get_text($footerinfo['etc'], 1); ?></p>
            <a href="<?php echo G5_BBS_URL; ?>/faq.php" class="link_cs">FAQ</a>
            <a href="<?php echo G5_BBS_URL; ?>/qalist.php" class="link_qa">1:1 문의</a>
        </div>
    </div>


    <div id="ft_info">
        <h3>INFO</h3>
        <strong>회사명 : <?php echo $default['de_admin_company_name']; ?></strong>
        <span>주소 : <?php echo $default['de_admin_company_addr']; ?></span><br>
        <span>사업자 등록번호 : <?php echo $default['de_admin_company_saupja_no']; ?></span><br>
        <span>대표 : <?php echo $default['de_admin_company_owner']; ?></span>
        <span>전화 : <?php echo $default['de_admin_company_tel']; ?></span>
        <span>팩스 : <?php echo $default['de_admin_company_fax']; ?></span><br>
        <!-- <span>운영자 <?php echo $admin['mb_name']; ?></span><br> -->
        <span>통신판매업신고번호 : <?php echo $default['de_admin_tongsin_no']; ?></span><br>
        <span>개인정보 보호책임자 : <?php echo $default['de_admin_info_name']; ?></span>

        <?php if ($default['de_admin_buga_no']) echo '<span>부가통신사업신고번호 '.$default['de_admin_buga_no'].'</span>'; ?><br>
        <span class="copy">Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.</span>
    </div>

</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
