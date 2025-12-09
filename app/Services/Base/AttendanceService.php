<?php

namespace App\Services\Base;

use App\Models\Attendance;
use App\Services\ApiService;
use Illuminate\Http\Request;
use App\Enums\AttendanceStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceService extends ApiService
{
    protected string $model = Attendance::class;

    public function index(Request $request): array|Collection|LengthAwarePaginator
    {
        $query = Auth::user()?->attendances()?->getQuery();

        if (is_null($query)) {
            return [];
        }

        return $this->makeApiResponse($query, $request);
    }

    public function store(array $data): Model
    {
        $user = Auth::user();
        $data = array_merge($data, [
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'check_in' => now(),
            'status' => AttendanceStatusEnum::PRESENT,
        ]);

        return $this->model::create($data);
    }
}
