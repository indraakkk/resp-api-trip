<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTrait;
use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;
use App\Http\Requests\TripUpdateRequest;
use App\Models\Trip;
use App\Models\User;
use App\Models\Typeoftrip;
use DateTime;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use stdClass;

/**
 * @OA\PathItem(path="/api")
 */
class TripController extends Controller
{
    use ResponseJsonTrait;

    public function index()
    {
        $trips = Trip::latest()->with(['type'])->get();
        return $this->success($trips);
    }

    public function create(TripRequest $request)
    {
        $validated = $request->all();
        $validated['duration'] = $this->duration($validated['start'], $validated['end']);

        $trip = Trip::create($validated);
        $data = Trip::find($trip->id)->with(['user', 'type'])->first();

        return $this->success($data);
    }

    public function update(TripUpdateRequest $request)
    {
        $validated = $request->all();
        $trip = Trip::find($validated['id']);

        if (isset($validated['start']) && isset($validated['end'])) {
            $validated['duration'] = $this->duration($validated['start'], $validated['end']);
        }
        $trip->update($validated);
        $trip->save();
        $data = Trip::find($trip->id)->with(['user', 'type'])->first();

        return $this->success($data);
    }

    public function delete($id)
    {
        Trip::find($id)->delete();
        return $this->success(['message'=>"deleted successfully"]);
    }

    public function duration($start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $diff = $end->diff($start);
        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);
        $days = $diff->d;
        $duration = "$hours hour(s)";
        if($hours >= 24){
            $duration = "$days day(s)";
        }
        return $duration;
    }
    public function type()
    {
        $types = Typeoftrip::latest()->get();
        return $this->success($types);
    }
}
