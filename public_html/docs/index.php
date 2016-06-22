<?php
// Markdown parsing libraries
require_once('parsedown/Parsedown.php');
require_once('parsedown-extra/ParsedownExtra.php');

// Get the docs markdown sources in order
require_once("../../Spyc.php");
$md = file_get_contents('../../clusterflow/docs/README.md');
$pages = [];
$md_parts = explode('---', $md, 3);
if(count($md_parts) == 3){
  $pages = spyc_load($md_parts[1]);
}
if(count($pages) == 0){ die("Error - couldn't find documentation source."); }

// Loop over the markdown files and build the HTML content
$content = '';
$tl_toc = '<ul>';
foreach ($pages as $section => $fn) {
  if(basename($fn) == 'README.md'){ continue; }
  $sid = strtolower(str_replace(' ', '-', $section));
  $tl_toc .= '<li><a href="#'.$sid.'">'.$section.'</a></li>';
  $content .= '<div class="docs_section">'."\n".'<h1 class="section-header" id="'.$sid.'"><a href="#'.$sid.'" class="header-link"><span class="glyphicon glyphicon-link"></span></a>'.$section."</h1>\n";
  $md = file_get_contents('../../clusterflow/docs/'.trim($fn));
  $pd = new ParsedownExtra();
  $content .= '<div class="docs_block" id="'.basename($fn).'">' . $pd->text($md) . '</div>';
  $content .= '</div>';
}
$tl_toc .= '</ul>';

// Add ID attributes to headers
$hids = Array();
$content = preg_replace_callback(
  '~<h([123])>([^<]*)</h([123])>~Ui', // Ungreedy by default, case insensitive
  function ($matches) {
    global $hids;
    $id_match = strtolower( preg_replace('/[^\w-]/', '', str_replace(' ', '-', $matches[2])));
    $id_match = str_replace('---', '-', $id_match);
    $hid = $id_match;
    $i = 1;
    while(in_array($hid, $hids)){
      $hid = $id_match.'-'.$i;
      $i += 1;
    }
    $hids[] = $hid;
    return '<h'.$matches[1].' id="'.$hid.'"><a href="#'.$hid.'" class="header-link"><span class="glyphicon glyphicon-link"></span></a>'.$matches[2].'</h'.$matches[3].'>';
  },
  $content);

// Build the ToC
$toc = '';
$curr_level = 0;
$id_regex = "~<h([123])([^>]*)id\s*=\s*['\"]([^'\"]*)['\"][^>]*>(.*)</h[123]>~Ui";
preg_match_all($id_regex, $content, $matches, PREG_SET_ORDER);
if($matches){
  foreach($matches as $match){
    $level = $match[1];
    if($level > 2) {
      continue;
    }
    $class = $match[2];
    $id = $match[3];
    $name = str_replace('&nbsp;','', htmlentities(strip_tags($match[4]) ));
    if($level > $curr_level){
      $toc .= "\n".'<ul class="nav nav-stacked">'."\n";
    } else if($level == $curr_level) {
      $toc .= "</li>\n";
    } else {
      while($level < $curr_level){
        $toc .= "</li>\n</ul>\n</li>\n";
        $curr_level -= 1;
      }
    }
    $curr_level = $level;
    $toc .= '<li><a href="#'.$id.'">'.$name.'</a>';
  }
}
while($curr_level > 0){
  $toc .= '</li></ul>';
  $curr_level -= 1;
}

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Documentation: Cluster Flow</title>
	<meta name="description" content="A pipelining tool to automate and standardise bioinformatics analyses on cluster environments"/>
	<meta name="author" content="Phil Ewels"/>
	<link rel="shortcut icon" href="../favicon.ico">

	<!-- Bootstrap -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Site Stylesheet -->
	<link rel="stylesheet" href="../css/style.css">
</head>
<body id="cf_docs" data-spy="scroll" data-target="#toc" data-offset="100">

<header class="container">
  
  <h1>Documentation
    <a class="pull-right" href="../"><img src="../img/Cluster_Flow.png" alt="Cluster Flow"></a>
  </h1>
  
  <p><span class="lead">Welcome to the Cluster Flow docs!</span><br>
    These are also bundled with the Cluster Flow download as markdown files.</p>
    
  <nav id="nav" role="navigation">
    <?php echo $tl_toc; ?>
  </nav>
  
</header>

<div class="container docs-container">
  <div class="row">
    <div class="col-sm-3 col-sm-push-9" id="toc_column">
      <div id="toc" data-spy="affix" data-offset-top="278">
        <?php echo $toc; ?>
        <p class="backtotop"><a href="#">Back to top</a></p>
      </div>
    </div>
    <div class="col-sm-9 col-sm-pull-3">
      <?php echo $content; ?>
    </div>
  </div>
</div> <!-- /container -->
  
  


<footer class="container">
	<p>Cluster Flow was written by <a href="http://phil.ewels.co.uk" target="_blank">Phil Ewels</a> whilst
    working at the <a href="http://www.babraham.ac.uk" target="_blank">Babraham Institute</a>.
    He now maintains it from <a href="http://www.scilifelab.se" target="_blank">SciLifeLab</a> in Stockholm, Sweden.</p>
	<p>This documentation is <a href="https://github.com/ewels/clusterflow/tree/master/docs" title="View the markdown source">
    written using markdown</a> and is included with the Cluster Flow source code.</p>
</footer>

<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script src="../js/docs.js"></script>

<!-- Google Analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-51481908-1', 'ewels.github.io');
  ga('send', 'pageview');
</script>
</body>
</html>
