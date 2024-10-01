<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PhpOption\None;
use PhpParser\Node\Expr\Throw_;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

class MainController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    /**
     * Generate exercises
     */
    public function generate(Request $request): View|RedirectResponse
    {
        // The field under validation must be present and not empty only when any of the other specified fields are empty or not present
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_sum,check_subtraction,check_division',
            'check_division' => 'required_without_all:check_sum,check_subtraction,check_multiplication',
            'number_one' => 'required|min:0|max:999|integer',
            'number_two' => 'required|min:0|max:999|integer|gt:number_one',
            'number_exercises' => 'required|integer|min:5|max:50'
        ]);

        $number_exercises = $request->number_exercises;
        $min = $request->number_one;
        $max = $request->number_two;

        // Store all the operations desired by the user
        $operations = [];
        $exercises = [];

        // If it exists in the requests then store it
        if ($request->input('check_sum')) { $operations[] = '+'; }
        if ($request->input('check_subtraction')) { $operations[] = '-'; }
        if ($request->input('check_multiplication')) { $operations[] = '*'; }
        if ($request->input('check_division')) { $operations[] = '/'; }

        // Generate the random operations and random numbers
        for ($index = 1; $index <= $number_exercises; $index++) {
            $exercises[] = $this->generateExercise($min, $max, $operations, $index);
        }

        // Set the exercises in the session
        session(['exercises' => $exercises]);

        return view('operations', [ 'exercises' => $exercises ]);
    }

    /**
     * Print exercises in browser
     */
    public function print()
    {

        if (!session()->has('exercises')) {
            return redirect()->route('home');
        }

        $exercises = session('exercises'); 

        echo '<h2> Exercises </h2>';
        echo '<pre>';
            foreach ($exercises as $exercise) {
                echo '<p>';
                echo $exercise['equation'];
                echo '</p>';
            }
        echo '</pre>';

        echo '<hr>';

        echo '<h2> Solution </h2>';
        echo '<pre>';
            foreach ($exercises as $exercise) {
                echo '<p>';
                echo $exercise['equation'] . $exercise['solution'];
                echo '</p>';
            }
        echo '</pre>';

        echo '<a href="/">Voltar</a>';
    }

    /**
     * Generate a random exercise 
     */
    private function generateExercise($min, $max, $operations, $index): array|RedirectResponse
    {
        $term_a = rand($min, $max);
        $term_b = rand($min, $max);
        $operation = $operations[array_rand($operations)];

        $equation = "$term_a $operation $term_b = ";
        $solution = 0;

        switch ($operation) {
            case '+':
                $solution = $term_a + $term_b;
                break;
            case '-':
                $solution = $term_a - $term_b;
                break;
            case '*':
                $solution = $term_a * $term_b;
                break;
            case '/':
                // Set term_b to 1 to avoid division by zero
                if ($term_b === 0) { $term_b = 1; }
                $solution = $term_a / $term_b;
                break;
            default:
                return redirect()->route('home');
                break;
        }
        
        // Round to 2 decimal places             
        $solution = round($solution, 2);

        return [
            'exercise_number' => str_pad($index, 2, '0', STR_PAD_LEFT),
            'equation' => $equation,
            'solution' => $solution
        ];
    }
}
