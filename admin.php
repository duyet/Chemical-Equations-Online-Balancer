<?php
define( 'DIR', pathinfo( str_replace( DIRECTORY_SEPARATOR, '/', __file__ ), PATHINFO_DIRNAME ) . '/' );
session_start();
if ($_POST['p'] AND $_SESSION['IS_ADMIN']==FALSE) {
	$fp = fopen(DIR . '/system/password.txt', 'r');
	$password = fread($fp, filesize(DIR . '/system/password.txt'));
	fclose($fp);
	
	if (md5(md5($_POST['p'])) == $password) {
		$_SESSION['IS_ADMIN'] = TRUE;
		@header('Location: ./admin.php');
	} else {
		$error = 'Sai mật khẩu!';
	}
}

if (isset($_GET['out'])) {
	$_SESSION['IS_ADMIN'] = FALSE;
	@header('Location: ./admin.php');
}

if ($_SESSION['IS_ADMIN'] == FALSE) define('IS_LOGIN', false);
else define('IS_LOGIN', true);

//if (IS_LOGIN) die('logined'); else die('not login');

if (IS_LOGIN) { // Panel
	switch($_GET['m']) {
		case 'changepassword': {
			$show_form = true;
			if ($_POST['p']) {
				if (strlen($_POST['p']) <4) {
					$error = 'Password is short!';
				} else {
					$password = md5(md5($_POST['p']));
					$fp = fopen(DIR . '/system/password.txt', 'w');
					fwrite($fp, $password);
					fclose($fp);
					_show('Thay đổi mật khẩu thành công!');
					$show_form = false;
				}
			} 
			if ($show_form) {
				_change_password_form($error);
			}
		} break;

		case 'settings': {
			$settings = unserialize(file_get_contents(DIR . '/system/settings.txt'));
			//$settings = array('version'=>'v2.0.2','analytics'=>'UA-xxxxx');
			//file_put_contents(DIR . '/system/settings.txt', serialize($settings));
			
			if ($_POST) {
				$_settings['version'] = $_POST['version'] ? $_POST['version'] : ($settings['version'] ? $settings['version'] : '');
				$_settings['analytics'] = $_POST['analytics'] ? $_POST['analytics'] : ($settings['analytics'] ? $settings['analytics'] : '');
			
				if (file_put_contents(DIR . '/system/settings.txt', serialize($_settings))) {
					$text = 'Save setting thành công!!';
				} else {
					$error = 'Lỗi!!';
				}

				$settings = $_settings;
			}
			
			_setting_form($settings, $error, $text);
				
		} break;
			
		default: {
			$dir = opendir(DIR . 'logs/');
			$logs = array();
			while ($file = readdir($dir)) {
				if ($file == '.' OR $file == '..' OR $file == 'index.html') continue;
				$logs[] = $file;
			}
			closedir($dir);
			_header();
			echo '<div class="span4"></div>';
			echo '<pre class="span4">';
			foreach($logs as $f) {
				echo '<a href="./logs/'. $f .'">' . $f . '</a><br />';
			}
			echo '</pre>';
			_footer();
		}
	}
} else { // Form Login
	_login_form($error);
}
?>

<?php 
function _header() {
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>AdminCp &middot; Lemon9x System</title>
	<link href="./files/css/style.css" rel="stylesheet">
	<link href="./files/css/main.css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="description" content="Bảng tuần hoàn các nguyên tố hóa học, cân bằng phương trình hóa học">
	<meta name="keywords" content="can bang phuong trinh hoa hoc online, can bang, hoa hoc, phuong trinh hoa hoc, hoa huu co, hoa vo co, can bang online"> 
	<meta http-equiv="content-language" content="vi">
	<meta name="language" content="vietnamese">
	<meta name="author" content="Lê Văn Duyệt">
	<meta name="version" content="1.0.1">
	<meta name="homepage" content="http://www.lemon9x.com">
	<meta name="copyright" content="Lemon9x.Com [duyet2000@gmail.com]">
	<link rel="shortcut icon" href="http://www.lemon9x.com/home/ico/favicon.ico">
	<script>$('#no-script').hide();</script>
	<script type="text/javascript">
		// Config
		var is_query = true;
		var yplitgroup_project_key = '5521246521';
		var yplitgroup_project_name = 'pthh';
		var yplitgroup_project_store_url = '/storeage/54512135412415';
		var version = '2.0.1 r54';
		var author = 'Lê văn Duyệt';
		var author_fb = 'https://facebook.com/yplitgroup';
		var conver = '';
		var showlog = false;
		var config_save_path = 'cgi-bin' + '/query' + '.' + 'php';
	</script>
</head>
<body id="top">
	<section id="content">
		<div id="breadcrumb">
			<div class="container">
				<div class="row">
					<div class="span9">
						<ul class="breadcrumb">
							<li>
								<a href="http://lemon9x.com/home/sitemap.html?utm_source=pthh" alt="Home">Trang chủ</a> &middot; 
							</li>
							<li>
								<a href="http://lemon9x.com/pthh/index.html?utm_source=pthh" alt="Cân bằng hóa học">Cân bằng hóa học</a> &middot; 
							</li>
							<li>
								<a href="http://lemon9x.com/pthh/bang-tuan-hoan.html?utm_source=pthh" alt="Bản tuần hoàn">Bản tuần hoàn</a> &middot; 
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
					admin.php
				</h1>
			</div>
			
			<?php if (IS_LOGIN) { ?>
				<div class="row">
				<ul class="breadcrumb nav-tabs navbar ">
					<li class=""><a href="admin.php?m=logs" title="">Logs</a></li>
					<li><a href="admin.php?m=changepassword" title="">Change password</a></li>
					<li><a href="admin.php?m=settings" title="">Settings</a></li>
					<li><a href="admin.php?out" title="">Logout</a></li>
				</ul>
				</div>
			<?php } ?>
			<div class="row">
<?php
}
?>

<?php function _footer() {
?>
	</div>
	<hr />

			<footer id="">
				<div class="container">
					<div class="row" style="text-align:center">
					
					</div>
					<div class="row span10" style="text-align:left">
						admin.php v1.0 ·  
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
			<script src="./files/js/jquery.cookie.js"></script>
			<script src="./files/js/jquery.quicksand.js"></script>
			<script src="./files/js/jquery.touchwipe.min.js"></script>
			<script src="./files/js/main.js"></script>
		</div>
	</section>
</body>
</html>

<?php 
}
?>

<?php 
function _show($text) {
	_header();
	echo $text;
	_footer();
}

function _change_password_form($error = '') {
	_header();
	?>
					<form action="" method="POST">
						<?php if (!empty($error)) { ?>
							<span class="red center"><?= $error ?></span><hr />
						<?php } ?>
						<center>
							Nhập mật khẩu mới: <input name="p" type="password" class="span4" style="width:450px;text-shadow:0px 1px 2px #999;color:#2d2d2d;font-weight:700;font-size:1.2em;text-align:center">
							<br />
							<input type="submit" class="btn btn-viva btn-large submit" value="Change" style="width:200px"/>
						</center>
					</form>						

	<?php 
	_footer();
}

function _login_form($error = '') {
	_header();
	?>
			<form action="admin.php" method="POST">
				<?php if (!empty($error)) { ?>
					<span class="red center"><?= $error ?></span><hr />
				<?php } ?>
				<center>
					<input name="p" type="password" class="span4" style="width:450px;text-shadow:0px 1px 2px #999;color:#2d2d2d;font-weight:700;font-size:1.2em;text-align:center">
					<br />
					<input type="submit" class="btn btn-viva btn-large submit" value="Login" style="width:200px"/>
				</center>
			</form>

	<?php
	_footer();
}

function _setting_form($settings = array(), $error = '', $text = '') {
	_header();
	?>
		<form action="" method="POST">
			<?php if (!empty($error)) { ?>
				<span class="red center control-group warning "><?= $error ?></span><hr />
			<?php } ?>
			<?php if(!empty($text)) { ?>
				<div class="span8 center control-group success"><label><?= $text ?></label></div>
			<?php } ?>
			<div class="span10">
				<div class="span4 right" style="float:left">
					Google Analytics Code 
				</div>
				<div class="span5 left">
					<input name="analytics" type="text" value="<?= $settings['analytics'] ?>" class="input span4" style="width:450px;text-shadow:0px 1px 2px #999;color:#2d2d2d;font-weight:700;font-size:1.2em;text-align:center">
				</div>
				<hr />
			</div>
			
			<div class="span10">
				<div class="span4 right"  style="float:left">
					Project version 
				</div>
				<div class="span5 left">
					<input name="version" type="text"  value="<?= $settings['version'] ?>" class="input span4" style="width:450px;text-shadow:0px 1px 2px #999;color:#2d2d2d;font-weight:700;font-size:1.2em;text-align:center">
				</div>
				<hr />
			</div>
			
			<div class="span12 center">
				<input type="submit" class="btn btn-viva btn-large submit" value="Save" style="width:200px"/>
			</div>

		</form>
	<?php 
	_footer();
}