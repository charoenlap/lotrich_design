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
	<div class="row mt-5">
		<div class="col-6 col-md-2 text-left">
			<form action="<?php echo $action;?>" method="GET" id="form-date">
				<input type="hidden" name="route" value="result">
				<input type="text" class="form-control" value="<?php echo $date;?>" id="date-result" name="date" placeholder="ระบุวันที่">
			</form>
		</div>
		<div class="col-6 col-md-10 text-right">
			<a href="<?php echo route('login');?>" class="btn ">เข้าสู่ระบบ คลิกที่นี่</a>
		</div>
	</div>
	<div class="row mt-4 panel-result" >
	<?php foreach($category as $val){ ?>
			<?php 
			$class_col_cate = 'col-md-12';
			if($val['column']==1){
				$class_col_cate = 'col-md-12';
			}else if($val['column']==2){
				$class_col_cate = 'col-md-6';
			} ?>
			<div class="col-12 mb-4 <?php echo $class_col_cate;?>">
				<div class="d-inline-flex text-default mb-1">
					<div class="d-inline" style="background:url(uploads/flag/<?php echo $val['flag'];?>);width:40px;height:25px;background-size:cover;background-position: center;margin-right:10px;"></div>
					<h4 class="d-inline text-default mr-2"><?php echo $val['name'];?></h4>
					<span class="badge rounded-pill bg-success" style="    line-height: 1.8;"><?php echo $val['last_date'];?></span>
				</div>
				<div class="row">
					<div class="col-12" style=" ">
						<div class="box" style="">
							<div class="row" >
								<?php 
									if(empty($val['sub'])){
										// var_dump($val['type']);
										foreach($val['type'] as $type){
											if($type['column']==1){
												$class="col-12";
											}else if($type['column']==2){
												$class="col-6";
											}else if($type['column']==3){
												$class="col-4";
											}else if($type['column']==4){
												$class="col-2";
											}else if($type['column']==5){
												$class="col-1";
											}else{
												$class="col-6 col-xs-6 col-sm-4 col-md-4 col-lg-3";
											}
										?>
												<div class="<?php echo $class;?> text-center mb-2" >
													<div class="card">
														<div class="card-header">
													  		<?php echo $type['type']; ?>
													  	</div>
													  	<div class="card-body">
													    	<h5 class="card-title"><?php echo (empty($type['result'])?'รอผล':$type['result']); ?></h5>
													  	</div>
													</div>
												</div>
										<?php } ?>
									<?php }else{
										foreach($val['sub'] as $v){?>
											<div class="col-6 text-center mb-2">
												<div class="card">
													<div class="card-header" style="font-size:18px;">
												  		<?php echo $v['name'];?>
												  	</div>
												  	<div class="card-body">
												  		<div class="">
												  		<?php foreach($v['type'] as $type_sub){ ?>
						   									<div class="col-6 float-left" style="margin:0px;padding:5px;">
						   										<div style="">
						   											<div class="card" style="border: solid 1px #e3e3e3;margin:0px;padding:0px;">
							   											<div class="card-header">
							   												<?php echo $type_sub['type']; ?>
							   											</div>
							   											<div class="card-body">
							   												<?php echo (empty($type_sub['result'])?'รอผล':$type_sub['result']); ?>
							   											</div>
						   											</div>
						   										</div>
						   									</div>
												  		<?php } ?>
												  		</div>
												  	</div>
												</div>
											</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>	
			</div>
			
	<?php } ?>
	</div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ผลการออกรางวัลออนไลน์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-md-12">
				<p>ประจำงวดวันที่ 1 ตุลาคม 2564</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<iframe width="100%" height="315" src="https://www.youtube.com/embed/fTdZJ86KzLk?start=1290" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
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