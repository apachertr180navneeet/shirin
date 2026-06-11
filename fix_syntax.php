<?php
$file = 'app\Http\Controllers\CheckoutController.php';
$content = file_get_contents($file);

// Fix the syntax error: replace '")' with '")'
$content = str_replace('flash(translate(\'Your order has been placed successfully. Please submit payment information from purchase history\'))->success()', 
                        'flash(translate(\'Your order has been placed successfully. Please submit payment information from purchase history\'))->success()', 
                        $content);

// Also fix similar issues in other flash calls
$content = str_replace('flash(translate(\'Order creation failed. Please try again.\'))->error()', 
                        'flash(translate(\'Order creation failed. Please try again.\'))->error()', 
                        $content);

$content = str_replace('flash(translate(\'Select Payment Option.\'))->warning()', 
                        'flash(translate(\'Select Payment Option.\'))->warning()', 
                        $content);

file_put_contents($file, $content);
echo "Fixed syntax errors\n";
