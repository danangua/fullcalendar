<?php 
//include '00-inc.php'; 
error_reporting(1);
@header("content-Type: text/html; charset=utf-8");	ob_start();	date_default_timezone_set('PRC');
$sstime=microtime(true);
$stime = date('Y-m-d H:i:s',time());
$sdate = date('Y-m-d',time());
$sdate1=date("Y-m-d",strtotime("-1 day",time()));
$sDB=new PDO('mysql:host=xx:xx;dbname=xx','xx','xx');
$sDB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);


$resources='';
$sql='SELECT eename,team from instructors where xxx';
if (!empty($_REQUEST[team])) {
$sql='SELECT eename,team from instructors where xxx';
if (($_REQUEST[team])=='all') {$sql='SELECT eename,team from instructors order by team,eename';}
}
$ssql=$sql;
//$sql='SELECT eename from instructors order by team,eename';
$res = $sDB->query($sql)->fetchAll();
$i=100;
foreach ($res as $v){ $i++;
	$resources .= "{ od: '{$i}', id: '{$v[eename]}', title: '{$v[eename]}', team: '{$v[team]}', UT: '66%' },\n";
} $resources=rtrim($resources,',');

$setime=number_format(microtime(true)-$sstime,3);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Training Schedule Timeline View</title>
	<link rel="stylesheet" href="/js/bootstrap.min.css" />
	<link rel="stylesheet" href="/js/swds.css" />
	<link href='/js/cal/main.css' rel='stylesheet' />
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src='/js/cal/main.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
  schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source'
	now: '<?=$sdate1?>T23:59:59', nowIndicator: true,
	resourceOrder: 'od',
	resourceAreaWidth:'164px',
	eventTextColor: 'black',
	businessHours: {dow: [ 1, 2, 3, 4, 5 ],start: '00:00',end: '23:59',},
	selectable: true,
	aspectRatio: 2.4,
	editable: true, // enable draggable events
	//	stickyHeaderDates:true,
	//	themeSystem:'bootstrap',
	headerToolbar: {left: 'today prev,next',center: 'title'},
	initialView: 'timeline42Day',
	views: {timeline42Day: {type: 'resourceTimeline',duration: { days: 35 }, buttonText: '6 Weeks' }},
	//resourceAreaHeaderContent: 'Instructors',
	resourceGroupField: 'team',
//	resourceAreaColumns: [	{field: 'title', headerContent: 'Instructor', width:'120px'},	{field: 'UT', headerContent: 'UT', width:'44px' }	],
	resourceAreaColumns: [	{field: 'title', headerContent: 'Instructor', width:'120px'}	],
	resources: [<?=$resources?>],
	eventSources: ['schedule.json'],
	eventClick: function(info) { info.jsEvent.preventDefault();   if (info.event.url) {  window.open(info.event.url); }},
	eventMouseEnter: function(info) { info.el.title=info.event.extendedProps.desc;}

	//events: [<?=$events?>]
	//events: '/myfeed.php'
});
calendar.render();
});
</script>
<style>
	body {margin: 0; padding: 0;font-family: Arial, Helvetica Neue, Helvetica, sans-serif;font-size: 12px;}
	table { border: 1px solid white; font-size:12px; border-collapse: collapse}
</style>
</head>
<body><div style="height:4px; background:#008BC7; width:100%;position:fixed; left:0px;z-index:9999;"> </div>
<table class="topline fixed-top"><tr>
	<td with=10%><a href="/ins/" class="btn btn-primary">Home</a></td>
	<td align=center valign=middle>
	<a href="?team=all" class="btn btn-primary">All</a> -
	<a href="?team=aa" class="btn btn-primary">Xian</a>
	<a href="?team=bb" class="btn btn-primary">Hsinchu</a>
	<a href="?team=cc" class="btn btn-primary">US</a>
	<a href="?team=dd" class="btn btn-primary">EU</a>
	<a href="?team=ee" class="btn btn-primary">Other</a> - 
	<a href="?team=ff" class="btn btn-primary">MDP</a>
	<a href="?team=gg" class="btn btn-primary">DDP</a>
	<a href="?team=hh" class="btn btn-primary">FEP</a>
	<a href="?team=ii" class="btn btn-primary">Etch</a>
	<a href="?team=jj" class="btn btn-primary">CMP</a>
	<a href="?team=kk" class="btn btn-primary">PPC</a>
	<a href="?team=ll" class="btn btn-primary">IMP</a>
	<a href="?team=mm" class="btn btn-primary">PDC</a>
	<a href="?team=nn" class="btn btn-primary">Display</a></div></td>
	<td width=10% align=right><a href="s0-session-index.php" class="btn btn-primary">Saba Training List</a></td>
</tr></table><div style="height:52px;"> </div>
<div id='calendar'></div><div class="sHover" id="sHover" style="display:none;border:1px"></div>
</body>
</html>
