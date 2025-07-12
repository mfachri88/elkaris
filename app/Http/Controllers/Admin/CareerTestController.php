<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerTestResult;
use Illuminate\Support\Facades\DB;

class CareerTestController extends Controller
{
    public function index()
    {
        $results = CareerTestResult::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('pages.admin.career-test.index', compact('results'));
    }
    
    public function show($id)
    {
        $result = CareerTestResult::with('user')->findOrFail($id);
        $careerDescriptions = $this->getCareerDescriptions();
        
        return view('pages.admin.career-test.show', compact('result', 'careerDescriptions'));
    }
    
    public function statistics()
    {
        $totalTests = CareerTestResult::count();
        
        // Get career distribution for all careers
        $careerDistribution = [
            'software_developer' => CareerTestResult::where('result', 'software_developer')->count(),
            'data_scientist' => CareerTestResult::where('result', 'data_scientist')->count(),
            'network_engineer' => CareerTestResult::where('result', 'network_engineer')->count(),
            'ui_ux_designer' => CareerTestResult::where('result', 'ui_ux_designer')->count(),
            'cybersecurity_analyst' => CareerTestResult::where('result', 'cybersecurity_analyst')->count()
        ];
        
        // Calculate percentages
        $distribution = [];
        foreach ($careerDistribution as $career => $count) {
            $distribution[$career] = [
                'count' => $count,
                'percentage' => $totalTests > 0 ? round(($count / $totalTests) * 100, 1) : 0
            ];
        }
        
        // Get average scores for each category
        $averageScores = [
            'software_developer' => CareerTestResult::avg('software_developer') ?? 0,
            'data_scientist' => CareerTestResult::avg('data_scientist') ?? 0,
            'network_engineer' => CareerTestResult::avg('network_engineer') ?? 0,
            'ui_ux_designer' => CareerTestResult::avg('ui_ux_designer') ?? 0,
            'cybersecurity_analyst' => CareerTestResult::avg('cybersecurity_analyst') ?? 0
           
        ];
        
        // Get monthly test counts
        $monthlyData = DB::table('career_test_results')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
            
        $monthlyTestData = [];
        foreach ($monthlyData as $data) {
            $monthName = date('M Y', mktime(0, 0, 0, $data->month, 1, $data->year));
            $monthlyTestData[$monthName] = $data->count;
        }
        
        $careerDescriptions = $this->getCareerDescriptions();
        
        return view('pages.admin.career-test.statistics', compact(
            'totalTests', 
            'distribution', 
            'averageScores', 
            'monthlyTestData',
            'careerDescriptions'
        ));
    }
    
    /**
     * Delete a career test result
     */
    public function destroy($id)
    {
        $result = CareerTestResult::findOrFail($id);
        $result->delete();
        
        return redirect()->route('admin.career-test.index')
            ->with('success', 'Hasil tes berhasil dihapus');
    }
    
    /**
     * Deskripsi karir untuk hasil tes
     */
    private function getCareerDescriptions()
    {
        return [
            'software_developer' => [
                'title' => 'Software Developer',
                'description' => 'Software Developer bertanggung jawab untuk merancang, mengembangkan, dan memelihara program komputer sesuai kebutuhan pengguna.',
                'color' => 'blue'
            ],
            'data_scientist' => [
                'title' => 'Data Scientist',
                'description' => 'Data Scientist menggunakan keahlian dalam statistik, matematika, dan pemrograman untuk menganalisis data dan menghasilkan insights untuk pengambilan keputusan.',
                'color' => 'purple'
            ],
            'network_engineer' => [
                'title' => 'Network Engineer',
                'description' => 'Network Engineer bertanggung jawab untuk merancang, mengimplementasikan, dan mengelola sistem jaringan komputer untuk memastikan konektivitas yang aman dan handal.',
                'color' => 'green'
            ],
            'ui_ux_designer' => [
                'title' => 'UI/UX Designer',
                'description' => 'UI/UX Designer merancang bagaimana pengguna berinteraksi dengan aplikasi, dengan mempertimbangkan aspek visual dan kegunaan.',
                'color' => 'pink'
            ],
            'cybersecurity_analyst' => [
                'title' => 'Cybersecurity Analyst',
                'description' => 'Cybersecurity Analyst bertanggung jawab untuk melindungi sistem dan jaringan dari ancaman digital dengan memantau, mendeteksi, dan merespons insiden keamanan.',
                'color' => 'red'
            ],
        ];
    }
}