<form class="mt-2 mt-md-2" action="/task/create" method="post">
  <h3>Создать задачу</h3>
  <div class="form-item">
    <label>Имя исполнителя задачи</label>
    <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" required="required" value="<?php print !empty($data['name']) ? $data['name'] : '';?>">
    <span class="invalid-feedback"><?php echo !empty($data['name_err']) ? $data['name_err'] : ''; ?></span>
  </div>
  <div class="form-item">
    <label>Email исполнителя</label>
    <input type="text" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" required="required" value="<?php print !empty($data['email']) ? $data['email'] : '';?>">
    <span class="invalid-feedback"><?php echo !empty($data['email_err']) ? $data['email_err'] : ''; ?></span>
  </div>
  <div class="form-item">
    <label>Текст задачи</label>
    <textarea rows="5" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : '';?>" name="body" required="required">
      <?php print !empty($data['body']) ? $data['body'] : '';?>
    </textarea>
    <span class="invalid-feedback"><?php echo !empty($data['body_err']) ? $data['body_err'] : ''; ?></span>
  </div>
  <div class="form-actions form-wrapper">
    <button type="submit" class="btn btn-primary btn-lg pull-right">Добавить задачу</button>
  </div>
</form>