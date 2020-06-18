<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="jumbotron jumbotron-light">
        <?php if(!empty($data["task"])):?>
            <h2 class="display-6">Задача от <?=$data["task"]->name?></h2>
            <p class="lead">Статус: <strong><?=$data["task"]->complete ? "выполнено" : "на исполнении"; ?></strong></p>
            
            <hr class="my-4">

            <p><?=$data["task"]->body?></p>
        <?php else: ?>
            <h1 class="display-4 text-center">Упс... Такой задачи нет</h1>
        <?php endif;?>
        </div>
    </div>
</div>