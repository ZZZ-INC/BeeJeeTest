 <?php
namespace app\models;
use app\system\App;
use app\system\Model;
class Task extends Model {
    public function tableName() {
        return 'task';
    }
    public function validate($data) {
        $this->errors = null;
        if (!strlen($data['name'])) {
            $this->errors[] = 'Поле "Имя пользователя" не может быть пустым!';
        }
        if (!strlen($data['email'])) {
            $this->errors[] = 'Поле "E-mail" не может быть пустым!';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Неправильный формат E-mail!';
        }
        if (!strlen($data['text'])) {
            $this->errors[] = 'Поле "Текст задания" не может быть пустым!';
        }
        if (isset($data['edit']) && !strlen($data['status'])) {
            $this->errors[] = 'Поле "Статус" не может быть пустым!';
        }
        return !count($this->errors);
    }
}