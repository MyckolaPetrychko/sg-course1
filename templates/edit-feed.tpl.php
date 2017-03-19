<form method="post" action="/save_edit">
    <div>
      <?php
        echo '<input type="hidden" name="id" value =' . $item->getId() . ' />';
      ?>
    </div>
    <div>
        <label for="title">Назва новини: </label>
        <?php
          echo '<textarea name="title">' . $item->getTitle() . '</textarea>';
        ?>
    </div>
    <div>
        <label for="link">Посилання: </label>
        <?php
          echo '<textarea name="link">' . $item->getLink() . '</textarea>';
        ?>
    </div>
    <div>
        <label for="description">Опис новини: </label>
        <?php
          echo '<textarea name="description">' . $item->getDescription() . '</textarea>';
        ?>
    </div>
    <div>
        <label for="source">Джерело: </label>
        <?php
          echo '<textarea name="source">' . $item->getSource() . '</textarea>';
        ?>
    </div>
    <div>
        <input type="submit" value="Зберегти новину" />
    </div>
</form>
