 <?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function item_icon2($it)
{
    global $g5;

    $icon = '<span class="sct_icon">';

    if ($it['it_type2'])
        $icon .= '<span class="shop_icon shop_icon_1">추천</span>';

    if ($it['it_type4'])
        $icon .= '<span class="shop_icon shop_icon_2">인기</span>';

    if ($it['it_type5'])
        $icon .= '<span class="shop_icon shop_icon_3">할인</span>';

    if ($it['it_type3'])
        $icon .= '<span class="shop_icon shop_icon_4">최신</span>';

    if ($it['it_type1'])
        $icon .= '<span class="shop_icon shop_icon_5">히트</span>';

    // 쿠폰상품
    $sql = " select count(*) as cnt
                from {$g5['g5_shop_coupon_table']}
                where cp_start <= '".G5_TIME_YMD."'
                  and cp_end >= '".G5_TIME_YMD."'
                  and (
                        ( cp_method = '0' and cp_target = '{$it['it_id']}' )
                        OR
                        ( cp_method = '1' and ( cp_target IN ( '{$it['ca_id']}', '{$it['ca_id2']}', '{$it['ca_id3']}' ) ) )
                      ) ";
    $row = sql_fetch($sql);
    if($row['cnt'])
        $icon .= '<span class="shop_icon shop_icon_6">쿠폰</span>';

    $icon .= '</span>';

    return $icon;
}

function soldout_icon($it)
{
    global $g5;
    $icon = '<span class="sct_icon">';
    // 품절
    if (is_soldout($it['it_id']))
        $icon .= '<span class="icon_soldout"><span class="soldout_txt">SOLD OUT</span></span>';

    return $icon;
}




function memo_recv_count($mb_id)
{
    global $g5;

    if(!$mb_id)
        return 0;

    $sql = " select count(*) as cnt from {$g5['memo_table']} where me_recv_mb_id = '$mb_id' and me_read_datetime = '0000-00-00 00:00:00' ";
    $row = sql_fetch($sql);
    return $row['cnt'];
}



function get_wish_count($it_id)
{
    global $g5;

    $sql = " select count(*) as cnt
                from {$g5['g5_shop_wish_table']}
                where it_id = '$it_id' ";
    $row = sql_fetch($sql);

    return $row['cnt'];
}

function get_use_count($it_id)
{
    global $g5;

    $sql = " select count(*) as cnt
                from {$g5['g5_shop_item_use_table']}
                where it_id = '$it_id' ";
    $row = sql_fetch($sql);

    return $row['cnt'];
}



?>