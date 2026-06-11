<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = DB::select('SHOW TABLES');
$databaseName = DB::getDatabaseName();
$tablesKey = "Tables_in_" . $databaseName;

$counts = [];
foreach ($tables as $tableObj) {
    $tableName = $tableObj->$tablesKey;
    try {
        $count = DB::table($tableName)->count();
        $counts[$tableName] = $count;
    } catch (\Exception $e) {
        $counts[$tableName] = 'ERROR: ' . $e->getMessage();
    }
}

asort($counts);
foreach ($counts as $table => $count) {
    echo "$table: $count\n";
}
