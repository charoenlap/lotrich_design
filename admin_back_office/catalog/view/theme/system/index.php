<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div class="card">
	<div class="card-body">
		<div class="container">
			<form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
				<div class="row mb-3">
					<div class="col-md-12">
						<h4>จัดการระบบ</h4>
					</div>
				</div>
				<?php if($result){?>
					<div class="alert alert-success text-success">บันทึกเรียบร้อย</div>
				<?php } ?>
				<div class="row">
					<div class="col-12">
						<h3>ธนาคาร</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#popupBank">เพิ่มธนาคาร</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<table class="table">
							<thead>
								<th>เลือกไปใช้</th>
								<th>ธนาคาร</th>
								<th>เลขบัญชี</th>
								<th>จัดการ</th>
							</thead>
							<tbody>
								<?php foreach($bankList as $val){ ?>
								<tr>
									<td>
										<input type="checkbox" name="chkBank[]" 
										value="1" <?php echo ($val['status']==1?'checked':''); ?>
										class="chkBank" id-take-bank="<?php echo $val['id'];?>">
									</td>
									<td>
										<?php echo $val['name']; ?>
									</td>
									<td>
										<?php echo $val['no']; ?>
									</td>
									<td>
										<a href="#" class="btn btn-del-bank btn-danger" id-take-bank="<?php echo $val['id'];?>">ลบ</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12">
						<h3>ตั้งค่าส่วนอื่นๆ</h3>
					</div>
				</div>
				<?php foreach($setting['detail'] as $val){ ?>
				<div class="row mt-4">
					<div class="col-3">
						<?php echo $val['desc']; ?>
					</div>
					<div class="col-6">
						<?php if($val['input_type']=='file'){?>
							<input type="file" name="<?php echo $val['name'];?>">
							<?php if($val['val']){?>
							<br><br>
							<img src="../<?php echo $val['val'];?>" alt="" width="100px" height="100px">
							<?php } ?>
						<?php }else if($val['input_type']=='textarea'){?>
							<textarea class="form-control" name="<?php echo $val['name'];?>" cols="30" rows="5"><?php echo $val['val'];?></textarea>
						<?php }else{?>
							<input class="form-control <?php echo $val['class'];?>" type="text" name="<?php echo $val['name'];?>" value="<?php echo $val['val'];?>">
						<?php } ?>
					</div>
				</div>
				<?php } ?>
				<div class="row mt-4">
					<div class="col-md-12">
						<input type="submit" class="btn btn-primary btn-block" value="บันทึก">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="popupBank" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="popupBankText" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="popupBankText">เพิ่มธนาคาร</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<label class="mt-2 mb-2">ชื่อธนาคาร</label>
      	<select name="id_bank" id="id_bank" class="form-control">
        <?php foreach($bank as $val){ ?>
        	<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
        <?php } ?>
        </select>
        <label class="mt-2 mb-2">เลขบัญชี</label>
        <input type="text" class="form-control" value="" id="no">

        <label class="mt-2 mb-2">ชื่อบัญชี</label>
        <input type="text" class="form-control" value="" id="name">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="btn-add-bank">เพิ่มประเภท</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).on('click','.chkBank',function(e){
		var chkVal = $(this).is(':checked');
		var id = $(this).attr('id-take-bank');
		$.ajax({
			url: 'index.php?route=system/statusBank',
			type: 'POST',
			// dataType: 'json',
			data: {
				id: id,
				val:chkVal
			},
		})
		.done(function() {
			console.log("success");
			location.reload();
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
	$(document).on('click','#btn-add-bank',function(e){
		$.ajax({
			url: 'index.php?route=system/addBank',
			type: 'POST',
			// dataType: 'json',
			data: {
				id_bank: $('#id_bank').val(),
				no: $('#no').val(),
				name: $('#name').val()
			},
		})
		.done(function() {
			console.log("success");
			location.reload();
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	$(document).on('click','.btn-del-bank',function(e){
		var id = $(this).attr('id-take-bank');
		$.ajax({
			url: 'index.php?route=system/delBank',
			type: 'POST',
			// dataType: 'json',
			data: {
				id: id
			},
		})
		.done(function() {
			console.log("success");
			location.reload();
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
</script>