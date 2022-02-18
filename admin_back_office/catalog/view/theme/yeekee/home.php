<form action="<?php echo $action; ?>" method="GET">	
	<input type="hidden" name="route" value="report/all">
	<div class="card">
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h4>รายงานดูยอดที่แทง</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-2">
						<div class="form-group">
							<label for="">เลือกวัน</label>
				            <div class="input-group date datetimepicker">
								<span class="input-group-addon btn btn-warning">
									<span class="fa fa-calendar"></span>
								</span>
								<input type="text" class="form-control" id="date" 
									name="date" value="<?php echo $date;?>"/>
							</div>
				         </div>
					</div>
					<div class="col-1">
						<label for="">&nbsp;</label><br>
						<input type="submit" class="btn btn-primary" value="ค้นหา">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-2">
						<div class="form-group">
							<label for="">% ที่เจ้าจะได้</label>
				            <input type="text" class="form-control" value="20">
				         </div>
					</div>
					<div class="col-4">
						<label for="">&nbsp;</label><br>
						<a href="" class="btn btn-warning" id="btn-check-15">Check 15 Min get result</a>
						<a href="" class="btn btn-warning" id="btn-check-minnight">Check MidNight</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="card">
	<div class="card-body">
		<div class="container">
			<div class="row">
				<div class="col-12">
					สูตรการคิด ใน 1 รอบแยกจำนวน ตัวแลขแต่ละประเภทออกมา<br>
					เช่น 2 ตัวมีจำนวนทั้งหมด 100 ตัวเลข 00-99<br>
					3 ตัวมี ทั้งหมด 1000 ตัวเลข 000-999<br>
					คำนวนยอดรวม ทั้งหมด ในรอบการแทงนั้น<br>
					สมมุติว่าได้ ยอดรวม 10,000 บาท แล้วกำหนดว่าเจ้าต้องได้ 20% คือ 2,000 บาทในรอบนั้น<br>
					หมายความว่า ระบบจะ แบ่งยอดที่เหลือ 8,000 ไปหารถั่วเฉลี่ย รางวัล ในแต่ละประเภท เช่น 2 ตัว 20% (1,600)<br>
 					คำนวนยอดรวมการจ่ายจริง ของแต่ละตัวเลขออกมา แล้วเรียง ยอดสูงสุดไป น้อยสุด <br>
 					ตัวอย่าง เลข 2 ตัว<br>
 					00 มียอดที่ต้องจ่ายรวม 1000 บาท<br>
 					01 มียอดที่ต้องจ่ายรวม 5000 บาท<br>
 					02 มียอดที่ต้องจ่ายรวม 2000 บาท<br>
 					03 มียอดที่ต้องจ่ายรวม 3000 บาท<br>
 					เท่ากับว่า เจ้าจะสามารถ จ่ายได้ 8,000 บาทเพื่อที่จะกำไร 2,000 บาท<br>
 					ดังนั้นระบบ จะออกตัวเลข 00 ซึ่งเจ้าจะจ่าย แค่ 1,000 บาท และกำไรส่วนต่าง 600 
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
					<table class="table">
						<thead>
							<th>รอบที่</th>
							<th>ผลที่ออก</th>
							<th>รายรับ</th>
							<th>รายจ่าย</th>
						</thead>
					<?php foreach($round['yeekee'] as $val){?>
						<tr>
							<td><?php echo $val['hour'].':'.$val['min'];?></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<link href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).on('click','#btn-check-15',function(e){
		var ele = $(this);
		$.ajax({
			url: '../api/index.php?route=cronjob/checkBy15Min',
			type: 'GET',
			dataType: 'json',
			// data: {param1: 'value1'},
		})
		.done(function() {
			ele.text('success');
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
		e.preventDefault();
	});
	$(document).on('click','#btn-check-minnight',function(e){
		var ele = $(this);
		$.ajax({
			url: '../api/index.php?route=cronjob/checkByMidNight',
			type: 'GET',
			dataType: 'json',
			// data: {param1: 'value1'},
		})
		.done(function() {
			ele.text('success');
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		e.preventDefault();
	});
	

	$(document).ready( function () {
	    $('.myTable').DataTable({
	    	"paging": false,
	    	"searching": false,
	    	"bInfo" : false
	    });
	} );
	$(document).ready(function(){
        $(".datetimepicker").datepicker({ 
        	format: 'yyyy-mm-dd' 
        });
    });
</script>