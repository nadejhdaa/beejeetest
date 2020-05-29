<form class="mt-2 mt-md-2" action="/task/edit" method="post">
  <h3>Редактировать задачу</h3>
  <div class="form-group">
    <label>Имя исполнителя задачи</label>
    <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" value="<?php print !empty($task->name) ? $task->name : '';?>" readonly>
    <span class="invalid-feedback"><?php echo !empty($data['name_err']) ? $data['name_err'] : ''; ?></span>
  </div>
  <div class="form-group">
    <label>Email исполнителя</label>
    <input type="text" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php print !empty($task->mail) ? $task->mail : '';?>" readonly>
    <span class="invalid-feedback"><?php echo !empty($data['email_err']) ? $data['email_err'] : ''; ?></span>
  </div>
  <div class="form-group">
    <label>Текст задачи</label>
    <textarea rows="5" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : '';?>" name="body" aria-label="With textarea"> 
      <?php print !empty($task->body) ? $task->body : '';?>
    </textarea>
    <span class="invalid-feedback"><?php echo !empty($data['body_err']) ? $data['body_err'] : ''; ?></span>
  </div>
  <div class="form-group"> 
    <input type="checkbox" id="status" name="status" checked="<?php print $task->status == 1 ? 'checked' : '';?>">
    <label for="status">Выполнено</label>
  </div>
  <input name="id" type="hidden" value="<?php print $task->id;?>">
  <div class="form-actions form-wrapper">
    <button type="submit" class="btn btn-primary btn-lg pull-right">Сохранить задачу</button>
  </div>
</form>