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
		    <div class="col-md-12">
		    	<?php foreach($lotto as $val){ ?>
				<div class="row pt-4" style="border-top:solid 1px #3e3e3e;">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<h4 style="color:#fff;">รหัสโพย: <?php echo $val['id']; ?></h4>
							สร้างเมื่อ: <?php echo $val['date_create']; ?>
						</div>
					</div>
				</div>
				<div class="row" >
					<div class="col-4">
						<h2 style="color:#fff;"><?php echo $val['name']; ?></h2>
					</div>
					<div class="col-4 text-center">
						เงินเดิมพันรวม <span class=""><?php echo $val['total'];?></span>
					</div>
					<div class="col-4 text-center">
						ผลแพ้ชนะรวม <span class="text-warning"><?php echo number_format($val['receive'],2);?></span>
					</div>
				</div>
				<?php 
					$i=1;
					foreach($val['lotto'] as $key => $val_sub){ ?>
					<div class="row">
						<div class="col-4">
							<h3 style="color:#fff;"><?php echo $val_sub['number'];?></h3>
							<p style="color:#fff;"><?php echo $val_sub['type'];?></p>
						</div>
						<div class="col-4 text-center ">
							เงินเดิมพัน
							<p style="color:#fff;"><?php echo number_format($val_sub['price'],2);?></p>
						</div>
						<div class="col-4 text-center ">
							ผลแพ้ชนะ
							<p style="color:#fff;"><?php echo number_format($val_sub['receive'],2);?></p>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
				<div class="row">
					<div class="load-btn mt-20">
			        	<a href="<?php echo route('member/dashboard'); ?>" class="hvr-btn btn-block">ซื้อเพิ่ม</a>
			        </div>
				</div>
			</div>
		</div>
	</div>