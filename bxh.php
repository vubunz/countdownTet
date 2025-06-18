<?php
$_title = "TOP Level";
include_once 'main.php';
//
$_alert = null;
?>
<div class="card">
	<div class="card-body">
		<h5 class="card-header" style='text-align:center; color: #0096ff;'>Bảng Xếp Hạng TOP</h5>
		<div class="table-responsive">
			<table class="table table-hover table-nowrap">

				<thead>
					<tr>
						<th style='text-align:center; font-size: 15px'>TOP</th>
						<th style='text-align:center; font-size: 15px'>Nhân vật</th>
						<th style='text-align:center; font-size: 15px'>Phái</th>
						<th style='text-align:center; font-size: 15px'>Yên</th>

					</tr>
				</thead>

				<tbody>
					<?php
					/* Kết nối SQL */
					require_once("CMain/connect.php");
					$sql = "SELECT * FROM `players` ORDER BY `yen` DESC LIMIT 20";
					$query = mysqli_query($conn, $sql);
					// Cố gắng thực thi truy vấn với mệnh đề ORDER BY
					// Mặc định sắp xếp theo thứ tự tăng dần
					$ranking = 1;
					while ($row = mysqli_fetch_array($query)) {
						if ($row['class'] == 1) {
							$class = "Kiếm";
						}
						if ($row['class'] == 2) {
							$class = "Tiêu";
						}
						if ($row['class'] == 3) {
							$class = "Kunai";
						}
						if ($row['class'] == 4) {
							$class = "Cung";
						}
						if ($row['class'] == 5) {
							$class = "Đao";
						}
						if ($row['class'] == 6) {
							$class = "Quạt";
						}
						if ($row['class'] == 0) {
							$class = "Chưa Vào Lớp";
						}
						if ($ranking == 1) {
							echo "<tr>";
							echo "<td style='text-align:center; color:red'><b>[TOP " . $ranking . "]</b></td>";
							echo "<td style='text-align:center; color:red'><b>" . $row['name'] . "</b></td>";
							echo "<td style='text-align:center; color:red'><b>" . $class . "</b></td>";
							echo "<td style='text-align:center; color:red'><b>" . $row['yen'] . "</b></td>";

							echo "</tr>";
						} else if ($ranking == 2) {
							echo "<tr>";
							echo "<td style='text-align:center; color:blue'><b>[TOP " . $ranking . "]</b></td>";
							echo "<td style='text-align:center; color:blue'><b>" . $row['name'] . "</b></td>";
							echo "<td style='text-align:center; color:blue'><b>" . $class . "</b></td>";
							echo "<td style='text-align:center; color:blue'><b>" . $row['yen'] . "</b></td>";

							echo "</tr>";
						} else if ($ranking == 3) {
							echo "<tr>";
							echo "<td style='text-align:center; color:#0096ff'><b>[TOP " . $ranking . "]</b></td>";
							echo "<td style='text-align:center; color:#0096ff'><b>" . $row['name'] . "</b></td>";
							echo "<td style='text-align:center; color:#0096ff'><b>" . $class . "</b></td>";
							echo "<td style='text-align:center; color:#0096ff'><b>" . $row['yen'] . "</b></td>";

							echo "</tr>";
						} else {
							echo "<tr>";
							echo "<td style='text-align:center; color:#008080'><b>#" . $ranking . "</b></td>";
							echo "<td style='text-align:center; color:#008080'>" . $row['name'] . "</td>";
							echo "<td style='text-align:center; color:#008080'>" . $class . "</td>";
							echo "<td style='text-align:center; color:#008080'>" . $row['yen'] . "</td>";

							echo "</tr>";
						}
						$ranking++;
					}


					?>
				</tbody>
			</table>
		</div>


	</div>
</div>

<?php
include_once 'end.php';
?>