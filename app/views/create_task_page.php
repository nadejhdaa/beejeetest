<?php include 'parts/head.php'; ?> 
  <body class="task-edit">
    <?php include 'parts/header.php'; ?> 
      <main class="container">
        <h1 class="page-header"><?php print $data['title']; ?></h1>
        <?php include 'parts/create_task_form.php'; ?>
      </main>
    <?php include 'parts/footer.php'; ?>