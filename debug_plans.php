<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Plan;

echo "All plans:\n";
$plans = Plan::notFree()->get();
foreach ($plans as $plan) {
    echo "ID: {$plan->id}, Name: {$plan->name}, Features: " . json_encode($plan->features) . "\n";
}

echo "\nSearching for specific plans:\n";

$basicPlan = $plans->firstWhere('name', 'Agent - Basic');
echo "Basic Plan: " . ($basicPlan ? "Found - ID: {$basicPlan->id}" : "NOT FOUND") . "\n";

$popularPlan = $plans->firstWhere('name', 'Agent - Pro');
echo "Popular Plan: " . ($popularPlan ? "Found - ID: {$popularPlan->id}" : "NOT FOUND") . "\n";

$companyPlan = $plans->firstWhere('name', 'Agency - Standard');
echo "Company Plan: " . ($companyPlan ? "Found - ID: {$companyPlan->id}" : "NOT FOUND") . "\n";

if ($basicPlan) {
    echo "\nBasic Plan Features: " . json_encode($basicPlan->features) . "\n";
    echo "Features type: " . gettype($basicPlan->features) . "\n";
    echo "Features is array: " . (is_array($basicPlan->features) ? 'YES' : 'NO') . "\n";

    // Test json_decode
    $decoded = json_decode($basicPlan->features);
    echo "json_decode result: " . json_encode($decoded) . "\n";
    echo "json_decode type: " . gettype($decoded) . "\n";
    echo "json_decode is array: " . (is_array($decoded) ? 'YES' : 'NO') . "\n";

    // Test what happens with null
    $nullDecoded = json_decode(null);
    echo "json_decode(null): " . json_encode($nullDecoded) . "\n";
    echo "json_decode(null) type: " . gettype($nullDecoded) . "\n";
}
