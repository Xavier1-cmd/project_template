<?php
require_once("./conections/connMysql.php");
//預設每頁筆數
$pageRow_records = 6;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages - 1) * $pageRow_records;
//未加限制顯示筆數的SQL敘述句
$query_RecAlbum = "SELECT album.album_id , album.album_date , album.album_location , album.album_title , album.album_desc , albumphoto.ap_picurl, count( albumphoto.ap_id ) AS albumNum FROM album LEFT JOIN albumphoto ON album.album_id = albumphoto.album_id GROUP BY album.album_id , album.album_date , album.album_location , album.album_title , album.album_desc ORDER BY album_date DESC";
//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
$query_limit_RecAlbum = $query_RecAlbum . " LIMIT {$startRow_records}, {$pageRow_records}";
//以加上限制顯示筆數的SQL敘述句查詢資料到 $RecAlbum 中
$RecAlbum = $db_link->query($query_limit_RecAlbum);
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_RecAlbum 中
$all_RecAlbum = $db_link->query($query_RecAlbum);
//計算總筆數
$total_records = $all_RecAlbum->num_rows;
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records / $pageRow_records);
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Begin: Global plugin css -->
  <link rel="stylesheet" href="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/vendor.css">
  <link rel="stylesheet" href="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/style.css">
  <link rel="stylesheet" href="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/frontend.css">
  <!-- End: Global css-->


  <title>模型屋</title>
</head>

<body>
  <section id="header">
    <div class="main_background" style="background: url(https://img.cloudimg.in/uploads/shops/1840/theme/43/43e429041e4b3946a481efd490ef1bcf.jpg?v=202407120420) center center  repeat  #000000 ;position:fixed;">
    </div>
    <div class="function_block">
      <header class="function_area">
        <div class="cont">
          <div class="d-flex justify-content-between">
            <ul class="function_list d-flex list-unstyled mb-0 flex_1">
              <li>
                <div class="el_hotkey_area">
                  <span class="position-relative">
                    <button class="btn el_btn el_btn_hotkey el_rounded_circle d-flex align-items-center justify-content-center js_hover_effect" type="button" style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-hover-style="background-color: #2B3033;border-color:#2B3033;color: #ffffff;" onclick="location.href='https://store.mrjoe.com.tw/order/query'">
                      <i class="icon-new_ordersearch md-16"></i>
                    </button>
                    <div class="el_btn_tips position-absolute mb-0">
                      <span class="el_top_triangle d-block mx-auto" style="border-bottom-color:rgba(50, 55, 58, 0.85);color: #ffffff;"></span>
                      <h6 class="d-flex mb-0" style="background-color: rgba(50, 55, 58, 0.85);color: #ffffff;">訂單查詢
                      </h6>
                    </div>
                  </span>
                  <span class="position-relative">
                    <button class="btn el_btn el_btn_hotkey el_rounded_circle d-flex align-items-center justify-content-center js_hover_effect" type="button" style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-hover-style="background-color: #2B3033;border-color:#2B3033;color: #ffffff;" onclick="location.href='https://store.mrjoe.com.tw/contact'">
                      <i class="icon-new_mail md-16"></i>
                    </button>
                    <div class="el_btn_tips position-absolute mb-0">
                      <span class="el_top_triangle d-block mx-auto" style="border-bottom-color:rgba(50, 55, 58, 0.85);color: #ffffff;"></span>
                      <h6 class="d-flex mb-0" style="background-color: rgba(50, 55, 58, 0.85);color: #ffffff;">聯絡我們
                      </h6>
                    </div>
                  </span>
                  <span class="position-relative">
                    <button class="btn el_btn el_btn_hotkey el_rounded_circle d-flex align-items-center justify-content-center js_hover_effect" type="button" style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-hover-style="background-color: #2B3033;border-color:#2B3033;color: #ffffff;" onclick="location.href='https://store.mrjoe.com.tw/faq'">
                      <i class="icon-new_info md-16"></i>
                    </button>
                    <div class="el_btn_tips position-absolute mb-0">
                      <span class="el_top_triangle d-block mx-auto" style="border-bottom-color:rgba(50, 55, 58, 0.85);color: #ffffff;"></span>
                      <h6 class="d-flex mb-0" style="background-color: rgba(50, 55, 58, 0.85);color: #ffffff;">購物說明
                      </h6>
                    </div>
                  </span>
                </div>
              </li>
              <li>
                <div class="el_login_area js_login" style="">
                </div>
                <div class="el_login_area js_logined" style="display:none">
                  <span class="is_login position-relative">
                    <button class="btn el_btn el_btn_login el_rounded_pill d-flex align-items-center justify-content-center js_member_hover_effect" type="button" style="background-color: #32373A;border-color:#32373A;" data-style="background-color: #32373A;border-color:#32373A;" data-hover-style="background-color: #FF9800;border-color:#FF9800;" onclick="location.href='https://store.mrjoe.com.tw/member/index'">
                      <i class="icon-crown md-16"></i>
                      <span style="background-color: rgba(255, 255, 255, 1)" data-style="background-color: rgba(255, 255, 255, 1)" data-hover-style="background-color: rgba(255, 255, 255, .1)">
                        <b class="js_member_name" style="color: #32373A;" data-style="color: #32373A;" data-hover-style="color: #ffffff;">
                          會員專區
                        </b>
                      </span>
                    </button>
                    <div class="el_btn_tips position-absolute mb-0">
                      <span class="el_top_triangle d-block mx-auto" style="border-bottom-color:rgba(50, 55, 58, 0.85);color: #ffffff;"></span>
                      <h6 class="d-flex mb-0" style="background-color: rgba(50, 55, 58, 0.85);color: #ffffff;">會員專區
                      </h6>
                    </div>
                  </span>
                  <span class="position-relative">
                    <button class="btn el_btn el_btn_hotkey el_rounded_circle d-flex align-items-center justify-content-center js_hover_effect js_member_logout" type="button" style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-style="background-color: #32373A;border-color:#32373A;color: #ffffff;" data-hover-style="background-color: #2B3033;border-color:#2B3033;color: #ffffff;">
                      <i class="icon-new_logout md-14"></i>
                    </button>
                    <div class="el_btn_tips position-absolute mb-0">
                      <span class="el_top_triangle d-block mx-auto" style="border-bottom-color:rgba(50, 55, 58, 0.85);color: #ffffff;"></span>
                      <h6 class="d-flex mb-0" style="background-color: rgba(50, 55, 58, 0.85);color: #ffffff;">登出</h6>
                    </div>
                  </span>
                </div>
              </li>

            </ul>
            <div class="el_social_area">
              <ul class="social_list d-flex list-unstyled mb-0">
                <li>
                  <a class="d-block" href="https://store.mrjoe.com.tw/">
                    <svg data-name=" 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72" style="width: 30px;">
                      <defs>
                        <style>
                          .cls-1 {
                            fill: #2B3033;
                          }

                          .cls-2 {
                            fill: #fff;
                          }
                        </style>
                      </defs>
                      <circle class="cls-1" cx="36" cy="36" r="36"></circle>
                      <path class="cls-2" d="M41.62,33.6a3.3,3.3,0,0,1-3.25-2.36V18h4.45l2.06,6.44v5.9a3.27,3.27,0,0,1-3.26,3.26Z">
                      </path>
                      <path class="cls-2" d="M30.38,33.6a3.27,3.27,0,0,1-3.26-3.26v-5.9L29.18,18h4.45V30.34a3.26,3.26,0,0,1-3.25,3.26Z">
                      </path>
                      <path class="cls-2" d="M19.14,33.6a3.27,3.27,0,0,1-3.26-3.26V24.66L19.43,18h4.78l-1.82,5.7v6.64a3.26,3.26,0,0,1-3.25,3.26Z">
                      </path>
                      <path class="cls-2" d="M32.41,45.91h7.31V54H32.41Z"></path>
                      <path class="cls-2" d="M44.45,54V43.54a2.37,2.37,0,0,0-2.36-2.37H30a2.37,2.37,0,0,0-2.37,2.37V54H21.94a1.64,1.64,0,0,1-1.64-1.65V38.24A8,8,0,0,0,24.76,36h0a8,8,0,0,0,11.18.06h0s.09.08.13.13a8.27,8.27,0,0,0,5.55,2.13h0A7.86,7.86,0,0,0,47.24,36h0a8,8,0,0,0,4.42,2.23h0v14.1A1.65,1.65,0,0,1,50.06,54H44.45Z">
                      </path>
                      <path class="cls-2" d="M52.86,33.6a3.26,3.26,0,0,1-3.25-3.26V23.7L47.79,18H52.6c1.68,3,3.07,5.61,3.52,6.53v5.81a3.27,3.27,0,0,1-3.26,3.26Z">
                      </path>
                    </svg>
                  </a>
                </li>

                <li><a class="d-block" href="https://www.facebook.com/MRJOEHOBBY/" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_facebook.svg" width="30" height="30" alt=""></a></li>


                <li><a class="d-block" href="https://www.instagram.com/mr.joehobby/?hl=zh-tw" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_instagram.svg" width="30" height="30" alt=""></a></li>

                <li><a class="d-block" href="https://www.youtube.com/c/MRJOEHOBBYtv/" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_youtube.svg" width="30" height="30" alt=""></a></li>


                <li><a class="d-block" href="https://www.tiktok.com/@mrjoehobby" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_tiktok.svg" width="30" height="30" alt=""></a></li>



              </ul>
            </div>
          </div>
        </div>
      </header>
    </div>

    <nav class="js_mobile_first_menu el_nav_bar first position-fixed active">
      <ul class="el_nav_items d-flex list-unstyled mb-0" style="background-color: rgba(50, 55, 58, 0.85);">
        <!-- 漢堡堡 -->
        <li>
          <div class="js_footer_btn js_mobile_footer_btn js_mobile_menu d-flex align-items-center justify-content-center" data-type="menu">
            <a class="mobile_footer_item btn el_btn el_nav_btn el_btn_hamburger d-flex flex-column align-items-center el_rounded_0 border-0" href="javascript:void(0)" style="color: #fff;">
              <i class="icon-new_menu md-20"></i>
              <h6 class="mb-0">選單</h6>
            </a>
          </div>
        </li>


        <li class="js_login" style="">
          <div class=" js_mobile_footer_btn d-flex align-items-center justify-content-center" data-type="order">
            <a class="mobile_footer_item btn el_btn el_nav_btn d-flex flex-column align-items-center el_rounded_0 border-0" href="https://store.mrjoe.com.tw/order/query" style="color: #fff;">
              <i class="icon-new_ordersearch md-20"></i>
              <h6 class="mb-0">查訂單</h6>
            </a>
          </div>
        </li>
        <li class="js_logined" style="display: none!important;">
          <!-- 登出 -->
          <div class="js_mobile_footer_btn d-flex align-items-center justify-content-center js_member_logout">
            <a class="mobile_footer_item btn el_btn el_nav_btn d-flex flex-column align-items-center el_rounded_0 border-0" href="javascript:void(0)" style="color: #fff;">
              <i class="icon-new_logout md-20"></i>
              <h6 class="mb-0">登出</h6>
            </a>
          </div>
        </li>

        <li class="js_logined" style="display: none!important;">
          <div class=" d-flex js_mobile_footer_btn align-items-center justify-content-center" data-type="member">
            <a class="mobile_footer_item btn el_btn el_nav_btn d-flex flex-column align-items-center el_rounded_0 border-0" href="https://store.mrjoe.com.tw/faq" style="color: #fff;">
              <i class="icon-new_info md-20"></i>
              <h6 class="mb-0">說明</h6>
            </a>
          </div>
        </li>
        <li class="js_login" style="">
          <div class="js_m_member d-flex js_mobile_footer_btn align-items-center justify-content-center" data-type="member">
            <a class="mobile_footer_item btn el_btn el_nav_btn d-flex flex-column align-items-center el_rounded_0 border-0" href="https://store.mrjoe.com.tw/faq" style="color: #fff;">
              <i class="icon-new_info md-20"></i>
              <h6 class="mb-0">說明</h6>
            </a>
          </div>
        </li>


        <li>
          <div class="js_mobile_footer_btn js_footer_btn d-flex align-items-center justify-content-center" data-type="search">
            <!-- 點擊按鈕後，.el_nav_search 加 .active -->
            <a class="mobile_footer_item btn el_btn el_nav_btn el_nav_search d-flex flex-column align-items-center el_rounded_0 border-0" href="javascript:void(0)" style="color: #fff;">
              <i class="icon-new_search md-20"></i>
              <h6 class="mb-0">搜尋</h6>
            </a>
            <div class="js_m_footer_area el_nav_info position-absolute p-10">
              <div class="form_group mb-0">
                <form class="form_data" action="">
                  <input id="form_search_mobile" name="keyword" class="form_input form_control" placeholder="商品搜尋" type="text">
                  <span class="msg_error"><i class="icon-new_exclamation"></i></span>
                </form>
                <div class="help_block d-none"><i class="icon-new_exclaim_circle"></i><span>必填欄位，不得為空白。</span></div>
              </div>
            </div>
            <div class="el_nav_overlay js_mask_cover_for_nav"></div>
          </div>
        </li>

        <li class="el_nav_fn">
          <div class="js_footer_btn js_mobile_footer_btn js_mobile_cart d-flex align-items-center justify-content-center" data-type="cart">
            <a class="js_cart_toggle mobile_footer_item btn el_btn el_nav_btn el_btn_cart d-flex flex-column align-items-center el_rounded_0 border-0" href="javascript:void(0)" style="color: #fff;">
              <span class="d-flex justify-content-center">
                <i class="icon-new_cart md-24"></i>
                <small class="el_cart_num el_rounded_pill d-block" style="background-color: #C14848;"><span class="position-relative js_cart_number">0</span></small>
              </span>
              <h6 class="mb-0">購物車</h6>
            </a>
          </div>
        </li>
      </ul>
    </nav>
  </section>

  <section id="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./product_img/pic1.jpg" class="d-block w-100" alt="水星的魔女 SDCS異靈鋼彈">
                <div class="carousel-caption d-none d-md-block">
                  <h5></h5>
                  <p></p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./product_img/pic2.jpg" class="d-block w-100" alt="AMAKLINITECH 始源我王凱牙">
                <div class="carousel-caption d-none d-md-block">
                  <h5></h5>
                  <p></p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./product_img/pic3.jpg" class="d-block w-100" alt="飛翼零式隨時加開 熱烈預購中！">
                <div class="carousel-caption d-none d-md-block">
                  <h5></h5>
                  <p></p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <hr>
          <div class="row text-center">
            <!-- <div class="card col-md-3">
              <img src="./product_img/pic0101.jpg" class="card-img-top" alt="濕身阿爾維娜">
              <div class="card-body">
                <h5 class="card-title">濕身阿爾維娜</h5>
                <p class="card-text">預購25年3月 SIKI ANIM 1/7 PVC人形 濕身阿爾維娜 豪華版 附掛軸 PVC 完成品</p>
                <span class="card-text text-decoration-line-through">TWD $2,000</span>
                <p class="card-text">TWD $1,650</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div> -->

            <!-- 顯示商品資訊 -->
            <?php while ($row_RecAlbum = $RecAlbum->fetch_assoc()) { ?>
              <div class="card col-md-4">
                <a href="albumshow.php?id=<?php echo $row_RecAlbum["album_id"]; ?>">
                  <?php if ($row_RecAlbum["albumNum"] == 0) { ?>
                    <img src="images/nopic.png" alt="暫無圖片">
                  <?php } else { ?>
                    <span class="card border-0">
                      <img src="photos/<?php echo $row_RecAlbum["ap_picurl"]; ?>" alt="<?php echo $row_RecAlbum["album_title"]; ?>">
                    </span>
                  <?php } ?>
                </a>
                <div class="card-body">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row_RecAlbum["album_title"]; ?></h5>
                    <p class="card-text"><?php echo $row_RecAlbum["album_desc"]; ?></p>
                    <span class="card-text text-decoration-line-through">TWD $2,000</span>
                    <p class="card-text">TWD $1,650</p>
                    <a href="#" class="btn btn-primary">更多資訊</a>
                    <a href="#" class="btn btn-success">放購物車</a>
                    <div class="albuminfo">
                      <a href="albumshow.php?id=<?php echo $row_RecAlbum["album_id"]; ?>"><?php echo $row_RecAlbum["album_title"]; ?></a><br />
                      <span class="smalltext">共 <?php echo $row_RecAlbum["albumNum"]; ?> 張</span><br>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <!-- 網路相簿程式 -->
            <!-- <table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="124" valign="top" background="images/album_r1_c1.jpg">
                  <div class="titleDiv"> [生活、旅行的記錄]<br />
                  </div>
                  <div class="menulink"><a href="index.php">[相簿首頁]</a> <a href="login.php">[相簿管理]</a></div>
                </td>
              </tr>
              <tr>
                <td background="images/album_r2_c1.jpg">
                  <div id="mainRegion">
                    <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
                      <tr>
                        <td>
                          <div class="subjectDiv"> 網路相簿總覽 </div>
                          <div class="actionDiv">相簿總數: <?php echo $total_records; ?></div>
                          <div class="normalDiv"></div>
                          <?php while ($row_RecAlbum = $RecAlbum->fetch_assoc()) { ?>
                            <div class="albumDiv">
                              <div class="picDiv"><a href="albumshow.php?id=<?php echo $row_RecAlbum["album_id"]; ?>"><?php if ($row_RecAlbum["albumNum"] == 0) { ?><img src="images/nopic.png" alt="暫無圖片" width="120" height="120" border="0" /><?php } else { ?><img src="photos/<?php echo $row_RecAlbum["ap_picurl"]; ?>" alt="<?php echo $row_RecAlbum["album_title"]; ?>" width="120" height="120" border="0" /><?php } ?></a></div>
                              <div class="albuminfo"><a href="albumshow.php?id=<?php echo $row_RecAlbum["album_id"]; ?>"><?php echo $row_RecAlbum["album_title"]; ?></a><br />
                                <span class="smalltext">共 <?php echo $row_RecAlbum["albumNum"]; ?> 張</span><br>
                                <br>
                              </div>
                            </div>
                          <?php } ?>
                          <div class="navDiv">
                            <?php if ($num_pages > 1) { // 若不是第一頁則顯示 
                            ?>
                              <a href="?page=1">|&lt;</a> <a href="?page=<?php echo $num_pages - 1; ?>">&lt;&lt;</a>
                            <?php } else { ?>
                              |&lt; &lt;&lt;
                            <?php } ?>
                            <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                              if ($i == $num_pages) {
                                echo $i . " ";
                              } else {
                                echo "<a href=\"?page=$i\">$i</a> ";
                              }
                            }
                            ?>
                            <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 
                            ?>
                              <a href="?page=<?php echo $num_pages + 1; ?>">&gt;&gt;</a> <a href="?page=<?php echo $total_pages; ?>">&gt;|</a>
                            <?php } else { ?>
                              &gt;&gt; &gt;|
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </td>
              </tr>
              <tr>
                <td align="center" background="images/album_r2_c1.jpg" class="trademark">© 2016 eHappy Studio All Rights Reserved.</td>
              </tr>
              <tr>
                <td><img name="album_r4_c1" src="images/album_r4_c1.jpg" width="778" height="24" border="0" id="album_r4_c1" alt="" /></td>
              </tr>
            </table> -->

            <!-- <div class="card col-md-3">
              <img src="./product_img/pic0102.jpg" class="card-img-top" alt="被束縛的貓 露芙娜">
              <div class="card-body">
                <h5 class="card-title">被束縛的貓 露芙娜</h5>
                <p class="card-text">預購25年3月 SIKI ANIM 1/7 PVC人形 被束縛的貓 露芙娜 豪華版 附掛軸 PVC 完成品</p>
                <span class="card-text text-decoration-line-through">TWD $2,000</span>
                <p class="card-text">TWD $1,650</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0103.jpg" class="card-img-top" alt="費倫 葬送的芙莉蓮">
              <div class="card-body">
                <h5 class="card-title">費倫 葬送的芙莉蓮</h5>
                <p class="card-text">預購12月 好微笑 GSC 代理版 POP UP PARADE 費倫 葬送的芙莉蓮 完成品</p>
                <span class="card-text text-decoration-line-through">TWD $950</span>
                <p class="card-text">TWD $820</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0104.jpg" class="card-img-top" alt="hololive 噶嗚‧古拉 GURA">
              <div class="card-body">
                <h5 class="card-title">hololive 噶嗚‧古拉 GURA</h5>
                <p class="card-text">預購25年1月 好微笑 GSC 代理版 POP UP PARADE hololive 噶嗚‧古拉 GURA</p>
                <span class="card-text text-decoration-line-through">TWD $1,099</span>
                <p class="card-text">TWD $940</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div> -->
            <!-- <div class="card col-md-3">
              <img src="./product_img/pic0201.jpg" class="card-img-top" alt="頂級金貝貝棉柔魔術氈">
              <div class="card-body">
                <h5 class="card-title">頂級金貝貝棉柔魔術氈</h5>
                <p class="card-text">金貝貝棉柔魔術氈XXL27+1片【6包/箱】，適用15公斤以上</p>
                <p class="card-text">NT1560</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0202.jpg" class="card-img-top" alt="櫻桃肌粉餅撲角型-3入">
              <div class="card-body">
                <h5 class="card-title">櫻桃肌粉餅撲角型-3入</h5>
                <p class="card-text">【IH】櫻桃肌粉餅撲角型-3入 CB-3204，乾濕兩用的粉餅專用粉撲。</p>
                <p class="card-text">NT119</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0203.jpg" class="card-img-top" alt="NOYL化妝刷套裝組">
              <div class="card-body">
                <h5 class="card-title">NOYL化妝刷套裝組</h5>
                <p class="card-text">NOYL化妝刷套裝組(附收納袋) NY-369，保存期限：7年</p>
                <p class="card-text">NT369</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0204.jpg" class="card-img-top" alt="3D蘋果光氣墊粉餅">
              <div class="card-body">
                <h5 class="card-title">3D蘋果光氣墊粉餅</h5>
                <p class="card-text">【Keep in touch】3D蘋果光氣墊粉餅，15g+15g(買一送一補充蕊)。</p>
                <p class="card-text">NT1680</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0301.jpg" class="card-img-top" alt="EVE'S 魔術性感美唇膏">
              <div class="card-body">
                <h5 class="card-title">EVE'S 魔術性感美唇膏</h5>
                <p class="card-text">魔術性感美唇膏，不沾杯超持久唇色，想不到的魔術效果持續久久。</p>
                <p class="card-text">NT580</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0302.jpg" class="card-img-top" alt="DMC三合一精華霜">
              <div class="card-body">
                <h5 class="card-title">DMC三合一精華霜</h5>
                <p class="card-text">DMC 欣蘭 水透透三合一凝凍 洗卸/面膜/精華霜 150g。</p>
                <p class="card-text">NT850</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0303.jpg" class="card-img-top" alt="森下仁丹整晚貼眼膜">
              <div class="card-body">
                <h5 class="card-title">森下仁丹整晚貼眼膜</h5>
                <p class="card-text">日本森下仁丹整晚貼眼膜 5對/盒，長效整晚貼，慢速釋放保濕因子。</p>
                <p class="card-text">NT300</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div>
            <div class="card col-md-3">
              <img src="./product_img/pic0304.jpg" class="card-img-top" alt="【美爽爽】泡泡染">
              <div class="card-body">
                <h5 class="card-title">【美爽爽】泡泡染</h5>
                <p class="card-text">【美爽爽】泡泡染BUBBLE COLOR系列，任意顏色，買五送二。</p>
                <p class="card-text">NT3250</p>
                <a href="#" class="btn btn-primary">更多資訊</a>
                <a href="#" class="btn btn-success">放購物車</a>
              </div>
            </div> -->
          </div>

          <hr>
          <!-- <div class="row mt-2">
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <?php if ($num_pages > 1) { // 若不是第一頁則顯示 
                  ?>
                    <a class="page-link" href="?page=<?php echo $num_pages - 1; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  <?php } else { // 若是第一頁則顯示禁止 
                  ?>
                    <span class="page-link page-not-allowed" aria-hidden="false" aria-label="Previous">&laquo;</span>
                  <?php } ?>
                </li>
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $num_pages) {
                    echo "<li class='page-item page-link active'>$i</li>";
                  } else {
                    echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                  }
                }
                ?>
                <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 
                ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $num_pages + 1; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                <?php } else { // 若是最後一頁則顯示禁止 
                ?>
                  <li class="page-item">
                    <span class="page-link page-not-allowed" aria-label="Next">
                      <span aria-hidden="false">&raquo;</span>
                    </span>
                  </li>
                <?php } ?>
              </ul>
            </nav>
          </div> -->
          <div class="pt_pagination_area js_pagination_block">
            <div class="pt_pagination_area js_pagination_area pt_pagination_a">
              <div class="d-flex justify-content-center align-items-center">
                <ul class="pt_pagination_list d-flex align-items-center list-unstyled mb-0" style="background-color:rgba(255, 85, 85, .8);border-color:rgba(255, 85, 85, .8);">
                  <li data-page="1">
                    <button class="btn el_btn btn_page btn_first js_pagination_page_button" disabled="disabled" type="button" style="">
                      <i class="icon-first_page"></i>
                    </button>
                  </li>
                  <li data-page="0">
                    <button class="btn el_btn btn_page btn_prev js_pagination_page_button" disabled="disabled" type="button" style="">
                      <i class="icon-navigate_before"></i>
                    </button>
                  </li>
                  <li class="active" data-page="1">
                    <button class="btn el_btn btn_page  js_pagination_button js_pagination_page_button" type="button" style="">1</button>
                    <div class="page_search_area">
                      <div class="page_search d-flex position-relative">
                        <input class="el_form_cont text-center js_pagination_search_form" placeholder="頁數" value="1" type="text" style="color:rgba(255, 85, 85, 1);">
                        <button class="btn el_btn btn_search js_pagination_search_button" type="button" style="background-color:rgba(255, 85, 85, 1);">
                          <i class="icon-search"></i>
                        </button>
                      </div>
                    </div>
                  </li>
                  <li class="" data-page="2">
                    <button class="btn el_btn btn_page  js_pagination_button js_pagination_page_button" type="button" style="">2</button>
                    <div class="page_search_area">
                      <div class="page_search d-flex position-relative">
                        <input class="el_form_cont text-center js_pagination_search_form" placeholder="頁數" value="1" type="text" style="background-color:rgba(255, 85, 85, 1);">
                        <button class="btn el_btn btn_search js_pagination_search_button" type="button" style="">
                          <i class="icon-search"></i>
                        </button>
                      </div>
                    </div>
                  </li>
                  <li disabled=""><span class="btn el_btn btn_page" style="">...</span></li>
                  <li class="" data-page="33">
                    <button class="btn el_btn btn_page  js_pagination_button js_pagination_page_button" type="button" style="">33</button>
                    <div class="page_search_area">
                      <div class="page_search d-flex position-relative">
                        <input class="el_form_cont text-center js_pagination_search_form" placeholder="頁數" value="1" type="text" style="background-color:rgba(255, 85, 85, 1);">
                        <button class="btn el_btn btn_search js_pagination_search_button" type="button" style="">
                          <i class="icon-search"></i>
                        </button>
                      </div>
                    </div>
                  </li>
                  <li data-page="2">
                    <button class="btn el_btn btn_page btn_next js_pagination_page_button" style="" type="button">
                      <i class="icon-navigate_next"></i>
                    </button>
                  </li>
                  <li data-page="33">
                    <button class="btn el_btn btn_page btn_last js_pagination_page_button" style="" type="button">
                      <i class="icon-last_page"></i>
                    </button>
                  </li>
                  <li>
                    <div class="page_search_area" data-goto="前往" data-page="頁" style="">
                      <div class="page_search d-flex position-relative">
                        <input class="el_form_cont text-center js_pagination_search_form" placeholder="頁數" value="1" type="text" style="">
                        <button class="btn el_btn btn_search js_pagination_search_button" type="button" style="">
                          <i class="icon-search"></i>
                        </button>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

          </div>
          <hr>
        </div>
      </div>
    </div>
  </section>

  <footer class="el_ft04 el_same" role="footer">
    <div class="block_area">
      <span class="block_bg filter_0 position-absolute" style="background-color:rgba(50, 55, 58, 0.95);"></span>
      <div class="cont_full">
        <div class="layout_grid gutter_0 g1_01">
          <div class="layout_row grid_1">
            <!-- g1_01 -->
            <div class="layout_cell flex_1 " grid_size="1">
              <div class="layout_inner">

                <div id="1244058" class="element_inner js_component">
                  <div class="el_inner js_footer">
                    <div class="el_ft_desktop">
                      <div class="el_footer_top">
                        <div class="cont">
                          <div class="el_top_block d-flex align-items-center justify-content-center">
                            <div class="d-flex align-items-center">
                              <div class="el_logo_area mr-15">
                                <div class="el_logo_inner d-flex">
                                  <div class="el_logo_fans d-block">
                                    <iframe class="d-flex" src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/mrjoe.model&amp;tabs&amp;width=280&amp;height=130&amp;small_header=false&amp;adapt_container_width=false&amp;hide_cover=false&amp;show_facepile=false&amp;appId=1480453388896053" width="280" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                  </div>
                                </div>
                              </div>
                              <div class="el_link_area">
                                <div class="el_link_inner d-flex is_title">
                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_pc1" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_pc1" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/about" style="color: #ffffff;">
                                        關於
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/contact" style="color: #ffffff;">聯絡我們</a>
                                      </li>
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/blogs" style="color: #ffffff;">部落格</a>
                                      </li>
                                    </ul>
                                  </div>

                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_pc2" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_pc2" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/product/all" style="color: #ffffff;">
                                        全部商品
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/order/query" style="color: #ffffff;">訂單查詢</a>
                                      </li>
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#order" style="color: #ffffff;">訂單相關說明</a>
                                      </li>
                                    </ul>
                                  </div>

                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_pc3" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_pc3" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/faq#payment" style="color: #ffffff;">
                                        付款方式說明
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#shipping" style="color: #ffffff;">寄送方式說明</a>
                                      </li>
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#service" style="color: #ffffff;">售後服務說明</a>
                                      </li>
                                    </ul>
                                  </div>

                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_pc4" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_pc4" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/faq#members_redeem" style="color: #ffffff;">
                                        現金積點規則
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#policy" style="color: #ffffff;">隱私權條款</a>
                                      </li>
                                    </ul>
                                  </div>

                                </div>
                              </div>
                            </div>
                            <div class="el_media ml-auto" style="border-right: 0; margin-right: -5px;">
                              <div class="el_media_body d-grid">
                                <div class="el_social_area">
                                  <ul class="social_list d-flex list-unstyled mb-0">
                                    <li>
                                      <a class="d-block" href="https://store.mrjoe.com.tw/">
                                        <svg data-name=" 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72" style="width: 30px;">
                                          <defs>
                                            <style>
                                              .cls-1 {
                                                fill: #2B3033;
                                              }

                                              .cls-2 {
                                                fill: #fff;
                                              }
                                            </style>
                                          </defs>
                                          <circle class="cls-1" cx="36" cy="36" r="36"></circle>
                                          <path class="cls-2" d="M41.62,33.6a3.3,3.3,0,0,1-3.25-2.36V18h4.45l2.06,6.44v5.9a3.27,3.27,0,0,1-3.26,3.26Z">
                                          </path>
                                          <path class="cls-2" d="M30.38,33.6a3.27,3.27,0,0,1-3.26-3.26v-5.9L29.18,18h4.45V30.34a3.26,3.26,0,0,1-3.25,3.26Z">
                                          </path>
                                          <path class="cls-2" d="M19.14,33.6a3.27,3.27,0,0,1-3.26-3.26V24.66L19.43,18h4.78l-1.82,5.7v6.64a3.26,3.26,0,0,1-3.25,3.26Z">
                                          </path>
                                          <path class="cls-2" d="M32.41,45.91h7.31V54H32.41Z">
                                          </path>
                                          <path class="cls-2" d="M44.45,54V43.54a2.37,2.37,0,0,0-2.36-2.37H30a2.37,2.37,0,0,0-2.37,2.37V54H21.94a1.64,1.64,0,0,1-1.64-1.65V38.24A8,8,0,0,0,24.76,36h0a8,8,0,0,0,11.18.06h0s.09.08.13.13a8.27,8.27,0,0,0,5.55,2.13h0A7.86,7.86,0,0,0,47.24,36h0a8,8,0,0,0,4.42,2.23h0v14.1A1.65,1.65,0,0,1,50.06,54H44.45Z">
                                          </path>
                                          <path class="cls-2" d="M52.86,33.6a3.26,3.26,0,0,1-3.25-3.26V23.7L47.79,18H52.6c1.68,3,3.07,5.61,3.52,6.53v5.81a3.27,3.27,0,0,1-3.26,3.26Z">
                                          </path>
                                        </svg>
                                      </a>
                                    </li>

                                    <li><a class="d-block" href="https://www.facebook.com/MRJOEHOBBY/" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_facebook.svg" width="30" height="30" alt=""></a></li>


                                    <li><a class="d-block" href="https://www.instagram.com/mr.joehobby/?hl=zh-tw" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_instagram.svg" width="30" height="30" alt=""></a></li>

                                    <li><a class="d-block" href="https://www.youtube.com/c/MRJOEHOBBYtv/" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_youtube.svg" width="30" height="30" alt=""></a></li>


                                    <li><a class="d-block" href="https://www.tiktok.com/@mrjoehobby" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_tiktok.svg" width="30" height="30" alt=""></a></li>



                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="el_footer_bottom">
                        <div class="cont">
                          <div class="el_bottom_block d-flex align-items-center justify-content-center">
                            <div class="el_media">
                              <div class="el_media_body d-flex">
                              </div>
                            </div>
                            <div class="el_copyright_area">
                              <div class="ed_copyright_waca">
                                <a class="copyright_inner d-flex align-items-center" href="https://www.waca.net/">
                                  <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" width="154.223" height="25" viewBox="0 0 154.223 25">
                                    <g>
                                      <path d="M81.344,16.033,84.707.283h-3.92l-4.216,19.4A4.6,4.6,0,0,0,81.344,16.033Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M72.437.283h0l2.782,13.029L77.957.283Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M80.844,21.1A1.952,1.952,0,1,0,82.8,23.048,1.952,1.952,0,0,0,80.844,21.1" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M139.572,11.114Z" fill="#000" fill-opacity="0.4"></path>
                                      <path d="M118.913,16.8h1.842l.911-2.019h2.8l.894,2.019h1.848l-4.149-8.909Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M150.075,7.887,145.927,16.8h1.842l.911-2.019h2.8l.894,2.019h1.847Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M91.637.283h-3.92L83.5,19.688a4.6,4.6,0,0,0,4.772-3.655Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M111.825,13.144,109.74,7.705l-1.981,5.467L106.022,8.51h-1.743l3.353,9.014,2.13-5.472,2.162,5.477,3.36-9.019H113.53Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M139.567,9.172a4.709,4.709,0,0,0-1.953-.794,4.79,4.79,0,0,0-.755-.061,4.484,4.484,0,0,0-1.667.32,4.1,4.1,0,0,0-1.958,1.578,4.293,4.293,0,0,0-.728,2.454,4.32,4.32,0,0,0,.723,2.46,4.01,4.01,0,0,0,2.8,1.793,5.561,5.561,0,0,0,.915.078,4.834,4.834,0,0,0,1.363-.194,3.87,3.87,0,0,0,1.186-.579l.093-.066V14.109q-.237.2-.454.386a4.328,4.328,0,0,1-.483.347,3.384,3.384,0,0,1-1.821.525,2.4,2.4,0,0,1-1.809-.75,2.7,2.7,0,0,1-.722-1.937,2.7,2.7,0,0,1,.739-1.974,2.572,2.572,0,0,1,1.925-.756,3.4,3.4,0,0,1,2.261.866l.354.3.1-1.87Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M89.588,21.1a1.952,1.952,0,1,0,1.952,1.952A1.952,1.952,0,0,0,89.588,21.1" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M93.454,3.663,90.035,19.688a4.6,4.6,0,0,0,4.773-3.655L97.695,2.471a.845.845,0,0,1,.726-.645l0,0h2.213L102.446.009h-4.22A4.6,4.6,0,0,0,93.454,3.663Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M3.327,9.173a2.132,2.132,0,0,0-1.083.28,2.191,2.191,0,0,0-.774.73V9.307H0v8.226H1.576v-3a3.016,3.016,0,0,0,.845.673,2,2,0,0,0,.895.2,2.271,2.271,0,0,0,1.767-.828,3.394,3.394,0,0,0,.729-2.32,3.3,3.3,0,0,0-.723-2.267A2.274,2.274,0,0,0,3.327,9.173Zm.516,4.536a1.138,1.138,0,0,1-.915.44,1.216,1.216,0,0,1-.97-.479,2.294,2.294,0,0,1-.4-1.484,1.99,1.99,0,0,1,.382-1.322,1.21,1.21,0,0,1,.959-.446,1.164,1.164,0,0,1,.932.455,2.157,2.157,0,0,1,.376,1.391,2.271,2.271,0,0,1-.365,1.445" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M10.228,9.173a3.257,3.257,0,0,0-1.585.387,2.663,2.663,0,0,0-1.1,1.122A3.228,3.228,0,0,0,7.159,12.2a3.617,3.617,0,0,0,.387,1.742,2.54,2.54,0,0,0,1.131,1.086,3.454,3.454,0,0,0,1.562.37,2.949,2.949,0,0,0,2.2-.889,3.07,3.07,0,0,0,.873-2.242,3.035,3.035,0,0,0-.865-2.219,2.975,2.975,0,0,0-2.216-.878m1.041,4.472a1.376,1.376,0,0,1-2.073,0,1.972,1.972,0,0,1-.421-1.358A1.974,1.974,0,0,1,9.2,10.929a1.376,1.376,0,0,1,2.073,0,1.965,1.965,0,0,1,.418,1.347,2,2,0,0,1-.418,1.369" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M20.417,13.213l-.993-3.9H17.9l-1.026,3.9-1.117-3.9H14.228l1.886,5.959h1.531l1.01-3.833,1.027,3.833H21.2L23.11,9.308H21.556Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M26.673,9.173a2.552,2.552,0,0,0-1.959.838,3.293,3.293,0,0,0-.774,2.32,3.41,3.41,0,0,0,.589,2.054,2.667,2.667,0,0,0,2.3,1.016,2.811,2.811,0,0,0,1.635-.452,2.577,2.577,0,0,0,.957-1.316l-1.571-.264a1.238,1.238,0,0,1-.382.651.963.963,0,0,1-.623.2,1.192,1.192,0,0,1-.908-.39,1.589,1.589,0,0,1-.382-1.091h3.95a3.888,3.888,0,0,0-.735-2.69,2.644,2.644,0,0,0-2.1-.878m-1.089,2.6a1.454,1.454,0,0,1,.331-1.021,1.138,1.138,0,0,1,1.672-.02,1.526,1.526,0,0,1,.354,1.041Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M33.324,9.364a2.54,2.54,0,0,0-.677.791V9.308H31.183v5.959h1.576V13.426a9.425,9.425,0,0,1,.132-2,1.24,1.24,0,0,1,.362-.659.872.872,0,0,1,.561-.183,1.389,1.389,0,0,1,.742.258l.487-1.374a2,2,0,0,0-1.037-.3A1.24,1.24,0,0,0,33.324,9.364Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M38.454,9.173a2.55,2.55,0,0,0-1.958.838,3.293,3.293,0,0,0-.774,2.32,3.41,3.41,0,0,0,.589,2.054,2.667,2.667,0,0,0,2.3,1.016,2.811,2.811,0,0,0,1.635-.452,2.577,2.577,0,0,0,.957-1.316l-1.571-.264a1.238,1.238,0,0,1-.382.651.963.963,0,0,1-.623.2,1.2,1.2,0,0,1-.909-.39,1.593,1.593,0,0,1-.381-1.091h3.95a3.888,3.888,0,0,0-.735-2.69,2.644,2.644,0,0,0-2.1-.878m-1.088,2.6a1.454,1.454,0,0,1,.331-1.021,1.138,1.138,0,0,1,1.672-.02,1.526,1.526,0,0,1,.354,1.041Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M46.92,10a2.229,2.229,0,0,0-1.728-.831,2.321,2.321,0,0,0-1.8.789,3.326,3.326,0,0,0-.713,2.3,3.367,3.367,0,0,0,.732,2.309,2.27,2.27,0,0,0,1.759.827,2.215,2.215,0,0,0,1-.249,2.366,2.366,0,0,0,.861-.761v.876H48.5V7.04H46.92Zm-.376,3.689a1.159,1.159,0,0,1-.926.463,1.192,1.192,0,0,1-1.066-.617,2.731,2.731,0,0,1-.264-1.381,2.016,2.016,0,0,1,.379-1.332,1.184,1.184,0,0,1,.94-.446,1.172,1.172,0,0,1,.948.451,2.34,2.34,0,0,1,.371,1.479A2.14,2.14,0,0,1,46.544,13.692Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M57.4,9.173a2.231,2.231,0,0,0-1.728.83V7.041H54.1v8.225H55.56v-.875a2.41,2.41,0,0,0,.856.754,2.173,2.173,0,0,0,1.007.256,2.269,2.269,0,0,0,1.765-.825,3.448,3.448,0,0,0,.726-2.351A3.265,3.265,0,0,0,59.2,9.961,2.325,2.325,0,0,0,57.4,9.173Zm.53,4.536a1.116,1.116,0,0,1-.889.446,1.247,1.247,0,0,1-1.089-.628,2.54,2.54,0,0,1-.292-1.369,2.028,2.028,0,0,1,.376-1.339,1.191,1.191,0,0,1,.943-.44,1.173,1.173,0,0,1,.948.452A2.325,2.325,0,0,1,58.3,12.3a2.195,2.195,0,0,1-.368,1.406" fill="#000" fill-opacity="0.4">
                                      </path>
                                      <path d="M64,13.538,62.573,9.307H60.9l2.267,5.976a2.242,2.242,0,0,1-.4.822.99.99,0,0,1-.814.323,3.536,3.536,0,0,1-.667-.073l.14,1.234a4.151,4.151,0,0,0,.892.095,3.1,3.1,0,0,0,.805-.095,1.9,1.9,0,0,0,.6-.266,1.757,1.757,0,0,0,.432-.447,4.206,4.206,0,0,0,.395-.8l.376-1.038,2.1-5.735H65.389Z" fill="#000" fill-opacity="0.4">
                                      </path>
                                    </g>
                                  </svg>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="el_footer_company">
                        <div class="cont">
                          <ul class="el_footer_list d-flex list-unstyled mb-0">
                            <li>公司名稱: 密斯特喬有限公司</li>
                            <li>統一編號: 47098433</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="el_ft_mobile">
                      <div class="cont">
                        <ul class="el_footer_mobile d-grid list-unstyled mb-0 align-items-center" style="">
                          <li class="el_footer_left">
                            <div class="el_footer_inner d-flex flex-column">
                              <div class="el_logo_area">
                                <div class="el_logo_inner d-flex">
                                  <div class="el_logo_fans d-block">
                                    <iframe class="d-flex" src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/mrjoe.model&amp;tabs&amp;width=280&amp;height=130&amp;small_header=false&amp;adapt_container_width=false&amp;hide_cover=false&amp;show_facepile=false&amp;appId=1480453388896053" width="280" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="el_footer_right d-flex flex-column">
                            <div class="el_footer_inner d-flex flex-column">
                              <div class="el_link_area">
                                <div class="el_link_inner d-flex is_title">
                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_mobile1" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_mobile1" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/about" style="color: #ffffff;">
                                        關於
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/contact" style="color: #ffffff;">聯絡我們</a>
                                      </li>
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/blogs" style="color: #ffffff;">部落格</a>
                                      </li>
                                    </ul>
                                  </div>

                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_mobile2" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_mobile2" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/product/all" style="color: #ffffff;">
                                        全部商品
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/order/query" style="color: #ffffff;">訂單查詢</a>
                                      </li>
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#order" style="color: #ffffff;">訂單相關說明</a>
                                      </li>
                                    </ul>
                                  </div>

                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_mobile3" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_mobile3" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/faq#payment" style="color: #ffffff;">
                                        付款方式說明
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#shipping" style="color: #ffffff;">寄送方式說明</a>
                                      </li>
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#service" style="color: #ffffff;">售後服務說明</a>
                                      </li>
                                    </ul>
                                  </div>

                                  <div class="el_link_items d-grid mb-0">
                                    <input id="el_ft_link_mobile4" class="el_link_ipt d-none" type="checkbox">
                                    <label for="el_ft_link_mobile4" class="el_link_lab el_link_title mb-0" style="color: #ffffff;">
                                      <a href="https://store.mrjoe.com.tw/faq#members_redeem" style="color: #ffffff;">
                                        現金積點規則
                                      </a>
                                    </label>
                                    <ul class="el_link_list justify-content-center list-unstyled mb-0">
                                      <li>
                                        <a href="https://store.mrjoe.com.tw/faq#policy" style="color: #ffffff;">隱私權條款</a>
                                      </li>
                                    </ul>
                                  </div>

                                </div>
                              </div>
                              <div class="el_footer_block flex-wrap">
                                <div class="el_social_area">
                                  <ul class="social_list d-flex list-unstyled mb-0">
                                    <li>
                                      <a class="d-block" href="https://store.mrjoe.com.tw/">
                                        <svg data-name=" 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72" style="width: 30px;">
                                          <defs>
                                            <style>
                                              .cls-1 {
                                                fill: #2B3033;
                                              }

                                              .cls-2 {
                                                fill: #fff;
                                              }
                                            </style>
                                          </defs>
                                          <circle class="cls-1" cx="36" cy="36" r="36"></circle>
                                          <path class="cls-2" d="M41.62,33.6a3.3,3.3,0,0,1-3.25-2.36V18h4.45l2.06,6.44v5.9a3.27,3.27,0,0,1-3.26,3.26Z">
                                          </path>
                                          <path class="cls-2" d="M30.38,33.6a3.27,3.27,0,0,1-3.26-3.26v-5.9L29.18,18h4.45V30.34a3.26,3.26,0,0,1-3.25,3.26Z">
                                          </path>
                                          <path class="cls-2" d="M19.14,33.6a3.27,3.27,0,0,1-3.26-3.26V24.66L19.43,18h4.78l-1.82,5.7v6.64a3.26,3.26,0,0,1-3.25,3.26Z">
                                          </path>
                                          <path class="cls-2" d="M32.41,45.91h7.31V54H32.41Z">
                                          </path>
                                          <path class="cls-2" d="M44.45,54V43.54a2.37,2.37,0,0,0-2.36-2.37H30a2.37,2.37,0,0,0-2.37,2.37V54H21.94a1.64,1.64,0,0,1-1.64-1.65V38.24A8,8,0,0,0,24.76,36h0a8,8,0,0,0,11.18.06h0s.09.08.13.13a8.27,8.27,0,0,0,5.55,2.13h0A7.86,7.86,0,0,0,47.24,36h0a8,8,0,0,0,4.42,2.23h0v14.1A1.65,1.65,0,0,1,50.06,54H44.45Z">
                                          </path>
                                          <path class="cls-2" d="M52.86,33.6a3.26,3.26,0,0,1-3.25-3.26V23.7L47.79,18H52.6c1.68,3,3.07,5.61,3.52,6.53v5.81a3.27,3.27,0,0,1-3.26,3.26Z">
                                          </path>
                                        </svg>
                                      </a>
                                    </li>

                                    <li><a class="d-block" href="https://www.facebook.com/MRJOEHOBBY/" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_facebook.svg" width="30" height="30" alt=""></a></li>


                                    <li><a class="d-block" href="https://www.instagram.com/mr.joehobby/?hl=zh-tw" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_instagram.svg" width="30" height="30" alt=""></a></li>

                                    <li><a class="d-block" href="https://www.youtube.com/c/MRJOEHOBBYtv/" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_youtube.svg" width="30" height="30" alt=""></a></li>


                                    <li><a class="d-block" href="https://www.tiktok.com/@mrjoehobby" target="_blank"><img class="mw-100" src="MR.JOE%20HOBBY%20%E6%A8%A1%E5%9E%8B%E5%B0%88%E9%96%80%E5%BA%97_files/img_tiktok.svg" width="30" height="30" alt=""></a></li>



                                  </ul>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="el_footer_copyright">
                        <div class="cont">
                          <div class="el_copyright_area">
                            <div class="ed_copyright_waca">
                              <a class="copyright_inner d-flex align-items-center" href="https://www.waca.net/">
                                <svg xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" width="154.223" height="25" viewBox="0 0 154.223 25">
                                  <g>
                                    <path d="M81.344,16.033,84.707.283h-3.92l-4.216,19.4A4.6,4.6,0,0,0,81.344,16.033Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M72.437.283h0l2.782,13.029L77.957.283Z" fill="#000" fill-opacity="0.4">
                                    </path>
                                    <path d="M80.844,21.1A1.952,1.952,0,1,0,82.8,23.048,1.952,1.952,0,0,0,80.844,21.1" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M139.572,11.114Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M118.913,16.8h1.842l.911-2.019h2.8l.894,2.019h1.848l-4.149-8.909Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M150.075,7.887,145.927,16.8h1.842l.911-2.019h2.8l.894,2.019h1.847Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M91.637.283h-3.92L83.5,19.688a4.6,4.6,0,0,0,4.772-3.655Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M111.825,13.144,109.74,7.705l-1.981,5.467L106.022,8.51h-1.743l3.353,9.014,2.13-5.472,2.162,5.477,3.36-9.019H113.53Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M139.567,9.172a4.709,4.709,0,0,0-1.953-.794,4.79,4.79,0,0,0-.755-.061,4.484,4.484,0,0,0-1.667.32,4.1,4.1,0,0,0-1.958,1.578,4.293,4.293,0,0,0-.728,2.454,4.32,4.32,0,0,0,.723,2.46,4.01,4.01,0,0,0,2.8,1.793,5.561,5.561,0,0,0,.915.078,4.834,4.834,0,0,0,1.363-.194,3.87,3.87,0,0,0,1.186-.579l.093-.066V14.109q-.237.2-.454.386a4.328,4.328,0,0,1-.483.347,3.384,3.384,0,0,1-1.821.525,2.4,2.4,0,0,1-1.809-.75,2.7,2.7,0,0,1-.722-1.937,2.7,2.7,0,0,1,.739-1.974,2.572,2.572,0,0,1,1.925-.756,3.4,3.4,0,0,1,2.261.866l.354.3.1-1.87Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M89.588,21.1a1.952,1.952,0,1,0,1.952,1.952A1.952,1.952,0,0,0,89.588,21.1" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M93.454,3.663,90.035,19.688a4.6,4.6,0,0,0,4.773-3.655L97.695,2.471a.845.845,0,0,1,.726-.645l0,0h2.213L102.446.009h-4.22A4.6,4.6,0,0,0,93.454,3.663Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M3.327,9.173a2.132,2.132,0,0,0-1.083.28,2.191,2.191,0,0,0-.774.73V9.307H0v8.226H1.576v-3a3.016,3.016,0,0,0,.845.673,2,2,0,0,0,.895.2,2.271,2.271,0,0,0,1.767-.828,3.394,3.394,0,0,0,.729-2.32,3.3,3.3,0,0,0-.723-2.267A2.274,2.274,0,0,0,3.327,9.173Zm.516,4.536a1.138,1.138,0,0,1-.915.44,1.216,1.216,0,0,1-.97-.479,2.294,2.294,0,0,1-.4-1.484,1.99,1.99,0,0,1,.382-1.322,1.21,1.21,0,0,1,.959-.446,1.164,1.164,0,0,1,.932.455,2.157,2.157,0,0,1,.376,1.391,2.271,2.271,0,0,1-.365,1.445" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M10.228,9.173a3.257,3.257,0,0,0-1.585.387,2.663,2.663,0,0,0-1.1,1.122A3.228,3.228,0,0,0,7.159,12.2a3.617,3.617,0,0,0,.387,1.742,2.54,2.54,0,0,0,1.131,1.086,3.454,3.454,0,0,0,1.562.37,2.949,2.949,0,0,0,2.2-.889,3.07,3.07,0,0,0,.873-2.242,3.035,3.035,0,0,0-.865-2.219,2.975,2.975,0,0,0-2.216-.878m1.041,4.472a1.376,1.376,0,0,1-2.073,0,1.972,1.972,0,0,1-.421-1.358A1.974,1.974,0,0,1,9.2,10.929a1.376,1.376,0,0,1,2.073,0,1.965,1.965,0,0,1,.418,1.347,2,2,0,0,1-.418,1.369" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M20.417,13.213l-.993-3.9H17.9l-1.026,3.9-1.117-3.9H14.228l1.886,5.959h1.531l1.01-3.833,1.027,3.833H21.2L23.11,9.308H21.556Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M26.673,9.173a2.552,2.552,0,0,0-1.959.838,3.293,3.293,0,0,0-.774,2.32,3.41,3.41,0,0,0,.589,2.054,2.667,2.667,0,0,0,2.3,1.016,2.811,2.811,0,0,0,1.635-.452,2.577,2.577,0,0,0,.957-1.316l-1.571-.264a1.238,1.238,0,0,1-.382.651.963.963,0,0,1-.623.2,1.192,1.192,0,0,1-.908-.39,1.589,1.589,0,0,1-.382-1.091h3.95a3.888,3.888,0,0,0-.735-2.69,2.644,2.644,0,0,0-2.1-.878m-1.089,2.6a1.454,1.454,0,0,1,.331-1.021,1.138,1.138,0,0,1,1.672-.02,1.526,1.526,0,0,1,.354,1.041Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M33.324,9.364a2.54,2.54,0,0,0-.677.791V9.308H31.183v5.959h1.576V13.426a9.425,9.425,0,0,1,.132-2,1.24,1.24,0,0,1,.362-.659.872.872,0,0,1,.561-.183,1.389,1.389,0,0,1,.742.258l.487-1.374a2,2,0,0,0-1.037-.3A1.24,1.24,0,0,0,33.324,9.364Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M38.454,9.173a2.55,2.55,0,0,0-1.958.838,3.293,3.293,0,0,0-.774,2.32,3.41,3.41,0,0,0,.589,2.054,2.667,2.667,0,0,0,2.3,1.016,2.811,2.811,0,0,0,1.635-.452,2.577,2.577,0,0,0,.957-1.316l-1.571-.264a1.238,1.238,0,0,1-.382.651.963.963,0,0,1-.623.2,1.2,1.2,0,0,1-.909-.39,1.593,1.593,0,0,1-.381-1.091h3.95a3.888,3.888,0,0,0-.735-2.69,2.644,2.644,0,0,0-2.1-.878m-1.088,2.6a1.454,1.454,0,0,1,.331-1.021,1.138,1.138,0,0,1,1.672-.02,1.526,1.526,0,0,1,.354,1.041Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M46.92,10a2.229,2.229,0,0,0-1.728-.831,2.321,2.321,0,0,0-1.8.789,3.326,3.326,0,0,0-.713,2.3,3.367,3.367,0,0,0,.732,2.309,2.27,2.27,0,0,0,1.759.827,2.215,2.215,0,0,0,1-.249,2.366,2.366,0,0,0,.861-.761v.876H48.5V7.04H46.92Zm-.376,3.689a1.159,1.159,0,0,1-.926.463,1.192,1.192,0,0,1-1.066-.617,2.731,2.731,0,0,1-.264-1.381,2.016,2.016,0,0,1,.379-1.332,1.184,1.184,0,0,1,.94-.446,1.172,1.172,0,0,1,.948.451,2.34,2.34,0,0,1,.371,1.479A2.14,2.14,0,0,1,46.544,13.692Z" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M57.4,9.173a2.231,2.231,0,0,0-1.728.83V7.041H54.1v8.225H55.56v-.875a2.41,2.41,0,0,0,.856.754,2.173,2.173,0,0,0,1.007.256,2.269,2.269,0,0,0,1.765-.825,3.448,3.448,0,0,0,.726-2.351A3.265,3.265,0,0,0,59.2,9.961,2.325,2.325,0,0,0,57.4,9.173Zm.53,4.536a1.116,1.116,0,0,1-.889.446,1.247,1.247,0,0,1-1.089-.628,2.54,2.54,0,0,1-.292-1.369,2.028,2.028,0,0,1,.376-1.339,1.191,1.191,0,0,1,.943-.44,1.173,1.173,0,0,1,.948.452A2.325,2.325,0,0,1,58.3,12.3a2.195,2.195,0,0,1-.368,1.406" fill="#000" fill-opacity="0.4"></path>
                                    <path d="M64,13.538,62.573,9.307H60.9l2.267,5.976a2.242,2.242,0,0,1-.4.822.99.99,0,0,1-.814.323,3.536,3.536,0,0,1-.667-.073l.14,1.234a4.151,4.151,0,0,0,.892.095,3.1,3.1,0,0,0,.805-.095,1.9,1.9,0,0,0,.6-.266,1.757,1.757,0,0,0,.432-.447,4.206,4.206,0,0,0,.395-.8l.376-1.038,2.1-5.735H65.389Z" fill="#000" fill-opacity="0.4"></path>
                                  </g>
                                </svg>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="el_footer_company">
                        <div class="cont">
                          <ul class="el_footer_list d-flex list-unstyled mb-0">
                            <li>公司名稱: 密斯特喬有限公司</li>
                            <li>統一編號: 47098433</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <section id="scontent"></section>
  <section id="footer"></section>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>