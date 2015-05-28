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
    <script src="examples_js.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
    <pre class="cmd_output"><?php echo file_get_contents('../demo/output/pipelines.txt'); ?></pre>

    <pre class="cmd_ex">cf --modules <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><?php echo file_get_contents('../demo/output/modules.txt'); ?></pre>

    <pre class="cmd_ex">cf --genomes <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><?php echo file_get_contents('../demo/output/genomes.txt'); ?></pre>


    <h3>Running pipelines</h3>
    <p>You can run modules and pipelines with varying numbers of extra parameters, to give increasing degrees of flexibility:</p>

    <pre class="cmd_ex">cf sra_trim *sra</pre>
    <pre class="cmd_ex">cf samtools_sort_index *bam</pre>
    <pre class="cmd_ex">cf --genome GRCh37 fastq_tophat *fastq.gz</pre>
    <pre class="cmd_ex">cf --genome GRCh37 sra_bismark ftp://ftp-trace.ncbi.nlm.nih.gov/sra/sra-instant/reads/ByRun/sra/SRR/SRR521/SRR521008/SRR521008.sra</pre>
    <pre class="cmd_ex">cf --genome GRCh37 --paired --project a2015930 --file_list downloads.txt fastq_tophat</pre>

    <h3>Monitoring progress</h3>
    <p>Once running, Cluster Flow has a number of tools to help you keep track of your jobs:</p>

    <pre class="cmd_ex">cf --qstat <button class="show-output btn-link pull-right">Show output <i class="fa fa-caret-down"></i></button></pre>
    <pre class="cmd_output"><?php echo file_get_contents('../demo/output/qstat.html'); ?></pre>

</div>

<footer class="container">
  <hr class="f-txt">
  <p class="f-txt">Cluster Flow was written by <a href="http://phil.ewels.co.uk" target="_blank">Phil Ewels</a> whilst working at the <a href="http://www.bioinformatics.babraham.ac.uk/" target="_blank">Babraham Institute</a> and now the <a href="http://www.scilifelab.se/facilities/genomics-applications/" target="_blank">Science for Life Laboratory</a>.</p>
</footer>

</body>
</html>
