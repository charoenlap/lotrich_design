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
				<li>แทงหวย รัฐบาล</li>
			</ul>	
		</div>
	</div>
</section>
<div class="container mt-4">
	<div class="row">
	    <div class="col-md-3 mt-2">
	    	<div class="card height" style="height:100%;">
	    		<div class="card-header">
	    			1. เลือกประเภท
	    		</div>
	    		<div class="card-body">
			    	เลือกชนิด
			    	<div class="form-check">
					  <input class="form-check-input rdoType" type="radio" 
					  	name="rdoType" data-input-count="3" value="2" id="rdo1" checked>
					  <label class="form-check-label" for="rdo1">
					    3 บน
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input rdoType" type="radio" 
					  	name="rdoType" data-input-count="3" value="3" id="rdo2">
					  <label class="form-check-label" for="rdo2">
					    3 ล่าง
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input rdoType" type="radio" 
					  	name="rdoType" data-input-count="3" value="6" id="rdo3">
					  <label class="form-check-label" for="rdo3">
					    3 โต๊ด
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input rdoType" type="radio" 
					  	name="rdoType" data-input-count="2" value="7" id="rdo4">
					  <label class="form-check-label" for="rdo4">
					    2 บน
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input rdoType" type="radio" 
					  	name="rdoType" data-input-count="2" value="4" id="rdo5">
					  <label class="form-check-label" for="rdo5">
					    2 ล่าง
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input rdoType" type="radio" 
					  	name="rdoType" data-input-count="2" value="8" id="rdo6">
					  <label class="form-check-label" for="rdo6">
					    2 โต๊ด
					  </label>
					</div>
			    	<br>
			    	<div class="form-check">
					  <input class="form-check-input" type="checkbox" name="check" id="check">
					  <label class="form-check-label" for="check">
					    + เพิ่มกลับ
					  </label>
					</div>
			    </div>
			</div>
	    </div>
	    <div class="col-md-3 mt-2">
	    	<div class="card height" style="height:100%;">
	    		<div class="card-header">
	    			2. ใส่ราคา
	    		</div>
	    		<div class="card-body">
	    			ใส่เลข
			    	<div class="row">
			    		<div class="col">
			    			<input type="text" maxlength="1" class="form-control input-number text-center">
			    		</div>
			    		<div class="col">
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
	    </div>
	    <div class="col-md-6 mt-2">
	    	<div class="card height" style="height:100%;">
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
			    		<div class="col">
			    			<!-- การแทง -->
			    		</div>
			    		<div class="col text-right">
			    			<!-- <a href="#" id="btn-del-all">ลบทั้งหมด</a> -->
			    		</div>
			    	</div>
			    	<form action="#" method="POST" id="form-lotto">
			    		<input type="hidden" name="id_category" value="<?php echo $_GET['id'];?>">
			    		<table class="table" id="table-lotto">
				    		<thead>
				    			<th>ประเภท</th>
				    			<th>เลข</th>
				    			<th class="text-right">แทง</th>
				    			<th>จ่าย</th>
				    			<th class="text-right">ชนะ</th>
				    			<th class="text-right">ลบ</th>
				    		</thead>
				    		<tbody>
				    			<?php if($lotto){ ?>
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
				    			<?php } ?>
				    		</tbody>
				    	</table>
			    	</form>
			    </div>
			</div>
	    </div>				
	</div>
	<div class="row mt-4">
		<div class="col-12">
			<div class="load-btn mt-20">
	        	<button type="submit" class="hvr-btn btn-block" id="btn-submit">ส่งโพยยืนยันการแทง</button>
	        </div>
		</div>
	</div>
</div>
<div class="position-fixed top-0 right-0 p-3" style="z-index: 99999; right: 0; bottom: 0;">
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
	$(document).on('click','.rdoType',function(e){
		var ele = $(this);
		$( ".input-number" ).each(function( index ) {
		  $(this).val("");
		});
		$('#price').val('');
		if(ele.attr('data-input-count') == "2"){
			$('#for-3-digit').addClass('hidden');
		}else{
			$('#for-3-digit').removeClass('hidden');
		}
	});
	$(document).on('click','#btn-add-lotto',function(e){
		var number = "";
		$( ".input-number" ).each(function( index ) {
		 number += $(this).val();
		});
		number = parseInt(number);
		var price = $('#price').val();
		var id_type = $('input[name="rdoType"]:checked').val();
		$.ajax({
			url: 'index.php?route=member/addLotto',
			type: 'POST',
			dataType: 'json',
			data: {
				number: number,
				price: $('#price').val(),
				id_type: id_type,
				id_category: '<?php echo $_GET['id'];?>'
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
				var html =   '<tr>'
				+ '<td>'+result.lotto.type+'<input type="hidden" name="type[]" value="'+result.lotto.type+'"><input type="hidden" name="id_type[]" value="'+result.lotto.id_type+'"></td>'
				+ '<td>'+result.lotto.number+'<input type="hidden" name="number[]" value="'+result.lotto.number+'"></td>'
				+ '<td class="text-right">'+result.lotto.price+'<input type="hidden" name="price[]" value="'+result.lotto.price+'"></td>'
				+ '<td>'+result.lotto.ratio+'<input type="hidden" name="ratio[]" value="'+result.lotto.ratio+'"></td>'
				+ '<td class="text-right">'+result.lotto.paid+'<input type="hidden" name="paid[]" value="'+result.lotto.paid+'"></td>'
				+ '<td class="text-right"><a href="#" class="btn btn-danger btn-xs btn-del">ลบ</a></td>'
				+'</tr>';
				$('#table-lotto  tbody:last-child').append(html);
				
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