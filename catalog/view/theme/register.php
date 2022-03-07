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
							ชื่อ <span class="text-danger">*</span>
	                        <input type="text" name="name" required id="name" class="form-control input-lg" placeholder="ชื่อ" tabindex="1">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<div class="form-group">
							นามสกุล<span class="text-danger">*</span>
							<input type="text" name="lname" required id="lname" class="form-control input-lg" placeholder="นามสกุล" tabindex="2">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<div class="form-group">
							เบอร์โทรศัพท์ <span class="text-danger">*</span>
							<input type="text" name="phone" id="phone" class="txt-check-dupplicate form-control input-lg" placeholder="เบอร์โทรศัพท์" tabindex="3" min="10" max="10" required>
							<label for="" class=""></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							หมายเลขบัญชีธนาคาร <span class="text-danger">*</span>
							<input type="text" name="bank_no" id="bank_no" class="txt-check-dupplicate form-control input-lg" placeholder="หมายเลขบัญชีธนาคาร" tabindex="4" required>
							<label for="" class=""></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							ธนาคาร <span class="text-danger">*</span>
							<select name="bank_name" id="bank_name" class="form-control input-lg" required>
								<option value="">เลือกธนาคาร</option>
								<?php foreach($bank as $val){?>
									<option value="<?php echo $val['name'];?>"><?php echo $val['name'];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							หมายเลขบัญชีธนาคาร (ถ้ามี กรณีฉุกเฉิน)
							<input type="text" name="bank_no_2" id="bank_no_2" class="txt-check-dupplicate form-control input-lg" placeholder="หมายเลขบัญชีธนาคาร" tabindex="6">
							<label for="" class=""></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							ธนาคาร
							<select name="bank_name_2" id="bank_name_2" class="form-control input-lg">
								<option value="">เลือกธนาคาร</option>
								<?php foreach($bank as $val){?>
									<option value="<?php echo $val['name'];?>"><?php echo $val['name'];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							ชื่อผู้ใช้ในการเข้าสู่ระบบ <span class="text-danger">*</span>
							<input type="text" name="email" id="email" class="txt-check-dupplicate form-control input-lg" placeholder="ชื่อผู้ใช้ในการเข้าสู่ระบบ" tabindex="8" required>
							<label for="" class=""></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							อีเมล <span class="text-danger">*</span>
							<input type="email_2" name="email_2" id="email_2" class="txt-check-dupplicate form-control input-lg" placeholder="อีเมล" tabindex="8">
							<label for="" class=""></label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							รหัสผ่าน <span class="text-danger">*</span>
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="รหัสผ่าน" tabindex="9" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							ยืนยันรหัสผ่าน <span class="text-danger">*</span>
							<input type="password" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="ยืนยันรหัสผ่าน" tabindex="10" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label for="" class="text-default">* กรุณากรอกชื่อจริง ให้ตรงกับบัญชีธนาคาร เนื่องจากมีผลกับการฝาก และถอนเงิน</label>
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
	$(document).on('blur','.txt-check-dupplicate',function(e){
		var ele = $(this);
		var val = $(this).val();
		var id= ele.attr('id');
		$.ajax({
			url: 'index.php?route=register/checkRegister',
			type: 'POST',
			dataType: 'json',
			data: {
				id: id,
				val: val
			},
		})
		.done(function(json) {
			console.log(json)
			var label = $(ele).parents('.form-group').find('label');
			label.html(json.desc);
			label.removeClass('text-default');
			label.removeClass('text-danger');
			if(json.status=='success'){
				label.addClass('text-default');
			}else{
				label.addClass('text-danger');
			}
			console.log(json.desc);
			console.log("success");
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