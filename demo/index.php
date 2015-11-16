<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Demo: Cluster Flow</title>
    <meta name="description" content="Cluster Flow: A simple and flexible bioinformatics pipeline tool">
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
    <!-- Bootstrap JS -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-69834359-1', 'auto');
      ga('send', 'pageview');

    </script>
    
  </head>
</html>

<body>

<div class="container">
    <h1><span class="h-txt">Cluster Flow Demo</span> <a class="pull-right" href="../"><img src="../img/Cluster_Flow.png" alt="Cluster Flow" class="h-img"></a></h1>
    <p><span class="lead">You can try out some basic Cluster Flow commands in the demo terminal below.</span><br>
    <span class="h-txt">Don't worry, you can't do any damage <abbr title="Go on - do your worst!"><i class="fa fa-smile-o"></i></abbr></span>
    <span class="h-txt">There are 7 steps to complete, but feel to play around.</span></p>
</div>

<div class="container">
  <div id="demo_instructions" class="well">
    <div class="help-toggle pull-right">
      <label>Show Help?</label>
      <div class="btn-group btn-toggle">
        <button class="btn btn-sm btn-on btn-default">Show</button>
        <button class="btn btn-sm btn-off btn-warning active">Hide</button>
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
      <li><h4>Step 3 <span class="step-progress"><i class="fa fa-square-o"></i> <i class="fa fa-square-o"></i></span></h4> See if you can find out more information about a pipeline and a module.
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
      <li><h4>Step 5 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> Check the files in your working directory and run a pipeline!
        <ul>
          <li><code>ls</code> (list files)</li>
          <li><code>cf [--genome ID] [pipeline / module] [files]</code></li>
          <li><em>eg.</em> <code>cf --genome GRCh37 fastq_bismark *.fastq.gz</code></li>
        </ul>
      </li>
      <li><h4>Step 6 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> Monitor the pipeline's progress
        <ul>
          <li><code>cf --qstat</code></li>
          <li><code>qs</code> (usual alias for above)</li>
        </ul>
      </li>
      <li><h4>Step 7 <span class="step-progress"><i class="fa fa-square-o"></i></span></h4> Check the e-mail when the pipeline finishes!
        <ul>
          <li><button class="btn-link" data-toggle="modal" data-target="#email">Click here to view the e-mail</button></li>
        </ul>
      </li>
      <li>That's it for this demo - feel free to have a <abbr title="Anyone for some pong?">play</abbr>.
        Better still, <a href="../">grab a copy of Cluster Flow</a> and try it for real!</li>
    </ol>
  </div>

  <div id="demo_terminal">Loading...</div>

  <!-- Notification Email -->
  <button style="display:none;" type="button" id="email_notification" data-toggle="modal" data-target="#email"><i class="fa fa-envelope-o"></i> New E-Mail!</button>
  <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="email_subject" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="email_subject">[CF] fastq_bismark pipeline complete</h4>
        </div>
        <div class="modal-body">[e-mail content here]</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


</div>

<footer class="container">
  <hr class="f-txt">
  <p class="f-txt">Cluster Flow was written by <a href="http://phil.ewels.co.uk" target="_blank">Phil Ewels</a> whilst working at the <a href="http://www.bioinformatics.babraham.ac.uk/" target="_blank">Babraham Institute</a> and now the <a href="http://www.scilifelab.se/facilities/genomics-applications/" target="_blank">Science for Life Laboratory</a>.</p>
  <p class="f-txt">The author will neither confirm nor deny the presence of a number of easter eggs<abbr title="Where might they be hidden?">.</abbr></p>
</footer>
</body>
</html>
