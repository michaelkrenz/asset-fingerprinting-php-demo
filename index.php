<?php require_once('static_file.php'); ?>

<!doctype html>
<head>
  <title>Asset Fingerprinting Demo Page</title>
  <?php echo staticFile('style.css'); ?>
</head>
<body>
  <div>
    <h1>Asset Fingerprinting Demo Page</h1>
    <?php echo staticFile('fingerprint-man.png'); ?>
  </div>
</body>
</html>