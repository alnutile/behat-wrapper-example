<div class="col-md-7 column">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Example of Raw Code Command
            </h3>
        </div>
        <div class="panel-body">
            <p>
                This is an example of just calling to the library and making a raw code command.
                Below is an example of the code.
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
//  the behat.yml file will define this but I want to point
//  out one file
$test_path = $base_path . '/vendor/alnutile/behat-wrapper/test/features/test.feature';
//6. set the Binary path
$wrapper->setBehatBinary($bin_path);
//7. set the Command instance
$command = \BehatWrapper\BehatCommand::getInstance()
    ->setOption('tags', '~@example')
    ->setFlag('no-path')
    ->setTestPath($test_path);
//7. Run the raw command and get the output.
$command = $wrapper->wrapper->run($command);
</pre>

<h4>Notes</h4>
<ul>
    <li>setFlag no-path you no longer, like Example 1, see the related step definition to the right of the test step</li>
</ul>
        </div>
    </div>
</div>
