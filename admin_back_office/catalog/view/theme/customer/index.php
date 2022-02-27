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
								<th>ติดต่อ</th>
								<th>ธนาคาร</th>
								<th>ธนาคาร(สำรอง)</th>
								<th>ยอดเงินคงเหลือ</th>
								<th>การเข้าใช้งาน</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if($customer['num_rows']){ 
										$i=1;
										foreach($customer['rows'] as $val){ ?>
									<tr>
										<td><?php echo $i;?></td>
										<td>
											<div>
												<?php echo ($val['approve']==1?'<i class="fa fa-check text-success"></i>':'<i class="fa fa-times text-danger"></i>'); ?>
												<?php echo $val['name'].' '.$val['lname'];?></div>
											<small><?php echo $val['date_create'];?></small>
										</td>
										<td>
											<div><?php echo $val['phone'];?></div>
											<small><?php echo $val['email'];?></small>		
										</td>
										<td>
											<div><?php echo $val['bank_no'];?></div>
											<div><?php echo $val['bank_name'];?></div>
										</td>
										<td>
											<div><?php echo $val['bank_no_2'];?></div>
											<div><?php echo $val['bank_name_2'];?></div>
										</td>
										<td><?php echo $val['balance'];?></td>
										<td class="text-center">
											<?php echo ($val['del']==0?'<a href="#" class="text-success">เปิด</a>':'<a href="#" class="text-danger">ปิด</a>');?>
											<br><br>
											<a href="<?php echo route('customer/undel&id='.encrypt($val['id'])); ?>" class="btn btn-success btn-sm">เปิด</a>

											<a href="<?php echo route('customer/del&id='.encrypt($val['id'])); ?>" class="btn btn-danger btn-sm">ปิด</a>
										</td>
									</tr>
									<?php $i++;} ?>
							<?php }else{?>
								<tr>
									<td colspan="10" class="text-center">ไม่พบข้อมูล</td>
								</tr>
							<?php } ?>
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