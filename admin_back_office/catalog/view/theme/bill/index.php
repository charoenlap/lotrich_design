<div class="card">
	<div class="card-body">
		<div class="container">
			<div class="row mt-4">
				<div class="col-12">
					<h4>บิลลูกค้า</h4>
				</div>
			</div>
			<form action="<?php echo $action; ?>" method="GET">	
				<input type="hidden" name="route" value="bill">
				<div class="row">
					<div class="col-3">
						<div class="form-group">
							<label for="">เลือกวันเริ่ม</label>
				            <div class="input-group date datetimepicker">
								<span class="input-group-addon btn btn-warning">
									<span class="fa fa-calendar"></span>
								</span>
								<input type="text" class="form-control" id="date" 
									name="date" value="<?php echo $date;?>"/>
							</div>
				         </div>
					</div>
					<div class="col-3">
						<div class="form-group">
							<label for="">เลือกวันสิ้นสุด</label>
				            <div class="input-group date datetimepicker">
								<span class="input-group-addon btn btn-warning">
									<span class="fa fa-calendar"></span>
								</span>
								<input type="text" class="form-control" id="date_end" 
									name="date_end" value="<?php echo $date_end;?>"/>
							</div>
				         </div>
					</div>
					<div class="col-3">
						<div class="form-group">
							<label for="">เลือกหมวด</label>
				            <div class="input-group">
								<select name="category" class="form-control" id="category">
									<?php foreach($category as $val){?>
									<option value="<?php echo $val['id']; ?>" <?php echo ($id_category==$val['id']?'selected':''); ?>>
										<?php echo $val['name']; ?>
									</option>
									<?php } ?>
								</select>
							</div>
				         </div>
					</div>
					<!--<div class="col-2">
						<div class="form-group">
							<label for="">เลือกประเภท</label>
				            <div class="input-group">
								<select name="type" class="form-control" id="type">
									<?php foreach($type as $val){?>
									<option value="<?php echo $val['id']; ?>" <?php echo ($id_type==$val['id']?'selected':''); ?>>
										<?php echo $val['type']; ?>
									</option>
									<?php } ?>
								</select>
							</div>
				         </div>
					</div>
					 <div class="col-2">
						<div class="form-group">
							<label for="">เรียงตาม</label>
				            <div class="input-group">
								<select name="order" class="form-control" id="order">
									<option value="number" <?php echo ($order=='number'?'selected':''); ?>>ตัวเลข</option>
									<option value="sum_price" <?php echo ($order=='sum_price'?'selected':''); ?>>ยอดเงินรวม</option>
									<option value="date_create" <?php echo ($order=='date_create'?'selected':''); ?>>ตามวัน</option>
								</select>
							</div>
				         </div>
					</div> -->
					<div class="col-2">
						<label for="">&nbsp;</label><br>
						<input type="submit" class="btn btn-primary" value="ค้นหา">
					</div>
				</div>
			<!-- <div class="row mt-4">
				<div class="col-12">
					<select name="" class="form-control" id=""></select>
				</div>
			</div> -->
			</form>
			<div class="row mt-4">
				<div class="col-12">
					<table class="table table-striped" id="myTable">
						<thead>
							<th>##</th>
							<th>รหัสบิล</th>
							<th>วันที่สร้างบิล</th>
							<th>ประเภทบิล</th>
							<th>ชื่อลูกค้า</th>
							<th>ยอดซื้อ</th>
							<th>ลูกค้าแทงถูก</th>
							<th>สถานะ</th>
							<th class="text-center">ดูบิล</th>
						</thead>
						<tbody>
							<?php if($lotto){ ?>
								<?php $i=1;foreach($lotto as $val){ ?>
								<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo $val['id'];?></td>
									<td><?php echo $val['date_create'];?></td>
									<td><?php echo $val['category_name'];?></td>
									<td><?php echo $val['name'];?></td>
									<td><?php echo number_format($val['total'],2);?></td>
									<td class="<?php echo ($val['receive']>0?'text-success':'text-danger'); ?>">
										<b><?php if($val['status']==1){ echo $val['receive']; } ?></b>
									</td>
									<td><?php echo ($val['status']==0?'ยังไม่คำนวน':'เรียบร้อย'); ?></td>
									<td class="text-end">
										<a href="#" class="btn btn-xs btn-primary btn-view-bill" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" data-id-bill="<?php echo encrypt($val['id']);?>" data-id-category="<?php echo encrypt($val['id_category']);?>">
											ดูบิล
										</a>
									</td>
								</tr>
								<?php } ?>
							<?php }else{ ?>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดบิล</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
          	<table class="table table-striped" id="table-bill">
          		<thead>
          			<th>ประเภท</th>
          			<th>เลขที่แทง</th>
          			<th>ราคาที่แทง</th>
          			<th>อัตราต่อรอง</th>
          			<th>แทงถูกจะได้</th>
          			<th>สถานะ</th>
          			<th></th>
          		</thead>
          		<tbody></tbody>
          	</table>
          </div>
          <?php if(get('category')!=24){ ?>
          <div id="panel-action">
          	ตรวจสอบด้วยผลลัพธ์ ของวันที่
          	<div class="input-group date datetimepicker">
				<span class="input-group-addon btn btn-warning">
					<span class="fa fa-calendar"></span>
				</span>
				<input type='text' class="form-control" id="date" name="date"/>
			</div>
			<!-- ลูกค้าแทงถูกทั้งหมด
			<div>
				0 บิล รวมเป็นเงิน 0 บาท
			</div> -->
          </div>
      		<?php } ?>
        </form>
      </div>
      <div class="modal-footer" id="control-action">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <?php if(get('category')!=24){ ?>
        <button type="button" class="btn btn-primary" id="btn-save-submit">ยืนยันปิดสถานะ และโอนเงินเข้าบัญชีของลูกค้า</button>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="position-fixed top-0 right-0 p-3" style="z-index: 99999; right: 0; bottom: 0;height: 150px;">
	<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	  <div class="toast-header">
	  	<i class="bi bi-arrow-bar-down"></i>
	    <strong class="mr-auto">ผลลัพธ์</strong>
	  </div>
	  <div class="toast-body"></div>
	</div>
</div>
<style>
	.dataTables_filter {
		display: none;
	}
</style>
<link href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#myTable').DataTable();
	} );
</script>

<script>
	// $(document).on('change','#date',function(e){
	// 	var ele = $(this);
	// 	$.ajax({
	// 		url: 'index.php?route=lotto/getResultRatio',
	// 		type: 'POST',
	// 		dataType: 'json',
	// 		data: {
	// 			date: ele.val(),
	// 			id_category: '<?php //echo get('id_category');?>'
	// 		},
	// 	})
	// 	.done(function(result) {
	// 		console.log("success");
	// 		console.log(result);
	// 		if(result.status=='failed'){
	// 			$('.toast-body').text(result.desc);
	// 			$('.toast-body').addClass('text-danger');
	// 			$('.toast-body').removeClass('text-success');
	// 			$('#toast').toast('show');
	// 		}else{
	// 			$( result.ratio ).each(function( index,val ) {
	// 			  $('#ratio_'+val.id).val(val.price);
	// 			});
	// 			$( result.type ).each(function( index,val ) {
	// 			  $('#type_'+val.id).val(val.result);
	// 			});
	// 			console.log(result.sub);
	// 			$( result.sub ).each(function( index,sub ) {
	// 				$( sub.type_sub ).each(function( index,val ) {
	// 			  		$('#sub_type_'+val.id).val(val.result);
	// 			  	});
	// 			});
	// 			$('.toast-body').removeClass('text-danger');
	// 			$('.toast-body').addClass('text-success');
	// 			$('.toast-body').text(result.desc);
	// 			$('#toast').toast('show');
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
	$(document).on('click','#btn-save-submit',function(e){
		var ele = $('#btn-save-submit');
		if($('#date').val()!=''){
			ele.addClass('disabled');
			// $('table#table-bill').each(function(index, tr) { 
				var id_bill = $('#table-bill tbody').attr('id_bill');
				$.ajax({
					url: 'index.php?route=bill/submitBill',
					type: 'POST',
					dataType: 'json',
					data: {
						id_bill: id_bill,
						date: $('#date').val()
					},
				})
				.done(function(e) {
					console.log(e);
					console.log("success");
					window.location.reload();
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
				
			// });
		}else{
			$('#date').focus();
		}
	});
	$(document).ready(function(){
        $(".datetimepicker").datepicker({ 
        	format: 'yyyy-mm-dd' 
        });
    });
	$(document).on('click','.btn-view-bill',function(e){
		var id_bill = $(this).attr('data-id-bill');
		$.ajax({
			url: 'index.php?route=bill/getBill',
			type: 'POST',
			dataType: 'json',
			data: {
				id_bill: id_bill
			},
		})
		.done(function(result) {
			console.log("success");
			console.log(result);
			console.log(id_bill);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				// $('.toast-body').removeClass('text-danger');
				// $('.toast-body').addClass('text-success');
				// $('.toast-body').text(result.desc);
				// $('#toast').toast('show');
				console.log(result);
				$('#table-bill  tbody').html('');
				$('#table-bill  tbody').attr('id_bill',id_bill);
				$( result.result_bill ).each(function( index,val ) {
					var status = "ยังไม่คำนวน";
					if(val.status=='1'){
						status = "เรียบร้อย";
						$('#panel-action').addClass('d-none');
						$('#control-action').addClass('d-none');
					}else{
						$('#panel-action').removeClass('d-none');
						$('#control-action').removeClass('d-none');
					}
					var html = 	'<tr>'
									+'<td>'+val.type+'</td>'
									+'<td>'+val.number+'</td>'
									+'<td>'+val.price+'</td>'
									+'<td>'+val.ratio+'</td>'
									+'<td>'+val.paid+'</td>'
									+'<td>'+status+'</td>'
									+'<td>'+val.receive+'</td>'
								+'</tr>';
					$('#table-bill  tbody:last-child').append(html);
				});
				
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