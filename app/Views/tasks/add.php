<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card bg-light">
            <h2 class="display-6 card-header text-center"><?=$data["title"]?></h2>
            <div class="card-body">
                <form action="<?=URLROOT?>/tasks/add" method="post">
                    
                    <div class="form-group">
                        <label for="name">Ваше имя: <sup class="text-danger">*</sup></label>
                        <input type="text" name="name" placeholder="Иван Иванович" class="form-control <?=!empty($data["errors"]["name"]) ? "is-invalid" : "";?>" value="<?=$data["form"]["name"]?>">
                        <?php if (!empty($data["errors"]["name"])): ?>
                        
                        <div class="invalid-feedback">
                            <ul class="list-unstyled">
                                <?php foreach($data["errors"]["name"] as $error): ?>
                                    <li><?=$error?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <?php endif;?>
                    </div>

                    <div class="form-group">
                        <label for="email">Ваша электронная почта: <sup class="text-danger">*</sup></label>
                        <input type="email" name="email" placeholder="ivan@mail.com" class="form-control <?=!empty($data["errors"]["email"]) ? "is-invalid" : "";?>" value="<?=$data["form"]["email"]?>">
                        <?php if (!empty($data["errors"]["email"])): ?>
                        
                        <div class="invalid-feedback">
                            <ul class="list-unstyled">
                                <?php foreach($data["errors"]["email"] as $error): ?>
                                    <li><?=$error?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <?php endif;?>
                    </div>

                    <div class="form-group">
                        <label for="body">Описание задачи: <sup class="text-danger">*</sup></label>
                        <textarea name="body" class="form-control <?=!empty($data["errors"]["body"]) ? "is-invalid" : "";?>" rows="5"><?=$data["form"]["body"]?></textarea>
                        <?php if (!empty($data["errors"]["body"])): ?>
                        
                        <div class="invalid-feedback">
                            <ul class="list-unstyled">
                                <?php foreach($data["errors"]["body"] as $error): ?>
                                    <li><?=$error?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <?php endif;?>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary btn-block" type="submit">Добавить задачу</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>