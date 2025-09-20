<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\PropertyAttribute;

$attrs = PropertyAttribute::all();
foreach ($attrs as $a) {
    $name = method_exists($a, 'getTranslation') ? $a->getTranslation('name', 'en') : (is_array($a->name) ? ($a->name['en'] ?? json_encode($a->name)) : $a->name);
    echo sprintf("%d | %s | %s\n", $a->id, $a->type, $name);
}
