<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class DiscountService
{
    public static function getSettings(): array
    {
        $defaults = [
            'enabled' => false,
            'threshold' => 200000,
            'percentage' => 10,
            'label' => 'Diskon Event',
        ];

        if (!Storage::disk('local')->exists('settings/discount.json')) {
            return $defaults;
        }

        try {
            $content = Storage::disk('local')->get('settings/discount.json');
            $data = json_decode($content, true);
            if (!is_array($data)) {
                return $defaults;
            }

            return array_merge($defaults, [
                'enabled' => isset($data['enabled']) ? (bool) $data['enabled'] : false,
                'threshold' => isset($data['threshold']) ? floatval($data['threshold']) : 200000,
                'percentage' => isset($data['percentage']) ? floatval($data['percentage']) : 10,
                'label' => isset($data['label']) ? trim($data['label']) : 'Diskon Event',
            ]);
        } catch (\Throwable $e) {
            return $defaults;
        }
    }

    public static function saveSettings(array $data): bool
    {
        $settings = [
            'enabled' => isset($data['enabled']) && $data['enabled'],
            'threshold' => max(0, floatval($data['threshold'] ?? 0)),
            'percentage' => max(0, floatval($data['percentage'] ?? 0)),
            'label' => trim($data['label'] ?? 'Diskon Event'),
        ];

        return Storage::disk('local')->put('settings/discount.json', json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public static function calculateDiscount(float $subtotal): float
    {
        $settings = self::getSettings();

        if (!$settings['enabled']) {
            return 0;
        }

        if ($settings['threshold'] <= 0 || $subtotal < $settings['threshold']) {
            return 0;
        }

        if ($settings['percentage'] <= 0) {
            return 0;
        }

        return round($subtotal * ($settings['percentage'] / 100), 2);
    }
}
