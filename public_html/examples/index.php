<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Examples: Cluster Flow</title>
    <meta name="description" content="Cluster Flow: A simple and flexible bioinformatics pipeline tool">
    <meta name="author" content="Phil Ewels">

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="../styles.css" rel="stylesheet">
    <link href="example_styles.css" rel="stylesheet">

    <!-- Demo Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="examples_js.js"></script>

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
    <h1>Cluster Flow Examples <a class="pull-right" href="../"><img src="../img/Cluster_Flow.png" alt="Cluster Flow"></a></h1>
    <p><span class="lead">You can see some static examples of what to expect from Cluster Flow below.</span><br>
      If you like, you can try these out in the <a href="../demo">online demo</a>.</p>
</div>

<div class="container">

    <h3>Finding out what's available with Cluster Flow</h3>
    <p>Cluster Flow has a number of functions to list installed pipelines, modules and reference genomes:</p>

    <pre class="cmd_ex">cf --pipelines <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><?php echo file_get_contents('../output/pipelines.txt'); ?></pre>

    <pre class="cmd_ex">cf --modules <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><?php echo file_get_contents('../output/modules.txt'); ?></pre>

    <pre class="cmd_ex">cf --genomes <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><?php echo file_get_contents('../output/genomes.txt'); ?></pre>


    <h3>Running pipelines</h3>
    <p>You can run modules and pipelines with varying numbers of extra parameters, to give increasing degrees of flexibility:</p>

    <pre class="cmd_ex">cf sra_trim *.sra</pre>
    <pre class="cmd_ex">cf samtools_sort_index *.bam</pre>
    <pre class="cmd_ex">cf --genome GRCh37 fastq_tophat *fastq.gz</pre>
    <pre class="cmd_ex">cf --genome NCBIM37 fastq_bismark ftp://fileserver.edu/data/sample1.fq</pre>
    <pre class="cmd_ex">cf --paired --project a2015930 --genome s.pombe --file_list downloads.txt fastq_tophat</pre>

    <h3>Monitoring progress</h3>
    <p>Once running, Cluster Flow has a number of tools to help you keep track of your jobs:</p>

    <pre class="cmd_ex">cf --qstat <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><?php echo file_get_contents('../output/qstat.html'); ?></pre>

    <pre class="cmd_ex"><span class="sans_font">Notification e-mails when a pipeline completes.</span> <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><iframe src="../output/email.html" style="width: 100%; height: 500px; background-color: #FFF; border: none;"></iframe></pre>

    <h3>Pipelines and Modules</h3>
    <p>To find out more about specific pipelines and modules that come bundled with Cluster Flow, click the buttons below:</p>

    <div class="row">
      <div class="col-sm-6">
        <h4>Modules</h4>
        <ul>
          <?php
          $modules = ['bismark_align', 'bismark_coverage', 'bismark_deduplicate', 'bismark_methXtract',
                       'bismark_report', 'bismark_summary_report', 'bowtie', 'bowtie1', 'bowtie2', 'bwa',
                       'cf_download', 'cf_merge_files', 'cf_run_finished', 'cf_runs_all_finished',
                       'fastq_screen', 'fastqc', 'featureCounts', 'hicup', 'htseq_counts', 'preseq_calc',
                       'preseq_plot', 'rseqc_geneBody_coverage', 'rseqc_inner_distance', 'rseqc_junctions',
                       'rseqc_read_GC', 'samtools_bam2sam', 'samtools_sort_index', 'sra_abidump',
                       'sra_fqdump', 'star', 'tophat', 'tophat_broken_MAPQ', 'trim_galore'];
          foreach($modules as $mod){
            echo '<li><button class="mod-modal-btn btn-link" data-toggle="modal" data-target="#mod-modal">'.$mod."</button></li>\n";
          }
          ?>
        </ul>
      </div>
      <div class="col-sm-6">
        <h4>Pipelines</h4>
        <ul>
          <?php
          $pipelines = ['bam_preseq', 'bismark', 'bismark_pbat', 'bismark_singlecell', 'bwa_preseq',
                       'fastq_bismark', 'fastq_bismark_RRBS', 'fastq_bowtie', 'fastq_hicup', 'fastq_pbat',
                       'fastq_star', 'fastq_tophat', 'sra_bismark', 'sra_bismark_RRBS', 'sra_bowtie',
                       'sra_bowtie1', 'sra_bowtie2', 'sra_bowtie_miRNA', 'sra_hicup', 'sra_pbat',
                       'sra_tophat', 'sra_trim', 'trim_bowtie_miRNA', 'trim_tophat'];
          foreach($pipelines as $p){
            echo '<li><button class="mod-modal-btn btn-link" data-toggle="modal" data-target="#mod-modal">'.$p."</button></li>\n";
          }
          ?>
        </ul>
      </div>
    </div>

    <h3>Further Information</h3>
    <p>To find out more about Cluster Flow - have a look at the <a href="../">online demo</a>,
      <a href="../docs">read the documentation</a> or <a href="https://github.com/ewels/clusterflow/releases">download a copy</a> and try it out!</p>

</div>

<footer class="container">
  <hr class="f-txt">
  <p class="f-txt">Cluster Flow was written by <a href="http://phil.ewels.co.uk" target="_blank">Phil Ewels</a> whilst working at the <a href="http://www.bioinformatics.babraham.ac.uk/" target="_blank">Babraham Institute</a> and now the <a href="http://www.scilifelab.se/facilities/genomics-applications/" target="_blank">Science for Life Laboratory</a>.</p>
</footer>

<!-- Help Modal -->
<div class="modal fade" id="mod-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="mod-modal-name"></span> Help</h4>
      </div>
      <div class="modal-body">[help content loading]</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
