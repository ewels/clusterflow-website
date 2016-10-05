<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cluster Flow</title>
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
    <div class="row">
      <div class="col-sm-12 col-md-6 intro">
        <p class="lead">Cluster Flow is designed to be quick and easy to install,
          with flexible configuration and simple customization.</p>
        <p>It's easy enough to set up and use for non-bioinformaticians (given a basic
          knowledge of the command line), and it's simplicity makes it great for low
          to medium throughput analyses.</p>
      </div>
      <div class="col-sm-8 col-md-4">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe id="cf-video" src="https://www.youtube.com/embed/FusdI-QvbJo?list=PLIA2-lqNuhvH6fog0ctm5ZpdtPoUOun-l&amp;showinfo=0" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-sm-4 col-md-2 intro-vids">
        <h4>Videos</h4>
        <ul id="video-links">
          <li><a data-youtubeid="FusdI-QvbJo" href="https://www.youtube.com/watch?v=FusdI-QvbJo&index=1&list=PLIA2-lqNuhvH6fog0ctm5ZpdtPoUOun-l">Introduction</a></li>
          <li><a data-youtubeid="BFBt5fCWWSY" href="https://www.youtube.com/watch?v=BFBt5fCWWSY&index=2&list=PLIA2-lqNuhvH6fog0ctm5ZpdtPoUOun-l">Usage</a></li>
          <li><a data-youtubeid="L9BmqU7PENo" href="https://www.youtube.com/watch?v=L9BmqU7PENo&index=3&list=PLIA2-lqNuhvH6fog0ctm5ZpdtPoUOun-l">Installation</a></li>
        </ul>
      </div>
    </div>
    
    <hr>
    <div class="row">
      <div class="col-md-6 intro-dl">
        <dl class="dl-horizontal">
          <dt>Simple</dt>
          <dd>Installation walkthroughs and a large module toolset mean you get up and running quickly.</dd>

          <dt>Powerful</dt>
          <dd>Comes packaged with support for 24 different bioinformatics tools (RNA, ChIP, Bisulfite and more).</dd>
        </dl>
      </div>
      <div class="col-md-6 intro-dl">
        <dl class="dl-horizontal">
          <dt>Flexibile</dt>
          <dd>Pipelines are fast to assemble, making it trivial to change on the fly.</dd>
          
          <dt>Traceable</dt>
          <dd>Commands, software versions, everything is logged for reproducability.</dd>

          <!-- <dt>Extensible</dt>
          <dd>Helper functions and commented examples make writing your own modules easy.</dd> -->
        </dl>
      </div>
    </div>
    <hr>
    
    <div class="row">
      <div class="col-sm-4">
        <a class="panel-btn panel-btn-info" href="docs">
          <i class="fa fa-book"></i><br>
          Read the Docs
        </a>
        <span class="visible-xs">&nbsp;</span>
      </div>
      <div class="col-sm-4">
        <a class="panel-btn panel-btn-primary" href="https://github.com/ewels/clusterflow/archive/v0.4.tar.gz">
          <i class="fa fa-download"></i><br>
          Download v0.4
        </a>
        <span class="visible-xs">&nbsp;</span>
      </div>
      <div class="col-sm-4">
        <a class="panel-btn panel-btn-success" href="https://github.com/ewels/clusterflow">
          <i class="fa fa-github"></i><br>
          Cluster Flow on GitHub
        </a>
      </div>
    </div>
    
    
    <div class="hidden-lg hidden-md hidden-sm">
      <h2>Cluster Flow Demo</h2>
      <p>Apologies, the demo doesn't work properly on small screens. Please try again when visiting from a bigger device..</p>
    </div>
    <div class="row hidden-xs demo_row">
      <div class="col-md-2 col-lg-3">
        <h2>Cluster Flow Demo</h2>
        <p class="lead">You can try out some basic Cluster Flow commands in this demo terminal.</p>
          
        <div id="demo_instructions" class="well">
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
                <li><code>cf [--genome ID] [pipeline] [files]</code></li>
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
              Better still, <a href="https://github.com/ewels/clusterflow/releases">grab a copy of Cluster Flow</a> and try it for real!</li>
          </ol>
          <hr>
          <div class="help-toggle">
            <div class="btn-group btn-toggle">
              <button class="btn btn-sm btn-on btn-default">Show Help</button>
              <button class="btn btn-sm btn-off btn-warning active">Hide Help</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-10 col-lg-9">
        <div id="demo_terminal_wrapper">
          <div id="demo_terminal_header">
            <div id="demo_terminal_btns"><span></span><span></span><span></span></div>
            <div id="demo_terminal_header_text">1. bash</div>
          </div>
          <div id="demo_terminal">Loading...</div>
        </div>
      </div>
    </div>

  </div>
  
</main>
<footer class="container">
  Cluster Flow was written by <a href="http://phil.ewels.co.uk" target="_blank">Phil Ewels</a> whilst working at the <a href="http://www.bioinformatics.babraham.ac.uk/" target="_blank">Babraham Institute</a> and now the <a href="http://www.scilifelab.se/facilities/genomics-applications/" target="_blank">Science for Life Laboratory</a>.
</footer>

<!-- Demo Notification Email -->
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

<!-- JavaScript imports -->
<!-- OLD jQuery for WTerm -->
<script src="js/jquery.1.3.2.min.js"></script>
<!-- WTerm jQuery for terminal emulation -->
<script src="js/wterm.jquery.js"></script>
<script type="text/javascript">var oldJQ = $.noConflict(true);</script>
<!-- Everything else -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.pong.js"></script>
<script src="js/jGravity-min.js"></script>
<script src="js/demo_js.js"></script>
<script>
  // Video links
  $('#video-links a').click(function(e){
    e.preventDefault();
    var vid = $(this).data('youtubeid');
    var url = 'https://www.youtube.com/embed/'+vid+'?list=PLIA2-lqNuhvH6fog0ctm5ZpdtPoUOun-l&amp;showinfo=0';
    $('#cf-video').attr('src', url);
  });
  
  // Google Analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-69834359-1', 'auto');
  ga('send', 'pageview');
</script>

</body>
</html>
