<?php

class BehatSetup
{
    public $behat_yml;
    public $test_path;
    public $test_path_long;
    public $wrapper;
    public $bin_path;

    public function __construct()
    {
        $this->wrapper = new \BehatWrapper\BehatWrapper();
        $base_path = base_path();
        $this->bin_path = $base_path . '/vendor/bin/';
        $this->behat_yml = $base_path . '/behat.yml';
        $this->test_path = $base_path . '/vendor/alnutile/behat-wrapper/test/features/test.feature';
        $this->test_path_long = $base_path . '/vendor/alnutile/behat-wrapper/test/features/test_long.feature';
    }
}

class StreamSuppressFilter extends \php_user_filter {

    public function filter($in, $out, &$consumed, $closing)
    {
        while ($bucket = stream_bucket_make_writeable($in)) {
            echo $bucket->data;
            $bucket->data = '';
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }
        return PSFS_PASS_ON;
    }
}


Route::get('about', function()
{
    return View::make('about');
});


Route::get('contact', function()
{
    return View::make('contact');
});


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

    $listener = new \Acme\Event\AcmeListener();
    $setup->wrapper->getDispatcher()->addSubscriber($listener);

    $output = \Illuminate\Support\Facades\Response::json($setup->wrapper->run($command));
    return $output;
});

Route::get('/example_inc', function(){
    $base = base_path();
    $setup = new BehatSetup();
    $setup->wrapper->setBehatBinary($setup->bin_path);
    $command = \BehatWrapper\BehatCommand::getInstance()
        ->setOption('format', 'pretty')
        ->setFlag('no-paths')
        ->setTestPath($setup->test_path_long);
    $process = $setup->wrapper->start($command);
    while($process->isRunning()){
        $content = $setup->wrapper->getOutput($process);
        echo \Illuminate\Support\Facades\Response::json($content);
        $file = fopen($base . '/public/results.html', "w");
        ftruncate($file, 0);
        fwrite($file, $content);
        fclose($file);
    };
});