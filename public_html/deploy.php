<?php
if ( $_POST['payload'] ) {

  // Get the hook secret
  $config = parse_ini_file("../config.ini");

  // Check that the hashed signature looks right
  list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
  $rawPost = file_get_contents('php://input');
  if ($hash == hash_hmac($algo, $rawPost, $config['secret'])){
    // CLUSTER FLOW UPDATE
    // Pull the new version of the main Cluster Flow repo
    shell_exec("cd /home/clusterflow/clusterflow && /usr/local/cpanel/3rdparty/bin/git pull");
    // Get the latest version number and write to a file
    // shell_exec("cd /home/clusterflow/clusterflow && /usr/local/cpanel/3rdparty/bin/git describe --tags --abbrev=0 > /home/clusterflow/version.txt");
    die("done " . mktime());
  } else if ($hash == hash_hmac($algo, $rawPost, $config['website_secret'])){
    // WEBSITE UPDATE
    // Pull the new version of the main Cluster Flow website repo
    shell_exec("cd /home/clusterflow/clusterflow-website && /usr/local/cpanel/3rdparty/bin/git pull");
    die("done " . mktime());
  } else {
    header('HTTP/1.0 403 Forbidden');
    die('GitHub signature looks wrong.');
  }

} else {
  header('HTTP/1.0 403 Forbidden');
}
?>