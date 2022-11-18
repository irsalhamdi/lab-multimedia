<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $title }}</title>
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
        <style>
            * {box-sizing: border-box;}   
            /* Button used to open the chat form - fixed at the bottom of the page */
            .open-button {
              background-color: rgb(255, 184, 4);
              color: white;
              padding: 1px 1px;
              border: 10px solid #ffb804;
              border-radius: 10px;
              cursor: pointer;
              opacity: 0.8;
              position: fixed;
              bottom: 23px;
              right: 28px;
              width: 280px;
            }
            
            /* The popup chat - hidden by default */
            .chat-popup {
              display: none;
              position: fixed;
              bottom: 0;
              right: 15px;
              border: 20px solid #f1f1f1;
              border-radius: 20px;
              z-index: 9;
            }
            
            /* Add styles to the form container */
            .form-container {
              max-width: 300px;
              padding: 10px;
              background-color: #f1f1f1;
              border: 3px;
            }
            
            /* Full-width textarea */
            .form-container textarea {
              width: 100%;
              padding: 15px;
              margin: 5px 0 22px 0;
              border: none;
              background: #f1f1f1;
              resize: none;
              min-height: 200px;
            }
            /* When the textarea gets focus, do something */
            .form-container textarea:focus {
              background-color: #f1f1f1;
              outline: none;
            }     
            /* Set a style for the submit/send button */
            .form-container .btn {
              background-color: #ffb804;
              color: white;
              padding: 16px 20px;
              border: none;
              cursor: pointer;
              width: 100%;
              margin-bottom:10px;
              opacity: 0.8;
            }           
            /* Add a red background color to the cancel button */
            .form-container .cancel {
              background-color: rgb(205, 197, 197);
            }
            /* Add some hover effects to buttons */
            .form-container .btn:hover, .open-button:hover {
              opacity: 1;
            }
        </style>
    </head>
    <body>
        @include('frontend.layouts.header')
        @yield('main')
        <button class="open-button" onclick="openForm()">
            <small>
                Ada yang dapat kami bantu ?
                <i class="fa fa-whatsapp ml-2"></i>
            </small>
        </button>
        <div class="chat-popup" id="myForm">
            <form id="form" method="POST" action="{{ route('admin.news.store') }}" class="form-container">
                <h1 style="font-family: sans-serif; color: #ffb804;">Pesan</h1>

                <h6 style="font-family: sans-serif; color: #ffb804;" for="msg">
                    Kirimkan pesan anda
                </h6>
                <textarea placeholder="Ketik disini" name="msg" required></textarea>
                
                <a target="_blank" href="https://wa.me/+6282286866972" class="btn">Kirim</a>
                <a class="btn cancel" onclick="closeForm()">Tutup</a>
            </form>
        </div>
        @include('frontend.layouts.footer')
        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }
           function closeForm() {
              document.getElementById("myForm").style.display = "none";
            }
        </script>
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