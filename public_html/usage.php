<?php

// Connect to the database
$dbconfig = parse_ini_file("../config.ini");
$db = new mysqli('localhost', $dbconfig['user'], $dbconfig['password'], $dbconfig['db']);
if($db->connect_errno != 0) die("Could not connect to database!");

// Usage per week, by version

$old_query = """SELECT
  `version`,
  COUNT(*) as `version_count`,
  `date`
from `version_checks`
GROUP BY `version`, WEEK(`date`)
ORDER BY `date` ASC, `version` ASC
""";

$query = """SELECT
  `version`,
  STR_TO_DATE(CONCAT(YEARWEEK(`date`,2),'0'),'%X%V%w') as `week`,
  COUNT(*) as `version_count`
from `version_checks`
GROUP BY `version`, `week`
ORDER BY `week` ASC, `version` ASC
""";
if ($result = $db->query($query)) {
    $versions_by_week = [];
    while ($row = $result->fetch_assoc()) {
      $v = $row['version'] == '' ? '<= 0.4' : $row['version'];
      if(!array_key_exists($v, $versions_by_week)){
        $versions_by_week[$v] = array(
          'x' => [],
          'y' => [],
          'name' => $v,
          'type' => 'bar'
        );
      }
      $monday = date("Y-m-d", strtotime('last monday', strtotime($row['date'])));
      $versions_by_week[$v]['x'][] = $monday;
      $versions_by_week[$v]['y'][] = $row['version_count'];
    }
    $result->close();
}

// Usage per IP
if ($result = $db->query("SELECT `ip`, COUNT(*) as `ip_count`, `addr` from `version_checks` GROUP BY `ip` ORDER BY `ip_count` DESC")) {
    $hits_per_ip = [];
    $hits_per_city = [];
    while ($row = $result->fetch_assoc()) {
      $hits_per_ip[$row['ip']] = array(
        'count' => $row['ip_count'],
        'address' => $row['addr']
      );
      $details = false;
      $stmt = $db->stmt_init();
      $stmt->prepare("SELECT ip, hostname, city, region, country, loc, org FROM ip_info WHERE ip=?");
      $stmt->bind_param('s',$row['ip']);
      $stmt->execute();
      $stmt->store_result();
      if($stmt->num_rows > 0){
        $stmt->bind_result($ip, $hostname, $city, $region, $country, $loc, $org);
        while ($stmt->fetch()) {
          $details = array(
            'ip' => $ip,
            'hostname' => $hostname,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'loc' => $loc,
            'org' => $org,
          );
        }
      } else {
        $details = json_decode(file_get_contents("http://ipinfo.io/".$row['ip']."/json"), true);
        if($details){
          $stmt = $db->prepare("INSERT INTO ip_info (ip, hostname, city, region, country, loc, org) VALUES (?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param('sssssss', $details['ip'], $details['hostname'], $details['city'], $details['region'], $details['country'], $details['loc'], $details['org'] );
          $stmt->execute();
        }
      }
      if($details){
        $hits_per_ip[$row['ip']]['city'] = $details['city'];
        $hits_per_ip[$row['ip']]['region'] = $details['region'];
        $hits_per_ip[$row['ip']]['country'] = $details['country'];
        $hits_per_ip[$row['ip']]['org'] = $details['org'];
        $k = $details['city'].'-'.$details['country'];
        if(!array_key_exists($k, $hits_per_city)){
          $hits_per_city[$k] = array(
            'city' => $details['city'],
            'region' => $details['region'],
            'country' => $details['country'],
            'count' => 0
          );
        }
        $hits_per_city[$k]['count'] += $row['ip_count'];
      }
    }
    // Sort city counts
    function sortCounts($a, $b) {
      return $a['count'] < $b['count'];
    }
    usort($hits_per_city, 'sortCounts');
    $result->close();
}

$db->close();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Usage Statistics: Cluster Flow</title>
    <meta name="description" content="Cluster Flow: A simple and flexible bioinformatics pipeline tool">
    <meta name="author" content="Phil Ewels">

    <!-- CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
</html>

<body>

<header>
  <div class="header-panel">
      <h1><a href="/"><img src="img/Cluster_Flow.png" alt="Cluster Flow"></a></h1>
      <h2 class="hidden-xs"><small>A simple and flexible bioinformatics pipeline tool</small></h2>
  </div>
</header>

<main>
  <div class="container">
    <h3>Runs by week</h3>
    <p>Showing version check counts per week, broken down by the running Cluster Flow version.</p>
    <div id="versions_by_week" style="height:450px;"></div>
    <div id="hits_by_ip">
      <h3>Runs by City</h3>
      <p>Showing total version checks, located to nearest city using <a href="http://ipinfo.io/" target="_blank">ipinfo.io</a>.</p>
      <table class="table">
        <thead>
          <tr>
            <th>City</th>
            <th>Region</th>
            <th>Country</th>
            <th>Count</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($hits_per_city as $k => $d){
            echo '<tr>';
            echo '<td>'.$d['city'].'</td>';
            echo '<td>'.$d['region'].'</td>';
            echo '<td>'.Locale::getDisplayRegion('-'.$d['country'], 'en').'</td>';
            echo '<td>'.$d['count'].'</td>';
            echo '</tr>';
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>


<!-- JavaScript imports -->
<!-- Everything else -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>
  // Google Analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-69834359-1', 'auto');
  ga('send', 'pageview');

  // Plotly
  VERSIONS_BY_WEEK = document.getElementById('versions_by_week');
  var versions_layout = {
    title: 'Runs per week',
    barmode: 'stack',
    paper_bgcolor: 'rgba(0,0,0,0)',
    plot_bgcolor: 'rgba(0,0,0,0)',
    yaxis: { gridcolor: '#dedede' }
  };
  Plotly.plot( VERSIONS_BY_WEEK, <?php echo json_encode(array_values($versions_by_week)); ?>, versions_layout );
</script>

</body>
</html>
