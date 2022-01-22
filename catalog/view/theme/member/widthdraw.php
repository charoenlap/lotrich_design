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
							<div class="card-body text-center">
								<div class="row">
									<div class="col-6">
										<?php if($bank_logo){ ?>
										<div class="text-center"><img src="<?php echo $bank_logo; ?>" alt="" style="width:100px;"></div>
										เลขที่บัญชี: <?php echo $bank_no; ?></br>
										ธนาคาร: <?php echo $bank_name; ?></br>
										ชื่อบัญชี: <?php echo $name; ?>
										<?php } ?>
									</div>
									<?php if($bank_name_2){ ?>
									<div class="col-6">
										<div class="text-center"><img src="<?php echo $bank_logo_2; ?>" alt="" style="width:100px;"></div>
										เลขที่บัญชี: <?php echo $bank_no_2; ?></br>
										ธนาคาร: <?php echo $bank_name_2; ?></br>
										ชื่อบัญชี: <?php echo $name; ?>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
					<div class="form-group text-center">
						<h4 class="text-default">จำนวนเงินที่ถอนได้</h4>
						<h3 class="text-default" ><?php echo number_format($balance,2); ?></h3>
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
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ยอดเงินที่ต้องการถอน: </label>
          </div>
          <div class="form-group">
            <input type="text" id="price_widthdraw" class="form-control" placeholder="กรุณาใส่เป็นตัวเลขเท่านั้น">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="hvr-btn btn-block" id="btn-submit">ยืนยันการชำระเงิน</button>
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
		$('#btn-submit').prop('disabled', true);
		$('#btn-submit').attr('aria-disabled', true);
		$('#btn-submit').addClass('disabled');
		$('#btn-submit').removeClass('hvr-btn');
		$.ajax({
			url: 'index.php?route=member/submitWidthdraw',
			type: 'POST',
			dataType: 'json',
			data: {
				price: $('#price_widthdraw').val()
			},
		})
		.done(function(result) {
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
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		e.preventDefault();
	});
</script>