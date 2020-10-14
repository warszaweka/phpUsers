<?php
define('tableHeaders', array(
  1 => array(
    'econtents' => 'Id',
    'id' => 'Id',
  ),
  2 => array(
    'econtents' => 'First name',
    'id' => 'FirstName',
  ),
  3 => array(
    'econtents' => 'Last name',
    'id' => 'LastName',
  ),
  4 => array(
    'econtents' => 'Email',
    'id' => 'Email',
  ),
  5 => array(
    'econtents' => 'Gender',
    'id' => 'Gender',
  ),
  6 => array(
    'econtents' => 'IP address',
    'id' => 'IPAddress',
  ),
  7 => array(
    'econtents' => 'Total clicks',
    'id' => 'TotalClicks',
  ),
  8 => array(
    'econtents' => 'Total page views',
    'id' => 'TotalPageViews',
  ),
));
define('navbarNumberButtonsAmount', 5);
?>
<!DOCTYPE html>
<html>
<head>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/styles.php');
?>

  <link rel="stylesheet" href="list.css">

</head>
<body>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<div id="page">
  <div id="pagePath">
    <div id="path">
      <span>
        <a class="pathInactive">Main page &rsaquo; </a><a href="/users/list.php" id="pathActive">User satistics</a>
      </span>
    </div>
  </div>
  <div id="pageTitle">
    <div id="title">
      <span>
        Users statistics
      </span>
    </div>
  </div>

  <div id="pageTable">
    <table id="table">
      <thead id="tableHead">
        <tr>
<?php
foreach (constant('tableHeaders') as $i) {
?>
          <th id="tableHeader<?= $i['id'] ?>">
            <div>
              <span>
                <?= $i['econtents'] ?>
              </span>
            </div>
          </th>
<?php
}
?>
        </tr>
      </thead>
      <tbody id="tableBody">
      </tbody>
    </table>
  </div>

  <div id="pageNavbar">
    <div id="navbar">
      <button id="navbarLeftButton">
        <div>
          <span>
            &lsaquo;
          </span>
        </div>
      </button>
<?php
for ($i = 0; $i < constant("navbarNumberButtonsAmount"); ++$i) {
?>
      <button class="navbarNumberButton">
        <div>
          <span>
            <?= $i + 1 ?>
          </span>
        </div>
      </button>
<?php
}
?>
      <button id="navbarRightButton">
        <div>
          <span>
            &rsaquo;
          </span>
        </div>
      </button>
    </div>
  </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>

  <script src="list.js"></script>

</body>
</html>
