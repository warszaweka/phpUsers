<?php
$size = (int) $_GET['size'];
$page = (int) $_GET['page'];
$offset = $size * ($page - 1);

$mysqli = new mysqli('localhost', 'warszaweka', 'warszawa', 'warszaweka');

$query = <<<EOD
select id, first_name, last_name, email, gender, ip_address, sum(clicks) as total_clicks, sum(page_views) as total_page_views
from (
  select *
  from users
  order by id asc
  limit {$offset}, {$size}
) as selected_users
join users_statistics on selected_users.id = users_statistics.user_id
group by id
EOD;
$result = $mysqli->query($query);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $users[] = $row;
}
$result->close();

$query = <<<EOD
select count(*) as total
from users
EOD;
$result = $mysqli->query($query);
$total = (int) $result->fetch_array(MYSQLI_ASSOC)['total'];
$result->close();

$data = array(
  'users' => $users,
  'total' => $total,
);
echo json_encode($data);

$mysqli->close();
?>
