<?php
		header('Content-Type: text/html; charset=utf-8');
		$weekDay = array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
		$thaiMon = array( "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน",
					"05" => "พฤษภาคม","06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม",
					"09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");
		
		//Sun - Sat
		$month = isset($_GET['month']) ? $_GET['month'] : date('m'); //ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
		$year = isset($_GET['year']) ? $_GET['year'] : date('Y'); //ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน
		
		//วันที่
		$startDay = $year.'-'.$month."-01";   //วันที่เริ่มต้นของเดือน
		
		$timeDate = strtotime($startDay);   //เปลี่ยนวันที่เป็น timestamp
		$lastDay = date("t", $timeDate);   //จำนวนวันของเดือน
		
		$endDay = $year.'-'.$month."-". $lastDay;  //วันที่สุดท้ายของเดือน
		
		$startPoint = date('w', $timeDate);   //จุดเริ่มต้น วันในสัปดาห์
		?>
<html>
	<head>
		<title>ทดลองสร้างปฏิทินด้วย PHP</title>
		<script type='text/javascript'>
			function goTo(month, year){
				window.location.href = "calenda02.php?year="+ year +"&month="+ month;
			}
		</script>
		<style>
			th,td{
				width:50px;
				height: 30px; 
				text-align:center}
			th{
				background-color: #eeeeee;
			}
			#tb_calendar, #main{ 
				width : 500px;
			}
			#main{ 
				border : 2px solid #46A5E0;
			}
			#nav{
				background-color: #0C79A4;
				min-height: 20px;
				padding: 10px;
				text-align: center;
				color : white;
			}
			.navLeft{
				float: left; 
			}
			.navRight{
				float: right;
			}
			.title{
				float: left; 
				text-align: center; 
				width: 280px;
			}
		</style>
	</head>
	<body>
		ตำแหน่งของวันที่ <?php echo $startDay;?> คือ <strong><?php echo $startPoint;?>(ตรงกับ วัน <?php echo $weekDay[$startPoint]?>)</strong>
		<?php
			$title = "";
			//ลดเวลาลง 1 เดือน
			$prevMonTime = strtotime ( '-1 month' , $timeDate  );
			$prevMon = date('m', $prevMonTime);
			$prevYear = date('Y', $prevMonTime);
			//เพิ่มเวลาขึ้น 1 เดือน
			$nextMonTime = strtotime ( '+1 month' , $timeDate  );
			$nextMon = date('m', $nextMonTime);
			$nextYear = date('Y', $nextMonTime);
		?>
		<div id="main">
			<div id="nav">
					<button class="navLeft" onclick="goTo('<?php echo $prevMon?>', '<?php echo $prevYear?>');"><< เดือนที่แล้ว</button>
					<div class="title">เดือน <?php echo $thaiMon[$month] ?><strong> <?php echo  $startDay?> <?php echo  $endDay ?></strong></div>
					<button class="navRight" onclick="goTo('<?php echo $nextMon?>', '<?php echo $nextYear?>');">เดือนต่อไป >></button>
			</div>
			<div style="clear:both"></div>
			<table id='tb_calendar' border='1'>
				<tr>
					<th>อาทิตย์</th>
					<th>จันทร์</th>
					<th>อังคาร</th>
					<th>พุธ</th>
					<th>พฤหัสฯ</th>
					<th>ศุกร์</th>
					<th>เสาร์</th>
				</tr>
				<tr>
					<?php
					$col = $startPoint;          //ให้นับลำดับคอลัมน์จาก ตำแหน่งของ วันในสับดาห์ 
					if($startPoint < 7){         //ถ้าวันอาทิตย์จะเป็น 7
						echo str_repeat("<td> </td>", $startPoint); //สร้างคอลัมน์เปล่า กรณี วันแรกของเดือนไม่ใช่วันอาทิตย์
					}
					for($i=0; $i < $lastDay; $i++){ //วนลูป ตั้งแต่วันที่ 1 ถึงวันสุดท้ายของเดือน
						$col++;       //นับจำนวนคอลัมน์ เพื่อนำไปเช็กว่าครบ 7 คอลัมน์รึยัง
						// echo "<td>", date("Y-m-d",strtotime("+$i day",$timeDate)) , "</td>";  //สร้างคอลัมน์ แสดงวันที่ 
						echo "<td>", $i+1, "</td>";  //สร้างคอลัมน์ แสดงวันที่ 
						
						if($col % 7 == false){   //ถ้าครบ 7 คอลัมน์ให้ขึ้นบรรทัดใหม่
							echo "</tr><tr>";   //ปิดแถวเดิม และขึ้นแถวใหม่
							$col = 0;     //เริ่มตัวนับคอลัมน์ใหม่
						}
					}
					if($col < 7){         // ถ้ายังไม่ครบ7 วัน
						echo str_repeat("<td> </td>", 7-$col); //สร้างคอลัมน์ให้ครบตามจำนวนที่ขาด
					}
					?>
				</tr>
			</table>
		</div>
	</body>
</html>