<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send SMS via Zend SMS API.
     *
     * @param  string  $phone    Recipient phone number (e.g., 01712345678 or +8801712345678)
     * @param  string  $message  SMS message text
     * @return array             ['success' => bool, 'response' => array|null, 'error' => string|null]
     */
    public function send(string $phone, string $message): array
    {
        // --- Normalize phone number (remove +, spaces, dashes) ---
        $phone = $this->normalizePhone($phone);

        if (empty($phone)) {
            return [
                'success'  => false,
                'response' => null,
                'error'    => 'Invalid phone number',
            ];
        }

        if (empty(trim($message))) {
            return [
                'success'  => false,
                'response' => null,
                'error'    => 'Message cannot be empty',
            ];
        }

        // --- Build query parameters ---
        $params = [
            'api_key'   => config('services.zendsms.api_key'),
            'to'        => $phone,
            'sender_id' => config('services.zendsms.sender_id'),
            'message'   => $message,
        ];

        try {
            $response = Http::timeout(config('services.zendsms.timeout', 30))
                ->acceptJson()
                ->get(config('services.zendsms.api_url'), $params);

            $body = $response->json() ?? ['raw' => $response->body()];

            // --- Log for debugging ---
            Log::info('Zend SMS attempt', [
                'to'          => $phone,
                'status_code' => $response->status(),
                'response'    => $body,
            ]);

            if ($response->successful()) {
                return [
                    'success'  => true,
                    'response' => $body,
                    'error'    => null,
                ];
            }

            return [
                'success'  => false,
                'response' => $body,
                'error'    => $body['message'] ?? 'SMS API returned error',
            ];

        } catch (\Throwable $e) {
            Log::error('Zend SMS exception: ' . $e->getMessage(), [
                'to'    => $phone,
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success'  => false,
                'response' => null,
                'error'    => $e->getMessage(),
            ];
        }
    }

    /**
     * Normalize phone number to a clean format.
     *
     * Rules:
     *  - Remove +, spaces, dashes, parentheses
     *  - Convert +880XXXXXXXXXX → 880XXXXXXXXXX (keep country code, drop +)
     *  - Convert 01XXXXXXXXX → 880XXXXXXXXX (add country code)
     */
    private function normalizePhone(string $phone): string
    {
        // Remove all non-digit characters
        $phone = preg_replace('/\D/', '', $phone);

        if (empty($phone)) {
            return '';
        }

        // If starts with 880 already, keep as-is
        if (str_starts_with($phone, '880')) {
            return $phone;
        }

        // If starts with 0 (local BD format like 01712345678), add 88
        if (str_starts_with($phone, '0')) {
            return '88' . $phone;
        }

        // If starts with 1 (like 1712345678), add 880
        if (str_starts_with($phone, '1')) {
            return '880' . $phone;
        }

        // Fallback: return as-is
        return $phone;
    }
}