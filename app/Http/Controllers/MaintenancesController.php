<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * @group Maintenance management
 *
 * APIs for managing maintenances
 */

class MaintenancesController extends Controller
{
    public function index()
    {
        return Maintenance::whereHas('users', fn($builder) => $builder->where(['user_id' => Auth::id()]))->paginate(Controller::PAGINATE_SIZE);
    }

    public function show(string $id)
    {
        $device = Maintenance::findOrFail($id);
        Gate::authorize('manage-maintenances',$device);
        return $device;
    }

    public function create(\Illuminate\Http\Request $request)
    {
        if (Maintenance::updateOrCreate($this->validateRequest($request)))
            return response('Save Successfully', 201);

        return response('Not saved', 422);
    }

    public function update(Request $request, string $id)
    {
        $device = Device::findOrFail($id);
        Gate::authorize('manage-maintenances',$device);

        $request->request->add(['id' => $id]);

        $device->update($this->validateRequest($request));
        return response('Updated Successfully', 200);
    }

    public function destroy(string $id)
    {
        $device = Device::findOrFail($id);
        Gate::authorize('manage-maintenances',$device);


        if ($device->delete())
            return response(['message' => 'Deleted Successfully'], 200);
    }

    private function validateRequest(Request $request)
    {
        return $this->validate($request, []);
    }


}
