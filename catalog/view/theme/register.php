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
			<form role="form">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4">
						<div class="form-group">
							ชื่อ
	                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="ชื่อ" tabindex="1">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<div class="form-group">
							นามสกุล
							<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="นามสกุล" tabindex="2">
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
							<input type="text" name="text" id="bankno" class="form-control input-lg" placeholder="หมายเลขบัญชีธนาคาร" tabindex="4">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="form-group">
							ธนาคาร
							<input type="text" name="text" id="bank" class="form-control input-lg" placeholder="ธนาคาร" tabindex="5">
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
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="ยืนยันรหัสผ่าน" tabindex="8">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="load-btn mt-20">
							<input type="submit" class="hvr-btn btn-block" value="ยอมรับข้อตกลงเงื่อนไข">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>