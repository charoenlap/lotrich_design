<div class="container-fluid mt-3">
	<div class="row mt-4">
		<div class="col-md-12">
			<h4>ภาพรวม</h4>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-12">
			  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  			  <div id="chart_div"></div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-2">
			วันที่
			<input type="text" class="form-control" placeholder="วันที่" value="<?php echo date('d');?>">
		</div>
		<div class="col-2">
			เดือน
			<select name="" id="" class="form-control">
				<?php for($i=1;$i<=12;$i++){?>
					<option value=""><?php echo $i;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-2">
			&nbsp;
			<input type="button" class="btn btn-block btn-primary" value="ค้นหาสรุป">
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-3 ">
			<div class="card ">
				<div class="card-body">
					<h2 class="text-center"><span class="text-success">857</span> </h2>
					<h4 class="text-center">ลูกค้า (คน)</h4>
				</div>
			</div>
		</div>
		<div class="col-md-3 ">
			<div class="card ">
				<div class="card-body">
					<h2 class="text-center"><span class="text-danger">203,291.20</span> </h2>
					<h4 class="text-center">ยอดถอน (บาท)</h4>
				</div>
			</div>
		</div>
		<div class="col-md-3 ">
			<div class="card ">
				<div class="card-body">
					<h2 class="text-center"><span class="text-success">203,291.20</span> </h2>
					<h4 class="text-center">ยอดฝาก (บาท)</h4>
				</div>
			</div>
		</div>
		<div class="col-md-3 ">
			<div class="card ">
				<div class="card-body">
					<h2 class="text-center"><span class="text-success">203,291.20</span> </h2>
					<h4 class="text-center">จำนวนโพย (บาท)</h4>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4>แจ้งโอน</h4>
					<table class="table table-striped">
						<thead>
							<th>วันที่</th>
							<th>ID</th>
							<th>จำนวนเงิน</th>
							<th>สถานะ</th>
							<th></th>
						</thead>
						<tbody>
							<tr>
								<td>2021-10-09 19:10:29</td>
								<td>testid</td>
								<td>200.25</td>
								<td>รอการยืนยัน</td>
								<td><a href="#">ยืนยัน</a></td>
							</tr>
							<tr>
								<td>2021-10-09 19:10:29</td>
								<td>testid</td>
								<td>200.25</td>
								<td>รอการยืนยัน</td>
								<td><a href="#">ยืนยัน</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
<script>
	google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'ยอดถอน', 'ยอดฝาก', 'จำนวนโพย'],
          ['1', 1000, 400, 200],
          ['2', 1170, 460, 250],
          ['3', 660, 1120, 300],
          ['4', 1030, 540, 350],
          ['5', 1030, 540, 350],
          ['6', 1030, 540, 350],
          ['7', 1030, 540, 350],
          ['8', 1030, 540, 350],
          ['9', 1030, 540, 350],
          ['10', 1030, 540, 350],
          ['11', 1030, 540, 350],
          ['12', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'แสดงรายรับรายจ่าย',
            subtitle: 'ประจำปี 2012',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>