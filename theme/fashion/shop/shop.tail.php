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
<!-- 하단 시작 { -->

<div id="quick" class="tab_wr">
	<button class="quick_toggle">보기</button>
	<div id="quick_innr">

	<ul class="tabs qk_btn">
		<li class="tab_my tabsTab active" rel="tab1">
			<button type="button" class="mypage_op_btn"><span class="sound_only">마이페이지 열기</span></button>
		</li>
		<li class="tab_cart tabsTab" rel="tab2">
		    <button type="button" class="cart_op_btn"><span class="sound_only">장바구니 열기</span></button>
		</li>
		<li class="tab_today tabsTab" rel="tab3">
		    <button type="button" class="view_op_btn"><span class="sound_only">오늘본상품 열기</span></button>
		</li>
		<li class="tab_wish tabsTab" rel="tab4">
			<button type="button" class="wish_op_btn"><span class="sound_only">위시리스트 열기</span></button>
		</li>
    </ul>
    
    <div class="tab_container tabs_con">
    	
        <div id="tab1" class="tab_content">
        	<?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
        </div>
        
        <div id="tab2" class="tab_content qk_con qk_cart">
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
            </div>
		</div>
        
        <div id="tab3" class="tab_content qk_con qk_view">
        	<div class="qk_con_wr">
            	<h3><span>오늘본상품</span></h3>
            	<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
            </div>
        </div>
        
        <div id="tab4" class="tab_content qk_con qk_wish">
        	<div class="qk_con_wr">
	            <h3><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">위시리스트</a></h3>
	            <ul class="qk_prdli">
	            <?php
	            $sql = " select *
						from {$g5['g5_shop_wish_table']} a,
						{$g5['g5_shop_item_table']} b
						where a.mb_id = '{$member['mb_id']}'
						and a.it_id  = b.it_id
						order by a.wi_id desc
						limit 0, 8 ";
	            $result = sql_query($sql);
	            for ($i=0; $row = sql_fetch_array($result); $i++)
	            {
	                $image_w = 60;
	                $image_h = 60;
	                $image = get_it_image($row['it_id'], $image_w, $image_h, true);
	                $list_left_pad = $image_w + 10;
	            ?>
	            <li>
	                <div class="qk_img"><?php echo $image; ?></div>
	                <div class="qk_txt">
	                    <div class="qk_name"><a href="./item.php?it_id=<?php echo $row['it_id']; ?>"><?php echo stripslashes($row['it_name']); ?></a></div>
	                    <span class="info_date"><?php echo substr($row['wi_time'], 2, 8); ?></span>
	                </div>
	            </li>
	            <?php
	            }
	            if ($i == 0)
	                echo '<li class="empty_list">보관 내역이 없습니다.</li>';
	            ?>
	            </ul>
            </div>
        </div>
    </div>
	</div>
</div>

<script>
$(function () {
    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide()
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn()
    });
});


$(function (){
    $(".quick_toggle").on("click", function() {
        $("#quick").toggleClass("close");
        $(".quick_toggle").toggleClass("close");
    });
});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 10) {
        $("#quick").addClass("fix");
    } else {
        $("#quick").removeClass("fix");
    }
});
</script>

<div id="ft">
    <div class="ft_wr">
        <a href="<?php echo G5_SHOP_URL; ?>/" id="ft_logo"><img src="<?php echo G5_DATA_URL; ?>/common/logo_img" alt="<?php echo $config['cf_title']; ?>"></a></a>
        <ul class="ft_ul">
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a></li>
            <li><a href="<?php echo get_device_change_url(); ?>">모바일버전</a></li>
        </ul>
        <div class="ft_info">
            <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span>
            <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br>
            <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
            <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
            <span><b>전화</b> <?php echo $default['de_admin_company_tel']; ?></span>
            <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span><br>
            <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
            <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
            <span><b>개인정보 보호책임자</b> <?php echo $default['de_admin_info_name']; ?></span>

            <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
            Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.
        </div>
    </div>
    <div class="top_btn_wr">
        <button type="button" class="top_btn"><i class="fa fa-arrow-up"></i><span class="sound_only">상단으로</span></button>
    </div>
</div>

<script>
$(function() {
    $(".top_btn").on("click", function() {
        $("html, body").animate({scrollTop:0}, '500');
        return false;
    });
});
</script>
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
