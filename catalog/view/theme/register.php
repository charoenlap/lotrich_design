<section class="breadcamb-area bg-17 bg-overlay-1">
    <div class="container">
        <div class="bradcamb-content text-center text-white text-uppercase">
            <h1>สมัครสมาชิก</h1>
            <ul>
                <li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
                <li>สมัครสมาชิก</li>
            </ul>   
        </div>
    </div>
</section>
<div class="container mt-4">
	<div class="row">
	    <div class="col-md-12">
			<form role="form" action="<?php echo $action; ?>" id="form-register" method="POST">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4">
						<div class="form-group">
							ชื่อ
	                        <input type="text" name="name" id="name" class="form-control input-lg" placeholder="ชื่อ" tabindex="1">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<div class="form-group">
							นามสกุล
							<input type="text" name="lname" id="lname" class="form-control input-lg" placeholder="นามสกุล" tabindex="2">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<div class="form-group">
							เบอร์โทรศัพท์
							<input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="เบอร์โทรศัพท์" tabindex="3">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							หมายเลขบัญชีธนาคาร
							<input type="text" name="bank_no" id="bank_no" class="form-control input-lg" placeholder="หมายเลขบัญชีธนาคาร" tabindex="4">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							ธนาคาร
							<input type="text" name="bank_name" id="bank_name" class="form-control input-lg" placeholder="ธนาคาร" tabindex="5">
						</div>
					</div>
				</div>
				<div class="form-group">
					อีเมล
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="อีเมล" tabindex="6">
				</div>
				
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							รหัสผ่าน
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="รหัสผ่าน" tabindex="7">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							ยืนยันรหัสผ่าน
							<input type="password" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="ยืนยันรหัสผ่าน" tabindex="8">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="load-btn mt-20">
							<input type="submit" id="btn-submit" class="hvr-btn btn-block" value="ยอมรับข้อตกลงเงื่อนไข">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="position-fixed top-0 right-0 p-3" style="z-index: 99; right: 0; bottom: 0;">
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
	$(document).on('submit','#form-register',function(e){
		var ele = $(this);
		$('#btn-submit').prop('disabled', true);
		$('#btn-submit').attr('aria-disabled', true);
		$('#btn-submit').addClass('disabled');
		$('#btn-submit').removeClass('hvr-btn');
		$.ajax({
			url: ele.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: ele.serialize(),
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
					window.location='index.php?route=login'; 
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
</script>