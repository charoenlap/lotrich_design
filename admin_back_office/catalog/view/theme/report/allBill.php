<div class="card">
	<div class="card-body">
		<div class="container">
			<div class="row mt-4">
				<div class="col-12">
					<?php foreach($result as $key => $val){ ?>
					<h4>id bill <?php echo $key;?></h4>
					<table class="table table-striped" id="">
						<thead>
							<th>วันที่ซื้อ</th>
							<th>ตัวเลข</th>
							<th>ราคาที่ซื้อ</th>
						</thead>
						<tbody>
							<?php foreach($val['rows'] as $v){ ?>
							<tr>
								<td><?php echo $v['date_create']; ?></td>
								<td><?php echo $v['number'];?></td>
								<td><?php echo $v['price'];?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>