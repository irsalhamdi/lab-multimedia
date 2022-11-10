<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('backend/vendors/typicons.font/font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vertical-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('frontend/img/unsri.png') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
    <style>
      trix-toolbar [data-trix-button-group="file-tools"]{
        display: none;
      }
    </style>
  </head>
  <body>
    @include('user.layouts.banner')
    <div class="container-scroller">
      @include('user.layouts.header')
      <div class="container-fluid page-body-wrapper">
        @include('user.layouts.setting')
        @include('user.layouts.sidebar')
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('main')
          </div>
          @include('user.layouts.footer')
        </div>
      </div>
    </div>
    <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('backend/js/template.js') }}"></script>
    <script src="{{ asset('backend/js/settings.js') }}"></script>
    <script src="{{ asset('backend/js/todolist.js') }}"></script>
    <script src="{{ asset('backend/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/js/dashboard.js') }}"></script>
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
        <script>
          ClassicEditor
              .create( document.querySelector( '#editor' ) )
              .catch( error => {
                  console.error( error );
              } );
      </script>
  </body>
</html>