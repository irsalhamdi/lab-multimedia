@extends('user.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="comments-area">
            <div class="comment-form">
                <h4>Pesan</h4>
                <form method="POST" action="{{ route('question') }}" class="form-contact comment_form" id="commentForm">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="comment" cols="30" rows="9" required placeholder="Tulis Pesan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

