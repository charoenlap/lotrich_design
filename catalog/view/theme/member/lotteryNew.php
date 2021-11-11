<style>
	.hidden{
		display:none;
	}
</style>
<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>แทงหวย รัฐบาล</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li><?php echo $detail['name'];?></li>
			</ul>	
		</div>
	</div>
</section>
<div class="container mt-4">
	<div class="row">
	    <div class="col-md-6 mt-2">
	    	<div class="card height">
	    		<div class="card-header">
	    			1. เลือกประเภท
	    		</div>
	    		<div class="card-body">
			    	เลือกชนิด
			    	<div class="row">
			    		<?php foreach($listType as $val){ ?>
				    	<div class="col-4">
				    		<div class="form-check">
							  <input class="form-check-input chkType <?php echo $val['id']; ?>" 
							  	value="<?php echo $val['name']; ?>" 
							  	data-allow-parent="<?php echo $val['allow_parent'];?>"
							  	type="checkbox" 
							  	name="checkbox" 
							  	data-input-count="<?php echo $val['digit']; ?>" 
							  	data-input-support="<?php echo $val['support_digit']; ?>" 
							  	data-input-sub="<?php echo (isset($val['sub'])?$val['id']:'');?>"
							  	data-id="<?php echo $val['id']; ?>"
							  	id="chk<?php echo $val['id']; ?>">
							  	<?php if($val['price']){ ?>
							  	<span class="badge bg-success"><?php echo $val['price']; ?></span>
								<?php } ?>
							  <label class="form-check-label" for="rdo1">
							    <?php echo $val['name']; ?>
							  </label>
							</div>
				    	</div>
						<?php } ?>
			    	</div>
			    	<?php foreach($listType as $val){ ?>
						<?php if($val['sub']){?>
							<div class="row sub_panel sub_panel_<?php echo $val['id'];?> d-none" >
							<?php foreach($val['sub'] as $val){ ?>
								<div class="col-4 text-center">
									<a href="#" 
										class="btn btn-outline-success btn-block mb-2" 
										data-input-count="<?php echo (isset($v['digit'])?$v['digit']:'');?>" 
									>
										<?php echo $val['type'];?>
									</a>
								</div>
							<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>
			    	<?php 
					foreach($data_lotto as $key => $val){ ?>
					<div class="row sub_panel sub_panel_fixed_<?php echo $key;?> d-none">
						<?php foreach($val as $k => $v){ ?>
							<div class="col-4 text-center">
								<a href="#" 
									class="btn btn-outline-success btn-block mb-2" 
									data-input-count="<?php echo (isset($v['digit'])?$v['digit']:'');?>" 
								><?php echo $k; ?></a>
								<?php if(isset($v['data'])){ ?>
								<?php foreach($v['data'] as $va){ ?>
								<input type="hidden"  value="<?php echo $va;?>">
								<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<?php } ?>
			    	
			    	<div class="row">
			    		<div class="col-12">
			    			<div style="border:solid 1px #3e3e3e;padding:5px 10px;">
					    		ชนิด: <span id="textChoose"></span>
					    	</div>
			    		</div>
			    	</div>
			    </div>
			</div>
			<div class="card height">
	    		<div class="card-header">
	    			2. ใส่ราคา
	    		</div>
	    		<div class="card-body">
	    			ใส่เลข
			    	<div class="row">
			    		<div class="col">
			    			<input type="text" maxlength="1" class="form-control input-number text-center">
			    		</div>
			    		<div class="col" id="for-2-digit">
			    			<input type="text" maxlength="1" class="form-control input-number text-center">
			    		</div>
			    		<div class="col" id="for-3-digit">
			    			<input type="text" maxlength="1" class="form-control input-number text-center " >
			    		</div>
			    	</div>
			    	ใส่ราคา (บาท)
			    	<input type="text" class="form-control text-right" id="price">
			    	<a href="#" class="btn btn-success btn-block mt-2" id="btn-add-lotto">ส่งเข้าโพย >> </a>
	    		</div>
	    	</div>
	    	<div class="card height">
	    		<div class="card-header">
	    			เลขอั้น
	    		</div>
	    		<div class="card-body">
	    			<table class="table table-striped">
	    				<?php foreach($blockNumber as $val){?>
	    				<tbody>
	    					<tr>
	    						<td><?php echo $val['num'];?></td>
	    						<td><?php echo $val['detail'];?></td>
	    					</tr>
	    				</tbody>
	    				<?php } ?>
	    			</table>
	    		</div>
	    	</div>
	    </div>
	    <div class="col-md-6 mt-2">
	    	<div class="card">
	    		<div class="card-header">
	    			<div class="row">
			    		<div class="col">
	    					3. โพย
	    				</div>
	    				<div class="col text-right">
	    					ยอดคงเหลือ: <span><?php echo $balance; ?></span>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    			ใส่ราคาเท่ากันหมด
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-2">
			    			<a href="#" class="btn btn-outline-success btn-block">5฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-outline-success btn-block">10฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-outline-success btn-block">20฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-outline-success btn-block">50฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-outline-success btn-block">100฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-outline-success btn-block">500฿</a>
			    		</div>
			    	</div>
			    	<div class="row mt-2">
			    		<div class="col-8">
			    			<input type="text" class="form-control" value="">
			    		</div>
			    		<div class="col-4">
			    			<a href="#" class="btn  btn-success btn-block">ยืนยันราคา</a>
			    		</div>
			    	</div>
			    	<div class="row mt-2" style="border-top:solid 1px #3e3e3e;">
			    		<div class="col-8">
			    			ราคารวม
			    		</div>
			    		<div class="col-4 text-right">
			    			<span id="total_paid">0.0</span> บาท
			    		</div>
			    	</div>
			    	<form action="#" method="POST" id="form-lotto" class="mt-2">
			    		<input type="hidden" name="id_package" value="<?php echo $id_package; ?>">
			    		<input type="hidden" name="id_category" value="<?php echo $_GET['id'];?>">
			    		<?php foreach($listType as $val){ ?>
			    				<?php if($val['price']){ ?>
			    					<div class="panel-lotto-<?php echo $val['id'];?> d-none">
				    					<div class="row">
				    						<div class="col-12">
				    							<h3><?php echo $val['name'];?></h3>
				    						</div>
				    					</div>
							    		<table class="table table-striped" id="table-lotto-<?php echo $val['id'];?>">
								    		<thead>
								    			<th>เลข</th>
								    			<th class="text-center">แทง</th>
								    			<th>จ่าย</th>
								    			<th class="text-right">ชนะ</th>
								    			<th class="text-right">ลบ</th>
								    		</thead>
								    		<tbody>
								    			<?php /*if($lotto){ ?>
								    			<?php foreach($lotto as $val){?>
								    			<tr>
								    				<td>
								    					<?php echo $val['type'];?>
								    					<input type="hidden" class="type" name="type[]" value="<?php echo $val['type'];?>">
								    					<input type="hidden" class="id_type" name="id_type[]" value="<?php echo $val['id_type'];?>">
								    				</td>
								    				<td>
								    					<?php echo $val['number'];?>
								    					<input type="hidden" class="number" name="number[]" value="<?php echo $val['number'];?>">	
								    				</td>
								    				<td class="text-right">
								    					<?php echo number_format($val['price'],2);?>
								    					<input type="hidden" class="price" name="price[]" value="<?php echo $val['price'];?>">	
								    				</td>
								    				<td>
								    					<?php echo number_format($val['ratio'],2);?>
								    					<input type="hidden" class="ratio" name="ratio[]" value="<?php echo $val['ratio'];?>">	
								    				</td>
								    				<td class="text-right">
								    					<?php echo number_format($val['paid'],2);?>
								    					<input type="hidden" class="paid" name="paid[]" value="<?php echo $val['paid'];?>">	
								    				</td>
								    				<td class="text-right"><a href="#" class="btn btn-danger btn-xs btn-del">ลบ</a></td>
								    			</tr>
								    			<?php } ?>
								    			<?php }*/ ?>
								    		</tbody>
								    	</table>
							    	</div>
						    	<?php } ?>
						    <?php } ?>
			    	</form>
			    	<div class="row">
			    		<div class="col-12">
			    			<button type="submit" class="hvr-btn btn-block" id="btn-submit">ส่งโพยยืนยันการแทง</button>
			    		</div>
			    	</div>
			    </div>
			</div>
			<div class="card ">
	    		<div class="card-header">
	    			อัตราส่วนรางวัล
				</div>
				<div class="card-body">
					<div class="row">
			    		<div class="col-12">
							<table class="table table-striped">
					    		<thead>
					    			<th>ชนิด</th>
					    			<th>จ่าย</th>
					    		</thead>
					    		<tbody>
					    			<?php foreach($listType as $val){ ?>
					    				<?php if($val['price']){ ?>
					    				<tr>
					    					<td><?php echo $val['name'];?></td>
					    					<td><?php echo $val['price'];?></td>
					    				</tr>
					    				<?php } ?>
					    	 		<?php } ?>
					    		</tbody>	
					    	</table>
					    </div>
					 </div>
				</div>
			</div>
	    </div>				
	</div>
</div>
<div class="position-fixed top-0 right-0 p-3" style="z-index: 99999; right: 0; bottom: 0;height:100px;">
	<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	  <div class="toast-header">
	  	<i class="bi bi-arrow-bar-down"></i>
	    <strong class="mr-auto">ผลลัพธ์</strong>
	    <!-- <small>11 mins ago</small> -->
	    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="toast-body"></div>
	</div>
</div>
<script>
	$(document).on('click','#btn-submit',function(e){
		var form = $('#form-lotto');
		$.ajax({
			url: 'index.php?route=member/submitLotto',
			type: 'POST',
			dataType: 'json',
			data: form.serialize(),
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('#btn-submit').prop('disabled', false);
				$('#btn-submit').attr('aria-disabled', false);
				$('#btn-submit').removeClass('disabled');
				$('#btn-submit').addClass('hvr-btn');
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				$('#table-lotto tbody tr').remove();
				window.location="index.php?route=member/ticket";
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
	$(document).on('click','.btn-del',function(e){
		var ele = $(this);
		var type 	= ele.parents('tr').find('.type').val();
		var id_type = ele.parents('tr').find('.id_type').val();
		var number  = ele.parents('tr').find('.number').val();
		var price	= ele.parents('tr').find('.price').val();
		var ratio	= ele.parents('tr').find('.ratio').val();
		var paid	= ele.parents('tr').find('.paid').val();
		$.ajax({
			url: 'index.php?route=member/delLotto',
			type: 'POST',
			dataType: 'json',
			data: {
				type : type,
				id_type : id_type,
				number : number,
				price : price,
				ratio : ratio,
				paid : paid
			},
		})
		.done(function(result) {
			console.log("success");
			console.log(result);
			ele.parents('tr').remove();
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
		
		e.preventDefault();
	});
	$(document).on('click','.chkType',function(e){
		var ele = $(this);
		// if(ele.checked){
			$( ".input-number" ).each(function( index ) {
			  $(this).val("");
			});
			var allow_parent = $(this).attr('data-allow-parent');

			$('.chkType').not(allow_parent).prop("checked", false);
			$(this).prop("checked", true);
			var textChoose = '';
			$( ".chkType:checked" ).each(function( index ) {
			  textChoose += '<span class="badge rounded-pill bg-secondary">'+$(this).val()+'</span> ';
			});
			$('#textChoose').html(textChoose);

			$('#price').val('');
			if(ele.attr('data-input-count') == "2"){
				$('#for-3-digit').addClass('hidden');
			}else if(ele.attr('data-input-count') == "1") {
				$('#for-3-digit').addClass('hidden');
				$('#for-2-digit').addClass('hidden');
			}else{
				$('#for-3-digit').removeClass('hidden');
				$('#for-2-digit').removeClass('hidden');
			}

			if(ele.attr('data-input-support') == "2"){
				$('.sub_panel_fixed_2').removeClass('d-none');
				$('.sub_panel_fixed_3').addClass('d-none');
			}else if(ele.attr('data-input-support') == "3"){
				$('.sub_panel_fixed_2').addClass('d-none');
				$('.sub_panel_fixed_3').removeClass('d-none');
			}else {
				$('.sub_panel_fixed_2').addClass('d-none');
				$('.sub_panel_fixed_3').addClass('d-none');
			}

			if(ele.attr('data-input-sub')!=""){
				// $('.sub_panel_'+ele.attr('data-input-sub')).removeClass('d-none');
				$('.sub_panel').addClass('d-none');
				$('.sub_panel_'+ele.attr('data-input-sub')).removeClass('d-none');
			}
		// }
	});
	$(document).on('click','#btn-add-lotto',function(e){
		var number = "";
		$( ".input-number" ).each(function( index ) {
		 number += $(this).val();
		});
		number = parseInt(number);
		var price = $('#price').val();
		var id_type = [];

		$( ".chkType:checked" ).each(function( index ) {
			id_type.push( $(this).attr('data-id') );
		});
		$.ajax({
			url: 'index.php?route=member/addLotto',
			type: 'POST',
			dataType: 'json',
			data: {
				number: number,
				price: $('#price').val(),
				id_type: id_type,
				id_category: '<?php echo $_GET['id'];?>',
				id_package: '<?php echo $_GET['package'];?>'
			},
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('#btn-submit').prop('disabled', false);
				$('#btn-submit').attr('aria-disabled', false);
				$('#btn-submit').removeClass('disabled');
				$('#btn-submit').addClass('hvr-btn');
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');

				$( result.rows ).each(function( index,result_rows ) {
					// var result_rows = $(this);
					var html =   '<tr>'
					+ '<td>'+result_rows.number+'<input type="hidden" name="number[]" value="'+result_rows.number+'"></td>'
					+ '<td class="text-right"><input type="text" name="price[]" class="form-control text-center" style="width:80px;" value="'+result_rows.price+'"></td>'
					+ '<td>'+result_rows.ratio+'<input type="hidden" name="ratio[]" value="'+result_rows.ratio+'"></td>'
					+ '<td class="text-right">'+result_rows.paid+'<input type="hidden" name="paid[]" value="'+result_rows.paid+'"></td>'
					+ '<td class="text-right"><input type="hidden" name="id_type[]" value="'+result_rows.id_type+'"><a href="#" class="btn btn-danger btn-xs btn-del">ลบ</a></td>'
					+'</tr>';
					$('#table-lotto-'+result_rows.id_type+'  tbody:last-child').append(html);
					$('.panel-lotto-'+result_rows.id_type).removeClass('d-none');
				});
				
				$( ".input-number" ).each(function( index ) {
				  $(this).val("");
				});
				$('#price').val('');
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