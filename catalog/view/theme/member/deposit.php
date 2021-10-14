<form role="form">
	<div class="container mt-4">
		<div class="row">
		    <div class="col-md-12">
				<h2 class="text-center">แจ้งเติมเงิน</small></h2>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							กรุณาโอนเงินจากบัญชี ที่ท่านสมัครเท่านั้น
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
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							จำนวนเงิน ขั้นต่ำ 10 บาท ไม่ต้องมีทศนิยม
							<input type="text" name="text" id="bank" class="form-control input-lg" placeholder="กรุณาใส่จำนวนเงิน" tabindex="5">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-10">
						<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">ยืนยันรายการ</button>
					</div>
					<div class="col-xs-12 col-md-2"><a href="#" class="btn btn-danger btn-block">ยกเลิก</a></div>
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