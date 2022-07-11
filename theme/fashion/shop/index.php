<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
?>

<!-- 메인이미지 시작 { -->
<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
<!-- } 메인이미지 끝 -->

<div id="container_bottom">
	
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
	
	<?php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>

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
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();

        ?>
    </section>
    <!-- } 인기상품 끝 -->
    <?php } ?>
	
	<!-- 쇼핑몰 배너 시작 { -->
    <?php echo display_banner('왼쪽'); ?>
	<!-- } 쇼핑몰 배너 끝 -->

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

	<div class="sct_bottom">
	    <!-- 후기 시작 { -->
	    <section id="idx_review" class="sct_wrap sct_review">
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
		            echo '<header><h2><a href="'.G5_SHOP_URL.'/itemuselist.php">사용후기</a></h2></header>'.PHP_EOL;
		            echo '<ul class="review">'.PHP_EOL;
		        }
		
		        $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
		    ?>
		        <li class="rv_li rv_<?php echo $i;?>">
		            <div class="li_wr">
		                <a href="<?php echo $review_href; ?>" class="rv_img"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 70, 70); ?></a>
		                <div class="txt_wr">
		                    <span class="rv_tit"><?php echo get_text(cut_str($row['is_subject'], 20)); ?></span>
		                    <a href="<?php echo $review_href; ?>" class="rv_prd"><?php echo $row['it_name']; ?></a>
		                    <p><?php echo get_text(cut_str(strip_tags($row['is_content']), 90), 1); ?></p>
		                </div>
		            </div>
		        </li>
		    <?php
		    }
		
		    if($i > 0) {
		        echo '</ul>'.PHP_EOL;
		    }
		    ?>
		</section>
		<!-- }후기 끝 -->
		
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
	        $list->set_view('it_basic', false);
	        $list->set_view('it_cust_price', false);
	        $list->set_view('it_price', true);
	        $list->set_view('it_icon', true);
	        $list->set_view('sns', true);
	        echo $list->run();
	        ?>
	        <?php echo poll('theme/shop_basic'); // 설문조사 ?>
	    </section>
	    <!-- } 할인상품 끝 -->
	    <?php } ?>
		
	    <?php if($default['de_type2_list_use']) { ?>
	    <!-- 추천상품 시작 { -->
	    <section class="sct_wrap">
	        <header>
	            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
	        </header>
	        <?php
	        $list = new item_list();
	        $list->set_type(2);
	        $list->set_view('it_id', false);
	        $list->set_view('it_name', true);
	        $list->set_view('it_basic', false);
	        $list->set_view('it_cust_price', true);
	        $list->set_view('it_price', true);
	        $list->set_view('it_icon', true);
	        $list->set_view('sns', false);
	        echo $list->run();
	        ?>
	    </section>
	    <!-- } 추천상품 끝 -->
	    <?php } ?>
	</div>

</div>
<script>
$("#container").addClass("idx-container");
</script>

<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>