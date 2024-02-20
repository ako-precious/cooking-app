<?php

namespace Database\Factories;

use App\Models\Cook;
use App\Models\User;
use App\Models\Meal;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MealSchedule>
 */
class MealScheduleFactory extends Factory
{
    protected $model = \App\Models\MealSchedule::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mealIds = Meal::pluck('id')->all();
        $meal_time = ['Breakfast', 'Lunch', 'Dinner',];
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Calculate the number of days in the current month
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        // Create an empty array to store the dates
        $datesThisMonth = [];

        // Loop through each day of the month and add it to the array
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $currentYear . '-' . $currentMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT); // Format as YYYY-MM-DD
            $datesThisMonth[] = $date;
        }
        $startDate = $this->faker->randomElement($datesThisMonth);

        // Generate end_date randomly, ensuring it's after start_date
        do {
            $endDate = $this->faker->randomElement($datesThisMonth);
        } while ($endDate <= $startDate);  // Keep generating until end_date is after start_date

        $userIds = User::pluck('id')->all();
        $status = ['pending', 'reject', 'accept', 'processed', 'ready', 'in transit', 'delivered', 'confirmed'];
        
        return [
            'meal_id' => $this->faker->randomElement($mealIds),
            'user_id' => $this->faker->randomElement($userIds),
            'meal_time' => $this->faker->randomElement($meal_time),
            'start_date' => $startDate,
            'end_date' => $startDate,
            'status' => $status,

        ];
    }
}
