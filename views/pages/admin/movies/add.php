<?php
// dd($session);
$view->component('start'); ?>

<h1>Add movie page</h1>
<form action="/admin/movies/add" method="post">
    <p>Name</p>
    <div>
        <input text="text" name="name">
    </div>
    <?php if ($session->has('name')) { ?>
        <ul>
            <?php foreach ($session->getFlash('name') as $error) {?>


                    <li style="color:red;">
                       <?php echo $error ?>
                    </li>
            <?php }?>
        </ul>
    <?php } ?>
    <div>
    </div>
    <div>
        <button>add</button>
    </div>

</form>
<?php $view->component('end'); ?>
