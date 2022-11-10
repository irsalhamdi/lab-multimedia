<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Lab Multimedia</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/unsri.png') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/gijgo.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    </head>
    <body>
        @include('frontend.layouts.header')
        @yield('form')
        @include('frontend.layouts.footer')
        
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
        <script src="{{ asset('frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('frontend/js/ajax-form.js') }}"></script>
        <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('frontend/js/scrollIt.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
        <script src="{{ asset('frontend/js/nice-select.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.slicknav.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/plugins.js') }}"></script>
        <script src="{{ asset('frontend/js/gijgo.min.js') }}"></script>
        <script src="{{ asset('frontend/js/contact.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('frontend/js/mail-script.js') }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

		<script>
			@if(Session::has('message'))
				var type = "{{ Session::get('alert-type', 'info') }}"
				switch(type){

					case 'info':
					toastr.info("{{ Session::get('message') }}");
					break;

					case 'success':
					toastr.success("{{ Session::get('message') }}");
					break;

					case 'warning':
					toastr.warning("{{ Session::get('message') }}");
					break;

					case 'error':
					toastr.error("{{ Session::get('message') }}");
					break;
				}
			@endif
		</script>

    </body>
</html>