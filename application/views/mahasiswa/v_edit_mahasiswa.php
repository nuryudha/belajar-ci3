<!-- Basic Card Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
	</div>
	<div class="card-body">

		<?php
		// Notif validasi form
		echo  validation_errors('<div class="col-lg-12"><div class="card bg-danger text-white shadow"><div class="card-body">', '</div></div></div>');

		// Notif error upload (gagal)
		if (isset($error_upload)) {
			echo '<div class="col-lg-12"><div class="card bg-danger text-white shadow"><div class="card-body">' . $error_upload, '</div></div></div>';
		}
		?>

		<?php echo form_open_multipart('mahasiswa/edit_mahasiswa/' . $mhs->id_mahasiswa) ?>
		<div class="form-group">
			<label for="nim">NIM</label>
			<input id="nim" name="nim" type="text" class="form-control" placeholder="NIM" value="<?= $mhs->nim ?>">
		</div>

		<div class="form-group">
			<label for="nama_mahasiswa">Nama Mahasiswa</label>
			<input id="nama_mahasiswa" name="nama_mahasiswa" type="text" class="form-control" placeholder="Nama Mahasiswa" value="<?= $mhs->nama_mahasiswa ?>">
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="tempat_lahir">Tempat Lahir</label>
					<input id="tempat_lahir" name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir" value="<?= $mhs->tempat_lahir ?>">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="tgl_lahir">Tanggal Lahir</label>
					<input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control" value="<?= $mhs->tgl_lahir ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="jenis_kelamin" class="form-control">
						<option value="">--Jenis Kelamin--</option>
						<option value="L" <?= $mhs->jenis_kelamin == 'L' ? 'selected' : '' ?>>Laki Laki</option>
						<option value="P" <?= $mhs->jenis_kelamin == 'P' ? 'selected' : '' ?>>Perempuan</option>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Fakultas</label>
					<select name="id_fakultas" class="form-control">
						<option value="">--Pilih Fakultas--</option>
						<?php foreach ($fakultas as $key => $value) { ?>
							<option value="<?= $value->id_fakultas ?>" <?= $value->id_fakultas == $mhs->id_fakultas ? 'selected' : '' ?>><?= "$value->nama_fakultas" ?></option>
						<?php } ?>

					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Program Studi</label>
					<select name="id_prodi" class="form-control">
						<option value="">--Pilih Program Studi--</option>
						<?php foreach ($prodi as $key => $value) { ?>
							<option value="<?= $value->id_prodi ?>" <?= $value->id_prodi == $mhs->id_prodi ? 'selected' : '' ?>><?= "$value->nama_prodi" ?></option>
						<?php } ?>

					</select>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label>Foto</label>
					<input id="preview_gambar" name="foto" type="file" class="form-control" accept="image/*">
				</div>
			</div>
			<div class="col-sm-8">
				<div class="form-group">
					<label>Preview Foto</label><br>
					<img src="<?= base_url('foto/' . $mhs->foto) ?>" alt="" id="gambar_load" width="250px">
				</div>
			</div>
		</div>


		<div class="form-group">
			<button class="btn btn-primary" type="submit">Save</button>
			<a href="<?= base_url('mahasiswa/index') ?>" class="btn btn-danger">Back</a>
		</div>

		<?php echo form_close() ?>

	</div>
</div>

<script>
	function bacaGambar(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#gambar_load').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0])

		}
	}

	$('#preview_gambar').change(function() {
		bacaGambar(this)
	});
</script>
