<section class="breadcamb-area bg-17 bg-overlay-1">
    <div class="container">
        <div class="bradcamb-content text-center text-white text-uppercase">
            <h1>ผลรางวัล</h1>
            <ul>
                <li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
                <li>ผลรางวัล</li>
            </ul>   
        </div>
    </div>
</section>
<div class="container">
	<!-- <div class="row mt-5">
		<div class="col-6 col-md-2 text-left">
			<form action="<?php echo $action;?>" method="GET" id="form-date">
				<input type="hidden" name="route" value="yeekee/result">
				<input type="text" class="form-control" value="<?php echo $date;?>" id="date-result" name="date" placeholder="ระบุวันที่">
			</form>
		</div>
	</div> -->
	<div class="row mt-4 panel-result" >
			<div class="col-12 mb-4 ">
				<div class="d-inline-flex text-default mb-1">
					<h4 class="d-inline text-default mr-2"></h4>
					<span class="badge rounded-pill bg-success" style="    line-height: 1.8;"></span>
				</div>
				<div class="row">
					<div class="col-12" style=" ">
						<div class="box" style="">
							<div class="row">
								<div class="col-md-12 text-center mb-2" >
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">รอบ <?php echo substr($yeekee['id_round'],6,2).':'.substr($yeekee['id_round'],8,2); ?></h5>
									  	</div>
									</div>
								</div>
							</div>
							<div class="row" >
								<div class="col-md-6 text-center mb-2" >
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">3 ตัวบน</h5>
									  	</div>
									  	<div class="card-body">
									    	<h4><?php echo $yeekee['result_3_digit']; ?></h4>
									  	</div>
									</div>
								</div>
								<div class="col-md-6 text-center mb-2" >
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">2 ตัวล่าง</h5>
									  	</div>
									  	<div class="card-body">
									    	<h4><?php echo $yeekee['result_2_digit']; ?></h4>
									  	</div>
									</div>
								</div>
								<div class="col-md-12 text-center mb-2" >
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">ผลรวมเลข</h5>
									  	</div>
									  	<div class="card-body">
									    	<h3><?php echo $yeekee['result_no']; ?></h3>
									  	</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
	</div>
</div>


<style>
	.card-body {
	background: #fff;
	flex: 0 0 auto !important;
    padding: 0rem 0rem !important;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date-result" ).datepicker({ dateFormat: 'yy-mm-dd' });

  });
  $("#date-result").on('change',function(e){
  	$('#form-date').submit();
  });
  </script>