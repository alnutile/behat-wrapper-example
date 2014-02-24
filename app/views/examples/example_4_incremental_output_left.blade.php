<div class="col-md-7 column">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Example using the Symfony Process incremental output
            </h3>
        </div>
        <div class="panel-body">
            <p>
                With the Symfony Process component we can output incremental results from our test.
                This is key on long tests so the user, just like the command line, can see progress.
            </p>
<pre class="prettyprint linenums">
//1. instantiate the wrapper class
$wrapper = new \BehatWrapper\BehatWrapper();
//2. get the base_path of your app [1]
$base_path = base_path();
//3. where is the vendor bin folder?
$bin_path = $base_path . '/vendor/bin/';
//4. where is the behat.yml file? You can see an example below
$behat_yml = $base_path . '/behat.yml';
//5. full path to the test file
//   the behat.yml file will
//   define this but I want to point
//   out one file
$test_path = $base_path . '/vendor/alnutile/behat-wrapper/test/features/test.feature';
//6. Set the Binary path
$wrapper->setBehatBinary($bin_path);
//7. build the command
$command = \BehatWrapper\BehatCommand::getInstance()
    ->setOption('tags', '~@example')
    ->setFlag('no-paths')
    ->setTestPath($setup->test_path);
//8. then register a subscriber to the event
//   ideally this would have automatically been setup as
//   BehatProcess::run is called.
$listener = new \Acme\Event\AcmeListener();
$setup->wrapper->getDispatcher()->addSubscriber($listener);
//9. run the wrapped command and get the output.
$command = $wrapper->wrapper->run($command);
</pre>
        </div>

    </div>

</div>
