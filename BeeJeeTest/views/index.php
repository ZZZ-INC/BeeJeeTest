 <?php
use app\system\App;
use app\system\View;
?>
<div class="container-fluid text-center mt-5">
    <h1>Задачи</h1>
    <div class="row text-left">
        <div class="col-sm-12">
            <?php View::render('widgets/taskTable', [
                'tasks' => $tasks,
                'totalRows' => $totalRows,
                'sort' => $sort,
                'direction' => $direction
            ]) ?>
        </div>
    </div>
    <hr />
    <div>
        <h2>Создать новую задачу</h2>
        <div class="col-sm-12 mb-1">
            <div class="create-task-form__info bg-success text-light"></div>
            <div class="create-task-form__error bg-danger text-light"></div>
        </div>
        <form class="create-task-form" class="text-left" method="post">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Имя пользователя</label><input name="name" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>E-mail</label><input name="email" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Текст задачи</label><textarea name="text" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-3 mt-3">
                    <button class="btn btn-default" class="form-control" onclick="taskActions.createTask()">Создать задачу</button>
                </div>
            </div>
        </form>
    </div>
</div>