<?php

namespace App\Http\Controllers\Api\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\Attendance\CreateAttendanceRequest;
use App\Http\Requests\Attendance\UpdateAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Services\Base\AttendanceService;
use Exception;

use function Symfony\Component\Clock\now;

class AttendanceController extends Controller
{
    /**
     * Display a listing of attendances.
     */
    public function index(
        ApiRequest $request,
        AttendanceService $service
    ) {
        $data = $service->index($request);

        return api(
            'Attendances are fetched successfully',
            $data
        );
    }

    /**
     * Store a newly attendance.
     */
    public function store(
        CreateAttendanceRequest $request,
        AttendanceService $service
    ) {
        try {
            $validated = $request->validated();
            $data = $service->store($validated);

            return api(
                'Attendance created successfully',
                new AttendanceResource($data),
                201
            );
        } catch (Exception $e) {
            report($e);

            return error('Error while saving attendance');
        }
    }

    /**
     * Display the specified attendance.
     */
    public function show(Attendance $attendance)
    {
        return api(
            'Attendance received successfully',
            new AttendanceResource($attendance)
        );
    }

    /**
     * Update the specified attendance.
     */
    public function update(
        UpdateAttendanceRequest $request, 
        Attendance $attendance,
        AttendanceService $service
    )
    {
        try {
            $validated = ['check_out' => now()];
            $data = $service->update($validated, $attendance);

            return api(
                'Attendance updated successfully',
                new AttendanceResource($data),
                200
            );
        } catch (Exception $e) {
            report($e);

            return error('Error while saving attendance');
        }
    }

    /**
     * Remove the specified attendance.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
