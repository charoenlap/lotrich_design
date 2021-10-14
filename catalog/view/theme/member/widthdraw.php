<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>ถอนเงิน</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li class="active">ถอนเงิน</li>
			</ul>	
		</div>
	</div>
</section>
<form role="form">
	<div class="container mt-4">
		<div class="row">
		    <div class="col-md-12">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							ถอนเงินเข้าบัญชีธนาคาร
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="panel">
							<div class="card">
								<div class="card-body">
									<p>กสิกรไทย</p>
									<p>xxx-x-xxxxx-x</p>
									<p>ชื่อบัญชี: x</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-12">
						<div class="form-group text-center">
							<h3>จำนวนเงินที่ถอนได้ <label for="">x,xxx</label></h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<a class="hvr-btn btn-block" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">ยืนยันรายการ</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">กรุณาโอนเงินตามยอดที่แจ้งเท่านั้น</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">ยอดเงินที่ต้องโอน: <span class="text-danger">100.34</span></label>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">กรุณาโอนภายในเวลา: <span class="text-danger">00:10:00</span></label>
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
	            		<input type="text" class="form-control" value="<?php echo date('H');?>">
	            	</div>
	            	<div class="col-6">
	            		<input type="text" class="form-control" value="<?php echo date('i');?>">
	            	</div>
	            </div>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">กรุณาแนบหลักฐานการโอนเงิน</label>
	            <input type="file" >
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
	        <button type="submit" class="btn btn-primary">ยืนยันการชำระเงิน</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>