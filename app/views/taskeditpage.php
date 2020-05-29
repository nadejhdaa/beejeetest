<?php include 'parts/head.php'; ?> 
<?php $task = !empty($data['task']) ? $data['task'] : ''; ?>
  <body class="task-edit">
    <?php include 'parts/header.php'; ?> 
      <main class="container">
        <h1 class="page-header"><?php print $data['title']; ?></h1>
        <?php if (!empty($task)): ?>
	        <?php include 'parts/edit_task_form.php'; ?>
	      <?php endif; ?>
      </main>
    <?php include 'parts/footer.php'; ?>