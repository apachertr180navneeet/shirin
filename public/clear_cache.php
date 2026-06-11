<?php
// Clear mPDF ttfontdata
$dirs = [
    __DIR__ . '/../vendor/mpdf/mpdf/ttfontdata/',
    __DIR__ . '/../vendor/mpdf/mpdf/tmp/',
    __DIR__ . '/../storage/framework/cache/data/',
    __DIR__ . '/../storage/framework/views/',
];

foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        $files = glob($dir . '*');
        foreach ($files as $file) {
            if (is_file($file) || is_link($file)) {
                unlink($file);
            } elseif (is_dir($file)) {
                // Recursive delete for subdirectories
                $subFiles = glob($file . '/*');
                foreach ($subFiles as $subFile) {
                    if (is_file($subFile)) unlink($subFile);
                }
                @rmdir($file);
            }
        }
    }
}
echo "Cache cleared successfully. <b>DELETE THIS FILE NOW.</b>";