<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?=URLROOT?>"><?=SITENAME?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=URLROOT?>">Задачи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=URLROOT?>/tasks/add">Добавить задачу</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <?php if (TorjaPHP\Components\Auth::isAuthorized()): ?>
                    <a class="btn btn-primary" href="<?=URLROOT?>/users/logout">Выйти</a>
                <?php else: ?>
                    <a class="btn btn-primary" href="<?=URLROOT?>/users/login">Войти</a>
                <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>