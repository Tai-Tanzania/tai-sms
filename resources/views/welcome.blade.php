<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <meta name="description" content="">
    <link rel="icon" href="img/favicon.png" sizes="32x32" type="image/png">
    <!-- custom.css -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- bootstrap.min.css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- font-awesome -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
    <!-- AOS -->
    <link rel="stylesheet" href="css/aos.css">
</head>

<body>
    <!-- banner -->
    <div class="jumbotron jumbotron-fluid" id="banner" style="background-image: url('img/tai-kids.png')">
        <div class="container text-center text-md-left">
            <header>
                <div class="row justify-content-between">
                    <div class="col-2">
                        <img src="img/tailogowhite.png" alt="logo" style="max-width: 200px">
                    </div>
                    <div class="col-6 align-self-center text-right">
                        <a href="#" id="chat" class="text-white lead mr-2">sw</a>
                    </div>
                </div>
            </header>
            <h1 data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true" class="display-3 text-white font-weight-bold my-5">
            	Get informed<br>
            	via messages.
            </h1>
            <p data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true" class="lead text-white my-4">
                Lorem ipsum dolor sit amet, id nec enim autem oblique, ei dico mentitum duo.
                <br> Illum iusto laoreet his te. Lorem partiendo mel ex. Ad vitae admodum voluptatum per.
            </p>
            <a href="#" data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true" style="background: black" class="btn my-4 text-white font-weight-bold atlas-cta">Text us now</a>
        </div>
    </div>
        <!-- three-blcok -->
        <div class="container my-1 py-0">
            <h2 class="text-center font-weight-bold my-5">
                Our statistics
            </h2>
            <div class="row">
                <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center"> 
                    <h4>Messages sent</h4>
                    <p style="font-size: 50px">
                        {{ is_array($messages) ? count($messages) : 0 }}
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
                    
                    <h4>People reached</h4>
                    <p style="font-size: 50px">
                        {{ is_array($users) ? count($users) : 0 }}
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center">
                   <h4>Regions reached</h4>
                   <p style="font-size: 50px">
                    10
                    </p>
                </div>
            </div>
        </div>
    <!-- feature (skew background) -->
    <div class="jumbotron jumbotron-fluid feature" id="feature-first">
        <div class="container my-2">
            <div class="row justify-content-between text-center text-md-left">
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="col-md-6">
                    <h2 class="font-weight-bold">Toll free</h2>
                    <p class="my-4">
                        Get information on education, health, and updates <br> on Tai, or just chat with us, for free! 
                        This ensures we can communicate with our stakeholders and beneficaries <br> regardless of their financial status.
                    </p>
                    {{-- <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-blue">Learn More</a> --}}
                </div>
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true" class="col-md-6 align-self-center">
                    <img src="{{ asset('img/Lucy_promo.png') }}" style="margin-top: -20px; max-width: 350px" alt="..." class="mx-auto d-block">
                </div>
            </div>
        </div>
    </div>
    <!-- feature (green background) -->
    <div class="jumbotron jumbotron-fluid feature" style="margin: 0 0; padding: 0 0" id="feature-last">
        <div class="container">
            <div class="row justify-content-between text-center text-md-left">
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true" class="col-md-6 flex-md-last">
                    <h2 class="font-weight-bold" style="color: white">Safe and reliable</h2>
                    <p class="my-4" style="color: white">
                        All your chats and information are safely kept with us, encrypted and hidden to ensure confidentiality.  
                    </p>
                    {{-- <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-blue">Learn More</a> --}}
                </div>
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="col-md-6 align-self-center flex-md-first">
                    <img src="{{ asset('img/Zongwe_promo.png') }}" style="max-width: 300px" alt="Safe and reliable" class="mx-auto d-block">
                </div>
            </div>
        </div>
    </div>

    <!-- client -->
    {{-- <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-2 py-2 align-self-center">
                    <img src="{{ secure_asset('home/img/client-1.png') }}" class="mx-auto d-block">
                </div>
                <div class="col-sm-4 col-md-2 py-2 align-self-center">
                    <img src="{{ secure_asset('home/img/client-1.png') }}" class="mx-auto d-block">
                </div>
                <div class="col-sm-4 col-md-2 py-2 align-self-center">
                    <img src="{{ secure_asset('home/img/client-1.png') }}" class="mx-auto d-block">
                </div>
                <div class="col-sm-4 col-md-2 py-2 align-self-center">
                    <img src="{{ secure_asset('home/img/client-1.png') }}" class="mx-auto d-block">
                </div>
                <div class="col-sm-4 col-md-2 py-2 align-self-center">
                    <img src="{{ secure_asset('home/img/client-1.png') }}" class="mx-auto d-block">
                </div>
                <div class="col-sm-4 col-md-2 py-2 align-self-center">
                    <img src="{{ secure_asset('home/img/client-1.png') }}" class="mx-auto d-block">
                </div>
            </div>
        </div>
    </div> --}}
    <!-- contact -->
    <div class="jumbotron jumbotron-fluid" id="contact" style="background-image: url('img/contact-bk.jpg');">
        <div class="container my-5">
            <div class="row justify-content-between">
                <div class="col-md-12 text-white">
                    <h2 class="font-weight-bold text-center">Text Us</h2>
                    <p class="my-4 text-center">
                        Sending us your details will <br> allow us to start chatting with you.
                    </p>
                    <br>
                    <form>
                    	<div class="row">
	                        <div class="form-group col-md-6">
	                            <label for="name">Your Name</label>
	                            <input type="name" class="form-control" id="name">
	                        </div>
	                        <div class="form-group col-md-6">
	                            <label for="Email">Your Phone number</label>
	                            <input type="text" class="form-control" id="phone">
	                        </div>
	                    </div>
	                    {{-- <div class="form-group">
	                        <label for="message">Message</label>
	                        <textarea class="form-control" id="message" rows="3"></textarea>
	                    </div> --}}
                        <div class="row d-flex justify-content-center">
                            <button type="submit" style="padding: 10px 60px; background: #6c4130" class="btn text-white font-weight-bold my-3">Text us</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<!-- copyright -->
	<div class="jumbotron jumbotron-fluid" id="copyright">
        <div class="container">
            <div class="row justify-content-between">
            	<div class="col-md-6 text-white align-self-center text-center text-md-left my-2">
                    Copyright © {{ date("Y") }} , Tai Tanzania.
                </div>
                <div class="col-md-6 align-self-center text-center text-md-right my-2" id="social-media">
                    <a href="#" class="d-inline-block text-center ml-2">
                    	<i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="d-inline-block text-center ml-2">
                    	<i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="d-inline-block text-center ml-2">
                    	<i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="d-inline-block text-center ml-2">
                    	<i class="fa fa-youtube" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- AOS -->
    <script src="js/aos.js"></script>
    <script>
      AOS.init({
      });

      $("#chat").click(function() {
            $('html, body').animate({
                scrollTop: $("#contact").offset().top
            }, 2000);
        });
    </script>
</body>

</html>