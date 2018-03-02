<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 14:40
 */

//test CI
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Config\Adapter\Ini as ConfigIni;

try {
    $config = new ConfigIni('../app/config/config.ini');
    $loader = new Loader();

    $loader->registerDirs(array(
        $config->phalcon->controllersDir,
        $config->phalcon->servicesDir,
        $config->phalcon->modelsDir,
        $config->phalcon->viewsDir
    ))->register();

    $di = new FactoryDefault();

    $di->setShared('config', $config);

    $di->set('db', function ($config) {
        return new DbAdapter(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname
        ));
    });

    //Меняем роутер так чтобы он принимал параметр на индексный метод
    $di->set('router', function(){
        $router = new \Phalcon\Mvc\Router();
        $router->add(
            '/{controller}/{id:\d+}',
            array(
                "action" => "index",
            )
        );

        return $router;
    });

    $di->set('request', new \Phalcon\Http\Request());

    $di->set('view', function () {
        $config = $this->getConfig();

        $view = new View();
        $view->setViewsDir($config->phalcon->viewsDir);
        return $view;
    });

    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}