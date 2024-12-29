<?php require('partials/head.php') ?>

<div class="container-fluid">
        <div class="clearfix mt-3">
            <a href="/upload-form" class="btn btn-primary btn-lg float-end" role="button" aria-disabled="true">Загрузить CSV файл</a>
        </div>
        <div class="mt-3">
            <h1 class="text-center my-4">Список товаров</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Код</th>
                        <th>Наимеование</th>
                        <th>Уровень1</th>
                        <th>Уровень2</th>
                        <th>Уровень3</th>
                        <th>Цена</th>
                        <th>ЦенаСП</th>
                        <th>Количество</th>
                        <th>Поля свойств</th>
                        <th>Совместные покупки</th>
                        <th>Единица измерения</th>
                        <th>Картинка</th>
                        <th>Выводить на главной</th>
                        <th>Описание</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($products): ?>
                    <?php foreach($products as $product): ?>
                        <tr>
                            <td><?= $product->id ?></td>
                            <td><?= $product->code ?></td>
                            <td><?= $product->name ?></td>
                            <td><?= $product->level_1 ?></td>
                            <td><?= $product->level_2 ?></td>
                            <td><?= $product->level_3 ?></td>
                            <td><?= $product->price ?></td>
                            <td><?= $product->price_sp ?></td>
                            <td><?= $product->quantity ?></td>
                            <td><?= $product->properties ?></td>
                            <td><?= $product->joint_purchases ?></td>
                            <td><?= $product->units ?></td>
                            <td><?= $product->image ?></td>
                            <td><?= $product->show_on_homepage ? 'Да' : 'Нет' ?></td>
                            <td><?= $product->description ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="15" class="text-center">
                            Товары отсутствуют
                        </td>
                    </tr>
                <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require('partials/footer.php') ?>