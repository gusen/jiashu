<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>framework demo</title>
</head>

<body>
Demo Name:<?=$n?><br />
Framework Version:<?=$v?><br />
<table width="200" border="1">
<?php
foreach($r as $data)
{
?>
    <tr>
      <td><?=$data[username]?></td>
      <td><?=$data[email]?></td>
      <td><?=date('Y-m-d H:i:s',$data[createdate])?></td>
    </tr>
<?php
}
?>
</table>
</body>
</html>
