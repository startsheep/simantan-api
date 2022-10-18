<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlagRequest;
use App\Http\Resources\Flag\FlagCollection;
use App\Http\Resources\Flag\FlagDetail;
use App\Http\Services\Flag\FlagService;
use App\Models\Flag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlagController extends Controller
{
    /**
     * @var $flagService
     */
    protected $flagService;

    /**
     * @param FlagService $flagService
     */
    public function __construct(FlagService $flagService)
    {
        $this->flagService = $flagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->flagService->all();

        return new FlagCollection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FlagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlagRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->flagService->create($request->all());
            DB::commit();
            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json([
                'message' => 'Fail, data failed to create'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->flagService->findOrFail($id);

        return new FlagDetail($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FlagRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $this->flagService->update($id, $request->all());
            DB::commit();
            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json([
                'message' => 'Fail, data failed to delete'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $this->flagService->delete($id);
            DB::commit();
            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json([
                'message' => 'Fail, data failed to delete'
            ], 500);
        }
    }
}
