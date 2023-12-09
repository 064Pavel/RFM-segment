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

        $reportId = $this->getReport($authToken);

        $segments = $this->runReport($authToken, $reportId);

        $totalClients = array_sum(array_column($segments, 'doc_count'));

        foreach ($segments as &$segment) {
            $segment['average_check'] = $segment['orders']['value'] > 0 ? round($segment['total']['value'] / $segment['orders']['value'], 2) : 0;
            $segment['percentage_of_total'] = $totalClients > 0 ? round(($segment['doc_count'] / $totalClients) * 100, 2) : 0;
        }
        
        return response()->json(['segments' => $segments]);
        
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
            logger()->error('Error getting report: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to get report.'], 500);
        }
        
    }

    private function runReport(string $authToken, string $reportId)
    {
        $url = 'https://app.magic-of-numbers.ru/api/report/' . $reportId .'/run';

        try{

            $res = Http::withHeaders(['Authorization' => 'Bearer ' . $authToken])->get($url);

            $res = $res->json();

            return $res['aggregations']['segments']['buckets'] ?? [];

        }catch(\Exception $e){
            logger()->error('Error running report: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to run report.'], 500);
        }
    }


}
