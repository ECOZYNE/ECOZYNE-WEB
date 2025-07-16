<footer id="footer" class="footer" style="box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="d-flex align-items-center">
          <img src="{{ asset('../assets2/img/ecozyne.png') }}" alt="Ecozyne Logo"
            style="height: 40px; margin-right: 10px;">
          <span class="sitename">Ecozyne</span>
        </a>

        <div class="footer-contact pt-3">
          <p>Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota</p>
          <p>Kota Batam, Kepulauan Riau 29461</p>
          <p class="mt-3"><strong>Telp:</strong> <span>+62 878-4203-3231</span></p>
          <p><strong>Email:</strong> <span>ecozyne@gmail.com</span></p>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Tautan Cepat</h4>
        <ul>
          <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
              </i>Beranda
            </a></li>
          <li><a href="{{ url('tentang-eco-enzim') }}" class="{{ request()->is('tentang-eco-enzim') ? 'active' : '' }}">
              </i>Tentang Kami
            </a></li>
          <li><a href="{{ url('kegiatan') }}" class="{{ request()->is('kegiatan') ? 'active' : '' }}">
              </i>Kegiatan
            </a></li>
          <li><a href="{{ url('artikel') }}" class="{{ request()->is('artikel') ? 'active' : '' }}">
              </i>Artikel
            </a></li>
          <li><a href="{{ url('bank_sampah') }}" class="{{ request()->is('bank_sampah') ? 'active' : '' }}">
              </i>Bank Sampah
            </a></li>
          <li><a href="{{ url('hadiah') }}" class="{{ request()->is('hadiah') ? 'active' : '' }}">
              </i>Hadiah
            </a></li>
        </ul>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="map-container">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3038.540186967666!2d104.04639665762097!3d1.1186615015316728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e1!3m2!1sid!2sid!4v1735045068555!5m2!1sid!2sid"
            width="100%" height="180" style="border: 0; display: block;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">Ecozyne</strong> <span>All Rights Reserved</span>
    </p>
    <div class="credits">
    </div>
  </div>

</footer>