<?php

namespace App\Http\Controllers\API\Segment;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ApiSegmentController extends Controller
{
    const USERNAME = 'username';
    const PASSWORD = 'password';

    public function getData(): string
    {
        $authToken = $this->getAuthToken(self::USERNAME, self::PASSWORD);

        return $authToken;
        
    }

    private function getAuthToken(string $username, string $password): string | JsonResponse
    {
        $url = 'https://app.magic-of-numbers.ru/api/user/token';
    
        try {
            $res = Http::get($url, [
                'username' => $username,
                'password' => $password,
            ]);
    
            $res = $res->json();
    
            return $res['access_token'];
        } catch (\Exception $e) {
            logger()->error('Error getting authentication token: ' . $e->getMessage());
            
            return response()->json(['error' => 'Failed to retrieve authentication token.'], 500);
        }
    }


}
