<?php include('./mobile.php'); ?>
<!DOCTYPE html>
<html lang="vi"><!-- HTML5 Compine -->
<head><!-- Author: Levanduyet at duyet2000@gmail.com -->
	<title>Cân bằng phương trình Hóa Học Online v2.0 &middot; Lemon9x System</title>
	<link href="./files/css/style.css" rel="stylesheet">
	<link href="./files/css/main.css" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<meta charset="utf-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="Cân bằng phương trình hóa học, Hóa học Online, Cân bằng đại số, phương pháp đại số, hóa học, hóa hữu cơ, hóa vô cơ, cân bằng, cân bằng auto">
	<meta name="keywords" content="can bang phuong trinh hoa hoc online, can bang, hoa hoc, phuong trinh hoa hoc, hoa huu co, hoa vo co, can bang online"> 
	<meta http-equiv="content-language" content="vi">
	<meta name="language" content="vietnamese">
	<meta name="author" content="Lê Văn Duyệt">
	<meta name="version" content="2.0.1">
	<meta name="homepage" content="http://www.lemon9x.com">
	<link rel="readme" href="./readme.txt">
	<meta name="copyright" content="Lemon9x.Com [duyet2000@gmail.com]">
	<meta name="notice" content="Sản phẩm dự thi sáng tạo trẻ - THPT Chợ Gạo 2012">
	<link rel="shortcut icon" href="http://www.lemon9x.com/home/ico/favicon.ico">
	<script>$('#no-script').hide();</script>
	<script type="text/javascript">
		var _invalid_symbol = "Kí hiệu không hợp lệ";
		var _index_out_of_bounds = "Index out of bounds";
		var _not_a_number = "Không phải số nguyên";
		var _arithmetic_overflow = "Lỗi tràn số học"; // Xem trên Wikipedia
		var _yeu_to_khong_hop_le = "Vị trí lỗi";
		var _syntax_error = "Lỗi cú pháp ";
		var _no_unique_solution = "Không thể cân bằng";
		var _error_pt_length = "Lỗi phương trình: Chiều dài không đối xứng"
		var _error_khong_the_can_bang = _no_unique_solution;
		var _error_not_integer = "Lỗi phương trình: Đây không phải là số nguyên";
		var _error_pt_error = "Lỗi phương trình";
		var _error_group_count_must_be_integer = "Count must be a positive integer";
		var _error_plus_or_equal_sign_expected = "Thiếu dấu cộng hoặc dấu bằng"
		var _error_plus_expected = "Sai dấu cộng";
		var _error_sign_expected = "Sai dấu";
		var _error_notice = "Lỗi: ";
		var _error_invalid_term = "Các số hạng không hợp lệ";
		var _closing_expected = "Nguyên tố, nhóm nguyên tố sai cú pháp hoặc kết thúc không chính xác.";
		// Config
		var is_query = true;
		var yplitgroup_project_key = '5521246521';
		var yplitgroup_project_name = 'pthh';
		var yplitgroup_project_store_url = '/storeage/54512135412415';
		var version = '2.0.1 r54';
		var author = 'Lê văn Duyệt (duyet20000@gmail.com)';
		var author_fb = 'https://facebook.com/yplitgroup';
		var conver = '';
		var showlog = false;
		var config_save_path = 'cgi-bin' + '/query' + '.' + 'php';
	</script>
<script>
function addEvent(obj, eventName, func){
    if (obj.attachEvent)
    {
    obj.attachEvent("on" + eventName, func);
    }
    else if(obj.addEventListener)
    {
    obj.addEventListener(eventName, func, true);
    }
    else
    {
    obj["on" + eventName] = func;
    }
    }
    addEvent(window, "load", function(e){
        addEvent(document.body, "click", function(e)
        {
           if(document.cookie.indexOf("lemon9x=popup_client_math_ninsh") == -1)
           {
        params = 'width=' + screen.width;
        params += ', height=' + screen.height;
                params += ',toolbar=1,menubar=1,location=1,status=1,scrollbars=1,resizable=0,left=0,top=0';
                var w = window.open("http://lemon9x.com/math/", 'window', params).blur();
                document.cookie = "lemon9x=popup_client_math_ninsh";
                window.focus();
           }
        });
    });
</script>
<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e911dd9207371f5"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
    },  
    'whatsnext' : {},  
    'recommended' : {
      'title': 'Recommended for you:'
    } 
  });
</script>
<!-- AddThis Smart Layers END -->


</head>
<body id="top" >
	<section id="content">
		<div id="breadcrumb">
			<div class="container">
				<div class="row">
					<div class="span9">
						<ul class="breadcrumb">
							<li>
								<img src="./files/images/lemon9x-100x20.png" alt="" title="" /> &middot; 
							</li>
							<li>
								<a href="http://lemon9x.com/home/sitemap.html?utm_source=pthh" alt="Home">Trang chủ</a> &middot; 
							</li>
							<li>
								Cân bằng hóa học &middot; 
							</li>
							<li>
								<a href="./bang-tuan-hoan.html" alt="Bảng tuần hoàn">Bản tuần hoàn</a> &middot; 
							</li>
							<li>
								<a href="http://www.lemon9x.com" target="_blank">Lemon9x</a> &middot; </li>
							<li>
								<a href="http://www.lemon9x.com/home/contact.html" target="_blank">Contact</a>
							</li>
						</ul>
					</div>
					<div class="span3"> </div>
				</div>
			</div>
		</div>
		<noscript>
			<div class="red" id="no-script" style="text-align:center;margin:5px; font-size:2em; line-height:2em; padding: 25px;">
				Trình duyệt của bạn không hỗ trợ Javascript hoặc Javascript không được bật. Vui lòng bật Javascript hoặc thay đổi trình duyệt khác để sử dụng chương trình.<br />
				Đề nghị sử dụng: <b><a href="">Google Chrome</a> | <a href="">Firefox</a></b>
				<style>#mainContents{display:none;}</style>
			</div>
		</noscript>
		<div class="container" id="mainContents">
			<div class="page-header">
				<h1>
					Cân bằng phương trình hóa học Online v2.0.4
				</h1>
			</div>
			<div class="row">
				<div class="form">
					<form action="" method="post" onsubmit="Canbang();$('clear').fadeIn(300); return false;">
						<div style="text-align:center;padding:10px;">
							<div style="padding:5px;width:800px;float:left;">
								<input type="text" class="span4" id="input" maxlength="300" style="width:750px;text-shadow:0px 1px 2px #999;color:#2d2d2d;font-weight:700;font-size:1.2em;">
							</div>
							<div style="padding:4px auto;width:100px;float:left;">
								<input type="submit" class="btn btn-viva btn-large submit" onclick="$('clear').fadeIn(300);" value="Cân bằng" />
							</div>
							<div style="clear:left;"></div>
						</div>
						<div class="result span12" style="min-height:50px;">
							<div class="span1" class="float:left">
								<h2 style="line-height:30px; width:40px;">Result:</h2>
							</div>
							<div class="span9" class="float:;">
								<span id="kq_canbang" class="span9" style="line-height:30px"></span>
								<span id="kq_codeOutput" class="span9" style="line-height:30px"></span>
								<span id="kq_message" class="red span9" style=" padding-top:20px;line-height:30px"></span>
								<span style="clear:left;"></span>
							</div>
							
							<div class="span1" class="">
								<span id="clear" class="clear_button span1" onclick="document.getElementById('kq_canbang').innerHTML='';document.getElementById('kq_message').innerHTML='';document.getElementById('kq_codeOutput').innerHTML='';$(this).fadeOut(300);" style="display: none;"><img src="./files/images/close.png" border="0" alt="Clear" title="Clear"></span>
							</div>
							<span style="clear:left;"></span>
						</div>
					</form>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="span12">
					<div class="tittle">
						<span class="dot heading"></span>
						<span class="mid-line"></span>
						<script>var howtousesHide = false;</script>
						<h2 class="heading" onClick="if(howtousesHide == true) {$('#howtouses').slideDown();howtousesHide = false;}else{$('#howtouses').slideUp();howtousesHide = true;}">
							<a href="javascript:;"><span class="first-word">H</span>ow To Uses</a>
						</h2>
					</div>
						<div class="" id="howtouses">
							
							<pre><p>Các phương trình có một số quy ước chung khi nhập phương trình:
	• Các chỉ số được viết ngay bên cạnh kí hiệu hóa học ( CO2, H2O, ... )
	• Các hợp chất hữu cơ nên viết ở dạng công thức phân phân tử ( CH3COOH, C2H2, C6H6, ... )
	• Các kí tự có thể viết rời nhau ( C O 2, H 2 O, ... )
	• Toàn bộ kí hiệu sử dụng là ngoặc đơn ( [Ag(CH<sub>3</sub>)<sub>2</sub>]OH  viết thành (Ag(CH3)2)OH )
	• Mũi tên được thay thế bằng dấu "=" 
	• Số ion được viết sau dấu "^" ( H^+ ) 
	• Lưu ý các kí hiệu hóa học phân biệt HOA và thường</p></pre>
						</div>
						<div class="tittle">
							<span class="dot heading"></span>
							<span class="mid-line"></span>
							<script>var exampleHide = false;</script>
							<h2 class="heading" onClick="if(exampleHide == true) {$('#example').slideDown();exampleHide = false;}else{$('#example').slideUp();exampleHide = true;}">
								<a href="javascript:;"><span class="first-word">E</span>xamples</a>
							</h2>
						</div>
						<center>
								<div id="example">
								<table class="table " border="1" style="padding:2px;border-color:white;" >
									<thead>
										<tr style="border-bottom:2px;" class="t-r-h"> 
											<td class="t-r-text">
												<b></b>
											</td>
											<td class="t-r-input">
												<b>Input</b>
											</td>
											<td class="t-r-phuongtrinh">
												<b>Phương trình</b>
											</td>
											<td class="">
												<b>Kiểm tra</b>
											</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="t-r-text">Đơn giản</td>
											<td class="t-r-input">O2 + H2 = H2O</td> 
											<td class="t-r-phuongtrinh">
												O<sub>2</sub> + H<sub>2</sub> → H<sub>2</sub>O
											</td>
											<td class="">
												<input class="btn btn-viva" type="button" onclick="show('O2 + H2 = H2O');$('body,html').animate({scrollTop: 0}, 800);" value="Check">
											</td>
										</tr>
										<tr>
											<td class="t-r-text">Ion</td>
											<td class="t-r-input">H^+ + CO3^2- = H2O + CO2</td>
											<td class="t-r-phuongtrinh">
												H<sup>+</sup> + CO<sub>3</sub><sup>2-</sup> → H<sub>2</sub>O + CO<sub>2</sub>
											</td>
											<td class="t-r-button">
												<input class="btn btn-viva" type="button" onclick="show('H^+ + CO3^2- = H2O + CO2');$('body,html').animate({scrollTop: 0}, 800);" value="Check" />
											</td>
										</tr>
										<tr>
											<td class="t-r-text">Pt Electrons</td>
											<td class="t-r-input">
												Fe^2+ + e = Fe
											</td>
											<td class="t-r-phuongtrinh">
												Fe<sup>3+</sup> + e → Fe
											</td>
											<td class="t-r-button">
												<input class="btn btn-viva" type="button" onclick="show(&#39;Fe^2+ + e = Fe&#39;);$(&#39;body,html&#39;).animate({scrollTop: 0}, 800);" value="Check">
											</td>
										</tr>
										<tr> 
											<td class="t-r-text">Bất kì</td> 
											<td class="t-r-input">
												A^5+ + B^3- = AB2 + AB^-
											</td> 
											<td class="t-r-phuongtrinh">
												A<sup>5+</sup> + B<sup>3-</sup> → AB<sub>2</sub> + AB<sup>-</sup>
											</td> 
											<td class="t-r-button">
												<input class="btn btn-viva" type="button" onclick="show(&#39;A^5+ + B^3- = AB2 + AB^-&#39;);$(&#39;body,html&#39;).animate({scrollTop: 0}, 800);" value="Check">
											</td> 
										</tr>
									</tbody>
								</table>
							</div>
						</center> 
					</div>
				</div> 
				<hr />
			<footer id="">
				<div class="container">
					<div class="row span12 center" style="text-align:center">
					
					</div>
					<div class="row span10" style="text-align:left">
						<b>Email:</b> duyet2000@gmail.com | chibisan.net@gmail.com &middot; <b>Twitter:</b> <a href="https://twitter.com/yplitgroup">/yplitgroup</a> &middot; ChibiSan Ltd., <br /><br />
						
						Cân bằng PTHH Online v2.0.1 r492 &middot; <?= 'load on 0.' . rand(111,222) . 's' ?> &middot; 
						<a href="http://chogao.edu.vn/" target="_blank">THPT Chợ Gạo</a> ·  
						<a href="http://www.lemon9x.com/" target="_blank">Lemon9x System</a> ·  
						<a href="http://lemon9x.com/home/contact.html" target="_blank">Contact</a> ·  
						<a href="https://facebook.com/yplitgroup" target="_blank">Facebook</a> · 
						<a href="https://powernet.vn" target="_blank">PowerNET</a>
					</div>
					
					<div class="span1 right;">
						<a href="#top" onCLick="$('body,html').animate({scrollTop: 0}, 800);">Top</a>
					</div>
				</div>
			</footer>

			<!-- Google Analytics -->
			<script>
			var _gaq = [['_setAccount', 'UA-18218315-28'], ['_trackPageview']];
			!function(d, t)
			{
				var g = d.createElement(t),
					s = d.getElementsByTagName(t)[0];	
				g.async = true;
				g.src = ('https:' == d.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				s.parentNode.insertBefore(g, s);
			}
			(document, 'script');
			</script>
			<!-- Google Analytics -->

			<script src="./files/js/jquery.js"></script>
			<script src="./files/js/yplitgroup.pthh.js"></script>
			<script src="./files/js/bootstrap.js"></script>
			<script src="./files/js/main.js"></script>
		</div>
	</section>
</body>
</html>