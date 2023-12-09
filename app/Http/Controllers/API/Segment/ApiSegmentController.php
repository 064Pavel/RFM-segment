<?php

namespace App\Http\Controllers\API\Segment;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ApiSegmentController extends Controller
{
    const USERNAME = 'username';
    const PASSWORD = 'password';

    public function getData()
    {
        $authToken = $this->getAuthToken(self::USERNAME, self::PASSWORD);

        return $this->getReport($authToken);
        
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

    private function getReport(string $authToken): string | JsonResponse
    {
        $url = 'https://app.magic-of-numbers.ru/api/reports';

        try{

            $res = Http::withHeaders(['Authorization' => 'Bearer ' . $authToken])->get($url);

            $res = $res->json();

            foreach ($res['grouped']['General'] ?? [] as $report) {
                if ($report['name'] === 'get_segment_rfm') {
                    return $report['id'];
                }
            }

            return null;

        } catch(\Exception $e){
            logger()->error('Error getting get report: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to get report.'], 500);
        }
        
    }


}
