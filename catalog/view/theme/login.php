<section class="breadcamb-area bg-17 bg-overlay-1">
    <div class="container">
        <div class="bradcamb-content text-center text-white text-uppercase">
            <h1>เข้าสู่ระบบ</h1>
            <ul>
                <li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
                <li>เข้าสู่ระบบ</li>
            </ul>   
        </div>
    </div>
</section>
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container mt-4">
	    <div class="row">
	        <div class="col-md-12">
				<form action="<?php echo $action; ?>" id="form-login" method="POST">
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						</div>
						<input type="text" name="email" class="form-control input_user" value="<?php echo $username; ?>" placeholder="Username/อีเมล์/เบอร์โทรศัพท์">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
					</div>
					<div class="text-center">
						<input type="checkbox" value="1" name="chk" id="chk" <?php echo (!empty('chk')?'checked':''); ?>> <label for="chk">จดจำการเข้าสู่ระบบ</label>
					</div>
					<div class=" mt-3 login_container">
						<div class="load-btn mt-20">
							<input type="submit" class="hvr-btn btn-block" value="เข้าสู่ระบบ">
						</div>
				   </div>
				</form>
		
				<div class="mt-4">
					<div class="text-center links">
						<a href="<?php echo route('register'); ?>" class="ml-2">สมัครสมาชิก</a> / <a href="<?php echo route('forgot'); ?>" class="ml-2"><small>ลืมรหัสผ่าน?</small></a>

					</div>
				</div>
			</div>
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
	$(document).on('submit','#form-login',function(e){
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
					window.location='index.php?route=member/dashboard'; 
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