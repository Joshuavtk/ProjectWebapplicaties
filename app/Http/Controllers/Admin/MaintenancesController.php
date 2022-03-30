<?php

namespace App\Http\Controllers\Admin;

use App\Models\Device;

/**
 * @group Maintenance management
 *
 * APIs for managing maintenances
 */
class MaintenancesController extends Controller
{
    public function __construct()
    {
        \Illuminate\Support\Facades\Gate::authorize('admin');
    }

    ///Admin functions
    public function index()
    {
        return Device::paginate(Controller::PAGINATE_SIZE);
    }

    public function trashed()
    {
        return Device::onlyTrashed()->paginate(Controller::PAGINATE_SIZE);
    }

    public function forceDelete(string $id)
    {
        if ((Device::findOrFail($id))->forceDelete())
            return response(['message' => 'Deleted Successfully'], 200);
    }
    public function restore(string $id){
        if ((Device::findOrFail($id))->restore())
            return response(['message' => 'Restore successfully'], 200);
    }
}
