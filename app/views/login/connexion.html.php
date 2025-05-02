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
     <img src="/assets/images/logo-removebg-preview.png" alt="Sonatel Logo" class="logo" />

     <h3>Bienvenue sur</h3>
     <h2 class="highlight">Ecole du code Sonatel Academy</h2>
     <h1>Se connecter</h1>
    <?php if (!empty($errors)): ?>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">

        <label for="login">Login</label>
        <input type="text" id="login" name="login" value="<?= $old['login'] ?? '' ?>" placeholder="Matricule ou email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe">

        <div class="forgot">
         <a href="/forgot-password">Mot de passe oublié ?</a>
       </div>


       <button type="submit">Se connecter</button>
     </form>

</div>

</body>
</html>