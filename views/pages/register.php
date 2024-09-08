<?php $view->component('start'); ?>

<h1>Register page</h1>

<form action="/register" method="post">
    <p>email</p>
    <input type="text" name="email">
    <?php if ($session->has('email')) { ?>
        <ul>
            <?php foreach ($session->getFlash('email') as $error) {?>


                    <li style="color:red;">
                       <?php echo $error ?>
                    </li>
            <?php }?>
        </ul>
    <?php } ?>
    <p>password</p>
    <?php if ($session->has('password')) { ?>
        <ul>
            <?php foreach ($session->getFlash('password') as $error) {?>


                    <li style="color:red;">
                       <?php echo $error ?>
                    </li>
            <?php }?>
        </ul>
    <?php } ?>
    <input type="password" name="password">
    <button>Register</button>

</form>

<?php $view->component('end'); ?>
