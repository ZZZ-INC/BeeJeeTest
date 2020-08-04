 <?php
namespace system;
spl_autoload_register(function ($className) {
    $alias = 'app\\';
    $length = strlen($alias);
    if (strncmp($alias, $className, $length) !== 0) {
        return;
    }
    $cleanClassName = substr($className, $length);
    $file = str_replace('\\', '/', $cleanClassName) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
function dbConnect() {
    return mysqli_connect('localhost', 'zzzinc', 'Zzz159753', 'zzz_inc');
}