 <?php
use app\system\App;
$limit = 3;
$page = $page ?? 1;
$directionContent = [
    'asc' => ' &uarr; ',
    'desc' => ' &darr; '
];
$isAdmin = App::isAdminLogin();
?>
<div class="task-table-container">
    <div class="task-table__info bg-success text-light text-center"></div>
    <div class="task-table__error bg-danger text-light text-center"></div>
    <table class="task-table table" data-page="<?= $page ?>" data-sort="<?= $sort ?>" data-direction="<?= $direction ?>">
        <tr>
            <?php
            foreach (['id' => '#', 'name' => 'Имя пользователя', 'email' => 'E-mail', 'text' => 'Текст задачи', 'status' => 'Статус', 'admin_edited' => 'Отредактировано администратором'] as $key => $col) {
                if ($sort) {
                    $directionHTML = $direction == 'asc' ? $directionContent['asc'] : $directionContent['desc'];
                    $sortContent = ($key == $sort ? $directionHTML : '');
                    $toggleDirection = $direction == 'asc' ? 'desc' : 'asc';
                }
                echo "<th><a href='#' onclick='taskTable.displayTaskTableAjax(\"$page\", \"$key\", \"$toggleDirection\")'>$col $sortContent</a></th>";
            }
            ?>
        </tr>
        <?php
        foreach ($tasks as $row) {
            $status = [];
            $status[$row['status']] = 'selected';
            $tdParams = (App::isAdminLogin() ? 'contenteditable="true"' : '') . ' onfocus="taskTable.startEdit(this)" onblur="taskTable.cellLeaveEdit(this)" data-id="' . $row['id'] . '"';
            echo '<tr>',
                    "<td>{$row['id']}</td>",
                    "<td $tdParams data-attr=\"name\">{$row['name']}</td>",
                    "<td $tdParams data-attr=\"email\">{$row['email']}</td>",
                    "<td $tdParams data-attr=\"text\">{$row['text']}</td>",
                    '<td>
                        <select ' . $tdParams . '" data-attr="status"' , ($isAdmin ? '' : 'disabled') , '>
                            <option value="1"' , ($status[1] ?? '' ) , '>Выполнен</option>                        
                            <option value="0" ' , ($status[0] ?? '' ) , '>Открыт</option>
                        </select>
                    </td>',
                    '<td data-attr="admin_edited" data-id="' . $row['id'] . '">' . ($row['admin_edited'] > 0 ? 'Да' : 'Нет') , '</td>',
            '</tr>';
        }
        ?>
    </table>
</div>
<div class="text-center">
    <?php
    if ($totalRows > $limit) {
        for ($i = 1; $i <= ceil($totalRows / $limit); $i++) {
            if ($i != $page) {
                echo '<a class="btn btn-default" onclick="taskTable.displayTaskTableAjax(' . ($i) . ')">' . $i . '</a>';
            } else {
                echo '<a class="btn btn-primary">' . $i . '</a>';
            }
        }
    }
?>
</div>