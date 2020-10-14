<?php
$url = $_SERVER['REQUEST_URI'];
$user = (int) explode('?', explode('/', $url)[3])[0];
$from = $_GET['from'];
$to = $_GET['to'];

$mysqli = new mysqli('localhost', 'warszaweka', 'warszawa', 'warszaweka');


$query = <<<EOD
select date, clicks, page_views
from users_statistics
where user_id = {$user}
and date between '{$from}' and '{$to}'
order by date asc
EOD;
$result = $mysqli->query($query);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $stats[] = $row;
}
$result->close();

$query = <<<EOD
select first_name, last_name
from users
where id = {$user}
EOD;
$result = $mysqli->query($query);
$name = $result->fetch_array(MYSQLI_ASSOC);
$result->close();

$data = array(
  'first_name' => $name['first_name'],
  'last_name' => $name['last_name'],
  'stats' => $stats,
);
echo json_encode($data);

$mysqli->close();
?>
