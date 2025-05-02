<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/login.css"/>

  <title>Document</title>
</head>
<body>
     <div class="container">
      <div class="login-card">
     <img src="/assets/images/logo-removebg-preview.png" alt="Sonatel Logo" class="logo">
    <h2>Mot de passe oublié</h2> 
    <?php if (!empty($errors)) : ?>
        <ul class="error-list">
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="login">Matricule ou Email</label>
        <input type="text" id="login" name="login" value="<?= $old['login'] ?? '' ?>">

        <label for="password">Nouveau mot de passe</label>
        <input type="password" id="password" name="password">

        <button type="submit">Réinitialiser</button>
    </form>
</div>
</div>

</body>
</html>
