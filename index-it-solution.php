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
          <li class="active"><a href="#header">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <!--li><a href="kta.php">Kredit Tanpa Agunan</a></li>
          <li><a href="multiguna.php">Kredit Multiguna</a></li>
          <li><a href="cc.php">Kartu Kredit</a></li>
          <li><a href="ramushop.php">Shop</a></li-->
          <!--li><a href="#services">Services</a></li-->
          <!--li><a href="#portfolio">Portfolio</a></li-->
          <li><a href="#team">Founding Team</a></li>
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
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" style="page-break-after: always;">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-autoplay="true" data-interval="6000">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active">
			<a href="kta.php"><img src = "assets/img/slide-it/slide-1.jpg" width="100%" height="100%"></a>
            <!--div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animated fadeInDown">Kredit Tanpa Agunan</h2>
                <p class="animated fadeInUp">Realisasikan Rencanamu.</p>
                <a href="#kta" class="btn-get-started animated fadeInUp scrollto">Mulai Pengajuan</a>
              </div>
            </div-->
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item">
			<a href="multiguna.php"><img src = "assets/img/slide-it/slide-2.jpg" width="100%" height="100%"></a>
            <!--div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animated fadeInDown">Kredit Multiguna</span></h2>
                <p class="animated fadeInUp">Wujudkan Impianmu.</p>
                <a href="#multiguna" class="btn-get-started animated fadeInUp scrollto">Mulai Pengajuan</a>
              </div>
            </div-->
          </div>

          <!-- Slide 3 -->
          <!--div class="carousel-item" style="background-image: url('assets/img/slide/slide-3.jpg');"-->
          <div class="carousel-item">
			<a href="cc.php"><img src = "assets/img/slide-it/slide-3.jpg" width="100%" height="100%"></a>
            <!--div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animated fadeInDown">Kartu Kredit</h2>
                <p class="animated fadeInUp">Belanja dengan Praktis.</p>
                <a href="#cc" class="btn-get-started animated fadeInUp scrollto">Mulai Pengajuan</a>
              </div>
            </div-->
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
      <!-- ======= KTA Section ======= -->
    <!--section id="kta" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Formulir KTA</h2>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form id="ktaForm" action="insert-kta.php" method="post" class="php-email-form">
              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="applicant_name" class="form-control" placeholder="Nama Lengkap" data-rule="minlen:3" data-msg="Tuliskan nama minimum 3 huruf." required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="text" name="mobile_number" class="form-control" placeholder="Nomor Handphone" pattern="[0-9+-]+" data-msg="Mohon input nomor HP sesuai format yang tepat." required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="text" name="company_name" class="form-control" placeholder="Nama Perusahaan" required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Mohon input email sesuai format yang tepat." />
                  <div class="validate"></div>
                </div>
              </div>
             <div class="form-group">
                <textarea class="form-control" name="company_address" rows="5" data-rule="required" data-msg="Mohon input alamat perusahaan." placeholder="Alamat Perusahaan"></textarea>
                <div class="validate"></div>
              </div>

              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="job" class="form-control" placeholder="Jabatan" required />
                  <div class="validate"></div>
                </div>
                 <div class="col-lg-6 form-group">
                  <input type="number" name="earnings_per_month" class="form-control" placeholder="Penghasilan per Bulan (Rp.)" data-msg="Mohon input Penghasilan per Bulan sesuai format yang tepat." required />
                  <div class="validate"></div>
                </div>
             </div>

             <div class="form-group">
                <textarea class="form-control" name="owned_kta" rows="3" data-msg="Mohon input KTA yang Anda miliki." placeholder="KTA yang Anda sudah Anda miliki"></textarea>
                <div class="validate"></div>
              </div>

              <div class="form-row">
                <div class="col-lg-6 form-group">
					<?php echo $message; ?>
					<input type="hidden" name="codeKTA" value="<?php echo $expression->n1 + $expression->n2; ?>" />
					<img src="<?php echo $captchaImage; ?>"  height="80px" width="100px"/>
					<input type="text" name="resultcaptchaKTA" placeholder="Jawaban Penjumlahan" pattern="[0-9.RPrp]+" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Jawaban Penjumlahan'" required>
                </div>
                <div class="col-lg-6 form-group">
                  Saya menyatakan bahwa data yang saya input adalah benar dan saya setuju untuk mematuhi Syarat dan Ketentuan.<input type="checkbox" name="declaration" class="form-control" value="Y" required />
                  <div class="validate"></div>
                </div>
              </div>
 			  
              <div class="text-center">
				<button class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center" onclick="return validateKTA();" type="submit">SUBMIT<span class="lnr lnr-arrow-right"></span></button>			  
			  </div>

              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your form has been sent. Thank you!</div>
              </div>

            </form>
          </div>

        </div>

      </div>
    </section--><!-- End KTA Section -->


      <!-- ======= Kredit Multiguna Section ======= -->
    <!--section id="multiguna" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Formulir Kredit Multiguna</h2>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form id="ktaForm" action="insert-multiguna.php" method="post" class="php-email-form">
              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="applicant_name" class="form-control" placeholder="Nama Lengkap" data-rule="minlen:3" data-msg="Tuliskan nama minimum 3 huruf." required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="text" name="mobile_number" class="form-control" placeholder="Nomor Handphone" pattern="[0-9+-]+" data-msg="Mohon input nomor HP sesuai format yang tepat." required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="text" name="company_name" class="form-control" placeholder="Nama Perusahaan" required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Mohon input email sesuai format yang tepat." />
                  <div class="validate"></div>
                </div>
              </div>
             <div class="form-group">
                <textarea class="form-control" name="company_address" rows="5" data-rule="required" data-msg="Mohon input alamat perusahaan." placeholder="Alamat Perusahaan"></textarea>
                <div class="validate"></div>
              </div>

              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="job" class="form-control" placeholder="Jabatan" required />
                  <div class="validate"></div>
                </div>
                 <div class="col-lg-6 form-group">
                  <input type="number" name="earnings_per_month" class="form-control" placeholder="Penghasilan per Bulan (Rp.)" data-msg="Mohon input Penghasilan per Bulan sesuai format yang tepat." required />
                  <div class="validate"></div>
                </div>
             </div>

             <div class="form-group">
                <textarea class="form-control" name="bpkb" rows="3" data-msg="Mohon input BPKB mobil yang Anda miliki, tipe mobil, dan tahun pembuatan." placeholder="BPKB mobil yang Anda miliki, tipe mobil, dan tahun pembuatan"></textarea>
                <div class="validate"></div>
              </div>

              <div class="form-row">
                <div class="col-lg-6 form-group">
					<?php echo $message; ?>
					<input type="hidden" name="codeMultiguna" value="<?php echo $expression->n1 + $expression->n2; ?>" />
					<img src="<?php echo $captchaImage; ?>"  height="80px" width="100px"/>
					<input type="text" name="resultcaptchaMultiguna" placeholder="Jawaban Penjumlahan" pattern="[0-9.RPrp]+" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Jawaban Penjumlahan'" required>
                </div>
                <div class="col-lg-6 form-group">
                  Saya menyatakan bahwa data yang saya input adalah benar dan saya setuju untuk mematuhi Syarat dan Ketentuan.<input type="checkbox" name="declaration" class="form-control" value="Y" required />
                  <div class="validate"></div>
                </div>
              </div>
 			  
              <div class="text-center">
				<button class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center" onclick="return validateMultiguna();" type="submit">SUBMIT<span class="lnr lnr-arrow-right"></span></button>			  
			  </div>

              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your form has been sent. Thank you!</div>
              </div>

            </form>
          </div>

        </div>

      </div>
    </section--><!-- End Kredit Multiguna Section -->


      <!-- ======= Kartu Kredit Section ======= -->
    <!--section id="cc" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Formulir Kartu Kredit</h2>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form id="ccForm" action="insert-cc.php" method="post" class="php-email-form">
              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="applicant_name" class="form-control" placeholder="Nama Lengkap" data-rule="minlen:3" data-msg="Tuliskan nama minimum 3 huruf." required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="text" name="mobile_number" class="form-control" placeholder="Nomor Handphone" pattern="[0-9+-]+" data-msg="Mohon input nomor HP sesuai format yang tepat." required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="text" name="company_name" class="form-control" placeholder="Nama Perusahaan" required />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Mohon input email sesuai format yang tepat." />
                  <div class="validate"></div>
                </div>
              </div>
             <div class="form-group">
                <textarea class="form-control" name="company_address" rows="5" data-rule="required" data-msg="Mohon input alamat perusahaan." placeholder="Alamat Perusahaan"></textarea>
                <div class="validate"></div>
              </div>

              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="job" class="form-control" placeholder="Jabatan" required />
                  <div class="validate"></div>
                </div>
                 <div class="col-lg-6 form-group">
                  <input type="number" name="earnings_per_month" class="form-control" placeholder="Penghasilan per Bulan (Rp.)" data-msg="Mohon input Penghasilan per Bulan sesuai format yang tepat." required />
                  <div class="validate"></div>
                </div>
             </div>

             <div class="form-group">
                <textarea class="form-control" name="cc" rows="3" data-msg="Mohon input Kartu Kredit yang Anda miliki." placeholder="Kartu Kredit yang Anda sudah Anda miliki"></textarea>
                <div class="validate"></div>
              </div>

              <div class="form-row">
                <div class="col-lg-6 form-group">
					<?php echo $message; ?>
					<input type="hidden" name="codeCC" value="<?php echo $expression->n1 + $expression->n2; ?>" />
					<img src="<?php echo $captchaImage; ?>"  height="80px" width="100px"/>
					<input type="text" name="resultcaptchaCC" placeholder="Jawaban Penjumlahan" pattern="[0-9.RPrp]+" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Jawaban Penjumlahan'" required>
                </div>
                <div class="col-lg-6 form-group">
                  Saya menyatakan bahwa data yang saya input adalah benar dan saya setuju untuk mematuhi Syarat dan Ketentuan.<input type="checkbox" name="declaration" class="form-control" value="Y" required />
                  <div class="validate"></div>
                </div>
              </div>
 			  
              <div class="text-center">
				<button class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center" onclick="return validateCC();" type="submit">SUBMIT<span class="lnr lnr-arrow-right"></span></button>			  
			  </div>

              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your form has been sent. Thank you!</div>
              </div>

            </form>
          </div>

        </div>

      </div>
    </section--><!-- End Kartu Kredit Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="col-lg-6 video-box">
            <img src="assets/img/about-bak.png" class="img-fluid" alt="">
            <!--a href="https://www.youtube.com/watch?v=hQ53aK4Z5d4" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a-->
            <a href="https://www.youtube.com/watch?v=dn8sNsTaQzw" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center about-content">

            <div class="section-title">
              <h2>About Us</h2>
              <p>PT. Ranajaya Mulia Sentosa (Ramusen) is a respected Indonesian IT Company. </p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Vision</a></h4>
              <p class="description">To be the Digital Based Company in Indonesia with commitment to excellence. We have broad experience in IT Sectors (Enterprise Resource Planning, Human Capital Management, Web Development, Mobile Development).</p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bx-gift"></i></div>
              <h4 class="title"><a href="">Mission</a></h4>
              <p class="description">1. To be a good partner for each customers in building together the IT Digital Transformation.<br>2. To be a digital-based in several aspects.</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= About Lists Section ======= -->
    <!--section class="about-lists">
      <div class="container">

        <div class="row no-gutters">

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-up">
            <span>01</span>
            <h4>Lorem Ipsum</h4>
            <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-up" data-aos-delay="100">
            <span>02</span>
            <h4>Repellat Nihil</h4>
            <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno para dest</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-up" data-aos-delay="200">
            <span>03</span>
            <h4> Ad ad velit qui</h4>
            <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam quis</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-up" data-aos-delay="300">
            <span>04</span>
            <h4>Repellendus molestiae</h4>
            <p>Inventore quo sint a sint rerum. Distinctio blanditiis deserunt quod soluta quod nam mider lando casa</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-up" data-aos-delay="400">
            <span>05</span>
            <h4>Sapiente Magnam</h4>
            <p>Vitae dolorem in deleniti ipsum omnis tempore voluptatem. Qui possimus est repellendus est quibusdam</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-up" data-aos-delay="500">
            <span>06</span>
            <h4>Facilis Impedit</h4>
            <p>Quis eum numquam veniam ea voluptatibus voluptas. Excepturi aut nostrum repudiandae voluptatibus corporis sequi</p>
          </div>

        </div>

      </div>
    </section--><!-- End About Lists Section -->

    <!-- ======= Counts Section ======= -->
    <!--section class="counts section-bg">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up">
            <div class="count-box">
              <i class="icofont-simple-smile" style="color: #20b38e;"></i>
              <span data-toggle="counter-up">232</span>
              <p>Happy Clients</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="count-box">
              <i class="icofont-document-folder" style="color: #c042ff;"></i>
              <span data-toggle="counter-up">521</span>
              <p>Projects</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
            <div class="count-box">
              <i class="icofont-live-support" style="color: #46d1ff;"></i>
              <span data-toggle="counter-up">1,463</span>
              <p>Hours Of Support</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="600">
            <div class="count-box">
              <i class="icofont-users-alt-5" style="color: #ffb459;"></i>
              <span data-toggle="counter-up">15</span>
              <p>Hard Workers</p>
            </div>
          </div>

        </div>

      </div>
    </sectio--n><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <!--section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
            <div class="icon"><i class="icofont-computer"></i></div>
            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="icofont-chart-bar-graph"></i></div>
            <h4 class="title"><a href="">Dolor Sitema</a></h4>
            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="icofont-earth"></i></div>
            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="icofont-image"></i></div>
            <h4 class="title"><a href="">Magni Dolores</a></h4>
            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="icofont-settings"></i></div>
            <h4 class="title"><a href="">Nemo Enim</a></h4>
            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
            <div class="icon"><i class="icofont-tasks-alt"></i></div>
            <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
          </div>
        </div>

      </div>
    </section--><!-- End Services Section -->

    <!-- ======= Our Portfolio Section ======= -->
    <!--section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
          <h2>Our Portfolio</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 1</h4>
                <p>App</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-1.jpg" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-2.jpg" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 2</h4>
                <p>App</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-3.jpg" data-gall="portfolioGallery" class="venobox" title="App 2"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 2</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-4.jpg" data-gall="portfolioGallery" class="venobox" title="Card 2"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 2</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-5.jpg" data-gall="portfolioGallery" class="venobox" title="Web 2"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 3</h4>
                <p>App</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-6.jpg" data-gall="portfolioGallery" class="venobox" title="App 3"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 1</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-7.jpg" data-gall="portfolioGallery" class="venobox" title="Card 1"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 3</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-8.jpg" data-gall="portfolioGallery" class="venobox" title="Card 3"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-9.jpg" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="icofont-eye"></i></a>
                  <a href="#" title="More Details"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section--><!-- End Our Portfolio Section -->

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <h2>Founding Team</h2>
          <p>Meet our exceptionally talented management team.</p>
        </div>

        <div class="row">

          <!--div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Reinhard Parulian</h4>
                <span>Chief Executive Officer</span>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Lidia Natalia</h4>
                <span>Chief Operating Officer</span>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div-->

          <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Andrew Nainggolan</h4>
                <span>Cofounder</span>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-7 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div>
                <h3>Profile</h3>
                <span>Andrew Steven Nainggolan has more than 15 years of experience in 20+ SDLC projects. He has enormous experience working in top IT companies in Indonesia and Malaysia such as PT. Metrodata Electronics, Tbk, PT. NTT Data Indonesia, PT. Sigma Cipta Caraka, KEDA Sdn. Bhd. , etc.<br><br>
With domain knowledge of Enterprise Resource Planning and Human Capital Management gather from top software industries, he could give consultations and implementations to fit client business needs.</span>
            </div>
          </div>

          <!--div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="pic"><img src="assets/img/team/team-4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sample Name Two</h4>
                <span>General Manager</span>
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div-->

        </div>

      </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <!--section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <div class="row  d-flex align-items-stretch">

          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>Non consectetur a erat nam at lectus urna duis?</h4>
            <p>
              Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="100">
            <h4>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h4>
            <p>
              Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="200">
            <h4>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?</h4>
            <p>
              Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus.
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="300">
            <h4>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h4>
            <p>
              Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="400">
            <h4>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</h4>
            <p>
              Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
            </p>
          </div>

          <div class="col-lg-6 faq-item" data-aos="fade-up" data-aos-delay="500">
            <h4>Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor?</h4>
            <p>
              Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
            </p>
          </div>

        </div>

      </div>
    </section--><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact Us</h2>
        </div>

        <div class="row">

          <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Ruko ITC Depok No.42, Jl. Margonda Raya, Depok, Jawa Barat, 16431</p>
            </div>
          </div>

          <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>contact@ramusen.com</p>
            </div>
          </div>

          <!--div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="info-box ">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+6221-7780-1247</p>
            </div>
          </div-->

          <!--div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-lg-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div-->

        </div>

      </div>
    </section><!-- End Contact Us Section -->

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
              <!--a href="#" class="twitter"><i class="bx bxl-twitter"></i></a-->
              <!--a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a-->
              <!--a href="#" class="google-plus"><i class="bx bxl-skype"></i></a-->
              <!--a href="https://www.linkedin.com/in/ramusen" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a-->
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
<!--a href="https://api.whatsapp.com/send?phone=6281289100640&text=Halo,%20Rana%20(Ramusen).%20Saya%20ingin%20info%20mengenai%20pengajuan" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a-->

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
<!-- <a href="http://www.freepik.com">Designed by vectorpouch / Freepik</a> -->
