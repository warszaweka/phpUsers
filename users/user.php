<!DOCTYPE html>
<html>
<head>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/styles.php');
?>

  <link rel="stylesheet" href="/users/user.css">

</head>
<body>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<div id="page">
  <div id="pagePath">
    <div id="path">
      <span>
        <a class="pathInactive">Main page &rsaquo; </a><a href="/index.php" class="pathInactive">Users satistics &rsaquo; </a><a href="/users/list.php" id="pathActive"></a>
      </span>
    </div>
  </div>
  <div id="pageTitle">
    <div id="title">
      <span>
      </span>
    </div>
  </div>

  <div id="pageClicksTitle">
    <div id="clicksTitle">
      <span>
        Clicks
      </span>
    </div>
  </div>
  <div id="pageClicksGraph">
    <div id="clicksGraph">
      <svg viewBox="0 0 1180 250" xmlns="http://www.w3.org/2000/svg">
        <path stroke="blue" stroke-width="1" fill="none">
        </path>
      </svg>
    </div>
  </div>
  <div id="pageViewsTitle">
    <div id="viewsTitle">
      <span>
        Views
      </span>
    </div>
  </div>
  <div id="pageViewsGraph">
    <div id="viewsGraph">
      <svg viewBox="0 0 1180 250" xmlns="http://www.w3.org/2000/svg">
        <path stroke="blue" stroke-width="1" fill="none">
        </path>
      </svg>
    </div>
  </div>
</div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>

<script src="/users/user.js"></script>

</body>
</html>
