<?php include 'parts/head.php'; ?> 
  <body class="text-center login">
    <?php include 'parts/header.php'; ?> 
     <?php check_msg(); ?>
      <main>
        <h1 class="page-header"><?php print $data['title']; ?></h1>
        <form class="form-signin" action="/user/login" method="post">
          <input type="text" name="username" class="form-control <?php print !empty($data['username_err']) ? 'is-invalid' : ''; ?>" placeholder="Email address" required="" autofocus="">
          <input type="password" name="password" class="form-control <?php print !empty($data['password_err']) ? 'is-invalid' : ''; ?>" placeholder="Password" required="">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Логин</button>
        </form>
      </main>
    <?php include 'parts/footer.php'; ?>
  