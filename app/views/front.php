<?php include 'parts/head.php'; ?> 
  <body class="front">
    <?php include 'parts/header.php'; ?>
    <main role="main" class="container">
      <h1 class="page-header"><?php print $data['title']; ?></h1>
  
      <?php check_msg(); ?>
      <?php include 'parts/create_task_form.php'; ?>
      <?php if (!empty($data['tasks'])): ?>
        <table class="table tasks">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col"><a href="<?php print sortLink('name'); ?>">Имя</a></th>
              <th scope="col"><a href="<?php print sortLink('mail'); ?>">Email</a></th>
              <th scope="col">Текст</th>
              <th scope="col"><a href="<?php print sortLink('status'); ?>">Статус</a></th>
              <th scope="col">Ред-но</th>
              <?php if (isLoggedIn()): ?>
                <th scope="col">Ред-ть</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data['tasks']['rows'] as $key => $row): ?>
            <tr>
              <th scope="row">
                <?php print $key; ?>
              </th>
              <td>
                <?php print $row->name; ?>
              </td>
              <td>
                <?php print $row->mail; ?>
              </td>
              <td>
                <?php print $row->body; ?>
              </td>
              <td>
                <?php print $row->status ? '<span class="status">выполнено</span>' : '<span class="status none">не выполнено</span>'; ?>
              </td>
              <td>
                <?php print $row->edited ? '<span class="edited">редактировано</span>' : '<span class="edited none">не редактировано</span>'; ?>
              </td>
              <?php if (isLoggedIn()): ?>
                <td>
                  <a href="/task/edit?id=<?php print $row->id; ?>" class=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
          <?php if ($count > 1): ?>
            <div class="d-flex justify-content-center">
              <nav aria-label="Tasks">
                <ul class="pagination">
                  <?php $cur_page = !empty($_GET['page']) ? $_GET['page'] : 0; ?>
                  <?php 
                    $count = count($data['tasks']['pages']) - 2;
                    $min = $cur_page > 3 ? $cur_page - 3 : 0;
                    $max = ($cur_page + 3) < $count ? $cur_page + 3 : $count;
                   
                    if ($cur_page > ($count - 3)) {
                      $min = $count - 6;
                    }
                    if ($cur_page < 3) {
                      $max = 6;
                    }
                  ?>
                
                  <?php if (count($data['tasks']['pages']) > 3): ?>
                    <li class="page-item">
                      <a class="page-link" href="/">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                  <?php endif; ?> 

                  <?php foreach ($data['tasks']['pages'] as $page): ?>
                    <?php if ($page >= $min && $page <= $max): ?>
                      <?php 
                        $link = pagerLink($page);
                      ?>
                      <li class="page-item <?php print $cur_page == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo $link; ?>"><?php print $page + 1; ?></a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?> 

                  <?php if (count($data['tasks']['pages']) > 3): ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?php print $count; ?>">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  <?php endif; ?> 
              </ul>
            </nav>
          </div>
          <?php endif; ?>
        
      <?php endif; ?>
    </main>
    <?php include 'parts/footer.php'; ?>
  