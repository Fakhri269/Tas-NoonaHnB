import re

with open(r'c:\laragon\www\ujilvl18\resources\views\orders\show.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

replacements = [
    (r'glass-effect border border-green-400 text-green-700', r'alert-success border border-green-500'),
    (r'glass-effect rounded-2xl shadow-xl p-6 border border-orange-100', r'card-dark p-6'),
    (r'border-b border-orange-100', r'border-b border-gray-800'),
    (r'bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-xl border border-orange-200', r'bg-[#1e2d3d] p-4 rounded-xl border border-gray-700'),
    (r'text-gray-800', r'text-white'),
    (r'text-gray-600', r'text-gray-400'),
    (r'text-orange-600', r'text-gray-400'),
    (r'bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-300', r'bg-[rgba(234,179,8,0.1)] border border-[rgba(234,179,8,0.3)]'),
    (r'text-yellow-800', r'text-yellow-400'),
    (r'text-yellow-700', r'text-yellow-200'),
    (r'bg-white p-6 rounded-2xl border-2 border-orange-200', r'bg-[#1e2d3d] p-6 rounded-2xl border border-gray-700'),
    (r'bg-gray-50 p-2 rounded-2xl inline-block border-\[3px\] border-orange-400', r'bg-white p-2 rounded-2xl inline-block border-2 border-orange-500'),
    (r'border-t border-gray-100', r'border-t border-gray-700'),
    (r'text-gray-700', r'text-gray-300'),
    (r'border-t border-orange-200', r'border-t border-gray-800'),
    (r'bg-white opacity-5 rounded-full', r'bg-orange-500 opacity-5 rounded-full')
]

for old, new in replacements:
    content = re.sub(old, new, content)

with open(r'c:\laragon\www\ujilvl18\resources\views\orders\show.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Replaced theme classes.")
