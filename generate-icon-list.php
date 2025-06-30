<?php

// Adjust the path if your icons.json is inside metadata/
$sourceFile = __DIR__ . '/metadata/icons.json';
$outputFile = __DIR__ . '/icon-list.json';

if (!file_exists($sourceFile)) {
    exit("❌ 'metadata/icons.json' not found.\n");
}

$icons = json_decode(file_get_contents($sourceFile), true);
$output = [];

foreach ($icons as $iconName => $data) {
    foreach ($data['styles'] as $style) {
        $prefix = match($style) {
            'solid' => 'fas',
            'regular' => 'far',
            'brands' => 'fab',
            default => 'fa-' . $style,
        };

        $output[] = [
            'class' => "$prefix fa-$iconName",
            'label' => ucwords(str_replace('-', ' ', $iconName)),
            'keywords' => $data['search']['terms'] ?? [],
        ];
    }
}

// Create output folder if not exists
@mkdir(dirname($outputFile), 0755, true);

file_put_contents($outputFile, json_encode($output, JSON_PRETTY_PRINT));
echo "✅ full_icon_list.json created with " . count($output) . " icons.\n";
