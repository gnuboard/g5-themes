<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_THEME_JS_URL.'/slick.min.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_JS_URL.'/slick.css"></script>', 10);
?>

<?php
$max_width = $max_height = 0;
$bn_slide_btn = '';
$bn_sl = ' class="bn_sl"';

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ($i==0) echo '<div id="main_bn">'.PHP_EOL.'<div class="main_bn_slide">'.PHP_EOL;
    //print_r2($row);
    // 테두리 있는지
    $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';;
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
    if (file_exists($bimg))
    {
        $banner = '';
        $size = getimagesize($bimg);

        if($size[2] < 1 || $size[2] > 16)
            continue;

        if($max_width < $size[0])
            $max_width = $size[0];

        if($max_height < $size[1])
            $max_height = $size[1];

        echo '<div class="bn_wr">'.PHP_EOL;
        echo '<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" width="'.$size[0].'" alt="'.get_text($row['bn_alt']).'"'.$bn_border.'>';
        echo '<div class="bn_text"><div class="txt_box"><div class="txt_wr">';
        echo '<div class="txt">'.get_text($row['bn_alt']).'</div>';
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'&amp;url='.urlencode($row['bn_url']).'"'.$bn_new_win.' >';
        
            echo $banner.'자세히보기';
            if($banner)
                echo '</a>'.PHP_EOL;
        }
        else {
            echo $banner.'';
        }

        echo '</div></div></div>'.PHP_EOL;
        echo '</div>'.PHP_EOL;

        $bn_sl = '';
    }
}

if ($i > 0) {
    echo '</div>'.PHP_EOL;


    echo '</div>'.PHP_EOL;
?>


<script>
$('.main_bn_slide').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true ,
    arrows:false,
    autoplay: true,
    responsive: [
    {
      breakpoint: 1200,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '15%',
        slidesToShow: 1,
        variableWidth: false,
      }
    },
    {
      breakpoint: 970,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 1  ,
             variableWidth: false,
      }
    }
  ]
});
</script>


<?php
}
?>