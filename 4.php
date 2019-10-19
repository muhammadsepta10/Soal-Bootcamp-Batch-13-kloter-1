<?php
function parkir($time)
{
	if ($time <= 3) {
		$hasil = $time * 2000;
		return $hasil;
	} elseif ($time > 3) {
		$hasil = ($time - 3) * 1000 + 6000;
		if ($hasil >= 10000) {
			return 10000;
		} elseif ($hasil < 10000) {
			return $hasil;
		}
	}
}
$waktu = 6; //ganti value variable waktu
$bayar = parkir($waktu);
echo 'lama waktu parkir dalam' . ' ' . $waktu . ' jam adalah ' . $bayar;
