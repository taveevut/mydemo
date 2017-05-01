<?php
	$date_begin = $_GET["b"];
	$date_end = date("Y-m-d", strtotime("+14 day", strtotime($date_begin)));
	$date_prev = date("Y-m-d", strtotime("-14 day", strtotime($date_begin)));
	$time_begin = strtotime($date_begin);
	$time_end = strtotime($date_end);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<style>
		html, body {
			margin:0px;
			padding:0px;
			width:100%;
			height:100%;
		}
		body {
			padding:20px;
		}
		table{
			border-collapse:collapse;
		}
	</style>

</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:1px; text-align:center;">
							<a href="?b=<?=$date_prev?>" target="_self">
								&#8592;
							</a>
						</td>
						<td style="text-align:center;">
							<?=date("d F Y",strtotime($date_begin))." - ".date("d F Y",strtotime($date_end))?>
						</td>
						<td style="width:1px; text-align:center;">
							<a href="?b=<?=$date_end?>" target="_self">
								&#8594;
							</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							&nbsp;
						</td>
						<?php
							$time_loop = $time_begin;
							while( $time_loop <= $time_end ){
						?>
						<td style="padding-left:10px; padding-right:10px;">
							<?=date("D",$time_loop)?>
						</td>
						<?php
								$time_loop = strtotime("+1 day", $time_loop);
							}
						?>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
						<?php
							$time_loop = $time_begin;
							while( $time_loop <= $time_end ){
						?>
						<td style="padding-left:10px; padding-right:10px; text-align:center;">
							<?=date("d",$time_loop)?>
						</td>
						<?php
								$time_loop = strtotime("+1 day", $time_loop);
							}
						?>
					</tr>
					<?php
						$l = 0;
						while( $l < 10 ){
							$l++;
					?>
					<tr>
						<td style="padding-left:10px; padding-right:10px; text-align:right;">
							รายการที่ <?=$l?>
						</td>
						<?php
							$time_loop = $time_begin;
							while( $time_loop <= $time_end ){
						?>
						<td style="padding-left:10px; padding-right:10px; text-align:center;">
							ข้อมูล
						</td>
						<?php
								$time_loop = strtotime("+1 day", $time_loop);
							}
						?>
					</tr>
					<?php
						}
					?>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>