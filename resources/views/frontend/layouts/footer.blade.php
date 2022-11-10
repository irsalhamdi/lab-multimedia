<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="newsLetter_wrap">
                <div class="row justify-content-between">
                    <div class="col-md-7">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Tetap Update
                            </h3>
                            <form method="POST" action="{{ route('subscribe') }}" class="newsletter_form">
                                @csrf
                                <input type="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" placeholder="Alamat Email" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <button type="submit">Berlangganan Sekarang</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Social Media
                            </h3>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a target="_blank" href="https://www.instagram.com/labmulmedfasilkomunsri/">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://www.instagram.com/labmulmedfasilkomunsri/">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://www.instagram.com/labmulmedfasilkomunsri/">
                                            <i class="ti-email"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://www.instagram.com/labmulmedfasilkomunsri/">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Tentang Kami
                        </h3>
                        <ul>
                            <li><a href="#">{{ $contact->province->name }}, {{ $regency->name }}, {{ $district->name }}, {{ $village->name }}</a></li>
                            <li><a href="#">{{ $contact->address }}, {{ $contact->zip_code }}</a></li>
                            <li><a href="#">{{ $contact->phone }}</a></li>
                            <li><a href="#">{{ $contact->email }}</a></li>
                            <li><a href="#">Senin - jumat 9:00 s/d 16:00 WIB</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-12">
                    <p class="copy_right text-center">
                        <p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <a>Lab Multimedia</a>
                        </p>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>