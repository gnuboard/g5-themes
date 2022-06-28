<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<div class="lt_tab">
    <ul class="tabs tab_01">
		<li class="tab-link current" data-tab="tab-1">게시판이름1</li>
		<li class="tab-link" data-tab="tab-2">게시판이름2</li>
		<li class="tab-link" data-tab="tab-3">게시판이름3</li>
	</ul>
    <div id="tab-1" class="tab-content content01 current">
        <!-- 탭  최신글 1 { -->
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/pic_basic', 'gallery', 4, 33);
        ?>
        <!-- } 탭  최신글1 끝 -->
    </div>
 
    <div id="tab-2" class="tab-content  content01">
        <!-- 탭  최신글2 { -->
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/pic_basic', 'notice', 4, 33);
        ?>
        <!-- } 탭  최신글2 끝 -->
    </div>

    <div id="tab-3" class="tab-content content01">
        <!-- 탭  최신글2 { -->
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/pic_basic', 'free', 4, 33);
        ?>
        <!-- } 탭  최신글2 끝 -->
    </div>
</div>

<script>
$(document).ready(function(){
	
	$('ul.tab_01 li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tab_01 li').removeClass('current');
		$('.content01').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
</script>


<div class="lt_tab">

    <ul class="tabs tab_02">
		<li class="tab-link current" data-tab="tab2-1">게시판이름1</li>
		<li class="tab-link" data-tab="tab2-2">게시판이름2</li>
		<li class="tab-link" data-tab="tab2-3">게시판이름3</li>
	</ul>

    <div id="tab2-1" class="tab-content content02 current">
        <!-- 탭  최신글 1 { -->
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/pic2_basic', 'gallery', 5, 33);
        ?>
        <!-- } 탭  최신글1 끝 -->
    </div>
 
    <div id="tab2-2" class="tab-content content02">
        <!-- 탭  최신글2 { -->
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/pic2_basic', 'notice', 5, 33);
        ?>
        <!-- } 탭  최신글2 끝 -->
    </div>

    <div id="tab2-3" class="tab-content content02">
        <!-- 탭  최신글2 { -->
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/pic2_basic', 'free', 5, 33);
        ?>
        <!-- } 탭  최신글2 끝 -->
    </div>
</div>
<script>
$(document).ready(function(){
	
	$('ul.tab_02 li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tab_02 li').removeClass('current');
		$('.content02').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
</script>


<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>