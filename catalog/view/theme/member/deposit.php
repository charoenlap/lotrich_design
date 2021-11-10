<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>แจ้งเติมเงิน</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li class="active">แจ้งเติมเงิน</li>
			</ul>	
		</div>
	</div>
</section>
	<div class="container mt-4">
		<div class="row">
		    <div class="col-md-12">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							กรุณาโอนเงินจากบัญชี ที่ท่านสมัครเท่านั้น
						</div>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-12">
						<div class="panel">
							<div class="card">
								<div class="card-body">
									<?php echo $bank_no; ?><br>
									<?php echo $bank_name; ?><br>
									ชื่อบัญชี: <?php echo $name; ?>
									<?php if($bank_no_2){?>
										<hr>
										<?php echo $bank_no_2; ?><br>
										<?php echo $bank_name_2; ?><br>
										ชื่อบัญชี: <?php echo $name; ?>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h4>ใส่จำนวนเงินที่ต้องการฝาก</h4>
					</div>
				</div>
				<div class="row mb-4">
					<?php $arr = array(100,200,300,500,1000,2000,3000,5000,10000);
 					foreach($arr as $val){?>
 					<div class="col-4 text-center">
 						<a href="#"  data-price="<?php echo $val;?>" class="btn   btn-block btn-price mb-2">
 							<?php echo number_format($val); ?>
 						</a>
 					</div>
 					<?php } ?>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<h4>จำนวนเงิน ขั้นต่ำ 10 บาท ไม่ต้องมีทศนิยม</h4>
							<input type="text" name="text" id="txt-price" class="form-control input-lg" placeholder="กรุณาใส่จำนวนเงิน" tabindex="5">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<a class="hvr-btn btn-block" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btn-confirm">ยืนยันรายการ</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header pt-60">
	        <h5 class="modal-title" id="exampleModalLabel">กรุณาโอนเงินตามยอดที่แจ้งเท่านั้น</h5>
	        <button type="button" data-bs-dismiss="modal">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form method="POST" action="<?php echo $action;?>" id="form-deposit">
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">ยอดเงินที่ต้องโอน: 
	            	<span class="text-danger" id="text-price-tranfer"></span>
	            	<input type="hidden" id="price" name="price" value="">
	            </label>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">กรุณาโอนภายในเวลา: <span class="text-danger" id="time"></span></label>
	          </div>
	          <div class="form-group">
	            <div class="card">
	            	<div class="card-body">
	            		<label for="message-text" class="col-form-label">บัญชีที่โอน:กสิกร</label><br>
	               		<label for="message-text" class="col-form-label">หมายเลขบัญชี:xxx-x-xxxxx-x</label><br>
	             		<label for="message-text" class="col-form-label">ชื่อบัญชี: </label>
	            	</div>
	            </div>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">กรุณาใส่เวลาที่โอน</label>
	            <div class="row">
	            	<div class="col-6">
	            		<input type="text" id="hour" name="hour" class="form-control" value="<?php echo date('H');?>">
	            	</div>
	            	<div class="col-6">
	            		<input type="text" id="minutes" name="minutes" class="form-control" value="<?php echo date('i');?>">
	            	</div>
	            </div>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">กรุณาแนบหลักฐานการโอนเงิน</label>
	            <input type="file" id="file" name="file" onchange="validate_fileupload(this.value);">
	            <span id="text-file"></span>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <div class="load-btn mt-20">
	        	<button type="submit" class="hvr-btn btn-block" id="btn-submit">ยืนยันการชำระเงิน</button>
	        </div>
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
	$(document).on('click','.btn-price',function(e){
		var price = $(this).attr('data-price');
		$('#txt-price').val(price);
		
		e.preventDefault();
	});
	var x;
	$(document).on('click','#btn-confirm',function(e){
		var now_start = new Date().getTime();
		var countDownDate = new Date(now_start + 10*60000).getTime();
		clearInterval(x);
		x = setInterval(function() {
		  var now = new Date().getTime();
		  var distance = countDownDate - now;
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		  document.getElementById("time").innerHTML = minutes + "นาที " + seconds + " วินาที ";
		  if (distance < 0) {
		    clearInterval(x);
		    document.getElementById("time").innerHTML = "EXPIRED";
		    $('#btn-submit').prop('disabled', true);
			$('#btn-submit').attr('aria-disabled', true);
			$('#btn-submit').addClass('disabled');
			$('#btn-submit').removeClass('hvr-btn');
		  }
		}, 1000);
		var price = $('#txt-price').val();
		var random = Math.floor(Math.random() * 100);
		var total = price + '.' + random;
		$('#price').val(total);
		$('#text-price-tranfer').text(total);
	});
	$(document).on('click','#btn-submit',function(e){

		var form = $('#form-deposit')[0];
		var data = new FormData(form);
		$('#btn-submit').prop('disabled', true);
		$('#btn-submit').attr('aria-disabled', true);
		$('#btn-submit').addClass('disabled');
		$('#btn-submit').removeClass('hvr-btn');
		// var formData = new FormData();
		// formData.append('file', $('#file')[0].files[0]);
		// formData.append('price', $('#price').val());
		// formData.append('hour', $('#hour').val());
		// formData.append('minutes', $('#minutes').val());

		$.ajax({
			url: 'index.php?route=member/depositSubmit',
			type: 'POST',
			dataType: 'json',
			enctype: 'multipart/form-data',
			data: data,
			processData: false,
            contentType: false,
            cache: false,
            // timeout: 800000,
		})
		.done(function(result) {
			console.log("success");
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
				setInterval(function(){ 
					window.location='index.php?route=member/finance'; 
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
		e.preventDefault();
	});
	function validate_fileupload(fileName){
	    var allowed_extensions = new Array("jpg","png","gif");
	    var file_extension = fileName.split('.').pop().toLowerCase();
	    for(var i = 0; i <= allowed_extensions.length; i++){
	        if(allowed_extensions[i]==file_extension){
	         	$('#text-file').text('สามารถใช้รูปภาพนี้ได้');  
	         	$('#text-file').removeClass('text-danger');
	         	$('#text-file').addClass('text-success');
	         	return true; 
	        }
	    }
	    $('#text-file').text('ไม่สามารถใช้รูปภาพนี้ได้');
	    $('#text-file').removeClass('text-success');
	    $('#text-file').addClass('text-danger');
	    return false;
	}
</script>