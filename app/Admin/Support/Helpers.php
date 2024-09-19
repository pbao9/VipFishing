<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

if (! function_exists('generate_text_depth_tree')) {
    /**
     * Tạo text theo độ sâu.
     *
     * @param integer $depth
     */
    function generate_text_depth_tree($depth, $word = '-')
    {
        $text = '';
        if ($depth > 0) {
            for ($i = 0; $i < $depth; $i++) {
                $text .= $word;
            }
        }
        return $text;
    }
}

if (! function_exists('uniqid_real')) {
    function uniqid_real($lenght = 13)
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return Str::upper(substr(bin2hex($bytes), 0, $lenght));
    }
}

if (! function_exists('format_price')) {
    function format_price($price, $positionCurrent = 'left')
    {
        return $positionCurrent == 'left' ? config('custom.currency') . number_format($price) : number_format($price) . config('custom.currency');
    }
}
if (!function_exists('getBoundsByName')) {
    /**
     * Lấy khung giới hạn cho một địa điểm cụ thể bằng cách sử dụng Google Geocoding API.
     *
     * @param string $name Tên địa điểm cần truy vấn.
     * @return array|null Mảng khung giới hạn hoặc null nếu không tìm thấy.
     */
    function getBoundsByName(string $name): ?array
    {
        $apiKey = config('services.google_maps.api_key');
        $encodedName = urlencode($name);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedName}&key={$apiKey}";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['results']) && isset($data['results'][0]['geometry']['bounds'])) {
                return $data['results'][0]['geometry']['bounds'];
            } else {
                return null;
            }
        }

        return null;
    }
}
