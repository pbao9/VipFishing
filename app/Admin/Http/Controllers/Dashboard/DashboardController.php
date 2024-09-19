<?php

namespace App\Admin\Http\Controllers\Dashboard;

use App\Admin\Http\Controllers\Controller;
use App\Models\Lakes;
use App\Models\Lakechilds;
// use App\Models\LakeFishs;
use App\Models\Fishs;
use App\Models\VariationFishs;
use App\Models\Ratings;
use App\Models\Ranks;
use App\Models\Withdraws;
use App\Models\Deposits;
use App\Models\TransactionHistory;
use App\Models\Balances;
use App\Models\Compensations;
use App\Models\CommissionHistory;
use App\Models\Banks;
use App\Models\Bookings;
use App\Models\FishingSet;
use App\Models\BookingLake;
use App\Models\Notifications;
use App\Models\Events;
use App\Models\LakeEvents;
use App\Models\UserEvents;
use App\Models\UserScores;


class DashboardController extends Controller
{
    //

    public function getView()
    {
        return [
            'index' => 'admin.dashboard.index'
        ];
    }
    public function index(){
		 // Đếm số lượng hàng trong bảng dữ liệu 1
		$rowCountLakes = Lakes::count();
        $rowCountLakechilds = Lakechilds::count();
        // $rowCountLakeFishs = LakeFishs::count();
        $rowCountFishs = Fishs::count();
        $rowCountVariationFishs = VariationFishs::count();
        $rowCountRatings = Ratings::count();
        $rowCountRanks = Ranks::count();
        $rowCountWithdraws = Withdraws::count();
        $rowCountDeposits = Deposits::count();
        $rowCountTransactionHistory = TransactionHistory::count();
        $rowCountBalances = Balances::count();
        $rowCountCompensations = Compensations::count();
        $rowCountCommissionHistory = CommissionHistory::count();
        $rowCountBanks = Banks::count();
        $rowCountBookings = Bookings::count();
        $rowCountFishingSet = FishingSet::count();
        $rowCountBookingLake = BookingLake::count();
        $rowCountNotifications = Notifications::count();
        $rowCountEvents = Events::count();
        $rowCountLakeEvents = LakeEvents::count();
        $rowCountUserEvents = UserEvents::count();
        $rowCountUserScores = UserScores::count();
        
		
        return view($this->view['index'], [
			'rowCountLakes' => $rowCountLakes,
            'rowCountLakechilds' => $rowCountLakechilds,
            // 'rowCountLakeFishs' => $rowCountLakeFishs,
            'rowCountFishs' => $rowCountFishs,
            'rowCountVariationFishs' => $rowCountVariationFishs,
            'rowCountRatings' => $rowCountRatings,
            'rowCountRanks' => $rowCountRanks,
            'rowCountWithdraws' => $rowCountWithdraws,
            'rowCountDeposits' => $rowCountDeposits,
            'rowCountTransactionHistory' => $rowCountTransactionHistory,
            'rowCountBalances' => $rowCountBalances,
            'rowCountCompensations' => $rowCountCompensations,
            'rowCountCommissionHistory' => $rowCountCommissionHistory,
            'rowCountBanks' => $rowCountBanks,
            'rowCountBookings' => $rowCountBookings,
            'rowCountFishingSet' => $rowCountFishingSet,
            'rowCountBookingLake' => $rowCountBookingLake,
            'rowCountNotifications' => $rowCountNotifications,
            'rowCountEvents' => $rowCountEvents,
            'rowCountLakeEvents' => $rowCountLakeEvents,
            'rowCountUserEvents' => $rowCountUserEvents,
            'rowCountUserScores' => $rowCountUserScores,
            
		]);
    }

}
