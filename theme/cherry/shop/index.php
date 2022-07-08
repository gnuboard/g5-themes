<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

if (!defined('_INDEX_')) define('_INDEX_', true);

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
?>

<!-- 메인이미지 시작 { -->
<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
<!-- } 메인이미지 끝 -->

<div class="idx_wr">
    <div class="col_3"><?php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?></div>
    <div class="col_3">

        <ul class="tabs-nav">
            <li><a href="#tab-1" rel="nofollow">공지</a>
            </li>
            <li ><a href="#tab-2" rel="nofollow">뉴스</a></li>
            <li><a href="#tab-3" rel="nofollow">고객센터</a></li>

        </ul>
        <div class="tabs-stage">
            <div id="tab-1" class="tab_con select">
                <p><?php echo latest('theme/shop_basic', 'notice', 5, 30); ?></p>
            </div>
            <div id="tab-2" class="tab_con" >
                <p><?php echo latest('theme/shop_basic', 'news', 5, 30); ?></p>
            </div>
            <div id="tab-3" class="tab_con tab_cs">
                <div class="cs_con">
                    <h2>고객센터</h2>
                    <?php
                    $save_file = G5_DATA_PATH.'/cache/theme/cherry/footerinfo.php';
                    if(is_file($save_file))
                        include($save_file);
                    ?>
                    <strong class="cs_tel"><?php echo get_text($footerinfo['tel']); ?></strong>
                    <p class="cs_info"><?php echo get_text($footerinfo['etc'], 1); ?></p>
                </div>
                <div class="cs_con cs_ac">
                    <h2>계좌정보</h2>
                
                    <?php
                    $save_file = G5_DATA_PATH.'/cache/theme/cherry/footerinfo.php';
                    if(is_file($save_file))
                        include($save_file);
                    ?>
                    <strong class="account"><?php echo get_text($footerinfo['account'], 1); ?></strong>
                    <p class="name">예금주 : <?php echo get_text($footerinfo['depositor']); ?></p>
                </div>
                <div class="cs_con cs_link">
                    <a href="<?php echo G5_BBS_URL; ?>/faq.php" class="link_cs">자주묻는질문</a>
                    <a href="<?php echo G5_BBS_URL; ?>/qalist.php" class="link_qa">1:1 문의</a>
                </div>
            </div>
        </div>

        <script>
        $('.tabs-nav a').on('click', function (event) {
            event.preventDefault();
            
            $('.tab-active').removeClass('tab-active');
            $(this).parent().addClass('tab-active');
            $('.tabs-stage div').removeClass('select');
            $($(this).attr('href')).addClass('select');
        });

        $('.tabs-nav a:first').trigger('click'); // Default
        </script>
    </div>
    <!-- 왼쪽이미지 시작 { -->
    <div class="col_3"><?php echo display_banner('왼쪽', 'boxbanner.skin.php'); ?> </div>
    <!-- } 왼쪽이미지 끝 -->
</div>


<?php if($default['de_type4_list_use']) { ?>
<!-- 인기상품 시작 { -->
<section class="sct_wrap">
    <header>
        <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
    </header>
    <?php
    $list = new item_list();
    $list->set_type(4);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', false);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', false);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</section>
<!-- } 인기상품 끝 -->
<?php } ?>


<?php if($default['de_type1_list_use']) { ?>
<!-- 히트상품 시작 { -->
<section class="sct_wrap">
    <header>
        <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h2>
    </header>
    <?php
    $list = new item_list();
    $list->set_type(1);
    $list->set_view('it_img', true);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    echo $list->run();
    ?>
</section>
<!-- } 히트상품 끝 -->
<?php } ?>

<?php if($default['de_type2_list_use']) { ?>
<!-- 추천상품 시작 { -->
<section class="sct_wrap sct_rc">
    <h2 class="sound_only"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_type(2);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', false);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</section>
<!-- } 추천상품 끝 -->
<?php } ?>


<?php if($default['de_type3_list_use']) { ?>
<!-- 최신상품 시작 { -->
<section class="sct_wrap">
    <header>
        <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품</a></h2>
    </header>
    <?php
    $list = new item_list();
    $list->set_type(3);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    echo $list->run();
    ?>
</section>
<!-- } 최신상품 끝 -->
<?php } ?>

<?php if($default['de_type5_list_use']) { ?>
<!-- 할인상품 시작 { -->
<section class="sct_wrap">
    <header>
        <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h2>
    </header>
    <?php
    $list = new item_list();
    $list->set_type(5);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    echo $list->run();
    ?>
</section>
<!-- } 할인상품 끝 -->
<?php } ?>


<script>
$("#container").removeClass("container").addClass("idx-container");
$("body").addClass("index");
</script>

<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>