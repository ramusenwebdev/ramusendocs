<?php

$message = '';

// generating expression

$expression = (object) array(

  "n1" => rand(0, 9),

  "n2" => rand(0, 9)

);

function generateImage($text, $file)
{

  $im = @imagecreate(74, 25) or die("Cannot Initialize new GD image stream");

  $background_color = imagecolorallocate($im, 200, 200, 200);

  $text_color = imagecolorallocate($im, 0, 0, 0);

  imagestring($im, 5, 5, 5, $text, $text_color);

  imagepng($im, $file);

  imagedestroy($im);

}

$captchaImage = 'captcha/captcha' . time() . '.png';

generateImage($expression->n1 . ' + ' . $expression->n2 . ' =', $captchaImage);

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

$code = $alphabet[$usedAlphabet] .

  $alphabetsForNumbers[$usedAlphabet][$expression->n1] .

  $alphabetsForNumbers[$usedAlphabet][$expression->n2];

// process form submitting

function getIndex($alphabet, $letter)
{

  for ($i = 0; $i < count($alphabet); $i++) {

    $l = $alphabet[$i];

    if ($l === $letter)
      return $i;

  }

}

function getExpressionResult($code)
{

  global $alphabet, $alphabetsForNumbers;

  $userAlphabetIndex = getIndex($alphabet, substr($code, 0, 1));

  $number1 = (int) getIndex($alphabetsForNumbers[$userAlphabetIndex], substr($code, 1, 1));

  $number2 = (int) getIndex($alphabetsForNumbers[$userAlphabetIndex], substr($code, 2, 1));

  return $number1 + $number2;

}

if (isset($_POST["code"])) {

  $sentCode = $_POST["code"];

  $result = (int) $_POST["result"];

  if (getExpressionResult($sentCode) === $result) {

    $message = '<p class="success">Success. (' . $result . ')</p>';

  } else {

    $message = '<p class="failure">Failure. (' . $result . ')</p>';

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

  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900"
    rel="stylesheet">



  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">

  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">

  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <link href="assets/vendor/aos/aos.css" rel="stylesheet">



  <!-- Template Main CSS File -->

  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Import Boostrap FrameWork  -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">




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



      window.open('https://api.whatsapp.com/send?phone=6281289100640&text=Halo%2C%20Rana%20%28Ramusen%29.%20Saya%20ingin%20info%20mengenai%20pengajuan%20' + 'Kredit%20Tanpa Agunan%20(KTA)' + '%3A%0D%0A%0D%0A-Nama%20Lengkap%3A%20' + document.forms["ktaForm"]["applicant_name"].value + '%0D%0A-Nomor%20Handphone%3A%20' + document.forms["ktaForm"]["mobile_number"].value + '%0D%0A-Nama%20Perusahaan%3A%20' + document.forms["ktaForm"]["company_name"].value + '%0D%0A-Email%3A%20' + document.forms["ktaForm"]["email"].value + '%0D%0A-Alamat%20Perusahaan%3A%20' + document.forms["ktaForm"]["company_address"].value + '%0D%0A-Jabatan%3A%20' + document.forms["ktaForm"]["job"].value + '%0D%0A-Penghasilan%20per%20Bulan%3A%20' + document.forms["ktaForm"]["earnings_per_month"].value + '%0D%0A-KTA%20yang%20sudah%20Anda%20miliki%3A%20' + document.forms["ktaForm"]["owned_kta"].value + '%20%0D%0A%0D%0ATerima%20Kasih', '_blank', 'resizable=yes');



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



      <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="index.php" class="nav-link" href="#about">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Layanan Produk
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="kta.php">Kredit Tanpa Agunan</a></li>
                <li><a class="dropdown-item" href="multiguna.php">Kredit Multiguna</a></li>
                <li><a class="dropdown-item" href="cc.php">Kartu Kredit</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Galery</a>
            </li>
          </ul>
        </div>
      </nav>



    </div>

  </header><!-- End Header -->





  <main id="main">

    <!-- ======= KTA Section ======= -->

    <section id="kta" class="contact">

      <div class="container">



        <div class="section-title">

          <h2>Formulir KTA</h2>

        </div>



        <div class="row">

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">

            <form id="ktaForm" action="insert-kta.php" method="post" class="php-email-form">

              <div class="form-row">

                <div class="col-lg-6 form-group">

                  <input type="text" name="applicant_name" class="form-control" placeholder="Nama Lengkap"
                    data-rule="minlen:3" data-msg="Tuliskan nama minimum 3 huruf." required />

                  <div class="validate"></div>

                </div>

                <div class="col-lg-6 form-group">

                  <input type="text" name="mobile_number" class="form-control" placeholder="Nomor Handphone"
                    pattern="[0-9+-]+" data-msg="Mohon input nomor HP sesuai format yang tepat." required />

                  <div class="validate"></div>

                </div>

                <div class="col-lg-6 form-group">

                  <input type="text" name="company_name" class="form-control" placeholder="Nama Perusahaan" required />

                  <div class="validate"></div>

                </div>

                <div class="col-lg-6 form-group">

                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email"
                    data-msg="Mohon input email sesuai format yang tepat." />

                  <div class="validate"></div>

                </div>

              </div>

              <div class="form-group">

                <textarea class="form-control" name="company_address" rows="5" data-rule="required"
                  data-msg="Mohon input alamat perusahaan." placeholder="Alamat Perusahaan"></textarea>

                <div class="validate"></div>

              </div>



              <div class="form-row">

                <div class="col-lg-6 form-group">

                  <input type="text" name="job" class="form-control" placeholder="Jabatan" required />

                  <div class="validate"></div>

                </div>

                <div class="col-lg-6 form-group">

                  <input type="number" name="earnings_per_month" class="form-control"
                    placeholder="Penghasilan per Bulan (Rp.)"
                    data-msg="Mohon input Penghasilan per Bulan sesuai format yang tepat." required />

                  <div class="validate"></div>

                </div>

              </div>



              <div class="form-group">

                <textarea class="form-control" name="owned_kta" rows="3" data-msg="Mohon input KTA yang Anda miliki."
                  placeholder="KTA yang Anda sudah Anda miliki"></textarea>

                <div class="validate"></div>

              </div>



              <div class="form-row">

                <div class="col-lg-6 form-group">

                  <?php echo $message; ?>

                  <input type="hidden" name="codeKTA" value="<?php echo $expression->n1 + $expression->n2; ?>" />

                  <img src="<?php echo $captchaImage; ?>" height="80px" width="100px" />

                  <input type="text" name="resultcaptchaKTA" placeholder="Jawaban Penjumlahan" pattern="[0-9.RPrp]+"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Jawaban Penjumlahan'" required>

                </div>

                <div class="col-lg-6 form-group">

                  Saya menyatakan bahwa data yang saya input adalah benar dan saya setuju untuk mematuhi Syarat dan
                  Ketentuan.<input type="checkbox" name="declaration" class="form-control" value="Y" required />

                  <div class="validate"></div>

                </div>

              </div>



              <div class="text-center">

                <button class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center"
                  onclick="return validateKTA();" type="submit">SUBMIT<span class="lnr lnr-arrow-right"></span></button>

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

    </section><!-- End KTA Section -->



    <!-- ======= Ilustrasi Pinjaman KTA Section ======= -->

    <section id="kta-illustration" class="contact">

      <div class="container">



        <div class="section-title">

          <h2>Ilustrasi Pinjaman KTA</h2>

        </div>



        <div class="row">

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">

            <img src="assets/img/kta-illustration.jpeg" class="img-fluid" alt="Ilustrasi Pinjaman KTA">

          </div>

        </div>



      </div>

    </section><!-- End Ilustrasi Pinjaman KTA Section -->



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

  <a href="https://api.whatsapp.com/send?phone=6281289100640&text=Halo,%20Rana%20(Ramusen).%20Saya%20ingin%20info%20mengenai%20pengajuan%20Kredit%20Tanpa%20Agunan"
    class="float" target="_blank">

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

  <!-- Link bootstrap -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>


</body>



</html>