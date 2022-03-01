<div class="card">
	<div class="card-body">
		<form action="#" method="POST" id="form-lotto">
			<div class="container">
				<div class="row mt-4">
					<div class="col-12">
						<nav aria-label="breadcrumb">
						  <ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="<?php echo route('lotto');?>">เลือกหมวดหมู่</a></li>
						    <li class="breadcrumb-item " aria-current="page">จัดการหวย</li>
						    <li class="breadcrumb-item active" aria-current="page"><?php echo $category['name'];?></li>
						  </ol>
						</nav>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-12">
						<table class="table table-striped">
							<tr>
								<td class="" >
									<b><?php echo $category['name'];?></b>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-5">
						<table class="table table-striped" id="table-package">
							<thead>
								<th colspan="10" class="text-end">
									<a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropPackage">จัดการแพคเกจ</a>
								</th>
							</thead>
							<tbody>
								<?php $i=0;foreach($listPackage as $val){?>
								<tr >
									<td >
										<input type="radio" 
											name="id_package" 
											class="rdoPackage"
											value="<?php echo $val['id'];?>" 
											id="id_package_<?php echo $val['id'];?>" 
											<?php echo ($val['id']==$id_package?'checked':'');?>
											<?php //echo ($i==$id_package?'checked':'');?> >
									</td>
									<td colspan="3">
										<label for="id_package_<?php echo $val['id'];?>">
											<input type="text" class="form-control edit-name-package" 
											package-id="<?php echo $val['id'];?>"
											value="<?php echo $val['name'];?>" style="">
										</label>
									</td>
									
								</tr>
								<tr>
									<td>
										ส่วนลด
										<label for="id_package_<?php echo $val['id'];?>">
											<input type="text" class="form-control edit-discount-package" 
											package-id="<?php echo $val['id'];?>"
											value="<?php echo $val['discount'];?>" style="width:50px;"> 
										</label> %
									</td>
									<td>
										ส่วนลดเลขวิ่ง 
										<label for="id_package_<?php echo $val['id'];?>">
											<input type="text" class="form-control edit-discount-run-number-package" 
											package-id="<?php echo $val['id'];?>"
											value="<?php echo $val['diccount_run_no'];?>" style="width:50px;">
										</label> %
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-danger btn-del-package" 
											id_package="<?php echo $val['id'];?>">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								<?php $i++;} ?>
							</tbody>
						</table>
						<?php if($id_package){ ?>
						<table class="table table-striped" id="table-ratio">
							<thead>
								<th>กำหนดอัตราต่อรอง</th>
								<th colspan="2" class="text-end">
									<a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropLabelRatio">+ เพิ่มอัตราต่อรอง</a>
								</th>
							</thead>
							<tbody>
								<?php foreach($category['ratio'] as $ratio){ ?>
									<tr>
										<td>
											<?php echo $ratio['name']; ?>
										</td>
										<td>
											<input id="ratio_<?php echo $ratio['id_type'];?>" 
												name="ratio[<?php echo $ratio['id_type'];?>]" 
												id_ratio = "<?php echo $ratio['id_type'];?>" 
												type="text" class="form-control" 
												value="<?php echo $ratio['price']; ?>"
											>
										</td>
										<td class="text-end" width="10%">
											<a href="#" 
												class="btn btn-danger btn-del-ratio" id_ratio="<?php echo $ratio['id'];?>">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
								<?php 	} ?>
							</tbody>
						</table>
						<?php } ?>
					</div>
					<div class="col-md-7">
						<?php if($id_category_decrypt != 24){ ?>
						<table class="table table-striped" id="table-date">
							<thead>
								<th>กำหนดวันที่ ของงวดที่ผ่านมา (yyyy-mm-dd hh:ii:ss)</th>
							</thead>
							<tbody>
								<tr>
									<td>
							            <div class="form-group">
								            <div class="input-group date dateandtimepicker">
								            	<label for=""></label><br>
												<span class="input-group-addon btn btn-warning">
													<span class="fa fa-calendar"></span>
												</span>
												<input type='text' class="form-control txt-change-date" 
												id="date_last_end" name="date_last_end" 
												value="<?php echo $date_last_end; ?>"
												placeholder="2021-12-31 15:00:00"/>
											</div>
								         </div>
									</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-striped" id="table-date">
							<thead>
								<th>กำหนดวันที่ และเวลาสำหรับงวดที่จะถึง (yyyy-mm-dd hh:ii:ss)</th>
							</thead>
							<tbody>
								<tr>
									<td>
							            <div class="form-group">
								            <div class="input-group date dateandtimepicker">
								            	<label for=""></label><br>
												<span class="input-group-addon btn btn-warning">
													<span class="fa fa-calendar"></span>
												</span>
												<input type='text' class="form-control txt-change-date" 
												id="date_end" name="date_end" 
												value="<?php echo $date_close; ?>"
												placeholder="2021-12-31 15:00:00"/>
											</div>
								         </div>
									</td>
								</tr>
							</tbody>
						</table>

						<div class="card">
							<div class="card-body">
								<table class="table table-striped" id="table-blockNo">
									<thead>
										<th>เลขอั้น</th>
										<th>ประเภทการอั้น</th>
										<th>จำกัดการแทง</th>
										<th>อัตราต่อรอง</th>
										<th class="text-end">
											<a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropBlockNo">เพิ่มเลขอั้น</a>
										</th>
									</thead>
									<tbody>
										<tr>
											<td class="text-center" colspan=10>ไม่พบเลขอั้นในวันนี้</td>
										</tr>
									</tbody>
								</table>
								<hr>
								<table class="table table-striped" id="table-blockNo-type">
									<thead>
										<th>ประเภทการอั้น</th>
										<th>จำกัดการแทง</th>
										<th class="text-end">
											<a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropBlockNoType">เพิ่มประเภทอั้น</a>
										</th>
									</thead>
									<tbody>
										<tr>
											<td class="text-center" colspan=10>ไม่พบประเภทอั้นในวันนี้</td>
										</tr>
									</tbody>
								</table>
								<hr>
								<p><label for=""><b>เพิ่มเลขอั้นทั้งหมดของลูกค้า</b></label></p>
								<table class="table table-striped" id="table-blockNo-all-type">
									<thead>
										<th>ประเภท</th>
										<th>จำกัดการแทง</th>
										<th class="text-end">
											<a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropBlockNoAllType">เพิ่มการอั้นประเภท</a>
										</th>
									</thead>
									<tbody>
										<tr>
											<td class="text-center" colspan=10>ไม่พบประเภทอั้นในวันนี้</td>
										</tr>
									</tbody>
								</table>
								<!--
								<table class="table table-striped" id="table-blockAll-bak">
									<thead>
										<th>กำหนดอั้นการซื้อของ <?php echo $category['name'];?> ภายในวันที่เลือก (ปล่อยว่างเท่ากับ ไม่จำกัด)</th>
									</thead>
									<tbody>
										<tr>
											<td>
												<input type="text" class="form-control" placeholder="อั้นจำนวนเงินในการแทงรวม" 
												id = "max_total" 
												name = "max_total"
												value="<?php echo $max_total;?>">
											</td>
										</tr>
									</tbody>
								</table>
								 <table class="table table-striped" id="table-block">
									<thead>
										<th>กำหนดอั้นการซื้อของ กระดานรวม</th>
									</thead>
									<tbody>
										<input type="text" class="form-control" placeholder="อั้นจำนวนเงินในการแทงรวม">
									</tbody>
								</table> -->
							</div>
						</div>
						<?php } ?>
						<?php if($id_category_decrypt != 24){ ?>
						<div class="card">
							<div class="card-body">
								<table class="table table-striped" id="table-date">
									<thead>
										<th>เลือกวันที่ สำหรับออกผลรางวัล</th>
									</thead>
									<tbody>
										<tr>
											<td>
									            <div class="form-group">
										            <div class="input-group date datetimepicker">
														<span class="input-group-addon btn btn-warning">
															<span class="fa fa-calendar"></span>
														</span>
														<input type='text' class="form-control" id="date" name="date"/>
													</div>
										         </div>
											</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-striped d-none" id="table-type">
									<?php 
									// var_dump($category['type']);
									if(empty($category['sub'])){ ?>
										<thead>
											<th colspan="10">ผลการออกรางวัล <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+ เพิ่มผลการออกรางวัล</a></th>
										</thead>
										<tbody>
										<?php 
										/*foreach($category['type'] as $type){ ?>
											
										<?php 	}*/ ?>
										</tbody>
								<?php 
									}else{
										foreach($category['sub'] as $v){ ?>
											<tr>
												<td colspan="3"><h5><?php echo $v['name'];?></h5></td>
											</tr>
											<?php foreach($v['type_sub'] as $type_sub){ ?>
											<tr>
												<td class="bg-info">
													<?php echo $type_sub['type'];?>
												</td>
												<td class="bg-info">
													<input id="sub_type_<?php echo $type_sub['id'];?>" type="text" name="result[<?php echo $type_sub['id'];?>]" 
													class="form-control" value="<?php echo $type_sub['result']; ?>">
												</td>
												<td class="text-end" width="10%">
													<a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
											<?php } ?>
										<?php } ?>
								<?php } ?>
								</table>
								
							</div>
							
							<div class="card-footer">
								<p>
									<input type="checkbox" name="chkCalculate" value="1" id="chkCalculate">
									<label for="chkCalculate">ให้คำนวนบิลทั้งหมด ในช่วงวันที่ 
										<span id="date-start-end">
											<?php echo $date_last_end.' - '.$date_close ; ?> 
										</span>
										<span>ระบบจะทำการ roll back และลบรายการแจ้งถอนของลูกค้า ที่สร้างในวันนี้</span>
									</label>
								</p>
								<div class="d-grid gap-2">
									<a href="#" class="btn btn-primary btn-block" id="btn-submit">บันทึก</a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="position-fixed top-0 right-0 p-3" style="z-index: 99999; right: 0; bottom: 0;height: 150px;">
	<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	  <div class="toast-header">
	  	<i class="bi bi-arrow-bar-down"></i>
	    <strong class="mr-auto">ผลลัพธ์</strong>
	  </div>
	  <div class="toast-body"></div>
	</div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มผลออกรางวัล</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<select name="listType" id="listType" class="form-control">
        <?php foreach($listType as $val){?>
        	<option value="<?php echo $val['id'];?>"><?php echo $val['type'];?></option>
        <?php } ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="btn-add-type">เพิ่มประเภท</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="staticBackdropPackage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelPackage" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabelPackage">เพิ่มแพคเกจ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<label class="mt-2 mb-2">ใส่ชื่อแพคเกจ</label>
      	<input type="text" class="form-control" value="" id="text-package" placeholder="ใส่ชื่อแพคเกจ">
      	<label class="mt-2 mb-2">ใส่ % ส่วนลด</label>
      	<input type="text" class="form-control" value="" id="text-package-discount" placeholder="ใส่ % ส่วนลด">
      	<label class="mt-2 mb-2">ใช้กับทุกประเภทใน package</label>
      	<?php /* ?>
      	<select id="text-package-type" class="form-control">
      		<option value="">ทั้งหมด</option>
	      	<?php foreach($listType as $val){?>
	        <option value="<?php echo $val['id'];?>"><?php echo $val['type'];?></option>
	        <?php } ?>
        </select>
        <?php */?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="btn-add-package">เพิ่มแพคเกจ</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="staticBackdropBlockNo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelPackage" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabelPackage">เพิ่มเลขอั้น</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	ใส่เลขอั้น
      	<input type="text" class="form-control" value="" id="block-no" placeholder="ใส่เลขอั้น">
      	<br>
      	ประเภทของเลข
      	<select name="" id="type-block-no" class="form-control">
      		<?php foreach($listType as $val){?>
	        <option value="<?php echo $val['id'];?>"><?php echo $val['type'];?></option>
	        <?php } ?>
      	</select>
      	<br>
      	อัตราต่อรอง
      	<input type="text" class="form-control" value="" id="ratio-price">
      	<?php /* ?>
      	<select name="" id="condition-block-no" class="form-control">
      		<?php foreach($getBlockNo as $val){?>
      		<option value="<?php echo $val['id'];?>"><?php echo $val['detail'];?></option>
      		<?php } ?>
      	</select>
      	<?php */?>
      	<br>
      	จำกัดยอดแทงรวม (บาท)
      	<input type="text" class="form-control" value="" id="text-block-no-max" placeholder="จำกัดยอดแทงรวม (บาท)">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="btn-add-block-no">เพิ่มเลขอั้น</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="staticBackdropBlockNoAllType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelPackageAll" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabelPackageAll">เพิ่มเลขอั้น</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	ประเภทของเลข
      	<select name="" id="type-block-no-all" class="form-control">
      		<?php foreach($listType as $val){?>
	        <option value="<?php echo $val['id'];?>"><?php echo $val['type'];?></option>
	        <?php } ?>
      	</select>
      	<br>
      	<!-- ประเภทเลขอั้น
      	<select name="" id="condition-block-no-all" class="form-control">
      		<?php foreach($getBlockNo as $val){?>
      		<option value="<?php echo $val['id'];?>"><?php echo $val['detail'];?></option>
      		<?php } ?>
      	</select>
      	<br> -->
      	จำกัดยอดแทงรวม (บาท)
      	<input type="text" class="form-control" value="" id="text-block-no-max-all" placeholder="จำกัดยอดแทงรวม (บาท)">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="btn-add-block-no-all">เพิ่มเลขอั้น</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdropBlockNoType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelPackage" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabelBlockNoType">เพิ่มประเภทอั้น</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	ประเภทของเลข
      	<select name="" id="no-type-block-no" class="form-control">
      		<?php foreach($listType as $val){?>
	        <option value="<?php echo $val['id'];?>"><?php echo $val['type'];?></option>
	        <?php } ?>
      	</select>
      	<br>
      	จำกัดยอดแทงรวม (บาท)
      	<input type="text" class="form-control" value="" id="no-text-block-no-max" placeholder="จำกัดยอดแทงรวม (บาท)">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="btn-add-block-no-type">เพิ่มเลขอั้น</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="staticBackdropLabelRatio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelRatio" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">เพิ่มอัตราต่อรอง</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<select name="listRatio" id="listRatio" class="form-control">
        <?php foreach($listType as $val){?>
        	<option value="<?php echo $val['id'];?>"><?php echo $val['type'];?></option>
        <?php } ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="btn-add-ratio">เพิ่มการต่อรอง</button>
      </div>
    </div>
  </div>
</div>

<link href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<link href="assets/datetimepicker-master/build/jquery.datetimepicker.min.css" rel="stylesheet">
<script src="assets/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
	$(document).on('keyup','#type_4',function(e){
		var ele = $(this);
		if(ele.val().length==2){
			var no_4_com = getCombinations(ele.val(),5);
			$('#type_36').val(no_4_com);
		}
	});
	$(document).on('keyup','#type_1',function(e){
		var ele = $(this);
		if(ele.val().length==6){
			// 2 บน
			var no_2_digit = ele.val().substr(4);
			// 3 บน
			var no_3_digit = ele.val().substr(3);
			$('#type_2').val(no_3_digit);
			
			var no_3_com = getCombinations(no_3_digit,3);
			$('#type_6').val(no_3_com);
			var no_2_com = getCombinations(no_3_digit,2);
			$('#type_8').val(no_2_com);
			$('#type_7').val(no_2_digit);
			var no_4_com = getCombinations(no_3_digit,4);
			$('#type_35').val(no_4_com);
		}
		console.log(ele.val().length);
	});
	function getCombinations(base,length){
		// console.log('>>'+base[0]);
		var result = '';
		if(length==3){
			// result 	=	base.substr(0,1)+base.substr(0,2)+base.substr(0,3)+','+
			// 			base.substr(0,1)+base.substr(0,3)+base.substr(0,2)+','+
			// 			base.substr(0,2)+base.substr(0,1)+base.substr(0,3)+','+
			// 			base.substr(0,3)+base.substr(0,1)+base.substr(0,2)+','+
			// 			base.substr(0,2)+base.substr(0,3)+base.substr(0,1)+','+
			// 			base.substr(0,3)+base.substr(0,2)+base.substr(0,1);
			result 	= 	base[0]+base[1]+base[2]+','+
						base[0]+base[2]+base[1]+','+
						base[1]+base[0]+base[2]+','+
						base[1]+base[2]+base[0]+','+
						base[2]+base[0]+base[1]+','+
						base[2]+base[1]+base[0];
		}
		if(length==2){
			result 	=	base[0]+base[1]+','+
						base[0]+base[2]+','+
						base[1]+base[0]+','+
						base[1]+base[2]+','+
						base[2]+base[0]+','+
						base[2]+base[1];
						// base.substr(0,1)+base.substr(0,2)+base.substr(0,3)+','+
						// base.substr(0,1)+base.substr(0,3)+base.substr(0,2);
						
		}
		if(length==4){
			result 	=	base[0]+','+base[1]+','+base[2];
						// base.substr(0,1)+base.substr(0,2)+base.substr(0,3)+','+
						// base.substr(0,1)+base.substr(0,3)+base.substr(0,2);
						
		}
		if(length==5){
			result 	=	base[0]+','+base[1];
						// base.substr(0,1)+base.substr(0,2)+base.substr(0,3)+','+
						// base.substr(0,1)+base.substr(0,3)+base.substr(0,2);
						
		}
		var result = (result).split(',').filter(function(item, pos,self) {
          return self.indexOf(item) == pos;
       	});
		return result;
	}
	$(document).on('change','.txt-change-date',function(e){
		var ele = $('#date-start-end');
		var date_last_end = $('#date_last_end').val();
		var date_end = $('#date_end').val();
		ele.text(date_last_end + ' - ' + date_end);
	});
	$(document).on('click','#btn-add-block-no-type',function(e){
		var max_price 			= $('#no-text-block-no-max').val();
		var date_block 			= $('#date_end').val();
		var id_category 		= '<?php echo get('id_category');?>';
		var id_type				= $('#no-type-block-no').val();
		$.ajax({
			url: 'index.php?route=lotto/addBlockNoType',
			type: 'POST',
			dataType: 'json',
			data: {
				max_price:max_price,
				date_block:date_block,
				id_category:id_category,
				id_type:id_type
			},
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				$.ajax({
					url: 'index.php?route=lotto/getBlockNoType',
					type: 'POST',
					dataType: 'json',
					data: {
						date: date_block,
						id_category: '<?php echo get('id_category');?>'
					},
				})
				.done(function(result_no) {
					console.log("success");
					console.log(result_no);
					if(result_no.status=='failed'){
						$('.toast-body').text(result_no.desc);
						$('.toast-body').addClass('text-danger');
						$('.toast-body').removeClass('text-success');
						$('#toast').toast('show');
					}else{
						$('.toast-body').removeClass('text-danger');
						$('.toast-body').addClass('text-success');
						$('.toast-body').text(result_no.desc);
						$('#toast').toast('show');

						$('#table-blockNo-type tbody').html('');

						$( result_no.rows ).each(function( index,val ) {
							var html = 
								'<tr>'
								+	'<td>'
										+val.type
								+	'</td>'
								+	'<td>'
									+val.max_price
								+	'</td>'
								+	'<td class="text-end">'
									+	'<a href="#" class="btn btn-danger btn-del-blockNoType" data-id="'+val.id+'">'
									+ 		'<i class="fa fa-trash"></i>'
									+	'</a>'
								+	'</td>'
							+	'</tr>';
							$('#table-blockNo-type  tbody:last-child').append(html);
						});
					}
				})
				.fail(function(a,b,c) {
					console.log("error");
					console.log(a);
					console.log(b);
					console.log(c);
				})
				.always(function() {
					console.log("complete");
				});
			}
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
	$(document).on('click','#btn-add-block-no',function(e){
		var num 				= $('#block-no').val();
		// var id_condition_detail = $('#condition-block-no').val();
		var max_price 			= $('#text-block-no-max').val();
		var date_block 			= $('#date_end').val();
		var id_category 		= '<?php echo get('id_category');?>';
		var id_type				= $('#type-block-no').val();
		var ratio_price			= $('#ratio-price').val();
		$.ajax({
			url: 'index.php?route=lotto/addBlockNo',
			type: 'POST',
			dataType: 'json',
			data: {
				num:num,
				// id_condition_detail:id_condition_detail,
				ratio_price:ratio_price,
				max_price:max_price,
				date_block:date_block,
				id_category:id_category,
				id_type:id_type
			},
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				// location.reload();
				$.ajax({
					url: 'index.php?route=lotto/getBlockNo',
					type: 'POST',
					dataType: 'json',
					data: {
						date: date_block,
						id_category: '<?php echo get('id_category');?>'
					},
				})
				.done(function(result_no) {
					console.log("success");
					console.log(result_no);
					if(result_no.status=='failed'){
						$('.toast-body').text(result_no.desc);
						$('.toast-body').addClass('text-danger');
						$('.toast-body').removeClass('text-success');
						$('#toast').toast('show');
					}else{
						$('.toast-body').removeClass('text-danger');
						$('.toast-body').addClass('text-success');
						$('.toast-body').text(result_no.desc);
						$('#toast').toast('show');

						$('#table-blockNo tbody').html('');

						$( result_no.rows ).each(function( index,val ) {
							var html = 
								'<tr>'
								+	'<td>'
										+val.num
								+	'</td>'
								+	'<td>'
										+val.type
								+	'</td>'
								+	'<td>'
									+val.max_price
								+	'</td>'
								+	'<td>'
									+val.ratio_price
								+	'</td>'
								+	'<td class="text-end">'
									+	'<a href="#" class="btn btn-danger btn-del-blockNoType" data-id="'+val.id+'">'
									+ 		'<i class="fa fa-trash"></i>'
									+	'</a>'
								+	'</td>'
							+	'</tr>';
							$('#table-blockNo  tbody:last-child').append(html);
						});
					}
				})
				.fail(function(a,b,c) {
					console.log("error");
					console.log(a);
					console.log(b);
					console.log(c);
				})
				.always(function() {
					console.log("complete");
				});
			}
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
	$(document).on('click','#btn-add-block-no-all',function(e){
		var num 				= $('#block-no-all').val();
		var id_condition_detail = $('#condition-block-no-all').val();
		var max_price 			= $('#text-block-no-max-all').val();
		var date_block 			= $('#date_end').val();
		var id_category 		= '<?php echo get('id_category');?>';
		var id_type				= $('#type-block-no-all').val();
		$.ajax({
			url: 'index.php?route=lotto/addBlockNoAll',
			type: 'POST',
			dataType: 'json',
			data: {
				num:num,
				id_condition_detail:id_condition_detail,
				max_price:max_price,
				date_block:date_block,
				id_category:id_category,
				id_type:id_type
			},
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				// location.reload();
				$.ajax({
					url: 'index.php?route=lotto/getBlockNoAll',
					type: 'POST',
					dataType: 'json',
					data: {
						date: date_block,
						id_category: '<?php echo get('id_category');?>'
					},
				})
				.done(function(result_no) {
					console.log("success");
					console.log(result_no);
					if(result_no.status=='failed'){
						$('.toast-body').text(result_no.desc);
						$('.toast-body').addClass('text-danger');
						$('.toast-body').removeClass('text-success');
						$('#toast').toast('show');
					}else{
						$('.toast-body').removeClass('text-danger');
						$('.toast-body').addClass('text-success');
						$('.toast-body').text(result_no.desc);
						$('#toast').toast('show');

						$('#table-blockNo-all-type tbody').html('');

						$( result_no.rows ).each(function( index,val ) {
							var html = 
								'<tr>'
								+	'<td>'
										+val.type
								+	'</td>'
								+	'<td>'
									+val.max_price
								+	'</td>'
								+	'<td class="text-end">'
									+	'<a href="#" class="btn btn-danger btn-del-blockNoType-all" data-id="'+val.id+'">'
									+ 		'<i class="fa fa-trash"></i>'
									+	'</a>'
								+	'</td>'
							+	'</tr>';
							$('#table-blockNo-all-type  tbody:last-child').append(html);
						});
					}
				})
				.fail(function(a,b,c) {
					console.log("error");
					console.log(a);
					console.log(b);
					console.log(c);
				})
				.always(function() {
					console.log("complete");
				});
			}
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
	$(document).on('click','.rdoPackage',function(e){
		var ele = $(this);
		window.location = 'index.php?route=lotto/categoryDetail&id_category=<?php echo $id_category;?>&id_package='+ele.val();
	});
	$(document).on('click','#btn-add-package',function(e){
		var txt_package_discount = $('#text-package-discount').val();
		var txt_package = $('#text-package').val();
		if(txt_package!=''){
			$.ajax({
				url: 'index.php?route=lotto/addPackage',
				type: 'POST',
				dataType: 'json',
				data: {
					id_category: '<?php echo get('id_category');?>',
					package: txt_package,
					discount: txt_package_discount
				},
			})
			.done(function(result) {
				console.log(result);
				if(result.status=='failed'){
					$('.toast-body').text(result.desc);
					$('.toast-body').addClass('text-danger');
					$('.toast-body').removeClass('text-success');
					$('#toast').toast('show');
				}else{
					$('.toast-body').removeClass('text-danger');
					$('.toast-body').addClass('text-success');
					$('.toast-body').text(result.desc);
					$('#toast').toast('show');
					location.reload();
				}
			})
			.fail(function(a,b,c) {
				console.log(a);
				console.log(b);
				console.log(c);
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		} 
	});
	$(document).on('click','#btn-submit',function(e){
		var form = $('#form-lotto');
		var ele = $(this);
		ele.text('กำลังประมวลผล');
		$.ajax({
			url: 'index.php?route=lotto/submitLotto&id_category=<?php echo $id_category;?>',
			type: 'POST',
			dataType: 'json',
			data: form.serialize(),
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
			}
			ele.text('บันทึก');
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
		
		e.preventDefault();
	});
	$(document).on('click','.btn-del-type',function(e){
		var ele = $(this);
		var id_type = ele.attr('id_type');

		ele.parents('tr').remove();
		$.ajax({
			url: 'index.php?route=lotto/delType',
			type: 'POST',
			dataType: 'json',
			data: {
				id_type: id_type,
				date: $('#date').val(),
				id_category: '<?php echo get('id_category');?>'
			},
		})
		.done(function(e) {
			console.log("success");
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
		e.preventDefault();
	});
	$(document).on('click','.btn-del-ratio',function(e){
		var ele = $(this);
		var id_ratio = $(this).attr('id_ratio');
		$.ajax({
			url: 'index.php?route=lotto/delRatio',
			type: 'POST',
			dataType: 'json',
			data: {
				id_ratio: id_ratio
			},
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				// location.reload();
			}
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		ele.parents('tr').remove();
		e.preventDefault();
	});
	$(document).on('click','.btn-del-package',function(e){
		var ele = $(this);
		var id_package = $(this).attr('id_package');
		$.ajax({
			url: 'index.php?route=lotto/delPackage',
			type: 'POST',
			dataType: 'json',
			data: {
				id_category: '<?php echo get('id_category');?>',
				id_package: id_package
			},
		})
		.done(function(result) {
			console.log(result);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
				location.reload();
			}
		})
		.fail(function(a,b,c) {
			console.log(a);
			console.log(b);
			console.log(c);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		ele.parents('tr').remove();
		e.preventDefault();
	});
	$(document).on('click','#btn-add-type',function(e){
		var listType = $("#listType option:selected").text();
		var IDType = $('#listType').val();
		var html = '<tr>'
					+	'<td class="bg-info">'
						+listType
					+	'</td>'
					+	'<td class="bg-info">'
						+	'<input id="ratio_'+IDType+'" name="result['+IDType+']" '
							+'type="text" class="form-control" value="">'
					+	'</td>'
					+	'<td class="text-end" width="10%">'
						+	'<a href="#" class="btn btn-danger btn-del-type"><i class="fa fa-trash"></i></a>'
					+	'</td>'
				+	'</tr>';
		$('#table-type  tbody:last-child').append(html);
		$('#staticBackdrop').modal('hide');
	});
	$(document).on('click','#btn-add-ratio',function(e){
		var listRatio = $("#listRatio option:selected").text();
		var IDRatio = $('#listRatio').val();
		var html = '<tr>'
					+	'<td>'
						+listRatio
					+	'</td>'
					+	'<td>'
						+	'<input id="ratio_'+IDRatio+'" name="ratio['+IDRatio+']" '
							+'type="text" class="form-control" value="">'
					+	'</td>'
					+	'<td class="text-end" width="10%">'
						+	'<a href="#" class="btn btn-danger btn-del-ratio" id_ratio="'+IDRatio+'"><i class="fa fa-trash"></i></a>'
					+	'</td>'
				+	'</tr>';
		$('#table-ratio  tbody:last-child').append(html);
		$('#staticBackdropLabelRatio').modal('hide');
	});
	$(document).on('change','#date',function(e){
		$('#table-type').removeClass('d-none');
		$('#table-blockNo').removeClass('d-none');
		$('#table-blockNo-type').removeClass('d-none');
		$('#table-blockNo-all-type').removeClass('d-none');
		$('#table-blockAll').removeClass('d-none');

		var ele = $(this);
		$.ajax({
			url: 'index.php?route=lotto/getResultRatio',
			type: 'POST',
			dataType: 'json',
			data: {
				date: ele.val(),
				id_category: '<?php echo get('id_category');?>'
			},
		})
		.done(function(result) {
			console.log("success");
			console.log(result);
			if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$( result.ratio ).each(function( index,val ) {
				  $('#ratio_'+val.id).val(val.price);
				});
				$('#table-type tbody').html('');
				$( result.type ).each(function( index,val ) {
				  // $('#type_'+val.id).val(val.result);
				  var 	html = 	'<tr>'
									+'<td class="bg-info">'
										+val.type
									+'</td>'
									+'<td class="bg-info">'
										+'<input id="type_'+val.id_cate_type+'" type="text" name="result['+val.id_cate_type+']"'
										+'class="form-control" value="'+val.result+'">'
									+'</td>'
									+'<td class="text-end" width="10%">'
										+'<a href="" class="btn btn-danger btn-del-type" id_type="'+val.id+'"><i class="fa fa-trash"></i></a>'
									+'</td>'
								+'</tr>';
					$('#table-type tbody').append(html);
				});
				console.log(result.sub);
				$( result.sub ).each(function( index,sub ) {
					$( sub.type_sub ).each(function( index,val ) {
				  		$('#sub_type_'+val.id).val(val.result);
				  	});
				});
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');

				$.ajax({
					url: 'index.php?route=lotto/getBlockNo',
					type: 'POST',
					dataType: 'json',
					data: {
						date: ele.val(),
						id_category: '<?php echo get('id_category');?>'
					},
				})
				.done(function(result_no) {
					console.log("success");
					console.log(result_no);
					if(result_no.status=='failed'){
						$('.toast-body').text(result_no.desc);
						$('.toast-body').addClass('text-danger');
						$('.toast-body').removeClass('text-success');
						$('#toast').toast('show');
					}else{
						$('.toast-body').removeClass('text-danger');
						$('.toast-body').addClass('text-success');
						$('.toast-body').text(result_no.desc);
						$('#toast').toast('show');

						$('#table-blockNo tbody').html('');

						$( result_no.rows ).each(function( index,val ) {
							var html = 
								'<tr>'
								+	'<td>'
										+val.num
								+	'</td>'
								+	'<td>'
										+val.type
								+	'</td>'
								+	'<td>'
									+val.max_price
								+	'</td>'
								+	'<td>'
									+val.ratio_price
								+	'</td>'
								+	'<td class="text-end">'
									+	'<a href="#" class="btn btn-danger btn-del-blockNo" data-id="'+val.id+'">'
									+ 		'<i class="fa fa-trash"></i>'
									+	'</a>'
								+	'</td>'
							+	'</tr>';
							$('#table-blockNo  tbody:last-child').append(html);
						});
					}
				})
				.fail(function(a,b,c) {
					console.log("error");
					console.log(a);
					console.log(b);
					console.log(c);
				})
				.always(function() {
					console.log("complete");
				});

				$.ajax({
					url: 'index.php?route=lotto/getBlockNoAll',
					type: 'POST',
					dataType: 'json',
					data: {
						date: ele.val(),
						id_category: '<?php echo get('id_category');?>'
					},
				})
				.done(function(result_no) {
					console.log("success");
					console.log(result_no);
					if(result_no.status=='failed'){
						$('.toast-body').text(result_no.desc);
						$('.toast-body').addClass('text-danger');
						$('.toast-body').removeClass('text-success');
						$('#toast').toast('show');
					}else{
						$('.toast-body').removeClass('text-danger');
						$('.toast-body').addClass('text-success');
						$('.toast-body').text(result_no.desc);
						$('#toast').toast('show');

						$('#table-blockNo-all-type tbody').html('');

						$( result_no.rows ).each(function( index,val ) {
							var html = 
								'<tr>'
								+	'<td>'
										+val.type
								+	'</td>'
								+	'<td>'
									+val.max_price
								+	'</td>'
								+	'<td class="text-end">'
									+	'<a href="#" class="btn btn-danger btn-del-blockNo" data-id="'+val.id+'">'
									+ 		'<i class="fa fa-trash"></i>'
									+	'</a>'
								+	'</td>'
							+	'</tr>';
							$('#table-blockNo-all-type  tbody:last-child').append(html);
						});
					}
				})
				.fail(function(a,b,c) {
					console.log("error");
					console.log(a);
					console.log(b);
					console.log(c);
				})
				.always(function() {
					console.log("complete");
				});

				$.ajax({
					url: 'index.php?route=lotto/getBlockNoType',
					type: 'POST',
					dataType: 'json',
					data: {
						date: ele.val(),
						id_category: '<?php echo get('id_category');?>'
					},
				})
				.done(function(result_no) {
					console.log("success");
					console.log(result_no);
					if(result_no.status=='failed'){
						$('.toast-body').text(result_no.desc);
						$('.toast-body').addClass('text-danger');
						$('.toast-body').removeClass('text-success');
						$('#toast').toast('show');
					}else{
						$('.toast-body').removeClass('text-danger');
						$('.toast-body').addClass('text-success');
						$('.toast-body').text(result_no.desc);
						$('#toast').toast('show');

						$('#table-blockNo-type tbody').html('');

						$( result_no.rows ).each(function( index,val ) {
							var html = 
								'<tr>'
								+	'<td>'
										+val.type
								+	'</td>'
								+	'<td>'
									+val.max_price
								+	'</td>'
								+	'<td class="text-end">'
									+	'<a href="#" class="btn btn-danger btn-del-blockNoType" data-id="'+val.id+'">'
									+ 		'<i class="fa fa-trash"></i>'
									+	'</a>'
								+	'</td>'
							+	'</tr>';
							$('#table-blockNo-type  tbody:last-child').append(html);
						});
					}
				})
				.fail(function(a,b,c) {
					console.log("error");
					console.log(a);
					console.log(b);
					console.log(c);
				})
				.always(function() {
					console.log("complete");
				});
			}
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
	});
	$(document).ready(function(){
        $(".datetimepicker").datepicker({ 
        	format: 'yyyy-mm-dd' 
        });
        $('.txt-change-date').datetimepicker({
        	// value:'2015/04/15 05:03', 
        	format:'Y-m-d H:i:00',
        	step:15
        });
        // $(".dateandtimepicker").datetimepicker({
              // viewMode: 'years',
              // format: 'yyyy-mm-dd hh:ii:ss'
          // });
        // format: 'yyyy-mm-dd hh:ii:ss' 
    });
    $(document).on('click','.btn-del-blockNoType',function(e){
    	var ele = $(this);
    	var id = $(this).attr('data-id');
    	$.ajax({
    		url: 'index.php?route=lotto/delBlockNoType',
    		type: 'POST',
    		dataType: 'json',
    		data: {
    			id: id
    		},
    	})
    	.done(function(result) {
    		if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
			}
			ele.parents('tr').remove();
			e.preventDefault();
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	e.preventDefault();
    });
    $(document).on('click','.btn-del-blockNoType-all',function(e){
    	var ele = $(this);
    	var id = $(this).attr('data-id');
    	$.ajax({
    		url: 'index.php?route=lotto/delBlockNoTypeAll',
    		type: 'POST',
    		dataType: 'json',
    		data: {
    			id: id
    		},
    	})
    	.done(function(result) {
    		if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
			}
			ele.parents('tr').remove();
			e.preventDefault();
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	e.preventDefault();
    });
    $(document).on('click','.btn-del-blockNo',function(e){
    	var ele = $(this);
    	var id = $(this).attr('data-id');
    	$.ajax({
    		url: 'index.php?route=lotto/delBlockNo',
    		type: 'POST',
    		dataType: 'json',
    		data: {
    			id: id
    		},
    	})
    	.done(function(result) {
    		if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
			}
			ele.parents('tr').remove();
			e.preventDefault();
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	e.preventDefault();
    });
    $(document).on('keyup','.edit-discount-package',function(e){
    	var package_id = $(this).attr('package-id');
    	var val = $(this).val();
    	console.log('package_id'+package_id);
    	console.log('val'+val);
    	$.ajax({
    		url: 'index.php?route=lotto/editDiscountPackage',
    		type: 'POST',
    		dataType: 'json',
    		data: {
    			id: package_id,
    			val: val
    		},
    	})
    	.done(function(result) {
    		if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
			}
			e.preventDefault();
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	e.preventDefault();
    });
    $(document).on('keyup','.edit-name-package',function(e){
    	var package_id = $(this).attr('package-id');
    	var val = $(this).val();
    	console.log('package_id'+package_id);
    	console.log('val'+val);
    	$.ajax({
    		url: 'index.php?route=lotto/editNamePackage',
    		type: 'POST',
    		dataType: 'json',
    		data: {
    			id: package_id,
    			val: val
    		},
    	})
    	.done(function(result) {
    		if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
			}
			e.preventDefault();
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	e.preventDefault();
    });
    $(document).on('keyup','.edit-discount-run-number-package',function(e){
    	var package_id = $(this).attr('package-id');
    	var val = $(this).val();
    	console.log('package_id'+package_id);
    	console.log('val'+val);
    	$.ajax({
    		url: 'index.php?route=lotto/editDiscountRunNoPackage',
    		type: 'POST',
    		dataType: 'json',
    		data: {
    			id: package_id,
    			val: val
    		},
    	})
    	.done(function(result) {
    		if(result.status=='failed'){
				$('.toast-body').text(result.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result.desc);
				$('#toast').toast('show');
			}
			e.preventDefault();
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	e.preventDefault();
    });
    $(function(){
    	$.ajax({
			url: 'index.php?route=lotto/getBlockNo',
			type: 'POST',
			dataType: 'json',
			data: {
				date: $('#date_end').val(),
				id_category: '<?php echo get('id_category');?>'
			},
		})
		.done(function(result_no) {
			console.log("success");
			console.log(result_no);
			if(result_no.status=='failed'){
				$('.toast-body').text(result_no.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result_no.desc);
				$('#toast').toast('show');

				$('#table-blockNo tbody').html('');

				$( result_no.rows ).each(function( index,val ) {
					var html = 
						'<tr>'
						+	'<td>'
								+val.num
						+	'</td>'
						+	'<td>'
								+val.type
						+	'</td>'
						+	'<td>'
							+val.max_price
						+	'</td>'
						+	'<td>'
							+val.ratio_price
						+	'</td>'
						+	'<td class="text-end">'
							+	'<a href="#" class="btn btn-danger btn-del-blockNo" data-id="'+val.id+'">'
							+ 		'<i class="fa fa-trash"></i>'
							+	'</a>'
						+	'</td>'
					+	'</tr>';
					$('#table-blockNo  tbody:last-child').append(html);
				});
			}
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});

		$.ajax({
			url: 'index.php?route=lotto/getBlockNoAll',
			type: 'POST',
			dataType: 'json',
			data: {
				date: $('#date_end').val(),
				id_category: '<?php echo get('id_category');?>'
			},
		})
		.done(function(result_no) {
			console.log("success");
			console.log(result_no);
			if(result_no.status=='failed'){
				$('.toast-body').text(result_no.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result_no.desc);
				$('#toast').toast('show');

				$('#table-blockNo-all-type tbody').html('');

				$( result_no.rows ).each(function( index,val ) {
					var html = 
						'<tr>'
						+	'<td>'
								+val.type
						+	'</td>'
						+	'<td>'
							+val.max_price
						+	'</td>'
						+	'<td class="text-end">'
							+	'<a href="#" class="btn btn-danger btn-del-blockNoType-all" data-id="'+val.id+'">'
							+ 		'<i class="fa fa-trash"></i>'
							+	'</a>'
						+	'</td>'
					+	'</tr>';
					$('#table-blockNo-all-type  tbody:last-child').append(html);
				});
			}
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});

		$.ajax({
			url: 'index.php?route=lotto/getBlockNoType',
			type: 'POST',
			dataType: 'json',
			data: {
				date: $('#date_end').val(),
				id_category: '<?php echo get('id_category');?>'
			},
		})
		.done(function(result_no) {
			console.log("success");
			console.log(result_no);
			if(result_no.status=='failed'){
				$('.toast-body').text(result_no.desc);
				$('.toast-body').addClass('text-danger');
				$('.toast-body').removeClass('text-success');
				$('#toast').toast('show');
			}else{
				$('.toast-body').removeClass('text-danger');
				$('.toast-body').addClass('text-success');
				$('.toast-body').text(result_no.desc);
				$('#toast').toast('show');

				$('#table-blockNo-type tbody').html('');

				$( result_no.rows ).each(function( index,val ) {
					var html = 
						'<tr>'
						+	'<td>'
								+val.type
						+	'</td>'
						+	'<td>'
							+val.max_price
						+	'</td>'
						+	'<td class="text-end">'
							+	'<a href="#" class="btn btn-danger btn-del-blockNoType" data-id="'+val.id+'">'
							+ 		'<i class="fa fa-trash"></i>'
							+	'</a>'
						+	'</td>'
					+	'</tr>';
					$('#table-blockNo-type  tbody:last-child').append(html);
				});
			}
		})
		.fail(function(a,b,c) {
			console.log("error");
			console.log(a);
			console.log(b);
			console.log(c);
		})
		.always(function() {
			console.log("complete");
		});
    });
</script>