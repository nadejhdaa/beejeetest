<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="/">BEEJEE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <?php if (!isLoggedIn()): ?>
      <a href="/user/login" class="btn">Войти</a>
    <?php else: ?>
      <ul class="nav menu">
        <li>
          <span class=""><?php print $data['username']; ?></span>
        </li>
        <li>
          <a href="/user/logout">Выйти</a>
        </li>
      </ul>
    <?php endif; ?>
  </div>
</nav>

 