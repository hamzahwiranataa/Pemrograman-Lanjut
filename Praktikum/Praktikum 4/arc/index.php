<?php
require_once __DIR__ . '/Core/Autoloader.php';


use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\AsistenDosen;
use App\Models\Person;


$persons = [
	new Mahasiswa('1', 'Sergio', '10241035', 'Teknik Analisisis'),
	new Mahasiswa('2', 'Adreas', '73241091', 'Teknik Pertahanan'),
	new Mahasiswa('3', 'Martin', '732410123', 'Teknik Pertahanan'),
	new Dosen('4', 'Budi Santoso', '123456', 'Pemrograman Web'),
	new Dosen('5', 'Dewi Lestari', '654321', 'Basis Data'),
	new AsistenDosen('6', 'Rina Sari', '71083', 'Teknik Informatika', 'Pemrograman Web')
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Demo OOP Lanjutan</title>
	<style>
		table { border-collapse: collapse; width: 100%; }
		th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
		th { background: #f5f5f5; }
	</style>
</head>
<body>
	<h1>Demo OOP Lanjutan</h1>
	<p>Total Instance Person: <?php echo Person::getJumlah(); ?></p>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>NIM/NIDN</th>
				<th>Nama</th>
				<th>Role</th>
				<th>Email</th>
				<th>Introduce()</th>
				<th>Deskripsi</th>
				<th>Teach/Assist</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($persons as $p): ?>
			<tr>
				<td><?php echo htmlspecialchars($p->getId()); ?></td>
				<td>
					<?php 
					if (method_exists($p, 'getNim')) echo htmlspecialchars($p->getNim());
					elseif (method_exists($p, 'getNidn')) echo htmlspecialchars($p->getNidn());
					else echo '-';
					?>
				</td>
				<td><?php echo htmlspecialchars($p->getNama()); ?></td>
				<td><?php echo htmlspecialchars($p->getRole()); ?></td>
				<td><?php echo method_exists($p, 'getEmail') ? htmlspecialchars($p->getEmail()) : '-'; ?></td>
				<td><?php echo htmlspecialchars($p->introduce()); ?></td>
				<td><?php echo htmlspecialchars($p->deskripsi()); ?></td>
				<td>
					<?php 
					if (method_exists($p, 'teach')) echo htmlspecialchars($p->teach('Pemrograman Web'));
					elseif (method_exists($p, 'assist')) echo htmlspecialchars($p->assist());
					else echo '-';
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<br>
	<span>Total : <?php echo Person::getJumlah(); ?></span>
</body>
</html>
