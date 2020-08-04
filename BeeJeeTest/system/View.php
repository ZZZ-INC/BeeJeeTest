 <?php
namespace app\system;
class View extends TaskObject {
    public static function render($viewName, $params = []) {
        foreach ($params as $param => $value) {
            $$param = $value;
        }
        require("views/$viewName.php");
    }
}