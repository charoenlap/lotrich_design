<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>ดูโพย</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li class="active">ดูโพย</li>
			</ul>	
		</div>
	</div>
</section>
<section>
	<div class="container">
		<form action="<?php echo $action; ?>" method="GET">	
			<input type="hidden" name="route" value="member/ticket">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<h4>รายงานดูยอดที่แทง</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group">
								<label for="">เลือกวันเริ่ม</label>
					            <div class="input-group date datetimepicker">
									<span class="input-group-addon btn btn-warning">
										<span class="fa fa-calendar"></span>
									</span>
									<input type="text" class="form-control datepicker" id="date" 
										name="date" value="<?php echo $date;?>"/>
								</div>
					         </div>
						</div>
						<div class="col-sm-5">
							<div class="form-group">
								<label for="">เลือกวันสิ้นสุด</label>
					            <div class="input-group date datetimepicker">
									<span class="input-group-addon btn btn-warning">
										<span class="fa fa-calendar"></span>
									</span>
									<input type="text" class="form-control datepicker" id="date_end" 
										name="date_end" value="<?php echo $date_end;?>"/>
								</div>
					         </div>
						</div>
						<div class="col-sm-2">
							<label for="">&nbsp;</label><br>
							<input type="submit" class="btn btn-primary" value="ค้นหา">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>

<div class="container mt-4">
	<div class="row">
		<?php foreach($lotto as $val){ ?>
	    <div class="col-md-6">
	    	<div class="card mb-4">
	    		<div class="card-body">
	    			<div class="row pt-4" style="border-top:solid 1px #3e3e3e;">
						<div class="col-xs-6 col-sm-6">
							<div class="form-group">
								<h3>
									<?php echo $val['name']; ?>
								</h3>
								<h4>รหัสโพย: <?php echo $val['id']; ?></h4>
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 text-right">
							สร้างเมื่อ: <?php echo $val['date_create']; ?>
						</div>
					</div>
					<div class="row" >
						<div class="col-4 text-center">
							<b class="text-danger">(ส่วนลด <span class=""><?php echo $val['discount'];?>%</span>)</b>
						</div>
						<div class="col-4 text-center">
							<div>
								<div>เดิมพันรวม</div> 
								<div><span class=""><?php echo $val['total'];?></span></div>
							</div>
						</div>
						<div class="col-4 text-center">
							<div>ผลแพ้ชนะรวม</div> 
							<div><span class="text-<?php echo ((int)$val['receive']>0?'success':'danger');?>"><?php echo number_format($val['receive'],2);?></span></div>
						</div>
					</div>
					<div class="panel-table">
						<div class="row">
							<div class="col-4">
								<div class="text-center">เลข</div>
							</div>
							<div class="col-4 text-center ">
								<div class="text-center">เงินเดิมพัน</div>
							</div>
							<div class="col-4 text-center ">
								<div class="text-center">ผลแพ้ชนะ</div>
							</div>
						</div>
						<?php 
						$i=1;
						foreach($val['lotto'] as $key => $val_sub){ ?>
						<div class="row">
							<div class="col-4">
								<h3 class="text-center"><?php echo $val_sub['number'];?></h3>
								<p class="text-center"><?php echo $val_sub['type'];?></p>
							</div>
							<div class="col-4 text-center ">
								<p><?php echo number_format($val_sub['price'],2);?></p>
							</div>
							<div class="col-4 text-center ">
								<p><?php echo number_format($val_sub['receive'],2);?></p>
							</div>
						</div>
						<?php } ?>
					</div>
	    		</div>
	    	</div>
		</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="load-btn mt-20">
        	<a href="<?php echo route('member/dashboard'); ?>" class="hvr-btn btn-block">ซื้อเพิ่ม</a>
        </div>
	</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

  });
  </script>
  <style>
  	.panel-table .row:nth-child(odd) {
		background-color: #f2f2f2;
	}
	.panel-table .row {
		padding-top: 10px; 
	}
	.panel-table .row h3 {
		margin-bottom:0px;
	}
  </style>