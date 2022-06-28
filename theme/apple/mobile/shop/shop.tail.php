<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

    </div>
    <div id="idx_left">
        <?php if($default['de_mobile_type4_list_use']) { ?>
            <?php
            $list = new item_list();
            $list->set_mobile(true);
            $list->set_type(4);
            $list->set_view('it_id', false);
            $list->set_view('it_name', true);
            $list->set_view('it_cust_price', false);
            $list->set_view('it_price', true);
            $list->set_view('it_icon', false);
            $list->set_view('sns', false);
            echo $list->run();
            ?>
        <?php } ?>

        <?php
        // 상품리뷰
        $sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
                    from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
                    where a.is_confirm = '1'
                    order by a.is_id desc
                    limit 0,10 ";
        $result = sql_query($sql);

        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($i == 0) {
                echo '<div id="idx_review">'.PHP_EOL;
                echo '<h2><a href="'.G5_SHOP_URL.'/itemuselist.php">리뷰</a></h2>'.PHP_EOL;
                echo '<ul class="review">'.PHP_EOL;
            }

            $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        ?>
            <li class="rv_li rv_<?php echo $i;?>">
                <div class="txt_wr">
                    <a href="<?php echo $review_href; ?>" class="rv_img"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 50, 50); ?></a>
                    <span class="rv_tit"><?php echo get_text(cut_str($row['is_subject'], 20)); ?></span>
                    <a href="<?php echo $review_href; ?>" class="rv_prd"><?php echo $row['it_name']; ?></a>
                </div>
                <p><?php echo get_text(cut_str(strip_tags($row['is_content']), 90), 1); ?></p>

            </li>
        <?php
        }
        if($i > 0) {
            echo '</ul>'.PHP_EOL;
            echo '</div>'.PHP_EOL;
        }
        ?>
        <script>
        $(document).ready(function(){
            $('.review').show().bxSlider({
                mode:'vertical',
                pager:false,
                minSlides: 3,
                maxSlides: 5 ,

            });
        });

        </script>
        <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>

    </div>
    <div id="idx_right">

        <?php echo outlogin('theme/basic'); // 외부 로그인 ?>

        <div class="ft_cs">
            <h2>고객센터</h2>
            <div>
                <?php
                $save_file = G5_DATA_PATH.'/cache/theme/apple/footerinfo.php';
                if(is_file($save_file))
                    include($save_file);
                ?>
                <strong class="cs_tel"><?php echo get_text($footerinfo['tel']); ?></strong>
                <p class="cs_info"><?php echo get_text($footerinfo['etc'], 1); ?></p>
            </div>
        </div>
   
        <?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>

        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/basic', 'notice', 2, 30);
        ?>
        
        <ul id="hd_nb">
            <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php"><i class="fa fa-gift" aria-hidden="true"></i> 쿠폰존</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php"><i class="fa fa-credit-card" aria-hidden="true"></i> 개인결제</a></li>
            <li class="hd_nb1"><a href="<?php echo G5_BBS_URL ?>/qalist.php" id="snb_qa"><i class="fa fa-comments" aria-hidden="true"></i> 1:1문의</a></li>
            <li class="hd_nb2"><a href="<?php echo G5_BBS_URL ?>/faq.php" id="snb_faq"><i class="fa fa-question-circle" aria-hidden="true"></i> FAQ</a></li>
        </ul>

    </div>

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
    <p>
        <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span>
        <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br>
        <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span><br>
        <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
        <span><b>전화</b> <?php echo $default['de_admin_company_tel']; ?></span>
        <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span><br>
        <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
        <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span><br>
        <span><b>개인정보 보호책임자</b> <?php echo $default['de_admin_info_name']; ?></span>

        <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
        Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.
    </p>
    <a href="#" id="ft_to_top"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></a>

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
