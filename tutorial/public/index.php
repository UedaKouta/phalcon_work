<?php

try {

    // オートローダにディレクトリを登録する
    $loader = new Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    // DIコンテナを作る
    $di = new Phalcon\DI\FactoryDefault();

    // ビューのコンポーネントの組み立て
    $di->set('view', function () {
        $view = new Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // ベースURIを設定して、生成される全てのURIが「tutorial」を含むようにする
    $di->set('url', function () {
        $url = new Phalcon\Mvc\Url();
        $url->setBaseUri('/tutorial/');
        return $url;
    });

    // リクエストを処理する
    $application = new Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}