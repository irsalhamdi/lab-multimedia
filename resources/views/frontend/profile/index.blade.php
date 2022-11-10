@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Tentang Kami</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="whole-wrap">
		<div class="container box_1170">
			<div class="section-top-border">
				<h3 class="mb-30">Visi</h3>
				<div class="row">
					<div class="col-md-3">
						<img src="img/elements/d.jpg" alt="" class="img-fluid">
					</div>
					<div class="col-md-9 mt-sm-20">
						<p>{!! $profile->vission !!}</p>
					</div>
				</div>
			</div>
			<div class="section-top-border">
				<h3 class="mb-30">Misi</h3>
				<div class="row">
					<div class="col-md-3">
						<img src="img/elements/d.jpg" alt="" class="img-fluid">
					</div>
					<div class="col-md-9 mt-sm-20">
						<p>{!! $profile->mission !!}</p>
					</div>
				</div>
			</div>
			<div class="section-top-border">
				<h3 class="mb-30">Tujuan</h3>
				<div class="row">
					<div class="col-md-3">
						<img src="img/elements/d.jpg" alt="" class="img-fluid">
					</div>
					<div class="col-md-9 mt-sm-20">
						<p>{!! $profile->goal !!}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection