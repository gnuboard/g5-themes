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

<?php if ($is_admin) {  ?>
<div class="hd-admin">
    <span><strong>관리자</strong>로 접속하셨습니다.</span>
    <a href="<?php echo G5_THEME_ADM_URL ?>" target="_blank">테마관리</a>
    <a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" target="_blank">관리자</a>
</div>
<?php } ?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
     } ?>
   
    <div id="hd_wrapper">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a></div>
        <div id="hd_sch">
            <h2>쇼핑몰 검색</h2>
            <form name="frmsearch1" id="qk_search" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" class="frm_input" required>
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
		
		<?php
        $save_file = G5_DATA_PATH.'/cache/theme/fashion/keyword.php';
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
			<?php if($seq > 2) { ?>
            <div class="custom1-navigation verical-btn">
                <a href="#" class="flex-prev">Prev</a>
                <a href="#" class="flex-next">Next</a>
            </div>
            <?php } ?>
        </div>
        <script>
        $(window).load(function() {
            $('#ppl_word').flexslider({
                animation: "slide",
                controlNav:false,
                slideshowSpeed:5000,
                animationSpeed:800,
                direction: "vertical",
                controlsContainer: $(".custom1-controls-container"),
                customDirectionNav: $(".custom1-navigation a")
            });
        });
        </script>
        <?php } ?>
        
		<div id="left_fix_btn">
			<button type="button" class="lfb btn_menu" title="전체메뉴"><span class="sound_only">전체메뉴 보기</span></button>
			<button type="button" class="lfb btn_sch search_toggle" title="검색"><span class="sound_only">검색창 열기</span></button>
			<div class="lfb_sch">
	            <div class="lfb_sch_cnt">
	            	<h3>쇼핑몰 검색</h3>
		            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
		            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		            <input type="text" name="q"  placeholder="검색어를 입력하세요" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required>
		            <button type="submit" id="sch_submit"><span class="sound_only">검색</span></button>
		            </form>
	            	<?php echo popular('theme/basic'); ?>
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
	            <button type="button" class="lfb_sch_cnt_close"><i class="fa fa-times"></i><span class="sound_only">쇼핑몰 검색 닫기</span></button>
	        </div>
			
			<?php if ($is_admin) {  ?>
				<a href="<?php echo G5_THEME_ADM_URL ?>" class="lfb btn_theme" title="테마관리"><span class="sound_only">테마관리</span></a>
				<a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" class="lfb btn_admin" title="관리자"><span class="sound_only">관리자</span></a>
			<?php } ?>
		</div>
		
        <div class="btn_r">
            <?php if ($is_member) {  ?>
            <a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn_hd btn_hd_logout"><span class="sound_only">로그아웃</span></a>
            <?php } else {  ?>
            <a href="<?php echo G5_BBS_URL ?>/register.php" class="btn_hd btn_hd_join"><span class="sound_only">회원가입</span></a>
            <a href="<?php echo G5_BBS_URL ?>/login.php" class="btn_hd btn_hd_login"><span class="sound_only">로그인</span></a>
            <?php }  ?>
			<a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="btn_hd btn_hd_cart"><span class="sound_only">장바구니</span><span class="cart-num"> <?php echo get_cart_count($tmp_cart_id); ?></span>
			</a>
        </div>

    </div>
    <nav id="menu">
        <h2>메인메뉴</h2>
		<?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>

        <ul class="shop_menu">
        	<li><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
		</ul>        
    </nav>
    <?php include_once(G5_THEME_SHOP_PATH.'/category.php'); // 분류 ?>
</div>

<script>
$(function(){
	$(".search_toggle").click(function(){
        $(".lfb_sch").toggle();
    });
    
	$(".lfb_sch .lfb_sch_cnt_close").click(function(){
         $(".lfb_sch").hide();
	});
	
    $(".btn_menu").click(function(){
        $("#category").show();
    });
});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 10) {
        $("#left_fix_btn").addClass("fix");
    } else {
        $("#left_fix_btn").removeClass("fix");
    }
});
</script>

<!-- 콘텐츠 시작 { -->
<div id="container">
    <?php if (!defined("_INDEX_")) { ?><div id="wrapper_title"><span><?php echo $g5['title'] ?></span></div><?php } ?>
      