<?php

// Connect to the database
$dbconfig = parse_ini_file("../config.ini");
$db = new mysqli('localhost', $dbconfig['user'], $dbconfig['password'], $dbconfig['db']);
if($db->connect_errno != 0) die("Could not connect to database!");

// Usage per week, by version
if ($result = $db->query("SELECT `version`, COUNT(*) as `version_count`, `date` from `version_checks` GROUP BY `version`, WEEK(`date`) ORDER BY `date` ASC, `version` ASC")) {
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
$db->close();


// $ip = $_SERVER['REMOTE_ADDR'];
// $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
// echo $details->city; // -> "Mountain View"

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
      <h1><img src="img/Cluster_Flow.png" alt="Cluster Flow"></h1>
      <h2 class="hidden-xs"><small>A simple and flexible bioinformatics pipeline tool</small></h2>
  </div>
</header>

<main>
  <div class="container">
    <div id="versions_by_week"></div>
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
  Plotly.plot( VERSIONS_BY_WEEK, <?php echo json_encode(array_values($versions_by_week), JSON_PRETTY_PRINT); ?>, versions_layout );
</script>

</body>
</html>