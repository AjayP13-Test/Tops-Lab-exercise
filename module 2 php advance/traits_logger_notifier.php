<?php
trait Logger {
    public function log($msg) {
        echo "Log: $msg<br>";
    }
}

trait Notifier {
    public function notify($msg) {
        echo "Notify: $msg<br>";
    }
}

class App {
    use Logger, Notifier;
}

$app = new App();
$app->log("This is a log message");
$app->notify("This is a notification");
?>
