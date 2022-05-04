<?php

namespace App\Repositories;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use App\Utils\Country;
use Exception;
use Illuminate\Support\Facades\Log;

class StudentRepository implements StudentRepositoryInterface
{
    /**
     * create student
     *
     * @param array $details
     * @return void
     */
    public function createStudent(array $details)
    {
        $details['country'] = $this->getCountryName($details['country_code']);
        Student::create($details);
    }

    protected function getCountryName($code)
    {
        try {
            $country  = new Country();
            $response = $country->FetchCountryByCode($code);
            return $response->name->common;
        } catch (Exception $ex) {
            Log::info(json_encode($ex->getMessage()));
        }
        return $code;
    }

}
