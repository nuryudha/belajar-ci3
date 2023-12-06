<h1>Halaman Mahasiswa</h1>

<a href="<?= base_url('mahasiswa/input_mahasiswa') ?>" class="btn btn-primary">Tambah Data</a>

<?php
//Notif berhasil input
if ($this->session->flashdata('pesan')) {
	echo '<div class="alert alert-success">';
	echo $this->session->flashdata('pesan');
	echo '</div>';

	# code...
}

?>
<table class="table table-bordered" id="dataTable">
	<thead>
		<tr class="text-center">
			<th>No</th>
			<th>NIM</th>
			<th>Nama Mahasiswa</th>
			<th>Tempat, Tanggal Lahir</th>
			<th>Jenis Kelamin</th>
			<th>Fakultas</th>
			<th>Program Studi</th>
			<th>Foto</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		foreach ($mhs as $key => $value) { ?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td class="text-center"><?= $value->nim ?></td>
				<td><?= $value->nama_mahasiswa ?></td>
				<td><?= $value->tempat_lahir ?>, <?= date('d M Y', strtotime($value->tgl_lahir)) ?></td>
				<td class="text-center"><?php if ($value->jenis_kelamin == 'L') {
											echo 'Laki-laki';
										} else {
											echo 'Perempuan';
										} ?>
				</td>
				<td><?= $value->nama_fakultas ?></td>
				<td><?= $value->nama_prodi ?></td>
				<td><img src="<?= base_url('foto') ?>/<?= $value->foto ?>" width="100px"></td>
				<td class="text-center">
					<a href="<?= base_url('mahasiswa/edit_mahasiswa/' . $value->id_mahasiswa) ?>" class="btn btn-warning btn-sm">Edit</a>
					<a href="<?= base_url('mahasiswa/delete_mahasiswa/' . $value->id_mahasiswa) ?>" onclick="return confirm('Yakin data dihapus ?')" class="btn btn-danger btn-sm">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
