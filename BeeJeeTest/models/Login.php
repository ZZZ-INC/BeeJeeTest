 <?php
namespace app\models;
use app\system\App;
use app\system\Model;
class Login extends Model {
    public function tableName() {
        return 'user';
    }
    public function validate($data) {
        $this->errors = null;
        if (!strlen($data['name'])) {
            $this->errors[] = 'Поле "Логин" не может быть пустым!';
        }
        if (!strlen($data['password'])) {
            $this->errors[] = 'Поле "Пароль" не может быть пустым!';
        }
        if (!empty($this->errors)) {
            return;
        }
        if ($data['name'] != App::getConfig('adminLogin')) {
            $this->errors[] = 'Неправильный логин!';
        }
        if ($data['password'] != App::getConfig('adminPassword')) {
            $this->errors[] = 'Неправильный пароль!';
        }
        return !count($this->errors);
    }
}