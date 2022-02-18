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
					<div class="col-2">
						<div class="form-group">
							<label for="">ประเภท</label>
							<select class="form-control" id="" name="" >
								<option value="">ทั้งหมด</option>
								<option value=""></option>
							</select>
				         </div>
					</div>
					<div class="col-1">
						<label for="">&nbsp;</label><br>
						<input type="submit" class="btn btn-primary" value="ค้นหา">
					</div>
					<div class="col-4">
						<a href="" class="btn btn-warning" id="btn-check-15">Check 15 Min</a>
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
			<div class="row mt-4">
				
				<!-- <table class="myTable table-striped table">
					<thead>
						<th>เลข</th>
						<th>ราคา</th>
					</thead>
					<tbody>

					</tbody>
				</table> -->
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
		$.ajax({
			url: '../api/index.php?route=cronjob/checkBy15Min',
			type: 'GET',
			dataType: 'json',
			// data: {param1: 'value1'},
		})
		.done(function() {
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
		$.ajax({
			url: '../api/index.php?route=cronjob/checkByMidNight',
			type: 'GET',
			dataType: 'json',
			// data: {param1: 'value1'},
		})
		.done(function() {
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