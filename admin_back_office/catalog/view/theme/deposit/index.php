<div class="card">
	<div class="card-body">
		<div class="container">
			<form action="" method="GET">
				<input type="hidden" name="route" value="deposit">
				<div class="row">
					<div class="col-3">
						<div class="form-group">
							<label for="">เลือกวัน</label>
				            <div class="input-group date datetimepicker">
								<span class="input-group-addon btn btn-warning">
									<span class="fa fa-calendar"></span>
								</span>
								<input type="text" class="form-control" id="date" 
									name="date" value="<?php echo $date; ?>"/>
							</div>
				         </div>
					</div>
					<div class="col-3">
						<label for="">&nbsp;</label><br>
						<input type="submit" class="btn btn-primary" value="ค้นหา">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<div class="container">
			<div class="row mt-4">
				<div class="col-12">
					<div class="">
						<h4>การฝาก</h4>
						<table class="table table-striped">
							<thead>
								<th>วันที่</th>
								<th>ID</th>
								<th>จำนวนเงิน</th>
								<th>เวลาแจ้งโอน</th>
								<th>สถานะ</th>
								<th>ไฟล์แนบ</th>
								<th></th>
							</thead>
							<tbody>
								<?php if($deposit['result']=="success"){ ?>
									<?php foreach($deposit['deposit'] as $val){ ?>
									<tr>
										<td><?php echo $val['date_create']; ?></td>
										<td><?php echo $val['name'].' '.$val['lname']; ?></td>
										<td>
											<input type="text" class="form-control amount" 
											value="<?php echo $val['amount']; ?>" 
											style="max-width:100px;"
											id-transection="<?php echo encrypt($val['id']);?>">
										</td>
										<td>
											<?php echo $val['hour'].':'.$val['minutes']; ?>
											<!-- <input type="text" class="form-control time" 
											value="<?php echo $val['hour'].':'.$val['minutes']; ?>" 
											style="max-width:100px;"
											id-transection="<?php echo encrypt($val['id']);?>"> -->
										</td>
										<td>
											<a href="img.php?file=2,1,<?php echo $val['img'];?>,1000,1000" target="_blank">
												<img src="img.php?file=2,1,<?php echo $val['img'];?>,500,500" alt="" width="100px;" height="100px;">
											</a>
										</td>
										<td><span class="text-status"><?php echo ($val['status']==0?'รอการยืนยัน':'เรียบร้อยแล้ว'); ?></span></td>
										<td>
											<?php if($val['status']==0){ ?>
											<a href="#" class="btn btn-xs btn-warning btn-transection" 
											id-transection="<?php echo encrypt($val['id']);?>"
											>ยืนยัน</a>
											<?php }else{?>
												<a href="#" class="btn btn-xs btn-danger btn-transection-cancle" 
												id-transection="<?php echo encrypt($val['id']);?>"
												>ยกเลิก</a>
											<?php } ?>
										</td>
									</tr>
									<?php } ?>
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
</div>
<div class="position-fixed top-0 right-0 p-3" style="z-index: 99999; right: 0; bottom: 0;max-height:150px;">
	<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	  <div class="toast-header">
	  	<i class="bi bi-arrow-bar-down"></i>
	    <strong class="mr-auto">ผลลัพธ์</strong>
	  </div>
	  <div class="toast-body"></div>
	</div>
</div>

<script>
	$(document).on('keyup','.amount',function(e){
		var ele = $(this);
		var amount = ele.val();
		
		$.ajax({
			url: 'index.php?route=deposit/editDeposit',
			type: 'POST',
			dataType: 'json',
			data: {
				id_transection: ele.attr('id-transection'),
				amount: amount
			},
		})
		.done(function(result) {
			console.log("success");
			if(result.status=='failed'){
				// ele.prop('disabled', false);
				// ele.attr('aria-disabled', false);
				// ele.removeClass('disabled');

				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				// setInterval(function(){ 
				// 	window.location='index.php?route=member/finance'; 
				// }, 3000);
				// ele.text('เสร็จสิ้น');
				// ele.addClass('btn-success');
				// ele.removeClass('btn-warning');
				// ele.parents('tr').find('.text-status').text('เรียบร้อยแล้ว');
			}
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	$(document).on('click','.btn-transection-cancle',function(e){
		var ele = $(this);
		// ele.prop('disabled', true);
		// ele.attr('aria-disabled', true);
		// ele.addClass('disabled');
		
		$.ajax({
			url: 'index.php?route=deposit/cancleDeposit',
			type: 'POST',
			dataType: 'json',
			data: {
				id_transection: ele.attr('id-transection')
			},
		})
		.done(function(result) {
			console.log("success");
			if(result.status=='failed'){
				// ele.prop('disabled', false);
				// ele.attr('aria-disabled', false);
				// ele.removeClass('disabled');

				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				// setInterval(function(){ 
				// 	window.location='index.php?route=member/finance'; 
				// }, 3000);
				ele.text('เสร็จสิ้น');
				ele.addClass('btn-success');
				ele.removeClass('btn-warning');
				ele.parents('tr').find('.text-status').text('เรียบร้อยแล้ว');
			}
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
		
	});
	// $(document).on('keyup','.time',function(e){
	// 	var ele = $(this);
	// 	var time = ele.val();
		
	// 	$.ajax({
	// 		url: 'index.php?route=deposit/editDeposit',
	// 		type: 'POST',
	// 		dataType: 'json',
	// 		data: {
	// 			id_transection: ele.attr('id-transection'),
	// 			time: time
	// 		},
	// 	})
	// 	.done(function(result) {
	// 		console.log("success");
	// 		if(result.status=='failed'){
	// 			ele.prop('disabled', false);
	// 			ele.attr('aria-disabled', false);
	// 			ele.removeClass('disabled');

	// 			$('.toast-body').text(result.desc);
	// 			$('.toast-body').addClass('text-danger');
	// 			$('.toast-body').removeClass('text-success');
	// 			$('#toast').toast('show');
	// 		}else{
	// 			$('.toast-body').removeClass('text-danger');
	// 			$('.toast-body').addClass('text-success');
	// 			$('.toast-body').text(result.desc);
	// 			$('#toast').toast('show');
	// 			// setInterval(function(){ 
	// 			// 	window.location='index.php?route=member/finance'; 
	// 			// }, 3000);
	// 			// ele.text('เสร็จสิ้น');
	// 			// ele.addClass('btn-success');
	// 			// ele.removeClass('btn-warning');
	// 			// ele.parents('tr').find('.text-status').text('เรียบร้อยแล้ว');
	// 		}
	// 	})
	// 	.fail(function(a,b,c) {
	// 		console.log("error");
	// 		console.log(a);
	// 		console.log(b);
	// 		console.log(c);
	// 	})
	// 	.always(function() {
	// 		console.log("complete");
	// 	});
		
	// });
	$(document).on('click','.btn-transection',function(e){
		var ele = $(this);
		ele.prop('disabled', true);
		ele.attr('aria-disabled', true);
		ele.addClass('disabled');
		
		$.ajax({
			url: 'index.php?route=deposit/addDeposit',
			type: 'POST',
			dataType: 'json',
			data: {
				id_transection: ele.attr('id-transection')
			},
		})
		.done(function(result) {
			console.log("success");
			if(result.status=='failed'){
				ele.prop('disabled', false);
				ele.attr('aria-disabled', false);
				ele.removeClass('disabled');

				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				// setInterval(function(){ 
				// 	window.location='index.php?route=member/finance'; 
				// }, 3000);
				ele.text('เสร็จสิ้น');
				ele.addClass('btn-success');
				ele.removeClass('btn-warning');
				ele.parents('tr').find('.text-status').text('เรียบร้อยแล้ว');
			}
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
		
	});
</script>
<link href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        $(".datetimepicker").datepicker({ 
        	format: 'yyyy-mm-dd' 
        });
    });
</script>