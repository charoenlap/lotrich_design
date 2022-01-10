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
			    	<div class="row">
			    		<div class="col-md-6">
			    			เลือกชนิด
			    		</div>
			    		<div class="col-md-6 text-end">
			    			<a href="#" id="btn-clean-check" class="btn btn-outline-danger btn-xs">ล้างค่าที่เลือก</a>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<?php foreach($listType as $val){ ?>
				    	<div class="col-4">
				    		<div class="form-check">
				    			<label class="form-check-label" for="chk<?php echo $val['id']; ?>">
								  <input class="form-check-input chkType chk<?php echo $val['id']; ?> <?php echo $val['id']; ?>" 
								  	value="<?php echo $val['name']; ?>" 
								  	data-allow-parent="<?php echo $val['allow_parent'];?>"
								  	type="checkbox" 
								  	name="checkbox" 
								  	data-input-count="<?php echo $val['digit']; ?>" 
								  	data-input-support="<?php echo $val['support_digit']; ?>" 
								  	data-input-sub="<?php echo (isset($val['sub'])?$val['id']:'');?>"
								  	data-id="<?php echo $val['id']; ?>"
								  	data-id-type="<?php echo $val['id']; ?>"
								  	data-digit="<?php echo $val['digit']; ?>"
								  	data-condition="<?php echo (empty($val['price'])?'1':'0'); ?>"
								  	data-chkType="<?php echo $val['name']; ?>"
								  	id="chk<?php echo $val['id']; ?>">
								  	<?php if($val['price']){ ?>
								  	<span class="badge bg-success"><?php echo $val['price']; ?></span>
									<?php } ?>
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
									<label 
										class="btn btn-outline-success btn-block mb-2 btn-add-muntiple-lottery" 
										data-input-count="<?php echo (isset($v['digit'])?$v['digit']:'');?>" 
										data-id-type="<?php echo $val['id'];?>"
										data-digit="<?php echo (isset($val['digit'])?$val['digit']:'');?>" 
										for="rdo<?php echo $val['id']; ?>"
									>
										<input type="radio" class="rdoType" 
										name="rdoType" 
										value="<?php echo $val['type']; ?>"
										id="rdo<?php echo $val['id']; ?>" 
										
										>
									
										<?php echo $val['type'];?>
									</label>
								</div>
							<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>
			    	<?php 
			    	$index_input = 0;
					foreach($data_lotto as $key => $val){ ?>
					<div class="row sub_panel sub_panel_fixed_<?php echo $key;?> d-none" id="sub_panel_fixed_<?php echo $key;?>">
						<?php foreach($val as $k => $v){ ?>
							<div class="col-4 text-center">
								<input type="radio" class="rdoType" 
										name="rdoType" 
										id="rdo<?php echo $index_input; ?>" 
										value="<?php echo $k; ?>">
										
								<label 
									class="btn btn-outline-success btn-block mb-2 btn-add-muntiple-lottery" 
									data-input-count="<?php echo (isset($v['digit'])?$v['digit']:'');?>" 
									data-digit="<?php echo (isset($v['digit'])?$v['digit']:'');?>" 
									data-id-type="<?php echo $key; ?>" 
									data-children-class="<?php echo $k;?>"
									for="rdo<?php echo $index_input; ?>"

								>
									<?php echo $k; ?> 
								</label>
								<?php if(isset($v['data'])){ ?>
								<?php foreach($v['data'] as $va){ ?>
								<input type="hidden" class="input_data_id_type_<?php echo $k;?>" value="<?php echo $va;?>">
								<?php } ?>
								<?php } ?>
							</div>
							<?php $index_input++; ?>
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
			    		<div class="col p-btn-no" id="for-1-digit">
			    			<input type="text" maxlength="1" class="form-control input-number text-center">
			    		</div>
			    		<div class="col p-btn-no" id="for-2-digit">
			    			<input type="text" maxlength="1" class="form-control input-number text-center">
			    		</div>
			    		<div class="col p-btn-no" id="for-3-digit">
			    			<input type="text" maxlength="1" class="form-control input-number text-center">
			    		</div>
			    		<div class="col p-btn-no" id="for-4-digit">
			    			<input type="text" maxlength="1" class="form-control input-number text-center " >
			    		</div>
			    		<div class="col p-btn-no" id="for-5-digit">
			    			<input type="text" maxlength="1" class="form-control input-number text-center " >
			    		</div>
			    	</div>
			    	<div>
			    		<div class="row mt-2">
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="1">1</a></div>
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="2">2</a></div>
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="3">3</a></div>
				    	</div>
				    	<div class="row mt-2">
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="4">4</a></div>
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="5">5</a></div>
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="6">6</a></div>
				    	</div>
				    	<div class="row mt-2">
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="7">7</a></div>
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="8">8</a></div>
				    		<div class="col"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="9">9</a></div>
				    	</div>
				    	<div class="row mt-2">
				    		<div class="col-8"><a href="#" class="btn btn-input-number btn-block btn-outline-success" data-input="0">0</a></div>
				    		<div class="col"><a href="#" class="btn btn-block btn-danger btn-input-number" data-input="<">ลบ</a></div>
				    	</div>
			    	</div>
			    	<a href="#" class="btn btn-success btn-block mt-2" id="btn-add-lotto">ส่งเข้าโพย >> </a>
	    		</div>
	    	</div>
	    	<div class="card height">
	    		<div class="card-header">
	    			เลขอั้น
	    		</div>
	    		<div class="card-body">
	    			<table class="table table-striped" id="table-block-num">
	    				<?php foreach($blockNumber as $val){?>
	    				<tbody>
	    					<tr>
	    						<td>
	    							<input type="hidden" class="num_block" data-num="<?php echo $val['num'];?>" data-condition="<?php echo $val['condition'];?>">
	    							<?php echo $val['num'];?>
	    						</td>
	    						<td><?php echo $val['detail'];?></td>
	    						<td><?php echo $val['type'];?></td>
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
			    			<a href="#" class="btn btn-allprice btn-outline-success btn-block" data-price="5">5฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-allprice btn-outline-success btn-block" data-price="10">10฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-allprice btn-outline-success btn-block" data-price="20">20฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-allprice btn-outline-success btn-block" data-price="50">50฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-allprice btn-outline-success btn-block" data-price="100">100฿</a>
			    		</div>
			    		<div class="col-2">
			    			<a href="#" class="btn btn-allprice btn-outline-success btn-block" data-price="500">500฿</a>
			    		</div>
			    	</div>
			    	<div class="row mt-2">
			    		<div class="col-8">
			    			<input type="text" class="form-control" value="" id="all-price">
			    		</div>
			    		<div class="col-4">
			    			<a href="#" class="btn  btn-success btn-block" id="btn-allprice">ยืนยันราคา</a>
			    		</div>
			    	</div>
			    	<div class="row mt-2" style="border-top:solid 1px #3e3e3e;">
			    		<div class="col-8">
			    			ราคารวม
			    		</div>
			    		<div class="col-4 text-right">
			    			<b><span id="total_paid">0.0</span></b> บาท
			    		</div>
			    	</div>
			    	<form action="#" method="POST" id="form-lotto" class="mt-2">
			    		<input type="hidden" name="id_package" value="<?php echo $id_package; ?>">
			    		<input type="hidden" name="id_category" value="<?php echo $_GET['id'];?>">
			    		
			    		<?php foreach($listType as $val){ ?>
			    				<?php if($val['price']){ ?>
			    					<div class="panel-lotto-header panel-lotto-<?php echo $val['id'];?> d-none">
				    					<div class="row">
				    						<div class="col-12">
				    							<h3><?php echo $val['name'];?></h3>
				    						</div>
				    					</div>
							    		<table class="table table-striped table-lotto-all" id="table-lotto-<?php echo $val['id'];?>">
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
						    	<?php  } ?>
						    	<?php if($val['sub']){ ?>
						    		<?php //echo "<pre>";var_dump($val['sub']); ?>
						    		<?php foreach($val['sub'] as $v){?>
						    			<div class="panel-lotto-<?php echo $v['id'];?> d-none">
					    					<div class="row">
					    						<div class="col-12">
					    							<h3><?php echo $v['type'];?></h3>
					    						</div>
					    					</div>
								    		<table class="table table-striped table-lotto-all" id="table-lotto-<?php echo $v['id'];?>">
									    		<thead>
									    			<th>เลข</th>
									    			<th class="text-center">แทง</th>
									    			<th>จ่าย</th>
									    			<th class="text-right">ชนะ</th>
									    			<th class="text-right">ลบ</th>
									    		</thead>
									    		<tbody>
									    		</tbody>
									    	</table>
								    	</div>
						    		<?php } ?>
						    	<?php } ?>
						    <?php } ?>
			    	</form>
			    	<div class="row">
			    		<div class="col-3">
			    			<a href="#" class="btn text-danger btn-block" id="btn-del-all">ลบทั้งหมด</a>
			    		</div>
			    		<div class="col-9">
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
					    				<?php if($val['sub']){ ?>
							    			<?php foreach($val['sub'] as $v){?>
							    				<tr>
							    					<td><?php echo $v['type'];?></td>
							    					<td><?php echo $v['price'];?></td>
							    				</tr>
							    			<?php } ?>
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
	// p-btn-no
	var count_box = 1;
	$(document).on('click','.btn-input-number',function(e){
		var no = $(this).attr('data-input');
		if(no=="<"){
			count_box--;
			$('#for-'+count_box+'-digit .input-number').val('');
		}else{
			$('#for-'+count_box+'-digit .input-number').val(no);
			count_box++;
		}
		$( ".p-btn-no.d-none" ).find('input').val('');
	});
	$(document).on('click','.btn-input-number',function(e){

	});
	function sum_cal(){
		var sum_cal = 0;
		$( '.txt-price' ).each(function( index ) {
			sum_cal += parseFloat($(this).val());
		});
		$('#total_paid').text(sum_cal);
	}
	
	$(document).on('click','#btn-allprice',function(e){
		var price = parseFloat($('#all-price').val());
		if(price > 0){
		$( ".txt-price" ).each(function( index ) {
			  $(this).val(price);
			  var ratio = parseFloat($(this).parents('tr').find(".ratio").text());
			  $(this).parents('tr').find(".paid").text( price * ratio);
			  console.log(price +' '+ratio);
			});
		}
		sum_cal();
		e.preventDefault();
	});
	$(document).on('change','.txt-price',function(e){
		var ele = $(this);
		var price = parseFloat(ele.val());
		var ratio = parseFloat(ele.parents('tr').find('.ratio').text());
		var number = ele.parents('tr').find('.number').text();
		var paid = parseFloat(ele.parents('tr').find('.paid').text());
		ele.parents('tr').find('.paid').text( parseFloat(price * ratio).toFixed(2));
		$( ".input-number" ).each(function( index ) {
			var num 		= $(this).attr('data-num');
			var condition 	= parseFloat($(this).attr('data-condition'));
			if(number == num){
				ele.parents('tr').find('.paid').text( parseFloat(price * ratio * condition).toFixed(2));
			}
		});
		e.preventDefault();
		sum_cal();
	});
	$(document).on('click','.btn-allprice',function(e){
		var price = parseFloat($(this).attr('data-price'));
		$( ".txt-price" ).each(function( index ) {
		  $(this).val(price);
		  var ratio = parseFloat($(this).parents('tr').find(".ratio").text());
		  $(this).parents('tr').find(".paid").text( parseFloat(price * ratio).toFixed(2));
		  console.log(price +' '+ratio);
		});
		sum_cal();
		e.preventDefault();
	});
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
				var text_result_detail = "";
				$.each(result.list_lotto_not_buy_total_over, function(index, val) {
					text_result_detail += val+ " ไม่สามารถแทงได้ ยอดรวมของหมวดนี้ เกินกำหนด<br>"
				});
				$.each(result.list_lotto_not_buy_limit_type, function(index, val) {
					text_result_detail += val+ " ไม่สามารถแทงได้ ยอดรวมของประเภทนี้ เกินกำหนด<br>"
				});
				$.each(result.list_lotto_not_buy_total_over, function(index, val) {
					text_result_detail += val+ " ไม่สามารถแทงได้ ยอดรวมของเลขนี้ เกินกำหนด<br>"
				});

				$('.toast-body').html(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
				console.log(result.list_lotto_not_buy);
				console.log(result.list_lotto_not_buy_limit_type);
				console.log(result.list_lotto_not_buy_total_over);
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				var text_result_detail = "";
				$.each(result.list_lotto_not_buy_total_over, function(index, val) {
					text_result_detail += val+ " ไม่สามารถแทงได้ ยอดรวมของหมวดนี้ เกินกำหนด<br>"
				});
				$.each(result.list_lotto_not_buy_limit_type, function(index, val) {
					text_result_detail += val+ " ไม่สามารถแทงได้ ยอดรวมของประเภทนี้ เกินกำหนด<br>"
				});
				$.each(result.list_lotto_not_buy_total_over, function(index, val) {
					text_result_detail += val+ " ไม่สามารถแทงได้ ยอดรวมของเลขนี้ เกินกำหนด<br>"
				});
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				$('#table-lotto tbody tr').remove();

				setInterval(function () {
					window.location="index.php?route=member/ticket";
				}, 3000);
				
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
	$(document).on('click','#btn-del-all',function(e){
		$('.table-lotto-all').find('tr').remove();
		$('.panel-lotto-header').addClass('d-none');
		e.preventDefault();
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
		count_box = 1;
		var ele = $(this);
		var chkType = $(this).attr('data-chkType');
		// if(ele.checked){
		$( ".input-number" ).each(function( index ) {
		  $(this).val("");
		});
		var allow_parent = $(this).attr('data-allow-parent');
		// console.log(allow_parent);

		$('.chkType').not(allow_parent).prop("checked", false);
		// $(this).prop("checked", true);
		
		var textChoose = '';
		$( ".chkType:checked" ).each(function( index ) {
		  textChoose += '<span class="badge rounded-pill bg-secondary">'+$(this).val()+'</span> ';
		});
		$('#textChoose').html(textChoose);

		$('#price').val('');
		$('#for-1-digit').addClass('d-none');
		$('#for-2-digit').addClass('d-none');
		$('#for-3-digit').addClass('d-none');
		$('#for-4-digit').addClass('d-none');
		$('#for-5-digit').addClass('d-none');
		if(ele.attr('data-digit') == "2"){
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
		}else if(ele.attr('data-digit') == "1") {
			$('#for-1-digit').removeClass('d-none');
		}else if(ele.attr('data-digit') == "3") {
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
			$('#for-3-digit').removeClass('d-none');
		}else if(ele.attr('data-digit') == "4") {
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
			$('#for-3-digit').removeClass('d-none');
			$('#for-4-digit').removeClass('d-none');
		}else if(ele.attr('data-digit') == "5") {
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
			$('#for-3-digit').removeClass('d-none');
			$('#for-4-digit').removeClass('d-none');
			$('#for-5-digit').removeClass('d-none');
		}
		// console.log('data-input-support: ' + ele.attr('data-input-support'));

		if(ele.attr('data-input-sub')!=""){
			// $('.sub_panel_'+ele.attr('data-input-sub')).removeClass('d-none');
			$('.sub_panel').addClass('d-none');
			$('.sub_panel_'+ele.attr('data-input-sub')).removeClass('d-none');
		}
		if(ele.attr('data-input-support') == "2"){
			$('#sub_panel_fixed_2').removeClass('d-none');
			$('#sub_panel_fixed_3').addClass('d-none');
		}else if(ele.attr('data-input-support') == "3"){
			$('#sub_panel_fixed_2').addClass('d-none');
			$('#sub_panel_fixed_3').removeClass('d-none');
		}else {
			$('#sub_panel_fixed_2').addClass('d-none');
			$('#sub_panel_fixed_3').addClass('d-none');
		}
	});
	$(document).on('click','#btn-add-lotto',function(e){
		count_box=1;
		var rdoType = $('.rdoType:checked').val();
		
		var number = "";
		$( ".input-number" ).each(function( index ) {
		 number += $(this).val();
		});
		number = parseInt(number);
		var price = $('#price').val();
		var id_type = [];

		$( ".chkType:checked" ).each(function( index ) {
			id_type.push( $(this).attr('data-id-type') );
		});
		
		// $( id_type ).each(function( index,id ) {
			console.log(rdoType);
			// var id_type_loop = id;
			$.ajax({
				url: 'index.php?route=member/addLotto',
				type: 'POST',
				dataType: 'json',
				data: {
					number: number,
					price: 1,
					id_type: id_type,//id_type_loop,
					id_category: '<?php echo $_GET['id'];?>',
					id_package: '<?php echo $_GET['package'];?>',
					rdoType: rdoType
				},
			})
			.done(function(result) {
				// $('.rdoType').prop('checked', false);
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

					$( result.data ).each(function( index,type ) {
						console.log('type');
						console.log(type);
						// $( type[index] ).each(function( d,sub ) {
								var html =   '<tr>'
								+ '<td><span class="number">'+type.number+'</span><input type="hidden" name="number[]" value="'+type.number+'"></td>'
								+ '<td class="text-right"><input type="text" name="price[]" class="txt-price form-control text-center" style="width:80px;" value="'+type.price+'"></td>'
								+ '<td><span class="ratio">'+type.ratio+'</span><input type="hidden" name="ratio[]" value="'+type.ratio+'"></td>'
								+ '<td class="text-right"><span class="paid">'+type.paid+'</span><input type="hidden" name="paid[]" value="'+type.paid+'"></td>'
								+ '<td class="text-right"><input type="hidden" name="id_type[]" value="'+type.id_type+'"><a href="#" class="btn btn-danger btn-xs btn-del">ลบ</a></td>'
								+'</tr>';
								$('#table-lotto-'+type.id_type+'  tbody:last-child').append(html);
								$('.panel-lotto-'+type.id_type).removeClass('d-none');
						// });
					});
					
					$( ".input-number" ).each(function( index ) {
					  $(this).val("");
					});
					$('#price').val('');
					sum_cal();
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
		// });
		
	});
	$(document).on('click','.btn-add-muntiple-lottery',function(e){
		// var id_rdo = $(this).attr('for');
		// $('.rdoType').attr('checked', '');
		// $('#'+id_rdo).attr('checked', 'checked');
		count_box = 1;
		var digit = parseInt($(this).attr('data-digit'));
		// console.log(digit);
		var chkType = $(this).attr('data-chkType')
		$('.input-number').removeClass('d-none');
		if(digit=="1"){
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').addClass('d-none');
			$('#for-3-digit').addClass('d-none');
			$('#for-4-digit').addClass('d-none');
			$('#for-5-digit').addClass('d-none');
		}else if(digit=="2"){
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
			$('#for-3-digit').addClass('d-none');
			$('#for-4-digit').addClass('d-none');
			$('#for-5-digit').addClass('d-none');
		}else if(digit=="3"){
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
			$('#for-3-digit').removeClass('d-none');
			$('#for-4-digit').addClass('d-none');
			$('#for-5-digit').addClass('d-none');
		}else if(digit=="4"){
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
			$('#for-3-digit').removeClass('d-none');
			$('#for-4-digit').removeClass('d-none');
			$('#for-5-digit').addClass('d-none');
		}else if(digit=="5"){
			$('#for-1-digit').removeClass('d-none');
			$('#for-2-digit').removeClass('d-none');
			$('#for-3-digit').removeClass('d-none');
			$('#for-4-digit').removeClass('d-none');
			$('#for-5-digit').removeClass('d-none');
		}else{
			// var input_count = $(this).attr('data-digit');
			var id_type = [];
			$( '.chkType:checked' ).each(function( index ) {
				id_type.push($(this).attr('data-id'));
			});
			
			var data_children_class = $(this).attr('data-children-class');

			$( this ).parents('div').find('.input_data_id_type_'+data_children_class).each(function( index ) {
				var number = $(this).val();
				$( id_type ).each(function( index,id ) {
					var id_type_loop = id;
					$.ajax({
						url: 'index.php?route=member/addLotto',
						type: 'POST',
						dataType: 'json',
						data: {
							number: number,
							price: 1,
							id_type: id_type_loop,
							id_category: '<?php echo $_GET['id'];?>',
							id_package: '<?php echo $_GET['package'];?>',
							digit: digit,
							chkType:chkType
						},
					})
					.done(function(result) {
						// console.log("success");
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

							$( result.data ).each(function( index,type ) {
							console.log('type');
							console.log(type);
							// $( type[index] ).each(function( d,sub ) {
									var html =   '<tr>'
									+ '<td><span class="number">'+type.number+'</span><input type="hidden" name="number[]" value="'+type.number+'"></td>'
									+ '<td class="text-right"><input type="text" name="price[]" class="txt-price form-control text-center" style="width:80px;" value="'+type.price+'"></td>'
									+ '<td><span class="ratio">'+type.ratio+'</span><input type="hidden" name="ratio[]" value="'+type.ratio+'"></td>'
									+ '<td class="text-right"><span class="paid">'+type.paid+'</span><input type="hidden" name="paid[]" value="'+type.paid+'"></td>'
									+ '<td class="text-right"><input type="hidden" name="id_type[]" value="'+type.id_type+'"><a href="#" class="btn btn-danger btn-xs btn-del">ลบ</a></td>'
									+'</tr>';
									$('#table-lotto-'+type.id_type+'  tbody:last-child').append(html);
									$('.panel-lotto-'+type.id_type).removeClass('d-none');
							// });
							});
							sum_cal();
						}
					})
					.fail(function(a,b,c) {
						console.log(a,b,c);
					})
					.always(function() {
						// console.log("complete");
					});
				});
			});
		}
		// e.preventDefault();
	});
	$(document).on('click','.btn-input-number',function(e){
		e.preventDefault();
	});
	$(document).on('click','#btn-clean-check',function(e){
	// 	if($(this).is(':checked')){
		$('.chkType').prop('checked', false);
		e.preventDefault();
	// 	}
	});
</script>
<style>
	input[type^='radio'] {
		display:none;
	}
</style>