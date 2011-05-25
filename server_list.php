<html>
<head>
<title>Server Info</title>
</head>

<body>
<?php
// You need to put in the host/usr/pwd/database info in or else this won't work!
$db_host = 'vergil.u.washington.edu:42731';
$db_user = 'root';
$db_pwd = '100degrees';
$database = 'uw_servers';
$table = 'servers';
$userName = $_SERVER['REMOTE_USER'];
$checkFavorite = @$_POST['favorite'];
$temp = 'test1';
$numbers = '124241';
$gameServerID = @$_GET['gameServer'];
$con = mysql_connect("vergil.u.washington.edu:42731","root","100degrees");
$searchINFO = @$_GET['search'];

if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");

if($checkFavorite == 'Favorite') {
  $input = "INSERT INTO uw_servers.favorites (userID, serverID) VALUES('$userName', '$gameServerID')";
  if(!mysql_query($input,$con))
  {
  $delete = "DELETE U FROM uw_servers.favorites U WHERE U.userID = '$userName' AND U.serverID = '$gameServerID'";
  mysql_query($delete,$con);
  }
}


// sending query
$result = mysql_query("
SELECT serverID AS 'Server ID', 
    netID AS 'User Name', 
    game AS 'Game', 
    serverName AS 'Server Name', 
    serverIP AS 'Server IP', 
    serverPort AS 'Server Port', 
    serverPass AS 'Server Pass', 
    maxPlayers AS 'Max Players', 
    whenCreated 'Date Created' 
FROM {$table} T 
LEFT JOIN users U 
    ON U.netID = T.creatorID 
WHERE 
    U.netID LIKE '%$searchINFO%' OR 
    T.serverIP ='$searchINFO' OR 
    T.serverName LIKE '%$searchINFO%' OR 
    T.game LIKE '%$searchINFO%'");
if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysql_num_fields($result);

echo "<div id='header'><h1>UW Game Servers</h1></div>";
echo "<div id='tableContent'><table border='1'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($result);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";
// printing table rows
while($row = mysql_fetch_row($result))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
  $temp = 0;
    foreach($row as $cell)
  
  if($row[3] == $cell) {
      echo "<td><a href='server.php?serverID=$row[0]'>$cell</a></td>";
  } else {
      echo "<td>$cell</td>";
  }
  

    echo "</tr>\n";
}
echo "</table>\n";
echo "<form action='server_list.php' method='POST'>
      <input type='submit' name='favorite' value='Favorite'/>
  </form></div>";

echo "<div id='search'><form action='server_list.php' method='GET'>
  <input type='text' name='search'/>
  <input type='submit' name='submit' value='Search'/>
</form></div>";
mysql_free_result($result);
?>
</body>
</html>