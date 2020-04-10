<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">			
				<form action="<?= site_url('myigniter/setoranSubmit') ?>" method="POST" role="form">
					<div class="form-group">
						<label for="">Penyetor</label>
						<input type="text" class="form-control" name="nama" required="required">						
					</div>
					<div class="form-group">
						<label for="">Tanggal Jual</label>
						<select name="tgljual" class="form-control" required="required">
							<?php foreach ($setoran->result() as $row): ?>
								<option value="<?= $row->tgl ?>"><?= $row->tgl ?></option>
							<?php endforeach ?>
						</select>					
					</div>
					<div class="form-group">
						<label for="">Setoran</label>
						<input type="text" class="form-control" name="setor" required="required">
					</div>				
					<button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<h2>Riwayat Setoran</h2>
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-hover client">
						<thead>
							<tr>
								<th>Penyetor</th>
								<th>Tanggal Jual</th>
								<th>Tanggal Setor</th>
								<th>Total Jual</th>
								<th>Total Setor</th>
								<th>Selisih</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($setoran_selesai->result() as $row): ?>
							<tr>
								<td><?php echo $row->penyetor; ?></td>
								<td><?php echo date('d F Y', strtotime($row->tgl_jual)); ?></td>
								<td><?php echo date('d F Y', strtotime($row->tgl_setor)); ?></td>
								<td><?php echo $row->total_jual; ?></td>
								<td><?php echo $row->total_setor; ?></td>
								<td><?php echo $row->selisih; ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
