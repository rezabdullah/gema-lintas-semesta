@extends('main', ['title' => 'Profil Perusahaan'])

@section('content-page')
	<main id="about" class="about section-bg">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Layanan & produk kami</h2>
			</div>

			<div class="row">
				<div class="col-lg-12 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
					<h4 class="mt-3 mb-0">PRODUK</h4>

					<ul>
						<li>
							<i class="bx bx-check-square"></i>
							<div>
								<h5>ONS (Over Night Services)</h5>
								<p>Produk ONS adalah kiriman yang hanya membutuhkan waktu 1 (satu) hari saja untuk pengantaran ketempat tujuan, sehingga anda tidak perlu menunggu dengan waktu yang lama</p>
							</div>
						</li>
						<li>
							<i class="bx bx-check-square"></i>
							<div>
								<h5>TDS (Two Days Services)</h5>
								<p>Hanya membutuhkan 2 (dua) hari saja agar kiriman anda bisa sampai di tempat tujuan </p>
							</div>
						</li>
						<li>
							<i class="bx bx-check-square"></i>
							<div>
								<h5>REG (Regular)</h5>
								<p>Produk regular menjangkau seluruh wilayah Indonesia hanya dalam waktu kurang dari 7 (tujuh) hari kerja, maka kiriman anda akan segera tiba</p>
							</div>
						</li>
					</ul>

					<h4 class="mt-3 mb-0">LAYANAN</h4>

					<ul>
						<li>
							<i class="bx bx-check-square"></i>
							<div>
								<h5>Asuransi</h5>
								<p>Asuransikanlah dokumen penting atau barang anda yang bernilai demi kenyamanan dalam pengiriman. Dengan senang hati petugas kami akan siap membantu anda.</p>
							</div>
						</li>
						<li>
							<i class="bx bx-check-square"></i>
							<div>
								<h5>Packing</h5>
								<p>Untuk menambah kenyamanan dan keamanan kiriman anda kami menuediakan servis packing, sampaikan kepada petugas kami bila anda memerlukan servis ini. Dengan senang hati petugas kami akan siap membantu anda.</p>
							</div>
						</li>
						<li>
							<i class="bx bx-check-square"></i>
							<div>
								<h5>Repack</h5>
								<p>Layanan tambahan untuk kiriman yang kemasannya dinilai kurang/tidak laik untuk dikirim dan atau kiriman yang belum dikemas. Dengan senang hati petugas kami akan siap membantu anda.</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</main>
@endsection