<?php 

namespace welabs\SalatNotifier;


use Illuminate\Support\Facades\DB;
use welabs\SalatNotifier\Contracts\SalatTimeInterface;
use welabs\SalatNotifier\Models\SalatTime;

class SalatTimeManager implements SalatTimeInterface
{
    public function getAllSalatTimes()
    {
        return SalatTime::select('id','salat','time','notification_send')->get();
    }

    public function getSalatTimeById($id)
    {
        return SalatTime::findOrFail($id);
    }

    public function createSalatTime(array $data)
    {
        return SalatTime::create($data);
    }

    public function updateSalatTime($id, array $data)
    {
        $salatTime = SalatTime::findOrFail($id);
        $salatTime->update($data);
        return $salatTime;
    }

    public function deleteSalatTime($id)
    {
        $salatTime = SalatTime::findOrFail($id);
        $salatTime->delete();
    }
}
