<div class="col-md-7 column">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Example using the Symfony Event hook included in the wrapper
            </h3>
        </div>
        <div class="panel-body">
            <p>
                We will show a hook of the command both pre and post run.
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
//  The behat.yml file will define this but I want to point
//  out one file
$test_path = $base_path . '/vendor/alnutile/behat-wrapper/test/features/test.feature';
//6. Set the Binary path
$wrapper->setBehatBinary($bin_path);
//7. Run the raw command and get the output.
$command = $wrapper->wrapper->behat($wrapper->test_path,  base_path());
</pre>

<h4>Notes</h4>
<ul>
    <li>[1] behat does not need to be installed on the server the composer command will set it up for you in the vendor folder</li>
</ul>

        </div>

    </div>

</div>
