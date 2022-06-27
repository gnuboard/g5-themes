<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
                where ca_use = '1' ";
    if($ca_id)
        $sql .= " and ca_id like '$ca_id%' ";
    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

    return $sql;
}
?>
 <div id="side_menu" class="menu">
    <button type="button" class="menu_close"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">카테고리닫기</span></button>
    <div class="cate_bg"></div>
    <div class="side_wr">
        <?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>
        <?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
        <ul id="hd_qnb">
           <li><a href="<?php echo G5_BBS_URL; ?>/faq.php"><i class="fa fa-question" aria-hidden="true"></i><span>FAQ</span></a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php"><i class="fa fa-comments" aria-hidden="true"></i><span>1:1문의</span></a>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php"><i class="fa fa-credit-card"></i><span>개인결제</span></a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php"><i class="fa fa-pencil"></i><span>사용후기</span></a></li>
            <?php if(G5_COMMUNITY_USE) { ?>
            <li class="tnb_left tnb_shop"><a href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-bag" aria-hidden="true"></i> 쇼핑몰</a></li>
            <li class="tnb_left tnb_community"><a href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i> 커뮤니티</a></li>
            <?php } ?>
        </ul>
    </div>
</div>

<div id="category" class="menu">
    <button type="button" class="menu_close"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">카테고리닫기</span></button>
    <div class="cate_bg"></div>
    <div class="menu_wr">
     
        <div id="cate_ul">
            <?php
            $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
            $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
            for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
                if($i == 0)
                    echo '<ul class="cate">'.PHP_EOL;
            ?>
                <li>
                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                    <?php
                    $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
                    if(sql_num_rows($mshop_ca_res2))
                        echo '<button class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row1['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                    for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
                        if($j == 0)
                            echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
                    ?>
                        <li>
                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                            <?php
                            $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
                            if(sql_num_rows($mshop_ca_res3))
                                echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row2['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                            for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
                                if($k == 0)
                                    echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
                            ?>
                                <li>
                                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>"><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
                                    <?php
                                    $mshop_ca_res4 = sql_query(get_mshop_category($mshop_ca_row3['ca_id'], 8));
                                    if(sql_num_rows($mshop_ca_res4))
                                        echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row3['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                                    for($m=0; $mshop_ca_row4=sql_fetch_array($mshop_ca_res4); $m++) {
                                        if($m == 0)
                                            echo '<ul class="sub_cate sub_cate3">'.PHP_EOL;
                                    ?>
                                        <li>
                                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row4['ca_id']; ?>"><?php echo get_text($mshop_ca_row4['ca_name']); ?></a>
                                            <?php
                                            $mshop_ca_res5 = sql_query(get_mshop_category($mshop_ca_row4['ca_id'], 10));
                                            if(sql_num_rows($mshop_ca_res5))
                                                echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row4['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                                            for($n=0; $mshop_ca_row5=sql_fetch_array($mshop_ca_res5); $n++) {
                                                if($n == 0)
                                                    echo '<ul class="sub_cate sub_cate4">'.PHP_EOL;
                                            ?>
                                                <li>
                                                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>"><?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
                                                </li>
                                            <?php
                                            }

                                            if($n > 0)
                                                echo '</ul>'.PHP_EOL;
                                            ?>
                                        </li>
                                    <?php
                                    }

                                    if($m > 0)
                                        echo '</ul>'.PHP_EOL;
                                    ?>
                                </li>
                            <?php
                            }

                            if($k > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                        </li>
                    <?php
                    }

                    if($j > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
            <?php
            }

            if($i > 0)
                echo '</ul>'.PHP_EOL;
            else
                echo '<p>등록된 분류가 없습니다.</p>'.PHP_EOL;
            ?>
        </div>
    </div>
</div>
<script>
$(function (){

    $("button.sub_ct_toggle").on("click", function() {
        var $this = $(this);
        $sub_ul = $(this).closest("li").children("ul.sub_cate");

        if($sub_ul.size() > 0) {
            var txt = $this.text();

            if($sub_ul.is(":visible")) {
                txt = txt.replace(/닫기$/, "열기");
                $this
                    .removeClass("ct_cl")
                    .text(txt);
            } else {
                txt = txt.replace(/열기$/, "닫기");
                $this
                    .addClass("ct_cl")
                    .text(txt);
            }

            $sub_ul.toggle();
        }
    });

     
});
</script>
