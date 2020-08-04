 <?php
namespace app\system;
class Controller extends TaskObject {
    public function run($action) {
        $content = $this->{'action' . $action}();
        return $content;
    }
    protected function render($viewName, $params = []) {
        View::render($viewName, $params);
    }
    public function error404() {
        header("HTTP/1.0 404 Not Found");
    }
}