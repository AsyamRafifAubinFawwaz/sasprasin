<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "--- COMPLAINTS BY STUDENT ---\n";
$counts = DB::table('complaints')
    ->select('student_id', DB::raw('count(*) as total'))
    ->whereNull('deleted_at')
    ->groupBy('student_id')
    ->get();

foreach ($counts as $c) {
    $user = DB::table('users')->where('id', $c->student_id)->first();
    echo "Student ID: {$c->student_id} (".($user ? $user->name : 'UNKNOWN').") - Total Complaints: {$c->total}\n";
}

echo "\n--- SAMPLE DATA FOR STUDENT ID 3 ---\n";
$sample = DB::table('complaints')
    ->where('student_id', 3)
    ->whereNull('deleted_at')
    ->limit(1)
    ->first();
if ($sample) {
    print_r($sample);
    $cat = DB::table('facility_categories')->where('id', $sample->facility_category_id)->first();
    $loc = DB::table('locations')->where('id', $sample->location_id)->first();
    echo 'Category: '.($cat ? $cat->name : 'NULL')."\n";
    echo 'Location: '.($loc ? $loc->name : 'NULL')."\n";
} else {
    echo "No non-deleted complaints for student 3\n";
}
