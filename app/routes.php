<?php

class BehatSetup
{
    public $behat_yml;
    public $test_path;
    public $wrapper;
    public $bin_path;

    public function __construct()
    {
        $this->wrapper = new \BehatWrapper\BehatWrapper();
        $base_path = base_path();
        $this->bin_path = $base_path . '/vendor/bin/';
        $this->behat_yml = $base_path . '/behat.yml';
        $this->test_path = $base_path . '/vendor/alnutile/behat-wrapper/test/features/test.feature';
    }
}


Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/example_raw', function(){
    //1. set the binary path
    //2. set working path to root of project since behat.yml is there
    //3. test is the path to the file but yml would work alone
    $base = new BehatSetup();
    $base->wrapper->setBehatBinary($base->bin_path);
    $command = $base->wrapper->behat($base->test_path,  base_path());
    return \Illuminate\Support\Facades\Response::json($command);
});

Route::get('/example_command', function(){
    $setup = new BehatSetup();
    $setup->wrapper->setBehatBinary($setup->bin_path);
    $command = \BehatWrapper\BehatCommand::getInstance()
        ->setOption('tags', '~@example')
        ->setFlag('no-paths')
        ->setTestPath($setup->test_path);

    return \Illuminate\Support\Facades\Response::json($setup->wrapper->run($command));
});

Route::get('/example_hooked', function(){
    $setup = new BehatSetup();
    $setup->wrapper->setBehatBinary($setup->bin_path);
    $command = \BehatWrapper\BehatCommand::getInstance()
        ->setOption('tags', '~@example')
        ->setFlag('no-paths')
        ->setTestPath($setup->test_path);


    $subscriber = new \Acme\Event\AcmeListener();
    $dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
    $dispatcher->addSubscriber($subscriber);

    return \Illuminate\Support\Facades\Response::json($setup->wrapper->run($command));
});