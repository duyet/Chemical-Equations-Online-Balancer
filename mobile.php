<?php 
require('./cgi-bin/functions.php');
if (is_mobile() OR $_GET['m'] == true) {
	load_mobile();
	die();
}

function load_mobile() {
?>
<!DOCTYPE html>
<html lang="vi"><!-- HTML5 Compine -->
<head><!-- Author: Levanduyet at duyet2000@gmail.com -->
	<title>Cân bằng phương trình Hóa Học Online v2.0 &middot; Lemon9x System</title>
	<link href="./files/css/bootstrap.css" rel="stylesheet">
	<link href="./files/css/bootstrap-responsive.css" rel="stylesheet">
	<meta charset="utf-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="Cân bằng phương trình hóa học, Hóa học Online, Cân bằng đại số, phương pháp đại số, hóa học, hóa hữu cơ, hóa vô cơ, cân bằng, cân bằng auto">
	<meta name="keywords" content="can bang phuong trinh hoa hoc online, can bang, hoa hoc, phuong trinh hoa hoc, hoa huu co, hoa vo co, can bang online"> 
	<meta name="language" content="vietnamese">
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
	<style>
	.red {color:red;}
	.header {text-align:center; padding:10px;background:#e6e6e6;font-weight:700; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}
	.main {padding:0;margin:0;}
	</style>
</head>
<body>
	<div class="container">
				<div class="header ">
					Cân bằng hóa học
				</div>
				
			<noscript>
				<div class="red" id="no-script" style="text-align:center;margin:5px; font-size:2em; line-height:2em; padding: 25px;">
					Không hỗ trợ!
					<style>#body{display:none;}</style>
				</div>
			</noscript>
			
			<div id="body">
				<div class="row" style="margin-top: 15px;">
					<?php if ($_GET['p'] == 'hd') { ?>
					<div class="span12 center"><ul class="pager"><li class="previous"><a href="./index.php">&larr; Cân bằng</a></li></ul></div>
						<div class="span12"><pre><p>Các phương trình có một số quy ước chung khi nhập phương trình:
  • Các chỉ số được viết ngay bên cạnh kí hiệu hóa học ( CO2, H2O, ... )
  • Các hợp chất hữu cơ nên viết ở dạng công thức phân phân tử ( CH3COOH, C2H2, C6H6, ... )
  • Các kí tự có thể viết rời nhau ( C O 2, H 2 O, ... )
  • Toàn bộ kí hiệu sử dụng là ngoặc đơn ( [Ag(CH<sub>3</sub>)<sub>2</sub>]OH  viết thành (Ag(CH3)2)OH )
  • Mũi tên được thay thế bằng dấu "=" 
  • Số ion được viết sau dấu "^" ( H^+ ) 
  • Lưu ý các kí hiệu hóa học phân biệt HOA và thường</p></pre></div>
					<?php } elseif ($_GET['p'] == 'ver') { ?>
					
					<div class="span12 center"><ul class="pager"><li class="previous"><a href="./index.php">&larr; Cân bằng</a></li></ul></div>
					<div class="span12"><pre>Cân bằng phương trình hóa học Online
Last update: 30/3/2013
Version: 2.0.3 r324					</pre></div>
					
					<?php } else { ?>
					<div class="span12">
						<form action="" method="post" onsubmit="Canbang();$('clear').fadeIn(300); return false;">
							<center>
								<div style="" class="span7" >
									<div class="span4">
										<input type="text" class="" id="input" maxlength="" />
									</div>
									<div class="span1">
										<input type="submit" class="btn btn-success" onclick="$('clear').fadeIn(300);" value="Cân bằng" />
									</div>
								</div>
							</center>


							<div class="result span7" style="">
								<div class="span1" style="width:40px;">
									<h4 style="">Result:</h4>
								</div>
								<div class="span4" style="text-align:left;">
									<span id="kq_canbang"></span>
									<span id="kq_codeOutput"></span>
									<span id="kq_message" style="color:red;"></span>
								</div>
							</div>
							
						</form>
					</div>
					<?php } ?>
				</div>
			</div>

				<hr />
				<div class="row span7" style="text-align:left; font-size: 0.7em;">
					<a href="http://www.lemon9x.com/" target="_blank">Home</a> &middot;   
					<a href="./?p=hd">Quy tắc</a> &middot;   
					<a href="./?p=ver">About</a> &middot;   
					(c) ChibiSan
				</div>
		</div>
</body>
<script src="./files/js/jquery.js"></script>
<script src="./files/js/yplitgroup.pthh.js"></script>
<script src="./files/js/bootstrap.js"></script>
</html>
<?php
}
?>