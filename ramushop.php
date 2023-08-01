<?php
    $message = '';
    // generating expression
    $expression = (object) array(
        "n1" => rand(0, 9), 
        "n2" => rand(0, 9)
    );
    function generateImage($text, $file) {
        $im = @imagecreate(74, 25) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, 200, 200,  200);
        $text_color = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, 5, 5, 5,  $text, $text_color);
        imagepng($im, $file);
        imagedestroy($im);
    }
    $captchaImage = 'captcha/captcha'.time().'.png';
    generateImage($expression->n1.' + '.$expression->n2.' =', $captchaImage);
    // masking with alphabets
    $alphabet = array('K', 'g', 'A', 'D', 'R', 'V', 's', 'L', 'Q', 'w');
    $alphabetsForNumbers = array(
        array('K', 'g', 'A', 'D', 'R', 'V', 's', 'L', 'Q', 'w'),
        array('M', 'R', 'o', 'F', 'd', 'X', 'z', 'a', 'K', 'L'),
        array('H', 'Q', 'O', 'T', 'A', 'B', 'C', 'D', 'e', 'F'),
        array('T', 'A', 'p', 'H', 'j', 'k', 'l', 'z', 'x', 'v'),
        array('f', 'b', 'P', 'q', 'w', 'e', 'K', 'N', 'M', 'V'),
        array('i', 'c', 'Z', 'x', 'W', 'E', 'g', 'h', 'n', 'm'),
        array('O', 'd', 'q', 'a', 'Z', 'X', 'C', 'b', 't', 'g'),
        array('p', 'E', 'J', 'k', 'L', 'A', 'S', 'Q', 'W', 'T'),
        array('f', 'W', 'C', 'G', 'j', 'I', 'O', 'P', 'Q', 'D'),
        array('A', 'g', 'n', 'm', 'd', 'w', 'u', 'y', 'x', 'r')
    );
    $usedAlphabet = rand(0, 9);
    $code = $alphabet[$usedAlphabet].
            $alphabetsForNumbers[$usedAlphabet][$expression->n1].
            $alphabetsForNumbers[$usedAlphabet][$expression->n2];
    // process form submitting
    function getIndex($alphabet, $letter) {
        for($i=0; $i<count($alphabet); $i++) {
            $l = $alphabet[$i];
            if($l === $letter) return $i;
        }
    }
    function getExpressionResult($code) {
        global $alphabet, $alphabetsForNumbers;
        $userAlphabetIndex = getIndex($alphabet, substr($code, 0, 1));
        $number1 = (int) getIndex($alphabetsForNumbers[$userAlphabetIndex], substr($code, 1, 1));
        $number2 = (int) getIndex($alphabetsForNumbers[$userAlphabetIndex], substr($code, 2, 1));
        return $number1 + $number2;
    }
    if(isset($_POST["code"])) {
        $sentCode = $_POST["code"];
        $result = (int) $_POST["result"];
        if(getExpressionResult($sentCode) === $result) {
            $message = '<p class="success">Success. ('.$result.')</p>';
        } else {
            $message = '<p class="failure">Failure. ('.$result.')</p>';
        }
    }

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

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li><a href="index.php#header">Home</a></li>
          <!--li><a href="#about">About Us</a></li-->
          <li><a href="kta.php">Kredit Tanpa Agunan</a></li>
          <li><a href="multiguna.php">Kredit Multiguna</a></li>
          <li><a href="cc.php">Kartu Kredit</a></li>
          <li class="active"><a href="ramushop.php">Shop</a></li>
          <!--li><a href="#services">Services</a></li-->
          <!--<a href="#portfolio">Portfolio</a></li-->
          <!--li><a href="#team">Team</a></li-->
          <!--li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li-->
          <li><a href="index.php#contact">Contact Us</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Our Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
          <h2>Ramusen Shop</h2>
          <p>Mau cemilan enak, sehat, dan nggak mahal ada disini. Di-order, yuk ...</p>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-snack">Snack</li>
              <!--li data-filter=".filter-herbal">Herbal</li-->
              <!--li data-filter=".filter-web">Web</li-->
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/01-lotus-biscoff-biscuit-312gr.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Lotus Biscoff Biscuit 312 gr</h4>
                <p>Rp 62.500</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/01-lotus-biscoff-biscuit-312gr.jpg" data-gall="portfolioGallery" class="venobox" title="lotus biscoff biscuit 312 gr"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/lotus-biscoff-biscuit-312-gr" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/02-lotus-biscoff-biscuit-250gr.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Lotus Biscoff Biscuit 250 gr</h4>
                <p>Rp 37.500</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/02-lotus-biscoff-biscuit-250gr.jpg" data-gall="portfolioGallery" class="venobox" title="lotus biscoff biscuit 250 gr"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/lotus-biscoff-biscuit-250gr" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/03-baby-star-oyatsu-crispy-wide-noodle-snack-74-gram-hot-spicy-flavour.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Baby Star Oyatsu Crispy Wide Noodle Snack 74 gr Hot Spicy Flavour</h4>
                <p>Rp 25.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/03-baby-star-oyatsu-crispy-wide-noodle-snack-74-gram-hot-spicy-flavour.jpg" data-gall="portfolioGallery" class="venobox" title="Baby Star Oyatsu Crispy Wide Noodle Snack 74 gr Hot Spicy Flavour"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/baby-star-oyatsu-crispy-wide-noodle-snack-74-gram-hot-spicy-flavour" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/04-oyatsu-baby-star-snack-mie-lebar-rasa-original-74-gram.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Oyatsu Baby Star Snack Mie Lebar Rasa Original 74 gr</h4>
                <p>Rp 25.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/04-oyatsu-baby-star-snack-mie-lebar-rasa-original-74-gram.jpg" data-gall="portfolioGallery" class="venobox" title="Oyatsu Baby Star Snack Mie Lebar Rasa Original 74 gr"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/oyatsu-baby-star-snack-mie-lebar-rasa-original-74-gram" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/05-samjin-pretzel-korea-85-gram-cheddar-cheese.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Samjin Pretzel Korea 85 gr Cheddar Cheese</h4>
                <p>Rp 18.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/05-samjin-pretzel-korea-85-gram-cheddar-cheese.jpg" data-gall="portfolioGallery" class="venobox" title="Samjin Pretzel Korea 85 gr Cheddar Cheese"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/samjin-pretzel-korea-85-gram-cheddar-cheese" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/06-herrs-deepdish-pizza-flavoured-cheese-curls-7-oz.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Herrs Deepdish Pizza Flavoured Cheese Curls 7oz</h4>
                <p>Rp 65.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/06-herrs-deepdish-pizza-flavoured-cheese-curls-7-oz.jpg" data-gall="portfolioGallery" class="venobox" title="Herrs Deepdish Pizza Flavoured Cheese Curls 7oz"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/herrs-deepdish-pizza-flavoured-cheese-curls-7-oz" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/07-herrs-jalapeno-poppers.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Herrs Jalapeno Poppers</h4>
                <p>Rp 65.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/07-herrs-jalapeno-poppers.jpg" data-gall="portfolioGallery" class="venobox" title="Herrs Jalapeno Poppers"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/herrs-jalapeno-poppers" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/08-thins-potato-chips-australia-175-gram-cheese-onion.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Thins Potato Chips Australia 175 gr Cheese Onion</h4>
                <p>Rp 59.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/08-thins-potato-chips-australia-175-gram-cheese-onion.jpg" data-gall="portfolioGallery" class="venobox" title="Thins Potato Chips Australia 175 gr Cheese Onion"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/thins-potato-chips-australia-175-gram-cheese-onion" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

          <!--div class="col-lg-4 col-md-6 portfolio-item filter-herbal">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/09-1-botol-miracle-herbal-madu-hitam-by-power-mix-400-ml.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>1 Botol Miracle Herbal Madu Hitam by Power Mix 400 ml</h4>
                <p>Rp 269.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/09-1-botol-miracle-herbal-madu-hitam-by-power-mix-400-ml.jpg" data-gall="portfolioGallery" class="venobox" title="1 Botol Miracle Herbal Madu Hitam by Power Mix 400 ml"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/1-botol-miracle-herbal-madu-hitam-by-power-mix-400-ml" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div-->

          <div class="col-lg-4 col-md-6 portfolio-item filter-snack">
            <div class="portfolio-wrap">
              <img src="assets/img/ramushop/cintangemil/10-toms-honey-butter-almond-210-gr.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Toms Honey Butter Almond 210 gr</h4>
                <p>Rp 119.000</p>
                <div class="portfolio-links">
                  <a href="assets/img/ramushop/cintangemil/10-toms-honey-butter-almond-210-gr.jpg" data-gall="portfolioGallery" class="venobox" title="Toms Honey Butter Almond 210 gr"><i class="icofont-eye"></i></a>
                  <a href="https://www.tokopedia.com/cintangemil/toms-honey-butter-almond-210-gr" title="Beli" target="_blank"><i class="icofont-shopping-cart"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Our Portfolio Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>PT. Ranajaya Mulia Sentosa</h3>
            <p>
              Ruko ITC Depok No.42<br>
              Jl. Margonda Raya, Depok, Jawa Barat, 16431<br><br>
              <!--strong>Phone:</strong> +6221-7780-1247<br-->
              <strong>Email:</strong> contact@ramusen.com<br>
            </p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

          <!--div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div-->

          <!--div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div-->

          <!--div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div-->

        </div>
      </div>
    </div>

    <!--div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Mamba</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/ -->
        <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a-->
      <!--/div-->
    <!--/div-->
  </footer><!-- End Footer -->
  
      <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=6281289100640&text=Halo,%20Rana%20(Ramusen).%20Saya%20ingin%20pesan%20snacknya" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>


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
