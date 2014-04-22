<?php
require_once __DIR__ . "/vendor/autoload.php";

use Builder\Element\Base\Form;
use Builder\Element\Base\Input\Text;
use Builder\Element\Base\Input\Password;
use Builder\Element\Base\Label;
use Builder\Element\Base\Literal;
use Builder\Element\Base\Button\Submit;

use Builder\Element\Composite\InputField;

use Builder\Element\Proxy\Tooltip;
use Builder\Element\Proxy\Example;

use Builder\Theme\Decorator\BootstrapThree;

$form = new Form;

$password = new InputField('Password Label', 'password-field', new Password);
$password->getHelpText()->nest(new Literal('Some help text'));
$password = new Tooltip($password);
$password->setTooltipText('Easy wrapped.');

$submit = new Submit('Submit Form');
$tooltip = new Tooltip(new Example($submit));
$tooltip->setTooltipText('Tooltip text that wraps an object.');

$form->nest(new InputField('Label', 'field', new Text));
$form->nest($password);
$form->nest($tooltip);

echo '<html><head>';
echo '<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">';
echo '<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>';
echo '<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>';
echo '</head><body><div style="width: 500px; margin: 0px auto;">';

// Render normal
echo($form->render());
echo "<br/><br/><br/>";

// Decorate and render themed
$decorator = new BootstrapThree();
echo($decorator->decorate($form));

echo '</div>';
echo '<script>$("*[data-toggle=\'tooltip\']").tooltip();</script>';
echo '</body></html>';