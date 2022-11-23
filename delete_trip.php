<?php
require "connection.php";
$id=$_GET["id"];
mysqli_query($conn,"delete from trip where id=$id") or die(mysqli_error($conn));
?>
<script type="text/javascript">
    window.location="report.php";
</script>