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
				<form>
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="" class="form-control input_user" value="" placeholder="username">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="" class="form-control input_pass" value="" placeholder="password">
					</div>
					<div class=" mt-3 login_container">
						<div class="load-btn mt-20">
							<input type="submit" class="hvr-btn btn-block" value="เข้าสู่ระบบ">
						</div>
				   </div>
				</form>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<a href="#" class="ml-2">สมัครสมาชิก</a> / <a href="<?php echo route('forgot'); ?>">ลืมรหัสผ่าน?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>