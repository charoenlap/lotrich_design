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
	<div class="container mt-4">
		<div class="row">
			<?php foreach($lotto as $val){ ?>
		    <div class="col-md-6">
		    	<div class="card mb-4">
		    		<div class="card-body">
		    			<div class="row pt-4" style="border-top:solid 1px #3e3e3e;">
							<div class="col-xs-12 col-sm-12">
								<div class="form-group">
									<h4>รหัสโพย: <?php echo $val['id']; ?></h4>
									สร้างเมื่อ: <?php echo $val['date_create']; ?>
								</div>
							</div>
						</div>
						<div class="row" >
							<div class="col-4">
								<h3><?php echo $val['name']; ?></h3>
							</div>
							<div class="col-4 text-center">
								เงินเดิมพันรวม <span class=""><?php echo $val['total'];?></span>
							</div>
							<div class="col-4 text-center">
								ผลแพ้ชนะรวม <span class="text-<?php echo ((int)$val['receive']>0?'success':'danger');?>"><?php echo number_format($val['receive'],2);?></span>
							</div>
						</div>
						<?php 
						$i=1;
						foreach($val['lotto'] as $key => $val_sub){ ?>
						<div class="row">
							<div class="col-4">
								<h3><?php echo $val_sub['number'];?></h3>
								<p><?php echo $val_sub['type'];?></p>
							</div>
							<div class="col-4 text-center ">
								เงินเดิมพัน
								<p><?php echo number_format($val_sub['price'],2);?></p>
							</div>
							<div class="col-4 text-center ">
								ผลแพ้ชนะ
								<p><?php echo number_format($val_sub['receive'],2);?></p>
							</div>
						</div>
						<?php } ?>
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