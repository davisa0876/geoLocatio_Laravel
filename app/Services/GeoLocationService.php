<?php

namespace App\Services;

use MaxMind\Db\Reader;

class GeoLocationService
{
    protected $reader;

    public function __construct()
    {
        $this->reader = new Reader(storage_path('app/GeoLite2-City.mmdb'));
    }

    public function getDetails($ip)
    {
        try {
            $ipDetails = $this->reader->get($ip);
            return [
                'success' => true,
                'ip' => $ip,
                'details' => $ipDetails,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
