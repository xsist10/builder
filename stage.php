<?php
require_once __DIR__ . "/vendor/autoload.php";

use Builder\Element\Base\Form;
use Builder\Element\Base\Input\Text;
use Builder\Element\Base\Input\File;
use Builder\Element\Base\Input\Password;
use Builder\Element\Base\Input\Checkbox;
use Builder\Element\Base\Label;
use Builder\Element\Base\Paragraph;
use Builder\Element\Base\Literal;
use Builder\Element\Base\Button\Submit;

use Builder\Element\Composite\InputField;

use Builder\Element\Proxy\Tooltip;
use Builder\Element\Proxy\Example;
use Builder\Element\Proxy\HelpText;
use Builder\Element\Proxy\Label as ProxyLabel;

use Builder\Theme\Decorator\ChainDecorator;
use Builder\Theme\Decorator\BootstrapThree\Base;
use Builder\Theme\Decorator\BootstrapThree\HorizontalForm;
use Builder\Theme\Decorator\ProxyDecorator;

$form = new Form;

// Password field
$password = new InputField('Password Label', 'password-field', new Password);
$password = new Tooltip($password);
$password->setTooltipText('Easy wrapped.');
$password = new HelpText($password);
//$password->setHelpText('Help password');

// Submit button
$submit = new Submit('Submit Form');
$tooltip = new Tooltip($submit);
$tooltip->setTooltipText('Tooltip text that wraps an object.');
$tooltip = new HelpText($tooltip);
$tooltip->setHelpText('help text block');

$test = new InputField('Some Label', 'field', new Text);
$test = new HelpText($test);
$test->setHelpText('help me use this field');
$test = new Tooltip($test);
$test->setTooltipText('testing tooltip');
$form->nest($test);

$checkbox = new InputField('Checkbox Label', 'check', new Checkbox);
//$form->nest($checkbox);


$file = new InputField('File Label', 'check', new file);
//$form->nest($file);

//$form->nest(new InputField('Label', 'field', new Text));
//$form->nest($password);
//$form->nest($tooltip);

echo '<html><head>';
echo '<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">';
echo '<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>';
echo '<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>';
echo '</head><body><div style="width: 900px; margin: 0px auto;">';

// Render normal
//echo($form->render());
echo "<br/><br/><br/>";

var_dump($form->dumpTree());
// Decorate and render themed
$decorator = new ChainDecorator();
$decorator->addDecorator(new Base());
$decorator->addDecorator(new HorizontalForm());
echo($decorator->decorate($form)->render());

var_dump($form->dumpTree());

echo '</div>';
echo '<script>$("*[data-toggle=\'tooltip\']").tooltip();</script>';
echo '</body></html>';