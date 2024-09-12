

<?php $view->component('start'); ?>

<main>
   <div class="container">
       <h3 class="mt-3">Добавление нового жанра</h3>
       <hr>
   </div>
   <div class="container d-flex justify-content-center">


       <form action="/admen/categories/add" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
           <div class="row g-2">
               <div class="col-md">
                   <div class="form-floating">
                       <input type="text" class="form-control <?php echo $session->has('name') ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Название жанра">
                       <label for="name">Название</label>
                       
                       <?php if ($session->has('name')) {?>
                       <div id="name" class="invalid-feedback">
                           <?php echo $session->getFlash('name')[0]; ?>
                       </div>
                       <?php }?>
                   </div>
               </div>
           </div>
          
           <div class="row g-2">
               <button class="btn btn-primary">Добавить жанр</button>
           </div>
       </form>
   </div>
</main>



<?php $view->component('end'); ?>