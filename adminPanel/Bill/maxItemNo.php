<?php
/**
 * Created by PhpStorm.
 * User: Vishva
 * Date: 1/9/2017
 * Time: 10:45 PM
 */

require("../../db/db.php");
$sql="SELECT Max(ItemNo) FROM bill";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
echo ($row['Max(ItemNo)']);
mysqli_close($db);