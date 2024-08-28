<?php

namespace welabs\SalatNotifier\Http\Controllers;


use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Routing\Controller;
use welabs\SalatNotifier\Http\Requests\SalatTimeRequest;
use welabs\SalatNotifier\Models\SalatTime;
use welabs\SalatNotifier\SalatTimeManager;

class SalatTimeController extends Controller
{
    protected $salatTimeManage;

    public function __construct(SalatTimeManager $salatTimeManage)
    {
        $this->salatTimeManage = $salatTimeManage;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $salatTimes = $this->salatTimeManage->getAllSalatTimes();

        return view('salatnotifier::index',compact('salatTimes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('salatnotifier::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalatTimeRequest $salattimerequest): RedirectResponse
    {
        try {
            // Attempt to save the Salat time to the database
            $this->salatTimeManage->createSalatTime($salattimerequest->validated());
    
            // Redirect back with a success message
            return redirect(route('salat-times.index'))->with('success', 'Salat time saved successfully!');

        } catch (Exception $e) {
            // Log the exception message for debugging purposes
            Log::error('Failed to save Salat time: ' . $e->getMessage());
    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while saving the Salat time. Please try again.');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalatTime $salat_time): View
    {
        return view("salatnotifier::edit",compact('salat_time'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalatTimeRequest $salattimerequest, SalatTime $salat_time): RedirectResponse
    {
       try{

        $this->salatTimeManage->updateSalatTime($salat_time->id, $salattimerequest->validated());

        return redirect(route('salat-times.index'))->with('success', 'Salat time updated successfully!');

       }catch(Exception $e) {

         // Log the exception message for debugging purposes
        Log::error('Failed to update Salat time: ' . $e->getMessage());
    
         // Redirect back with an error message
        return redirect()->back()->with('error', 'An error occurred while updating the Salat time. Please try again.');

       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalatTime $salat_time): RedirectResponse
    {
        try{
         
            $this->salatTimeManage->deleteSalatTime($salat_time->id);

            return redirect()->back()->with('success', 'Salat time deleted successfully!');

        }catch(Exception $e) {

            // Log the exception message for debugging purposes
        Log::error('Failed to delete Salat time: ' . $e->getMessage());
    
         // Redirect back with an error message
        return redirect()->back()->with('error', 'An error occurred while deleting the Salat time. Please try again.');

        }
    }
}
