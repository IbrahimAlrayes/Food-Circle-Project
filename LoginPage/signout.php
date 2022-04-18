<?php

setcookie("auth", "out", time()-3600, "/");
setcookie("id", "out", time()-3600, "/");

header("Location:/project/homepage/index.php?message=Goodbye! See you later.");
?>
