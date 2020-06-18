<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card bg-light">
            <div class="card-header">
                <h2 class="display-6 text-center"><?=$data["title"];?></h2>
            </div>
            <div class="card-body">

                <form action="<?=URLROOT;?>/users/login" method="post">

                    <div class="form-group">
                        <label for="login">Логин: <sup class="text-danger">*</sup></label>
                        <input type="text" name="login" class="form-control <?=!empty($data["errors"]["login"]) ? "is-invalid" : "";?>" value="<?=$data["form"]["login"]?>">
                        <?php if (!empty($data["errors"]["login"])): ?>
                        
                        <div class="invalid-feedback">
                            <ul class="list-unstyled">
                                <?php foreach($data["errors"]["login"] as $error): ?>
                                    <li><?=$error?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <?php endif;?>
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль: <sup class="text-danger">*</sup></label>
                        <input type="password" name="password" class="form-control <?=!empty($data["errors"]["password"]) ? "is-invalid" : "";?>" value="<?=$data["form"]["password"]?>">
                        <?php if (!empty($data["errors"]["password"])): ?>
                        
                        <div class="invalid-feedback">
                            <ul class="list-unstyled">
                                <?php foreach($data["errors"]["password"] as $error): ?>
                                    <li><?=$error?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <?php endif;?>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success btn-block" type="submit">Войти</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>