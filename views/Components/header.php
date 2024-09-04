<?php
$user = $auth->user();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <?php if($auth->check()) {?>
        <h3>User: <?php echo $user->email(); ?></h3>
        <form action="/logout" method="post">
            <button>Logout</button>
        </form>
        <hr>
    <?php }?>
</header>
</body>
</html>