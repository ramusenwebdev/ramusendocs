 <?php
require_once('function.php');

 ob_start();
 
// Connection Variable
$servername = "localhost";
$username = "ramusenc_root";
$password = "#hbSqB5Z6J48PmXYZC";
$dbname = "ramusenc_ramufin";

// Input Variable
$applicant_name = $_POST['applicant_name'];
$mobile_number = $_POST['mobile_number'];
$email = $_POST['email'];
$company_name = $_POST['company_name'];
$company_address = $_POST['company_address'];
$job = $_POST['job'];
$earnings_per_month = $_POST['earnings_per_month'];
$cc = $_POST['cc'];
$declaration = $_POST['declaration'];
$lastupd_user = 'RAMU.USER';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//$sql = "INSERT INTO `rf_cc` (`applicant_name`, `mobile_number`, `email`, `company_name`, `company_address`, `job`, `earnings_per_month`, `cc`, `created_dttm`, `lastupd_user`, `lastupd_dttm`) VALUES ('cuy', '0812313', 'PT Angin Ribut', 'Jalan Sudirman', 'CEO', '30000000', 'BRI, BNI', CURRENT_TIMESTAMP, 'RAMU.USER', CURRENT_TIMESTAMP)";

$sql = "INSERT INTO `rf_cc` (`applicant_name`, `mobile_number`, `email`, `company_name`, `company_address`, `job`, `earnings_per_month`, `cc`, `declaration`,`created_dttm`, `lastupd_user`, `lastupd_dttm`) VALUES ('" .$applicant_name. "', '" .$mobile_number. "', '" .$email. "', '".$company_name. "', '" .$company_address. "', '" .$job. "', '" .$earnings_per_month. "', '" .$cc. "', '" .$declaration. "', CURRENT_TIMESTAMP, 'RAMU.USER', CURRENT_TIMESTAMP)";

?>



<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RAMUSEN - PT. Ranajaya Mulia Sentosa</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mamba - v2.0.1
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
		<script>
		function validateKTA() {
  			var codeKTA = document.forms["ktaForm"]["codeKTA"].value;
  			var resultcaptchaKTA = document.forms["ktaForm"]["resultcaptchaKTA"].value;

  			if (codeKTA != resultcaptchaKTA) {
    			alert("Hasil penjumlahan di Form KTA tidak sama dengan captcha. Silakan coba lagi.");
    			return false;
		 	}
		}

		function validateMultiguna() {
  			var codeMultiguna = document.forms["multigunaForm"]["codeMultiguna"].value;
  			var resultcaptchaMultiguna = document.forms["multigunaForm"]["resultcaptchaMultiguna"].value;
  			
  			if (codeMultiguna != resultcaptchaMultiguna) {
    			alert("Hasil penjumlahan di Form Multiguna tidak sama dengan captcha. Silakan coba lagi.");
    			return false;
		 	}
		}
		
		function validateCC() {
  			var codeCC = document.forms["ccForm"]["codeCC"].value;
  			var resultcaptchaCC = document.forms["ccForm"]["resultcaptchaCC"].value;
  			
  			if (codeCC != resultcaptchaCC) {
    			alert("Hasil penjumlahan di Form Kartu Kredit tidak sama dengan captcha. Silakan coba lagi.");
    			return false;
		 	}
		}		
		</script>  
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <!--section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="icofont-envelope"></i><a href="mailto:contact@ramusen.com">contact@ramusen.com</a>
        <i class="icofont-phone"></i> +6221-7780-1247
      </div>
      <div class="social-links float-right">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </section-->

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">
      <div class="logo float-left">
        <!--h1 class="text-light"><a href="ramusen"><span>Ramusen</span></a></h1-->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="./index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>
    </div>
  </header><!-- End Header -->

  <main id="main">
      <!-- ======= Status Submit CC Section ======= -->
    <section id="cc" class="contact">
      <div class="container">

        <div class="section-title" style="border:1px solid black;">
<?php
	if ($conn->query($sql) === TRUE) {		
          echo "<h2>Formulir Kartu Kredit Telah Berhasil Di-Submit. Staff kami akan menghubungi Anda. Terima kasih sudah menggunakan Ramusen.</h2><br><br><a href=\"index.php\" style=\"color:rgb(255, 204, 0)\">Klik Disini</a> untuk kembali ke halaman utama.";
	}else{
		echo "<h2>Error: " . $sql . "<br>" . $conn->error ."</h2>";
	}
	$conn->close();
?>		
        </div>
      </div>
    </section><!-- End Submit CCa Section -->
  </main><!-- End #main -->


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>



<?php
/*
// Input Variable
$applicant_name = $_POST['applicant_name'];
$mobile_number = $_POST['mobile_number'];
$email = $_POST['email'];
$company_name = $_POST['company_name'];
$company_address = $_POST['company_address'];
$job = $_POST['job'];
$earnings_per_month = $_POST['earnings_per_month'];
$owned_kta = $_POST['owned_kta'];
$declaration = $_POST['declaration'];
$lastupd_user = 'YENOM.ID';

*/

    $to       = $email;
    $subject  = "Pengajuan Kartu Kredit dari Ramusen - " .$applicant_name ;
	$message = "
<html>
<head>
<title>" .$subject. "</title>
</head>
<body>
<p>Yth. ".$applicant_name.",</p></p>Berikut adalah " .$subject. " sbb. :</p>
<table border=1>
<tr>
<th text-align=left>Kolom</th>
<th text-align=left>Data</th>
</tr>
<tr>
<td>Nama Lengkap</td>
<td>" .$applicant_name. "</td>
</tr>
<tr>
<td>Nomor Handphone</td>
<td>" .$mobile_number. "</td>
</tr>
<tr>
<td>Nama Perusahaan</td>
<td>" .$company_name. "</td>
</tr>
<tr>
<td>Alamat Perusahaan</td>
<td>" .$company_address. "</td>
</tr>
<tr>
<td>Jabatan</td>
<td>" .$job. "</td>
</tr>
<tr>
<td>Penghasilan per Bulan</td>
<td>Rp. " .number_format($earnings_per_month). "</td>
</tr>
<tr>
<td>Kartu Kredit yang sudah dimiliki</td>
<td>" .$cc. "</td>
</tr>
<tr>
<td>Submitted Time</td>
<td>" .date("j F Y, g:i a"). "</td>
</tr>
</table>
<p>Customer Service Representative akan menghubungi Anda. Atas perhatiannya kami ucapkan terima kasih.</p>
<p>Note: Email Notification generated by system, please DO NOT REPLY, thank you.</p><br>Best Regards,<br><img src='https://ramusen.com/email-signature.png'>
</body>
</html>
";
    //smtp_mail($to, $subject, $message, '', '', 0, 'ramufin@ramusen.com', false);


header('Refresh: 5; URL=index.php');
?>
