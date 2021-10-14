<div class="card">
	<div class="card-body">
		<div class="container-fluid">
			<div class="row mb-3">
				<div class="col-md-12">
					<h4>ลูกค้า</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ลำดับ.</th>
								<th>ชื่อลูกค้า</th>
								<th>ประเภทลูกค้า</th>
								<th>เบอร์ลูกค้า</th>
								<th>อีเมล</th>
								<th>วันที่สมัคร</th>
								<th class="text-center" width="10%"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-center">
									<a href="<?php echo route('customer/edit'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
									<button  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#customer').addClass('active');
	});
</script>