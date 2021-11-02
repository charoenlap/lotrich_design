<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>การเงิน</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li>การเงิน</li>
			</ul>	
		</div>
	</div>
</section>
	<div class="container mt-4">
		<div class="row">
		    <div class="col-md-12">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs mb-3 text-center" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ทั้งหมด</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link text-success" id="pills-deposit-tab" data-toggle="pill" href="#pills-deposit" role="tab" aria-controls="pills-deposit" aria-selected="false">ฝาก</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link text-danger" id="pills-widthdraw-tab" data-toggle="pill" href="#pills-widthdraw" role="tab" aria-controls="pills-widthdraw" aria-selected="false">ถอน</a>
						  </li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
						  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						  	<table class="table">
						  		<thead>
						  			<th style="width:150px;">วันที่</th>
						  			<th>ประเภท</th>
						  			<th class="text-right" style="width:100px;">จำนวนเงิน</th>
						  			<th class="text-center" style="width:100px;">สถานะ</th>
						  		</thead>
						  		<?php foreach($transection as $val){ 
						  				$status = $val['status'];
						  				$text_status = 'รอการอนุมัติ';
						  				$class = 'text-info';
						  				if($status == 1 ){
						  					$text_status = 'อนุมัติ';
						  					$class = 'text-success';
						  				}else if($status == 2 ){
						  					$text_status = 'ถูกปฏิเสธ';
						  					$class = 'text-danger';
						  				}
						  		?>
						  		<tr>
						  			<td><?php echo $val['date_create']; ?></td>
						  			<td><?php echo $val['detail']; ?></td>
						  			<td class="text-right"><?php echo $val['amount']; ?></td>
						  			<td class="text-center <?php echo $class;?>">
						  				<?php echo $text_status; ?>
						  			</td>
						  		</tr>
						  		<?php } ?>
						  	</table>
						  </div>
						  <div class="tab-pane fade" id="pills-deposit" role="tabpanel" aria-labelledby="pills-deposit-tab">
						  	<table class="table">
						  		<thead>
						  			<th style="width:150px;">วันที่</th>
						  			<th class="text-right" style="width:100px;">จำนวนเงิน</th>
						  			<th class="text-center" style="width:100px;">สถานะ</th>
						  		</thead>
						  		<?php 
						  		foreach($transection as $val){ 
						  			if($val['type']=="0"){
						  				$status = $val['status'];
						  				$text_status = 'รอการอนุมัติ';
						  				$class = 'text-info';
						  				if($status == 1 ){
						  					$text_status = 'อนุมัติ';
						  					$class = 'text-success';
						  				}else if($status == 2 ){
						  					$text_status = 'ถูกปฏิเสธ';
						  					$class = 'text-danger';
						  				} ?>
								  		<tr>
								  			<td><?php echo $val['date_create']; ?></td>
								  			<td class="text-right"><?php echo $val['amount']; ?></td>
								  			<td class="text-center <?php echo $class;?>">
								  				<?php echo $text_status; ?>
								  			</td>
								  		</tr>
						  			<?php } ?>
						  		<?php } ?>
						  	</table>
						  </div>
						  <div class="tab-pane fade" id="pills-widthdraw" role="tabpanel" aria-labelledby="pills-widthdraw-tab">
						  	<table class="table">
						  		<thead>
						  			<th style="width:150px;">วันที่</th>
						  			<th class="text-right" style="width:100px;">จำนวนเงิน</th>
						  			<th class="text-center" style="width:100px;">สถานะ</th>
						  		</thead>
						  		<?php 
						  		foreach($transection as $val){ 
						  			if($val['type']=="1"){
						  				$status = $val['status'];
						  				$text_status = 'รอการอนุมัติ';
						  				$class = 'text-info';
						  				if($status == 1 ){
						  					$text_status = 'อนุมัติ';
						  					$class = 'text-success';
						  				}else if($status == 2 ){
						  					$text_status = 'ถูกปฏิเสธ';
						  					$class = 'text-danger';
						  				} ?>
								  		<tr>
								  			<td><?php echo $val['date_create']; ?></td>
								  			<td class="text-right"><?php echo $val['amount']; ?></td>
								  			<td class="text-center <?php echo $class;?>">
								  				<?php echo $text_status; ?>
								  			</td>
								  		</tr>
						  			<?php } ?>
						  		<?php } ?>
						  	</table>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).on('click','.nav-link',function(e){
			$( ".tab-pane" ).each(function() {
				$(this).removeClass('active');
				$(this).removeClass('show');
			});
			$( ".nav-link" ).each(function() {
				$(this).removeClass('active');
			});
			$(this).addClass('active');
			var tab_id = $(this).attr('href');//.addClass('show');
			$(tab_id).addClass('active');
			$(tab_id).addClass('show');
			e.preventDefault();
		});
	</script>