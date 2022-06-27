<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

    </div>
    <!-- } 콘텐츠 끝 -->
  
        
<!-- 하단 시작 { -->
</div>
<!-- 쇼핑몰 배너 시작 { -->
<?php
if (!isset($_COOKIE['ck_top_banner_close']))
    echo display_banner('왼쪽');
?>

<!-- } 쇼핑몰 배너 끝 -->
<div id="quick"  class="tab-wr">
    <ul class="qk_btn">

        <li class="tabsTab">
            <a href="#" onclick="try{window.external.AddFavorite('<?php echo G5_SHOP_URL; ?>','<?php echo $default['de_admin_company_name']; ?>')}catch(e){alert('이 브라우저에서는 즐겨찾기 기능을 사용할 수 없습니다.\n크롬에서는 Ctrl 키와 D 키를 동시에 눌러서 즐겨찾기에 추가할 수 있습니다.')}; return false;" class="bg_01"><i class="fa fa-bookmark" aria-hidden="true"></i><span class="qk_tit">BOOKMARK</span></a>
        </li>
        <li class="tabsTab">
            <button type="button" class="menu_op_btn bg_02"><i class="fa fa-bars" aria-hidden="true"></i><span class="qk_tit">CATEGORY</span></button>
        </li>
        <li class="tabsTab">
            <button type="button" class="my_op_btn bg_03"><i class="fa fa-user" aria-hidden="true"></i><span class="qk_tit">MY INFO</span></button>
        </li>
        <li class="tabsTab">
            <button type="button" class="cart_op_btn bg_04"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="qk_tit">CART</span></button>
        </li>
        <li class="tabsTab">
            <button type="button" class="sch_op_btn bg_05"><i class="fa fa-search" aria-hidden="true"></i><span class="qk_tit">SEARCH</span></button>
        </li>
         <li class="tabsTab">
             <button type="button" class="wish_op_btn bg_06"><i class="fa fa-heart" aria-hidden="true"></i><span class="qk_tit">WISH LIST</span></button>
        </li>
        <li class="tabsTab">
            <button type="button" class="review_op_btn bg_07"><i class="fa fa-camera" aria-hidden="true"></i><span class="qk_tit">REVIEW</span></button>
        </li>
    </ul>

    <div class="btn_scroll">
        <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
        <button type="button" id="bottom_btn"><i class="fa fa-arrow-down" aria-hidden="true"></i><span class="sound_only">하단으로</span></button>
    </div>

    <div  class="tabsCon">
        <div class="qk_con" id="qk_menu">
            <div class="qk_con_wr">
                <h3><a href="<?php echo G5_SHOP_URL; ?>/cart.php">전체분류</a></h3>
                <?php include_once(G5_THEME_SHOP_PATH.'/category.php'); // 분류 ?>
            </div>
            <button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">나의정보 닫기</span></button>
        </div>
        <div class="qk_con" id="qk_my">
            <div class="qk_con_wr">
                <h3><a href="<?php echo G5_SHOP_URL; ?>/cart.php">나의정보</a></h3>
                <?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
                <?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
                <ul class="qk_mymenu">
                    <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a></li>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
                </ul>
            </div>
            <button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">나의정보 닫기</span></button>
        </div>

        <div class="qk_con" id="qk_cart">
            <div class="qk_con_wr">

            <h3><a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a></h3>
            <div class="hdqk_wr">
                <div class="hdqk_wr" id="q_cart_wr"></div>
            <script>
            $(function(){
                $(".cart_op_btn").on("click", function() {
                    var $this = $(this);

                    $("#q_cart_wr").load(
                        g5_theme_shop_url+"/ajax.cart.php",
                        function() {
                            $this.next(".hdqk_wr").show();
                        }
                    );
                });
            });
            </script>
            </div>
            <button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">장바구니 닫기</span></button>
            </div>
        </div>

        <?php $q = isset($_GET['q']) ? clean_xss_tags($_GET['q'], 1, 1) : ''; ?>
        <div class="qk_con" id="qk_sch">
            <div class="qk_con_wr">
                <h3>쇼핑몰 검색</h3>
                <form name="frmsearch1" id="qk_search" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

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
                $save_file = G5_DATA_PATH.'/theme/shoes/keyword.php';
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
                        <li><span class="word-rank word-rank<?php echo $seq; ?>"><?php echo $seq; ?></span><a href="<?php echo G5_SHOP_URL; ?>/search.php?q=<?php echo urlencode($word); ?>"><?php echo get_text($word); ?></a></li>
                    <?php
                        $seq++;
                    }
                    ?>
                    </ol>

                </div>
                <?php } ?>
             <button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">나의정보 닫기</span></button>
            </div>
        </div>

        <div class="qk_con tabsList" id="qk_wish">
            <div class="qk_con_wr">
            <h3><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">위시리스트</a></h3>
            <?php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
            <button type="button" class="con_close"><i class="fa fa-times-circle" aria-hidden="true"></i><span class="sound_only">위시리스트닫기 </span></button>
            </div>
            
        </div>

        
        <!-- 메인리뷰-->
        <?php
        // 상품리뷰
        $sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
                    from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
                    where a.is_confirm = '1'
                    order by a.is_id desc
                    limit 0,6 ";
        $result = sql_query($sql);

        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($i == 0) {
                echo '<div id="idx_review" class="qk_con tabsList "><div class="qk_con_wr">'.PHP_EOL;
                echo '<h3><a href="'.G5_SHOP_URL.'/itemuselist.php">REVIEW</a></h3>'.PHP_EOL;
                echo '<ul class="review">'.PHP_EOL;
            }

            $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        ?>
            <li class="rv_li rv_<?php echo $i;?>">
                <div class="li_wr">
                    <a href="<?php echo $review_href; ?>" class="prd_img"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 190, 90); ?></a>
                    <div class="txt_wr">
                        <span class="rv_tit"><?php echo get_text(cut_str($row['is_subject'], 20)); ?></span>
                        <a href="<?php echo $review_href; ?>" class="rv_prd">상품명 : <?php echo $row['it_name']; ?></a>
                        <p><?php echo get_text(cut_str(strip_tags($row['is_content']), 50), 1); ?></p>
                    </div>
                </div>
            </li>
        <?php
        }

        if($i > 0) {
            echo '</ul>'.PHP_EOL;
            echo '</div></div>'.PHP_EOL;
        }
        ?>
    </div>
</div>




<script>
$(function (){
     $(".menu_op_btn").on("click", function(){
        $("#qk_menu").show();
    });
     
     $(".my_op_btn").on("click", function(){
        $("#qk_my").show();
    });
     
     $(".cart_op_btn").on("click", function(){
        $("#qk_cart").show();
    });
    $(".sch_op_btn").on("click", function(){
        $("#qk_sch").show();
    });
    $(".review_op_btn").on("click", function(){
        $("#idx_review").show();
    });

     $(".wish_op_btn").on("click", function(){
        $("#qk_wish").toggle();
    });
    $(".con_close").on("click", function(){
        $(".qk_con").hide();
    });


    
    $("#quick_open").on("click", function(){
        $("#quick").toggle();
    });

});
$(document).mouseup(function (e){
    var container = $(".qk_con");
    if( container.has(e.target).length === 0)
    container.hide();
});

        
$(function() {
    $("#top_btn").on("click", function(e) {
                e.preventDefault();
                $("html, body").animate({scrollTop:0}, '500');
                return false;
            });
    $("#bottom_btn").on("click", function(e) {
        e.preventDefault();
        
        var scrollBottom = $("html,body").scrollTop + $("html,body").height();
        
        $("html, body").animate({scrollTop:$(document).height()}, '500');
        return false;
    });
});
</script>


<div id="ft">
    <div>
        <?php echo latest('theme/shop_basic', 'notice', 5, 30); ?>
    </div>
    <div class="ft_wr">
        <ul class="ft_ul">
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a></li>
            <li><a href="<?php echo get_device_change_url(); ?>">모바일버전</a></li>
        </ul>
        
        <div class="ft_info">
            <h2>INFO</h2>
            <div>
            <span><b>회사명.</b> <?php echo $default['de_admin_company_name']; ?></span>
            <span><b>주소.</b> <?php echo $default['de_admin_company_addr']; ?></span><br>
            <span><b>사업자 등록번호.</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
            <span><b>대표.</b> <?php echo $default['de_admin_company_owner']; ?></span>
            <span><b>개인정보 보호책임자.</b> <?php echo $default['de_admin_info_name']; ?></span><br>
            <span><b>전화.</b> <?php echo $default['de_admin_company_tel']; ?></span>
            <span><b>팩스.</b> <?php echo $default['de_admin_company_fax']; ?></span><br>
            <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
            <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
            <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
            <span class="ft_cp">Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.</span>

            </div>
        </div>

        <div class="ft_cs">
            <h2>CS CENTER</h2>
            <div>
                <?php
                $save_file = G5_DATA_PATH.'/theme/shoes/footerinfo.php';
                if(is_file($save_file))
                    include($save_file);
                ?>
                <strong class="cs_tel"><?php echo get_text($footerinfo['tel']); ?></strong>
                <p class="cs_info"><?php echo get_text($footerinfo['etc'], 1); ?></p>
                <a href="<?php echo G5_BBS_URL; ?>/faq.php" class="link_cs">FAQ</a>
                <a href="<?php echo G5_BBS_URL; ?>/qalist.php" class="link_qa">1:1 문의</a>
            </div>
        </div>

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
<!-- } 하단 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
