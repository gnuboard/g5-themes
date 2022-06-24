<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
 
<?php
$od_ids = array();
$sql = " select distinct od_id from {$g5['g5_shop_cart_table']} where it_id = '$it_id' and ct_status in ('입금', '준비', '배송', '완료') order by od_id desc limit 50 ";
$result = sql_query($sql);
for($k=0; $row=sql_fetch_array($result); $k++) {
    if($row['od_id'])
        $od_ids[] = $row['od_id'];
}

if(!empty($od_ids)) {
    $sql = " select it_id, it_name, sum(ct_qty) as qty from {$g5['g5_shop_cart_table']} where od_id in ( '".implode("', '", $od_ids)."' ) and it_id <> '$it_id' group by it_id order by qty desc limit 6 ";
    $result = sql_query($sql);

    if(sql_num_rows($result)) {
?>

<!-- 같이구매한상품 시작 { -->
<section id="sit_relbuy">
    <h2>같이 구매한 상품 </h2>
    <div id="sct_relbuyitem">
        <ul>
            <?php
            for($k=0; $row=sql_fetch_array($result); $k++) {
                $name = get_text($row['it_name']);
                $img  = get_it_image($row['it_id'], 230, 230, false, '', $name);
                $href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];

                if(!$img)
                    continue;
            ?>
            <li>
                <a href="<?php echo $href; ?>" class="sct_a"><?php echo $img; ?></a>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
</section>
<script>
jQuery(function($){
    $('#sct_relbuyitem ul').show().bxSlider({
        maxSlides: 5,
        moveSlides:5,
        slideWidth: 200,
        slideMargin: 15,
        auto: true,
        pager:false,
        infiniteLoop:false
    });
});
</script>
<?php
    }
}
?>


<div class="view_wr">
    <div class="view_left">
        <!-- 상품 정보 시작 { -->
        <section id="sit_inf">
            <h2>상품 정보</h2>

            <?php
            if ($it['it_info_value']) { // 상품 정보 고시
                $info_data = unserialize(stripslashes($it['it_info_value']));
                if(is_array($info_data)) {
                    $gubun = $it['it_info_gubun'];
                    $info_array = $item_info[$gubun]['article'];
            ?>
            <h3>상품 정보 고시</h3>
            <table id="sit_inf_open">
            <colgroup>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <?php
            foreach($info_data as $key=>$val) {
                $ii_title = $info_array[$key][0];
                $ii_value = $val;
            ?>
            <tr>
                <th scope="row"><?php echo $ii_title; ?></th>
                <td><?php echo $ii_value; ?></td>
            </tr>
            <?php } //foreach?>
            </tbody>
            </table>
            <!-- 상품정보고시 end -->
            <?php
                } else {
                    if($is_admin) {
                        echo '<p>상품 정보 고시 정보가 올바르게 저장되지 않았습니다.<br>config.php 파일의 G5_ESCAPE_FUNCTION 설정을 addslashes 로<br>변경하신 후 관리자 &gt; 상품정보 수정에서 상품 정보를 다시 저장해주세요. </p>';
                    }
                }
            } //if
            ?>

            <?php if ($it['it_explan']) { // 상품 상세설명 ?>
            <h3>상품 상세설명</h3>
            <div id="sit_inf_explan">
                <?php echo conv_content($it['it_explan'], 1); ?>
            </div>
            <?php } ?>
        
            <?php if ($it['it_basic']) { // 상품 기본설명 ?>
            <h3>상품 기본설명</h3>
            <div id="sit_inf_basic">
                 <?php echo $it['it_basic']; ?>
            </div>
            <?php } ?>

        </section>
        <!-- } 상품 정보 끝 -->
    </div>
    <div class="view_right">
        <!-- 사용후기 시작 { -->
        <section id="sit_use">
            <h2>사용후기</h2>
           
            <div id="itemuse"><?php include_once(G5_SHOP_PATH.'/itemuse.php'); ?></div>
        </section>
        <!-- } 사용후기 끝 -->

        <!-- 상품문의 시작 { -->
        <section id="sit_qa">
            <h2>상품문의</h2>
            

            <div id="itemqa"><?php include_once(G5_SHOP_PATH.'/itemqa.php'); ?></div>
        </section>
        <!-- } 상품문의 끝 -->

        <?php if ($default['de_baesong_content']) { // 배송정보 내용이 있다면 ?>
        <!-- 배송정보 시작 { -->
        <section id="sit_dvr">
            <h2>배송정보</h2>
            <div id="itemdv"><?php echo conv_content($default['de_baesong_content'], 1); ?></div>
        </section>
        <!-- } 배송정보 끝 -->
        <?php } ?>


        <?php if ($default['de_change_content']) { // 교환/반품 내용이 있다면 ?>
        <!-- 교환/반품 시작 { -->
        <section id="sit_ex">
            <h2>교환/반품</h2>
            <div id="itemch"><?php echo conv_content($default['de_change_content'], 1); ?></div>
        </section>
        <!-- } 교환/반품 끝 -->
        <?php } ?>

    </div>
</div>
<script>
$(window).on("load", function() {
    $("#sit_inf_explan").viewimageresize2();
});


$("#container").removeClass("container").addClass("view-container");

</script>