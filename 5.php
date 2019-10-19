<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<head>
		<title></title>
	</head>
	<body>
		<!-- hasil inputan -->
	<?php 
		if (isset($_POST['submit'])){
			$nama = $_POST['nama'];
			$nim = $_POST['nim'];
			$tugas =$_POST['tugas'];
			$uts =$_POST['uts'];
			$uas =$_POST['uas'];
			$hadir =$_POST['hadir'];
			$total =$_POST['total'];
	?>
		<div class="container mb-5 mt-5">
			<div class="text-center mx-auto mb-5">
				<h1>Hasil perhitungan</h1>
			</div>
			<div class="card">
			  <div class="card-body">
			  	Nama : <?= $nama ?> <br>
			  	NIM : <?= $nim ?> <br>
			  	Nilai :
			  	<?php 
			  		if ($uts==0||$uas==0||$tugas==0||$hadir==0) {
			  			echo "E";
			  		}else{
			  			if ($total>=80) {
			  				echo "A";
			  			}elseif ($total>=71 && $total<=79) {
			  				echo "B";
			  			}elseif ($total>=61 && $total<=70) {
			  				echo "C";
			  			}elseif ($total>=50 && $total<=60) {
			  				echo "D";
			  			}elseif ($total<50) {
			  				echo "E";
			  			}
			  		}
			  	 ?>
			  </div>
			</div>
		</div>
	<?php
	exit;
		}
	 ?>
	<!-- form input -->
	<div class="container mb-5 mt-5 shadow">
		<div class="text-center mx-auto mb-5">
			<h1>Mesin penghitungan nilai mahasiswa</h1>
		</div>
		<div>
	 		<form method="post">
			  <div class="form-group">
			    <label for="nama">Nama</label>
			    <input type="text" required="" name="nama" class="form-control" id="nama" placeholder="input nama">
			  </div>
			  <div class="form-group">
			    <label for="NIM">NIM</label>
			    <input required type="text" name="nim" class="form-control" id="NIM" placeholder="input NIM">
			  </div>
			  <div class="form-group">
			    <label for="hadir">Jumlah Hadir</label>
			    <input name="hadir" required type="number" max="14" min="0" class="form-control" id="hadir" placeholder="input kehadir">
			  </div>
			  <div class="form-group">
			    <label for="tugas">Nilai Tugas</label>
			    <input onkeyup="sum();" name="tugas" required type="number" max="100" min="0" class="form-control" id="tugas" placeholder="input nilai tugas">
			  </div>
			  <div class="form-group">
			    <label for="UTS">Nilai UTS</label>
			    <input onkeyup="sum();" name="uts" required type="number" max="100" min="0" class="form-control" id="UTS" placeholder="input nilai UTS">
			  </div>
			  <div class="form-group">
			    <label for="UAS">Nilai UAS</label>
			    <input onkeyup="sum();" name="uas" required type="number" max="100" min="0" class="form-control" id="UAS" placeholder="input nilai UAS">
			  </div>
			  <div class="form-group">
			    <label for="Total">Nilai Total</label>
			    <input  name="total" readonly type="text" class="form-control" max="100" min="0" id="Total" placeholder="input nilai Total">
			  </div>
			  <button name="submit" type="submit" class="btn btn-primary btn-block">Simpan</button>
			</form>
		</div>
	</div>
</body>
<script>
	function sum() {
	      var tugas = 20/100*document.getElementById('tugas').value;
	      var uas = 40/100*document.getElementById('UAS').value;
	      var uts = 30/100*document.getElementById('UTS').value;
	      var hadir = document.getElementById('hadir').value/14*10/100*100;
	      var result = parseInt(tugas) + parseInt(uas) + parseInt(hadir) + parseInt(uts);
	      if (!isNaN(result)) {
	         document.getElementById('Total').value = result;
	      }
	}
</script>
</html>