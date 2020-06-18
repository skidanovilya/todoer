<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="row border-bottom border-gray">
        <div class="col mr-auto">
            <h6 class="pb-2 mb-0">Задачи</h6>
        </div>
        <div class="col-lg-8 ml-auto">
            <form action="<?=URLROOT;?>" method="get">
                <div class="form-row d-flex flex-wrap">
                    <div class="form-group col-md-12 col-lg mr-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" name="sort">Сортировать по:</label>
                            </div>
                            <select class="custom-select" name="sort">
                                <option value="name">Имя</option>
                                <option value="email">Email</option>
                                <option value="complete">Статус</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-lg mr-2">
                        <select class="custom-select" name="order">
                            <option value="asc">Возрастанию</option>
                            <option value="desc">Убыванию</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 col-lg">
                        <button class="btn btn-secondary btn-block" type="submit">Показать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if (!$data["tasks"]): ?>
        <p class="lead">Задач нет. Отдыхайте...</p>
    <?php endif; ?>
    <?php foreach($data["tasks"] as $task): ?>

    <div class="media text-muted pt-3">

        <?php if ($task->complete):?>
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
            <rect width="100%" height="100%" fill="#159911"></rect><text x="30%" y="50%" fill="#ADF9AB"
                dy=".3em">✓</text>
        </svg>
        <?php else: ?>
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
            <rect width="100%" height="100%" fill="#D34949"></rect><text x="37%" y="50%" fill="#FFDDDD"
                dy=".3em">×</text>
        </svg>
        <?php endif; ?>


        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <span class="d-block text-gray-dark">Имя: <strong><?=$task->name; ?></strong></span>
            <span class="d-block text-gray-dark">Электронная почта: <strong><?=$task->email;?></strong></span>
            <span class="d-block text-gray-dark"">Статус: <strong><?=$task->complete ? "выполнено" : "на исполнении"; ?></strong></span>
           
            <?=$task->body;?>

            <br>


            <a href="<?=URLROOT . "/tasks/show/" . $task->id; ?>" class="btn btn-sm my-2 btn-primary">Подробнее</a>

            <?php if (TorjaPHP\Components\Auth::isAuthorized()): ?>

            <a href="<?=URLROOT . "/tasks/delete/" . $task->id; ?>" class="btn btn-sm my-2 btn-danger">Удалить</a>
            <a href="<?=URLROOT . "/tasks/edit/" . $task->id; ?>" class="btn btn-sm my-2 btn-warning">Редактировать</a>

                <?php if(!$task->complete): ?>
            <a href="<?=URLROOT . "/tasks/complete/" . $task->id; ?>" class="btn btn-sm my-2 btn-success">Выполнено</a>
                <?php endif; ?>

                <?php if($task->modified): ?>
            <small class="ml-3">отредактировано администратором</small>
                <?php endif; ?>
            <?php endif; ?>
        </p>
    </div>

    <?php endforeach; ?>

    <?php if ($data["last_page"] > 1): ?>
    <div class="row mt-3">
        <div class="col">
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?=($data["page"] == 1) ? "disabled" : ""; ?>">
                        <a class="page-link" href="<?=$data["page"] != 1 ? (URLROOT . "/tasks/page/" . ($data["page"] - 1)  . "?sort=" . $data["sort"] . "&order=" . $data["order"]) : ""; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for ($page = 1; $page <= $data["last_page"]; $page++): ?>
                    
                    <li class="page-item <?=($page == $data["page"]) ? "active" : ""; ?>">
                        <a class="page-link" href="<?=URLROOT . "/tasks/page/" . $page . "?sort=" . $data["sort"] . "&order=" . $data["order"]; ?>"><?=$page;?></a>
                    </li>

                    <?php endfor; ?>

                    <li class="page-item <?=($data["page"] == $data["last_page"]) ? "disabled" : ""; ?>">
                        <a class="page-link" href="<?=$data["page"] != $data["last_page"] ? (URLROOT . "/tasks/page/" . ($data["page"] + 1)  . "?sort=" . $data["sort"] . "&order=" . $data["order"]) : ""; ?>" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <?php endif; ?>
</div>