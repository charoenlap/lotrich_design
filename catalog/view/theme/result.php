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
			<input type="text" class="form-control" value="16-Oct-2021">
		</div>
		<div class="col-6 col-md-10 text-right">
			<a href="<?php echo route('login');?>" class="btn ">เข้าสู่ระบบ คลิกที่นี่</a>
		</div>
	</div>
	<?php foreach($category as $val){ ?>
	<div class="row mt-4">
		<div class="col-12">
			<h4 class="d-inline-flex">
				<div class="d-inline-flex" style="background:url(uploads/flag/<?php echo $val['flag'];?>);width:50px;height:30px;background-size:cover;background-position: center;margin-right:10px;"></div>
				<?php echo $val['name'];?>
			</h4>
		</div>
				<?php 
			if(empty($val['sub'])){
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
					<div class="<?php echo $class;?> text-center mb-2">
						<div class="card">
							<div class="card-header">
						  		<?php echo $type['type']; ?>
						  	</div>
						  	<div class="card-body">
						    	<h5 class="card-title"><?php echo $type['result']; ?></h5>
						    	<p class="card-text"></p>
						  	</div>
						</div>
					</div>
				<?php } ?>

			<?php }else{
				foreach($val['sub'] as $v){?>
					<div class="col-6 text-center mb-2">
						<div class="card">
							<div class="card-header">
						  		<?php echo $v['name'];?>
						  	</div>
						  	<div class="card-body">
						  		<div class="row">
						  		<?php foreach($v['type'] as $type_sub){ ?>
   									<div class="col-12">
   										<p><?php echo $type_sub['type']; ?></p>
   										<h5 class="card-title"><?php echo $type_sub['result']; ?></h5>
   									</div>
						  		<?php } ?>
						  		</div>
						  	</div>
						</div>
					</div>
			<?php } ?>
		<?php } ?>
		
	</div>	
	<?php } ?>
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
