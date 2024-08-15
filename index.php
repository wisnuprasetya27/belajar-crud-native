<?php
include 'config/database.php';

#==cek_session
if(empty($_SESSION['login_app'])){
	header('Location: login.php');
	die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="template/dist/img/AdminLTELogo.png" type="image/x-icon"/>
  <title>Belajar CURD Native</title>

  <?php include 'layouts/css.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="template/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

	<?php
	#==load
	include 'layouts/navbar.php'; 
	include 'layouts/sidebar.php';

	if(!empty($_GET['page']))
	{
		$page = base64_decode($_GET['page']).'.php';
		if(file_exists($page)){
			$content = $page;
		}
		else{
			$content = 'page_404.php';
		}
	}
	else{
		$content = 'dashboard.php';
	}

	
	#==load
	echo '<div class="content-wrapper">';
		if(!empty($_SESSION['alert'])){
			echo '<div id="alert-notifikasi" class="alert alert-'.$_SESSION['alert']['status'].' m-3">'.$_SESSION['alert']['pesan'].'</div>';
			echo '<script>
				setTimeout(function() { 
					$("#alert-notifikasi").hide(500);
				}, 3000);
			</script>';
		}
		unset($_SESSION['alert']);
		
		include $content;
	echo '</div>';

	include 'layouts/footer.php'; 
	?>

	<!-- untuk menampung modal -->
	<div id="div_modal"></div>
</div>
<!-- ./wrapper -->

<?php include 'layouts/js.php'; ?>
</body>
</html>
