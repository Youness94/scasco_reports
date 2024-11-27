<?php


namespace App\Services;

use App\Models\Branche;
use App\Models\Client;
use App\Models\PotencialCase;
use App\Models\PotencialCaseHisotry;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PotencialCaseHisotryService
{
   /**
     * Create a history record for a potential case.
     *
     * @param  string  $actionType
     * @param  string|null  $comment
     * @param  \App\Models\PotencialCase  $potencialCase
     * @param  int|null  $appointmentId
     * @param  int|null  $reportId
     * @param  int  $userId
     * @return \App\Models\CaseHistory
     */
    public function createHistoryRecord($actionType, $comment = null, $potencialCase, $appointmentId = null, $reportId = null, $userId)
    {
        return PotencialCaseHisotry::create([
            'comment' => $comment,
            'action_type' => $actionType,
            'action_date' => Carbon::now(),
            'potencial_case_id' => $potencialCase->id,
            'appointment_id' => $appointmentId,
            'report_id' => $reportId,
            'created_by' => $userId,
        ]);
    }
}
