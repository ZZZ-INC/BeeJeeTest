 <?php
namespace app\Controllers;
use app\models\Login;
class AdminController extends \app\system\Controller {
    public function actionLogin() {
        $model = new Login();
        if (!$model->validate($_POST)) {
            $this->error404();
            echo json_encode($model->getErrors());
            return;
        }
        $_SESSION['is_admin_logged'] = 1;
    }
    public function actionLogout() {
        unset($_SESSION['is_admin_logged']);
        session_destroy();
        header("Location: /");
    }
    public function actionIndex() {
        $this->render('admin', [
            'isLogged' => isset($_SESSION['is_admin_logged'])
        ]);
    }
}