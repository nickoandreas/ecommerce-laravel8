<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
<div class="flex-w p-b-90">
<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
	<h4 class="s-text12 p-b-30">
		Alamat Kantor Kami
	</h4>
<div class='s-text7'>

<div style="width: 15px; height: 25px;" class="float-left mr-2 "><i class="fa fa-map-marker"></i></div>
<div class="p-b-10">{{$data['konfigurasi']->alamat}}</div>

<p class="s-text7 ">
	<i class="fa fa-envelope-open mr-2 p-b-10"></i> {{$data['konfigurasi']->email}}<br>

	<i class="fa fa-phone mr-2 "></i> {{$data['konfigurasi']->telepon}}
</p>

</div>

</div>


<div class="w-size15 p-t-30 p-l-15 p-r-15 respon4">
	<h4 class="s-text12 p-b-30">
		Part Motor
	</h4>
	
	<ul>
   @for($i=0; $i < count($data['kategori2']); $i++) 
	@php $kategori2 = $data['kategori2'][$i] @endphp
		<li>
			<a class='s-text7' href="/produk/kategori2/{{$kategori2->slug_kategori}}">{{$kategori2->nama_kategori}}</a>
		</li>
 	@endfor
	</ul>

</div>

<div class="w-size15 p-t-30 p-l-15 p-r-15 respon4">
	<h4 class="s-text12 p-b-30">
		Part Mobil
	</h4>
	
	<ul>
   @for($i=0; $i < count($data['kategori4']); $i++)
	@php $kategori4 = $data['kategori4'][$i] @endphp		
		<li >
			<a class='s-text7' href="/produk/kategori4/{{$kategori4->slug_kategori}}">{{$kategori4->nama_kategori}}</a>
		</li>
 	@endfor
	</ul>

</div>


<div class="w-size9 p-t-30 p-l-15 p-r-15 respon4">

	<h4 class="s-text12 p-b-30">Link</h4>

	<ul>	

		<li>
			<a href="/produk" class="s-text7">Semua Produk</a>
		</li>

		<li>
			<a href="/dashboard" class="s-text7">Konfirmasi Pembayaran</a>
		</li>

		<li>
			<a href="/dashboard/belanja" class="s-text7">PesananKu</a>
		</li>


	</ul>

</div>


</footer>

<script type="text/javascript" src="{{asset('assets/template/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/vendor/bootstrap/js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/vendor/animsition/js/animsition.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/vendor/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/template/js/slick-custom.js')}}"></script>
<script src="{{asset('assets/template/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/template/js/main.js')}}"></script>
<script src="{{asset('assets/template/js/cart-alert.js')}}"></script>

<!-- api rajaongkir -->
<script type='text/javascript'>

	let id_kotaTujuan = $('input[name=id_tujuan]').val() 
	let id_provinsi = $('input[name=id_tujuan_provinsi').val()

	if(id_kotaTujuan && id_provinsi != undefined) {
		// ambil nama kota (tujuan)
		$.ajax({
			url: '/datakota/nama_kota/'+id_kotaTujuan+'/'+id_provinsi,
			type: 'GET',
			success: function(hasil) {
				$('input[name=kota]').val(hasil)
			}
		})

		// ambil nama provinsi (tujuan)
		$.ajax({
			url: '/datakota/nama_provinsi/'+id_kotaTujuan+'/'+id_provinsi,
			type: 'GET',
			success: function(hasil) {
				$('input[name=provinsi]').val(hasil)
			}
		})
		

  
	// format rupiaah
	function rubah(angka){
		var reverse = angka.toString().split('').reverse().join(''),
		ribuan = reverse.match(/\d{1,3}/g);
		ribuan = ribuan.join('.').split('').reverse().join('');
		return ribuan;
	}
		
	// berat
	let berat = parseInt($('input[name=berat]').val())
	$('.total-berat').html(rubah(berat/1000)+' Kg')

	// ongkir dan total
	$('select[name=layanan]').on('change', function() {
		let ongkir = parseInt($('option:selected', this).attr('harga'))
		let tes = $('option:selected', this).hasClass('opt-layanan')
		let pembelian = parseInt($('input[name=jumlah_transaksi]').val())
		let total = ongkir + pembelian

		if(tes === true) {
			
			$('.ongkir').html('IDR. '+rubah(ongkir))
			$('.total-belanja').html('IDR. '+rubah(total))
			$('input[name=ongkir]').val(ongkir)

		} else {

			$('.ongkir').html('IDR. 0')
			$('.total-belanja').html('-')
		}

	})

	//layanan expedisi
	$('select[name=expedisi]').on('change', function() {
		$('option').remove('.opt-layanan')
		let origin = $('input[name=asal]').val()
		let destination = $('input[name=id_tujuan]').val()
		let weight = $('input[name=berat]').val()
		let kurir = $('option:selected', this).val()

		$.ajax({
			url: '/datakota/layanan/'+origin+'/'+destination+'/'+weight+'/'+kurir,
			type: 'GET',
			success: function(hasil) {
				$('select[name=layanan]').append(hasil)
			}

		})
		
	})

}

	// datakota
	$(".regis-provinsi").on('change', function() {
			$('option').remove('.opt')
			let id_provinsi = $('option:selected', this).attr('id_provinsi')
			if(id_provinsi) {
			$.ajax({
			url: '/datakota/kotaaja/'+id_provinsi,
			type: 'GET',
			success: function(hasil) {

				$(".regis-kota").append(hasil)
				
			}
			})
		}
	}) 

  	//datakotaupdate
	$(document).ready(function() {
		let id_provinsi = $('option:selected', this).attr('id_provinsi')
		if(id_provinsi) {
		$.ajax({
			url: '/datakota/kotaById/'+id_provinsi,
			type: 'GET',
			success: function(hasil) {
				$(".profile-kota").append(hasil)
			}
		})

		$('.profile-provinsi').on('change', function() {
			$('option').remove('.opt')
			let id_provinsi = $('option:selected', this).attr('id_provinsi')
			$.ajax({
				url: '/datakota/kotaaja/'+id_provinsi,
				type: 'GET',
				success: function(hasil) {

					$(".profile-kota").append(hasil)

				}
			})
		})
	 }
	})
</script>

<!-- livesearch/autocomplete ajax -->
<script type='text/javascript'>

	$(document).ready(function() {
	
	$('.nav-cari').on('click', function() {
		$('#keyword').val('')
		$('#result').html('')
	})

	$('#keyword').on('keyup', function() {
		let keyword = $('#keyword').val()
		if(keyword == ''){
			keyword = 'tidak ada';
		} 
		$.ajax({
			url : "/produk/get_produk/"+keyword,
			type: "GET",
			success : function(data) {
				$('#result').html('')
				$('#result').append(data)
			}
		})

	})

	})
	
	// autocomplete mobile
	$(document).ready(function() {
	
	$('.nav-cari-mobile').on('click', function() {
		$('#keyword-mobile').val('')
		$('#result-mobile').html('')
	})

	$('#keyword-mobile').on('keyup', function() {
		let keyword = $('#keyword-mobile').val()
		if(keyword == ''){
			keyword = 'tidak ada';
		} 
		$.ajax({
			url : "/produk/get_produk/"+keyword,
			type: "GET",
			success : function(data) {
				$('#result-mobile').html('')
				$('#result-mobile').append(data)
			}
		})
		
	})

	})


</script>
</body>
</html>