<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 440;
$thumb_height = 300;
$content_length = 100;

?>

<div class="pic_lt">
	<h2 class="lat_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject ?></a></h2>
    <ul>
    <?php
    for ($i=0; $i<count($list); $i++) {
    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

    if($thumb['src']) {
        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
    } else {
        $img_content = '';
    }

    if($thumb['src']) {
        $img_class = '';
    } else {
        $img_class = 'li_noimg';
    }
    ?>
        <li class="<?php echo $img_class; ?>">
            <a href="<?php echo $list[$i]['href'] ?>" class="lt_img"><?php echo $img_content; ?></a>
            <?php
            echo "<a href=\"".$list[$i]['href']."\" class=\"lt_tit\"> ";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];
            if ($list[$i]['icon_secret']) echo " <i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
            if ($list[$i]['icon_new']) echo " <span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span> ";
            if ($list[$i]['icon_hot']) echo " <span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span> ";

            echo "</a>";
            ?>
            <div class="lat_detail"> <?php echo get_text(cut_str(strip_tags($list[$i]['wr_content']), $content_length), 1); ?></div>
            <div class="lt_info">
                <span class="sound_only">작성자</span><span class="lt_nick"><?php echo $list[$i]['name'] ?></span>
                <span class="lt_date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['datetime2'] ?></span>
                <span class="lt_comnt"><?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo $list[$i]['comment_cnt'] ?><span class="sound_only">개</span><?php } ?>
            </div>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="more"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a>
</div>

