<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerTestQuestion;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\User\CareerTestController;

class ManageCareerTestController extends Controller
{
    /**
     * Display a listing of test questions.
     */
    public function index()
    {
        try {
            // Check if the table exists, if not create it
            if (!Schema::hasTable('career_test_questions')) {
                Schema::create('career_test_questions', function (Blueprint $table) {
                    $table->id();
                    $table->text('text');
                    $table->string('category');
                    $table->timestamps();
                });
            }
            
            $questions = CareerTestQuestion::orderBy('id')->paginate(15);
            $categories = $this->getCareerCategories();
            
            return view('pages.admin.career-test.manage', compact('questions', 'categories'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created question.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:500',
            'category' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            CareerTestQuestion::create([
                'text' => $request->text,
                'category' => $request->category,
            ]);

            return response()->json(['success' => 'Pertanyaan berhasil ditambahkan!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get a specific question.
     */
    public function getQuestion($id)
    {
        try {
            $question = CareerTestQuestion::findOrFail($id);
            return response()->json($question);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Pertanyaan tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified question.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:500',
            'category' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $question = CareerTestQuestion::findOrFail($id);
            $question->update([
                'text' => $request->text,
                'category' => $request->category,
            ]);

            return response()->json(['success' => 'Pertanyaan berhasil diperbarui!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified question.
     */
    public function destroy($id)
    {
        try {
            $question = CareerTestQuestion::findOrFail($id);
            $question->delete();
            
            return response()->json(['success' => 'Pertanyaan berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Seed the default questions.
     */
    public function seedDefaultQuestions()
    {
        try {
            // Check if the table exists, if not create it
            if (!Schema::hasTable('career_test_questions')) {
                Schema::create('career_test_questions', function (Blueprint $table) {
                    $table->id();
                    $table->text('text');
                    $table->string('category');
                    $table->timestamps();
                });
            }
            
            // Check if the database already has questions
            if (CareerTestQuestion::count() > 0) {
                return redirect()->route('admin.career-test.manage')->with('info', 'Database sudah memiliki pertanyaan.');
            }

            // Get default questions from CareerTestController
            $userCareerController = new CareerTestController();
            $defaultQuestions = $userCareerController->getCareerTestQuestions();

            foreach ($defaultQuestions as $question) {
                CareerTestQuestion::create([
                    'text' => $question['text'],
                    'category' => $question['category'],
                ]);
            }

            return redirect()->route('admin.career-test.manage')->with('success', 'Berhasil menambahkan pertanyaan default.');
        } catch (\Exception $e) {
            return redirect()->route('admin.career-test.manage')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get career categories.
     */
    private function getCareerCategories()
    {
        return [
            'software_developer' => 'Software Developer',
            'data_scientist' => 'Data Scientist',
            'network_engineer' => 'Network Engineer',
            'ui_ux_designer' => 'UI/UX Designer',
            'cybersecurity_analyst' => 'Cybersecurity Analyst',
            'it_consultant' => 'IT Consultant'
        ];
    }
}
