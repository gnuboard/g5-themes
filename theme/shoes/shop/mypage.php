<?php
include_once('./_common.php');

$g5['title'] = '마이페이지';

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');

global $cp_count;
$cp_count = 0;
$sql = " select cp_id
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."' ";
$res = sql_query($sql);

for($k=0; $cp=sql_fetch_array($res); $k++) {
    if(!is_used_coupon($member['mb_id'], $cp['cp_id']))
        $cp_count++;
        
}
?>

<!-- 마이페이지 시작 { -->
<div id="smb_my">

   <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <div class="hello_name">
            <div class="my_name">
                <strong><?php echo $member['mb_id'] ? $member['mb_name'] : '비회원'; ?></strong>님
            </div>
            <ul id="smb_my_act">
                <?php if ($is_admin == 'super') { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/" class="btn_admin">관리자</a></li><?php } ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/memo.php" target="_blank" class="win_memo">쪽지함</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();">회원탈퇴</a></li>
            </ul>
        </div>
        <div class="my_cou_wr">
            <div class="my_cou"><a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><span class="sound_only">쿠폰</span><?php echo number_format($cp_count); ?></a></div>
            <div class="my_po"><a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point"><span class="sound_only">포인트</span><?php echo number_format($member['mb_point']); ?>점</a></div>
        </div>
        <dl class="my_info">
            <dt>연락처</dt>
            <dd><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></dd>
            <dt>E-Mail</dt>
            <dd><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></dd>
            <dt>최종접속일시</dt>
            <dd><?php echo $member['mb_today_login']; ?></dd>
            <dt>회원가입일시</dt>
            <dd><?php echo $member['mb_datetime']; ?></dd>
            <dt class="add">주소</dt>
            <dd class="add"><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></dd>
        </dl>
    </section>

    <!-- } 회원정보 개요 끝 -->
    <div id="smb_my_wr" >
        <!-- 최근 주문내역 시작 { -->
        <section id="smb_my_od">
            <h2>최근 주문내역</h2>
            <?php
            // 최근 주문내역
            define("_ORDERINQUIRY_", true);

            $limit = " limit 0, 5 ";
            include G5_SHOP_PATH.'/orderinquiry.sub.php';
            ?>

            <div class="smb_my_more">
                <a href="./orderinquiry.php">더보기</a>
            </div>
        </section>
        <!-- } 최근 주문내역 끝 -->

        <!-- 최근 위시리스트 시작 { -->
        <section id="smb_my_wish">
            <h2>최근 위시리스트</h2>

            <div class="list_02">
                <ul>

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
                    $image = get_it_image($row['it_id'], 230, 230, true);
                ?>

                <li>
                    <div class="smb_my_img"><?php echo $image; ?></div>
                    <div class="smb_my_tit"><a href="./item.php?it_id=<?php echo $row['it_id']; ?>"><?php echo stripslashes($row['it_name']); ?></a></div>
                    <div class="smb_my_date"><?php echo $row['wi_time']; ?></div>
                </li>

                <?php
                }

                if ($i == 0)
                    echo '<li class="empty_li">보관 내역이 없습니다.</li>';
                ?>
                </ul>
            </div>

            <div class="smb_my_more">
                <a href="./wishlist.php">더보기</a>
            </div>
        </section>
        <!-- } 최근 위시리스트 끝 -->
    </div>
</div>

<script>
$(function() {
    $(".win_coupon").click(function() {
        var new_win = window.open($(this).attr("href"), "win_coupon", "left=100,top=100,width=700, height=600, scrollbars=1");
        new_win.focus();
        return false;
    });
});

function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>
<!-- } 마이페이지 끝 -->

<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>