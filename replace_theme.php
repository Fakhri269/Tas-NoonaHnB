<?php
$file = 'c:\laragon\www\ujilvl18\resources\views\orders\show.blade.php';
$content = file_get_contents($file);

$replacements = [
    '/glass-effect border border-green-400 text-green-700/' => 'alert-success border border-green-500',
    '/glass-effect rounded-2xl shadow-xl p-6 border border-orange-100/' => 'card-dark p-6',
    '/border-b border-orange-100/' => 'border-b border-gray-800',
    '/bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-xl border border-orange-200/' => 'bg-[#1e2d3d] p-4 rounded-xl border border-gray-700',
    '/bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-xl border border-orange-200/' => 'bg-[#1e2d3d] p-4 rounded-xl border border-gray-700',
    '/text-gray-800/' => 'text-white',
    '/text-gray-600/' => 'text-gray-400',
    '/text-orange-600/' => 'text-gray-400',
    '/bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-300/' => 'bg-[rgba(234,179,8,0.1)] border border-[rgba(234,179,8,0.3)]',
    '/text-yellow-800/' => 'text-yellow-400',
    '/text-yellow-700/' => 'text-yellow-200',
    '/bg-white p-6 rounded-2xl border-2 border-orange-200/' => 'bg-[#1e2d3d] p-6 rounded-2xl border border-gray-700',
    '/bg-gray-50 p-2 rounded-2xl inline-block border-\[3px\] border-orange-400/' => 'bg-white p-2 rounded-2xl inline-block border-2 border-orange-500',
    '/border-t border-gray-100/' => 'border-t border-gray-700',
    '/text-gray-700/' => 'text-gray-300',
    '/border-t border-orange-200/' => 'border-t border-gray-800',
    '/bg-white opacity-5 rounded-full/' => 'bg-orange-500 opacity-5 rounded-full',
    '/gradient-text/' => 'text-white' // since we are changing themes, maybe gradient text is still fine but let's see. It's defined as orange.
];

foreach ($replacements as $pattern => $replacement) {
    $content = preg_replace($pattern, $replacement, $content);
}

file_put_contents($file, $content);
echo "Replaced theme classes.\n";
