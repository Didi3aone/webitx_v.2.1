<!DOCTYPE html>
<html>
<head>
	<title>NDA</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style>
	/** {
	  box-sizing: border-box;
	}*/

	/* Create two equal columns that floats next to each other */
	.column {
	  /*float: left;*/
	  width: 100%;
	  /*padding: 10px;*/
	  /*margin-left: 30%;*/
	  height: auto; /* Should be removed. Only for demonstration */
	}

	/* Clear floats after the columns */
	.row:after {
	  content: "";
	  display: table;
	  clear: both;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
		  	<div class="column">
		    	<p>
		    		<?php
		    			$mitra_name = $mitra['mitra_name'];
		    			$today 		= date('d M Y');
		    			$address	= $mitra['city'];
		    			$pic_mitra  = $mitra['owner'];

		    			$text = '<b><center>PERJANJIAN KERAHASIAAN</center></b>
					<b><center>ANTARA</center></b>
					<b><center>ITX</center></b>
					<b><center>DAN</center></b>
					<b><center>PT.'.$mitra_name.'</center></b>
					Perjanjian Kerahasiaan ini (selanjutnya disebut “Perjanjian”) ditandatangani pada tanggal 
					'.$today.' (selanjutnya disebut “Tanggal Efektif”) oleh dan antara:
					  
					PT.	ITX, suatu perseroan terbatas yang didirikan berdasarkan hukum negara Republik Indonesia, berdomisili di Jl. K.H. Wahid Hasyim No.147, Jakarta Pusat 10240, Indonesia, dalam hal ini diwakili oleh  Edward Nelson Jusuf, dalam jabatannya selaku Direktur Utama dari dan karenanya sah bertindak untuk dan atas nama ITX; and
					PT.	'.$mitra_name.', suatu perseroan terbatas yang didirikan berdasarkan hukum negara Republik Indonesia, berdomisili di '.$address.', dalam hal ini diwakili oleh  '.$pic_mitra.', dalam jabatannya selaku Direktur Utama dari dan karenanya sah bertindak untuk dan atas nama PT. '.$mitra_name.'
					Masing-masing disebut Pihak, dan secara bersama-sama disebut Para Pihak.
					<b><center>KONSIDERANS</center></b>
					Para Pihak sedang menjajaki kerjasama bisnis yang saling menguntungkan (selanjutnya disebut “Hubungan Bisnis”). Para Pihak mengakui bahwa dalam proses diskusi untuk menyelenggarakan Hubungan Bisnis, masing-masing Pihak akan perlu mengungkapkan informasi rahasia tertentu kepada Pihak Lainnya (sebagaimana didefinisikan di bawah). Untuk itu perlu ditetapkan ketentuan guna mengatur pengungkapan Informasi Rahasia tersebut. 

					Pihak yang mengungkapkan informasi yang bersifat rahasia selanjutnya disebut “Pihak Yang Mengungkapkan” dan Pihak yang menerima informasi yang bersifat rahasia disebut “Pihak Yang Menerima”


					Pihak Yang Mengungkapkan dan Pihak Yang Menerima selanjutnya masing-masing disebut “Pihak”, dan bersama-sama disebut “Para Pihak”.

					Oleh karena itu, Para Pihak bermaksud untuk mengatur tentang pengungkapan, penggunaan, dan perlindungan Informasi Rahasia. Berdasarkan hal-hal tersebut di atas, Para Pihak menyetujui hal-hal sebagai berikut:
					<b><center>Pasal 1
					Definisi</center></b>

					1.Dalam Perjanjian ini, “Informasi Rahasia” adalah semua informasi yang bersifat rahasia dalam segala bentuk dan yang diungkapkan dengan segala cara dari satu Pihak (“Pihak yang Mengungkapkan”) beserta Afiliasinya kepada Pihak lainnya (“Pihak yang Menerima”) beserta Afiliasinya, sehubungan dengan Maksud, termasuk, tetapi tidak terbatas pada, data-data, teknologi, pengetahuan, dokumen-dokumen, spesifikasi, informasi tentang pekerjaan riset serta pengembangan, dan/atau rahasia dagang dan usaha, rencana pemasaran dan usaha, anggaran, proyeksi dan analisis, informasi keuangan, dan informasi konsumen. Jika Informasi Rahasia berwujud, hanya apabila diberi tanda secara jelas sebagai rahasia ketika diungkapkan kepada Pihak yang Menerima, atau jika tidak berwujud, kerahasiaan dari informasi tersebut harus diberitahukan terlebih dahulu, dan dituangkan secara tertulis serta diberikan kepada Pihak yang Menerima dalam waktu 30 hari dari saat pengungkapan pertama, namun tidak dilakukannya hal tersebut, tidak dapat dianggap sebagai penyimpangan hak Pihak yang Mengungkapkan atas informasi yang diketahui oleh Pihak yang Menerima atau yang biasa berlaku dalam dunia usaha patut diketahuinya, sebagai rahasia.

					2.Pihak yang Mengungkapkan berhak menentukan sesuai kebijakannya sendiri macam Informasi Rahasia yang akan diungkapkan kepada Pihak lainnya.

					3.	Dalam Perjanjian ini, “Afiliasi” dari suatu Pihak berarti suatu entitas yang mengendalikan, dikendalikan oleh, atau berada dalam kendali yang sama dengan Pihak tersebut, dan “kendali” berarti kekuasaan untuk menentukan kebijakan manajemen dari entitas tersebut, secara langsung atau tidak langsung, melalui kepemilikan mayoritas hak suara dari sahamnya, atau untuk menunjuk mayoritas anggota manajemennya, atau berdasarkan perjanjian, atau lainnya.
					<b><center>Pasal 2
					Tanpa Lisensi</center></b>

					Perjanjian ini tidak memberikan hak kekayaan intelektual atau industri atau lisensi atas Informasi Rahasia kepada Pihak yang Menerima, baik secara langsung atau tersirat, atau lainnya.
									<b><center>Pasal 3
					Kerahasiaan Informasi Rahasia</center></b>


					1.	Pihak yang Menerima menyetujui untuk tidak menyalin dan/atau menggunakan Informasi Rahasia kecuali untuk Maksud. Pihak yang Menerima menyetujui untuk menjaga kerahasiaan Informasi Rahasia dan mengambil langkah-langkah yang wajar untuk melindungi Informasi Rahasia termasuk, tetapi tidak terbatas pada, langkah-langkah yang diambil untuk melindungi informasi rahasianya sendiri.

					2.	Pihak yang Menerima menyetujui bahwa Informasi Rahasia dibatasi pengungkapannya hanya kepada pegawainya, direkturnya, atau kontraktornya yang perlu mengetahui untuk Maksud dan yang terikat pada kewajiban kerahasiaan yang melarang pengungkapan lebih lanjut dari Informasi Rahasia dan Pihak yang Menerima tidak akan mengungkapkan atau memberikan Informasi Rahasia kepada pihak ketiga mana pun tanpa izin tertulis dari Pihak yang Mengungkapkan, kecuali: (a) kepada Afiliasinya, yang perlu untuk mengetahuinya dan dengan ketentuan Afiliasi tersebut setuju untuk terikat pada ketentuan Perjanjian ini seolah-olah tercantum sebagai pihak dalam Perjanjian ini serta menggunakan Informasi Rahasia hanya untuk Maksud, atau (b) pihak yang berwenang sebagaimana disyaratkan oleh ketentuan perundang-undangan yang berlaku.

						<b><center>Pasal 4
						Pengecualian</center></b>

					Informasi Rahasia tidak termasuk informasi yang:


					a.telah diketahui umum pada saat pengungkapan, yang bukan disebabkan oleh kesalahan Pihak yang Menerima;

					b.menjadi diketahui oleh umum, yang bukan disebabkan oleh kesalahan Pihak yang Menerima dengan melanggar Perjanjian ini;

					c.diungkapkan kepada Pihak yang Menerima oleh pihak ketiga yang tidak, sepanjang pengetahuan Pihak yang Menerima, melanggar kewajiban kerahasiaan dan yang dapat diungkapkan tanpa pembatasan;

					d.telah diketahui atau secara independen dikembangkan oleh Pihak yang Menerima tanpa menggunakan Informasi Rahasia, dengan ketentuan Pihak yang Menerima dapat membuktikan hal tersebut;

					e.diungkapkan berdasarkan putusan pengadilan atau badan pemerintahan lain atau ketentuan perundang-undangan, dengan ketentuan Pihak yang Menerima, atas permintaan Pihak yang Mengungkapkan, melakukan tindakan-tindakan yang wajar untuk membatasi pengungkapan tersebut sejauh yang diminta putusan atau ketentuan tersebut; atau
						diungkapkan berdasarkan izin tertulis dari Pihak yang Mengungkapkan.
						
						<b><center>Pasal 5
						Pengembalian Barang-Barang</center></b>

					Dengan berakhirnya waktu Perjanjian ini atau diputuskannya Perjanjian ini atau berdasarkan permintaan tertulis dari Pihak yang Mengungkapkan, Pihak yang Menerima harus mengembalikan kepada Pihak yang Mengungkapkan, dan/atau menghapuskan semua berkas komputer, dan/atau menghancurkan berdasarkan instruksi tertulis Pihak yang Mengungkapkan, atas biaya Pihak yang Menerima, semua Informasi Rahasia yang berwujud yang ada dalam penguasaannya beserta salinannya

						<b><center>Pasal 6
						Tanpa Jaminan dan Penyerahan Hak Milik</center></b>

						1.Informasi Rahasia dan salinannya tetap menjadi milik Pihak yang Mengungkapkan. Pihak yang Mengungkapkan menyatakan bahwa dirinya berhak membuat pengungkapan tersebut berdasarkan Perjanjian ini. Informasi Rahasia yang diungkapkan berdasarkan Perjanjian ini diberikan “apa adanya” dan Pihak yang Mengungkapkan tidak memberikan jaminan atas kelengkapan, ketepatan, kesesuaian untuk maksud tertentu dari Informasi Rahasia, atau segala penggunaan hasil dari Informasi Rahasia dan tidak dilanggarnya hak milik industri atau intelektual pihak ketiga.

						Perjanjian ini tidak menghalangi suatu Pihak untuk membuat, menggunakan, memasarkan, melisensi, atau menjual segala teknologi, produk, atau barang yang dikembangkan secara mandiri, baik yang serupa atau berhubungan dengan Informasi Rahasia yang diungkapkan berdasarkan Perjanjian ini, dengan ketentuan Pihak tersebut tidak melakukannya dengan melanggar Perjanjian ini.

						<b><center>Pasal 7
						Jangka Waktu dan Pemutusan</center></b>

						1.Perjanjian ini berlaku pada Tanggal Efektif dan berakhir dalam waktu 1 (Satu) tahun dari tanggal Perjanjian. Setiap Pihak berhak memutuskan Perjanjian ini dengan pemberitahuan 30 hari sebelumnya. Kewajiban Pihak yang Menerima atas Informasi Rahasia tetap berlaku selamanya walaupun Perjanjian ini telah berakhir atau diputuskan.

						2.Ketentuan Perjanjian ini juga berlaku surut terhadap Informasi Rahasia yang diungkapkan sehubungan dengan Maksud sebelum Tanggal Efektif. 

						3.Untuk pemutusan Perjanjian ini, Para Pihak sepakat untuk menyampingkan Pasal 1266 dan Pasal 1267 Kitab Undang-Undang Hukum Perdata.
						Pasal 8
						Hukum yang Berlaku 
						dan 
						Penyelesaian Perselisihan

						1.Perjanjian ini tunduk kepada, dan ditafsirkan berdasarkan hukum Republik Indonesia, dengan mengecualikan prinsip hukum perselisihannya. 

						Segala perselisihan yang timbul dari pelaksanaan atau penafsiran Perjanjian ini, yang tidak dapat diselesaikan oleh Para Pihak secara musyawarah, pada akhirnya akan diselesaikan berdasarkan peraturan administrasi dan prosedur Badan Arbitrase Nasional Indonesia (selanjutnya disebut “Peraturan”) oleh 3 arbiter yang ditunjuk berdasarkan Peraturan kecuali Para Pihak setuju atas 1 arbiter. Arbitrase dilangsungkan di Jakarta dan bahasa Indonesia dan/atau Inggris digunakan dalam beracara. Putusan BANI bersifat final dan mengikat Para Pihak.

						<b><center>Pasal 8
						Hukum yang Berlaku 
						dan 
						Penyelesaian Perselisihan</center></b>

						1.Perjanjian ini tunduk kepada, dan ditafsirkan berdasarkan hukum Republik Indonesia, dengan mengecualikan prinsip hukum perselisihannya. 

						2.Segala perselisihan yang timbul dari pelaksanaan atau penafsiran Perjanjian ini, yang tidak dapat diselesaikan oleh Para Pihak secara musyawarah, pada akhirnya akan diselesaikan berdasarkan peraturan administrasi dan prosedur Badan Arbitrase Nasional Indonesia (selanjutnya disebut “Peraturan”) oleh 3 arbiter yang ditunjuk berdasarkan Peraturan kecuali Para Pihak setuju atas 1 arbiter. Arbitrase dilangsungkan di Jakarta dan bahasa Indonesia dan/atau Inggris digunakan dalam beracara. Putusan BANI bersifat final dan mengikat Para Pihak.



						<b><center>Pasal 9
						Pemulihan</center></b>

						Karena pengungkapan atau penggunaan Informasi Rahasia yang tidak sah akan mengurangi nilai hak kepemilikan dari Informasi Rahasia, Pihak yang Menerima menyatakan dan menyetujui bahwa ganti rugi bukanlah suatu pemulihan yang mencukupi dan karenanya, jika Pihak yang Menerima (atau Afiliasinya) melanggar kewajibannya berdasarkan Perjanjian ini, selain mendapatkan ganti rugi, Pihak yang Mengungkapkan berhak atas pemulihan lainnya berdasarkan hukum.
						<b><center>Pasal 10
						Lain-lain</center></b>

						1.Hubungan Para Pihak adalah hubungan yang independen. Perjanjian ini tidak membuktikan atau membuat suatu perwakilan, persekutuan, atau hubungan lainnya yang serupa antara Para Pihak. Setiap Pihak tidak berhak menggunakan nama, nama dagang, merek dagang, merek jasa, atau tanda lainnya dari Pihak lain dalam advertensi, publisitas, atau kegiatan lainnya.

						2.Jika salah satu ketentuan Perjanjian tidak dapat diberlakukan, Para Pihak sepakat bahwa ketidakberlakuan tersebut tidak mempengaruhi keberlakuan dari ketentuan yang lain dalam Perjanjian, dan selanjutnya Para Pihak sepakat untuk mengganti ketentuan yang tidak berlaku tersebut dengan ketentuan yang berlaku yang sedapat mungkin mencerminkan maksud semula dari Para Pihak.

						3.Perjanjian ini tidak dapat dialihkan oleh salah satu Pihak tanpa izin tertulis Pihak lainnya. Pihak yang Menerima akan memberitahukan Pihak yang Mengungkapkan jika terjadi perubahan substansial terhadap kepemilikan atau hak atas saham yang mempengaruhi manajemen atau kendali dari Pihak yang Menerima.

						4.Pengabaian salah satu Pihak untuk mengharuskan Pihak lainnya dalam melaksanakan secara seksama ketentuan Perjanjian ini bukan dianggap sebagai penyampingan hak selanjutnya untuk mengharuskan pelaksanaan ketentuan tersebut atau ketentuan lainnya dari Perjanjian ini.

						5.Perjanjian ini termasuk konsideransnya merupakan pernyataan kesepakatan Para Pihak yang lengkap dan eksklusif, dan menghapuskan semua kesepakatan lainnya, secara lisan maupun tulisan, yang berhubungan dengan Maksud. Perjanjian ini hanya dapat diubah berdasarkan kesepakatan tertulis yang ditandatangani oleh Para Pihak.

						6.Segala pemberitahuan atau dokumen yang diperlukan sehubungan dengan Perjanjian ini harus secara tertulis dan dikirimkan dan dianggap telah diberikan sebagaimana ditentukan sebagai berikut: (a) dikirimkan secara langsung atau melalui kurir pada tanggal penerimaan yang tercantum dalam tanda terima dari penerima atau konfirmasi pengiriman yang diterima pengirim dari kurir, (b) dikirimkan melalui faksimile, berdasarkan bukti pengiriman faksimile yang berhasil, dan (c) dikirimkan melalui e-mail, berdasarkan bukti pengiriman e-mail yang berhasil. Pemberitahuan atau dokumen dikirimkan kepada alamat yang tertera di atas atau alamat lainnya yang diberitahukan secara tertulis oleh tiap Pihak. 


						7.Setiap judul dari pasal-pasal atau bagian lain Perjanjian hanya untuk memudahkan pembacaan Perjanjian dan tidak mempengaruhi penafsiran Perjanjian.

						8.Perjanjian ini dibuat dalam bahasa Indonesia dan Inggris. Jika terdapat perbedaan penafsiran, versi bahasa Indonesia yang berlaku.


						<b>Demikian</b> Perjanjian ini dilaksanakan dan ditandatangani oleh Para Pihak yang berwenang pada hari dan tahun sebagaimana tersebut pada awal Perjanjian.
						<br><br>
						<div class="col-md-4">
							<u style="margin-left:40px;"><b>ITX</b></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>ITX</u></b><br><br><br>

							<u style="margin-left:40px;"><b>Jeami Gumilarsjah</b></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b>'.$mitra_name.'</b></u><br/>
							<div style="margin-left:0px;"><p style="line-height: 1.5em;">'.ucfirst('Director').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.ucfirst('Director').'</p></div>
							
						</div>
						<div class="col-md-4">
						</div>
					';
		    			echo auto_format_paragraph($text);
		    		?>
		    		

		    	</p>
		  	</div>
		  	
		</div>
	</div>
</body>
</html>