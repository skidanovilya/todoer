<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=SITENAME;?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="icon" href="/favicon.ico"> 
    <link rel="stylesheet" href="<?=URLROOT . "/css/style.css" ?>">
  </head>
  <body class="bg-secondary">

    <?php require_once APPROOT . "/Views/inc/navbar.php"; ?>

    <main class="container">

    <?php if(\TorjaPHP\Components\Flash::exists()): 
        $flash = TorjaPHP\Components\Flash::get(); ?>
      <div class="alert alert-<?=$flash["type"]?>"><?=$flash["message"]?></div>
    <?php endif; ?>