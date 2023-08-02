<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoLocationService;

class GeoLocationController extends Controller
{
    protected $geoLocationService;

    public function __construct(GeoLocationService $geoLocationService)
    {
        $this->geoLocationService = $geoLocationService;

    }

    public function getIPDetails(Request $request)
    {
        // Retrieve IP addresses from JSON request
        $ips = $request->json('ips');

        // If 'ips' is not an array, return an error response
        if (!is_array($ips)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input, expected an array of IP addresses',
            ], 400);
        }

        // Initialize an empty results array
        $results = [];

        // Retrieve details for each IP address
        foreach ($ips as $ip) {
            $results[] = $this->geoLocationService->getDetails($ip);
        }

        // Return the results as a JSON response
        return response()->json($results);
    }
}
