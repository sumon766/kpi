<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Employee;

class EvaluationController extends Controller
{
    //
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'question_id' => 'required|exists:questions,id',
            'mark' => 'required|integer|min:0|max:100'
        ]);

        $evaluation = Evaluation::create($validatedData);

        return response()->json($evaluation, 201);
    }

    public function leaderboard(Request $request)
    {
        $date = $request->input('date');

        if (!$date) {
            $latestEvaluation = Evaluation::latest('created_at')->first();
            if ($latestEvaluation) {
                $date = $latestEvaluation->created_at->toDateString();
            } else {
                return response()->json([]);
            }
        }

        $leaderboard = Employee::select('employees.id', 'employees.name')
            ->join('evaluations', 'employees.id', '=', 'evaluations.employee_id')
            ->whereDate('evaluations.created_at', $date)
            ->selectRaw('SUM(evaluations.mark) as total_marks')
            ->groupBy('employees.id', 'employees.name')
            ->orderByDesc('total_marks')
            ->get();

        return response()->json($leaderboard);
    }
}
