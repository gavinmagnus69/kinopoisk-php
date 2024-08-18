<?php $view->component('start'); ?>

<h1>Add movie page</h1>
<form action="/admin/movies/add" method="post">
    <p>Name</p>
    <div>
        <input text="text" name="name">
    </div>
    <div>
        <button>add</button>
    </div>

</form>
<?php $view->component('end'); ?>
