<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Demo: Cluster Flow</title>
    <meta name="description" content="A simple and flexible bioinformatics pipeline tool">
    <meta name="author" content="Phil Ewels">

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- OLD jQuery for WTerm -->
    <script src="assets/jquery.1.3.2.min.js"></script>
    <!-- WTerm jQuery for terminal emulation -->
    <script src="assets/wterm.jquery.js"></script>
    <script type="text/javascript">var oldJQ = $.noConflict(true);</script>
    <!-- NEW jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Nothing to see here.. -->
    <script src="assets/jquery.pong.js"></script>
    <script src="assets/jGravity-min.js"></script>
    <!-- Demo Javascript -->
    <script src="demo_js.js"></script>

    <!-- Custom Styles -->
    <link href="../styles.css" rel="stylesheet">
    <link href="demo_styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
</html>

<body>

<div class="container">

  <h1>Cluster Flow Demo</h1>
  <p>You can try out some basic Cluster Flow commands in the demo terminal below.
    Don't worry, you can't do any damage <abbr title="Go on - do your worst!">;)</abbr></p>
  <div id="demo_instructions" class="well">
    <div class="help-toggle pull-right">
      <label>Help</label>
      <div class="btn-group btn-toggle">
        <button class="btn btn-xs btn-on btn-default">Show</button>
        <button class="btn btn-xs btn-off btn-warning active">Hide</button>
      </div>
    </div>

    <ol>
      <li><h4>Step 1 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> First, let's work out how to use Cluster Flow - try to display the Cluster Flow help. The main Cluster Flow command is <code>cf</code>.
        <ul>
          <li><code>cf --help</code></li>
        </ul>
      </li>
      <li><h4>Step 2 <span class="step-progress"><i class="fa fa-square-o"></i> <i class="fa fa-square-o"></i> <i class="fa fa-square-o"></i></span></h4> Which pipelines, modules and reference genomes do we have available?
        <ul>
          <li><code>cf --pipelines</code></li>
          <li><code>cf --modules</code></li>
          <li><code>cf --genomes</code></li>
        </ul>
      </li>
      <li><h4>Step 3 <span class="step-progress"><i class="fa fa-square-o"></i> <i class="fa fa-square-o"></i></span></h4> Find more information a pipelines and a module.
        <ul>
          <li><code>cf --help [pipeline]</code></li>
          <li><code>cf --help [module]</code></li>
        </ul>
      </li>
      <li><h4>Step 4 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> Add a new reference genome
        <ul>
          <li><code>cf --add_genome</code></li>
        </ul>
      </li>
      <li><h4>Step 5 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> Check your files and run the pipeline!
        <ul>
          <li><code>ls</code> (list files)</li>
          <li><code>cf --genome GRCh37 fastq_bismark *.fastq.gz</code></li>
        </ul>
      </li>
      <li><h4>Step 6 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> Monitor the pipeline's progress
        <ul>
          <li><code>cf --qstat</code></li>
          <li><code>qs</code> (usual alias for above)</li>
        </ul>
      </li>
      <li><h4>Step 7 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> Check the e-mail when the pipeline finishes!</li>
      <li>That's it for this demo - feel free to have a <abbr title="Anyone for some pong?">play</abbr>.
        Better still, <a href="../">grab a copy of Cluster Flow</a> and try it for real!</li>
    </ol>
  </div>

  <div id="demo_terminal"></div>

</div>

</body>
</html>
