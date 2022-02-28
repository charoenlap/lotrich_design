<div class="container-fluid">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">ลูกค้า</a></li>
			<li class="breadcrumb-item active" aria-current="page">แก้ไขลูกค้า</li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-md-12">
			<div class="card mt-3 border-0">
				<div class="card-body">
					<form action="<?php echo $action;?>" method="POST">
						<input type="hidden" name="route" value="<?php echo $action; ?>">
						<div class="row mb-3">
							<div class="col-md-12">
								<h4>ลูกค้า</h4>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="">ชื่อ</label>
								<input type="text" class="form-control" name="name" value="<?php echo $cus['name'];?>">
							</div>
							<div class="col-md-6">
								 <label for="">นามสกุล</label>
								 <input type="text" class="form-control" name="lname" value="<?php echo $cus['lname'];?>">
							</div>
							<div class="col-md-6">
								 <label for="">เบอร์โทร</label>
								 <input type="text" class="form-control" name="phone" value="<?php echo $cus['phone'];?>">
							</div>
							<div class="col-md-6">
								 <label for="">อีเมล</label>
								 <input type="text" class="form-control" name="email" value="<?php echo $cus['email'];?>">
							</div>
							<div class="col-md-6">
								 <label for="">เลขบัญชี ธนาคาร</label>
								 <input type="text" class="form-control" name="bank_no" value="<?php echo $cus['bank_no'];?>">
							</div>
							<div class="col-md-6">
								 <label for="">ชื่อธนาคาร</label>
								 <input type="text" class="form-control" name="bank_name" value="<?php echo $cus['bank_name'];?>">
							</div>
							<div class="col-md-6">
								 <label for="">เลขบัญชี ธนาคาร</label>
								 <input type="text" class="form-control" name="bank_no_2" value="<?php echo $cus['bank_no_2'];?>">
							</div>
							<div class="col-md-6">
								 <label for="">ชื่อธนาคาร</label>
								 <input type="text" class="form-control" name="bank_name_2" value="<?php echo $cus['bank_name_2'];?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
								<button class="btn btn-primary" type="submit">บันทึก</button>
							</div>
						</div>
					</form>
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