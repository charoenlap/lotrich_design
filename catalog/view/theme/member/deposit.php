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
<form role="form">
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
									<p>กสิกรไทย</p>
									<p>xxx-x-xxxxx-x</p>
									<p>ชื่อบัญชี: x</p>
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
					<?php $arr = array(100,200,300,500,1000,2000,3000,5000,1000);
 					foreach($arr as $val){?>
 					<div class="col-4 text-center">
 						<a href="#" data-price="<?php echo $val;?>" class="btn   btn-block btn-price mb-2">
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
						<a class="hvr-btn btn-block" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">ยืนยันรายการ</a>
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
	        <form>
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">ยอดเงินที่ต้องโอน: <span class="text-danger">100.34</span></label>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">กรุณาโอนภายในเวลา: <span class="text-danger" id="time">00:15:00</span></label>
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
	        <div class="load-btn mt-20">
	        	<button type="submit" class="hvr-btn btn-block">ยืนยันการชำระเงิน</button>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<script>
	$(document).on('click','.btn-price',function(e){
		var price = $(this).attr('data-price');
		$('#txt-price').val(price);
	});
</script>
<script>
// Set the date we're counting down to


// Update the count down every 1 second
var now_start = new Date().getTime();
var countDownDate = new Date(now_start + 15*60000).getTime();
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
  // var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  
  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("time").innerHTML = minutes + "นาที " + seconds + " วินาที ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "EXPIRED";
  }
}, 1000);
</script>