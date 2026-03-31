<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LostFound;
use App\Models\Visitor;
use App\Models\Meeting;
use App\Models\Drop;
use App\Models\Deliver;
use App\Models\User;
use App\Http\Controllers\Traits\ScopesToOrganization;

class DashboardController extends Controller
{
    use ScopesToOrganization;

    public function getDashboard()
    {
        return view('pages.dashboard');
    }

    public function getCharts()
    {
        return view('charts.chartsmenu');
    }

    public function getBarCharts()
    {
        return view('charts.bar');
    }

    public function getPieCharts()
    {
        return view('charts.pie');
    }

    public function barChartShow(Request $request)
    {
        $input = $request->month;
        $date = "$request->month";
        $currentMonth = date("m", strtotime($date));
        $orgId = $this->currentOrgId();

        $lostItems = LostFound::where('organization_id', $orgId)
            ->orderBy('idLostFound', 'desc')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->withTrashed()->get();

        $meetings = Meeting::where('organization_id', $orgId)
            ->orderBy('idMeeting', 'desc')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->withTrashed()->get();

        $visitors = Visitor::where('organization_id', $orgId)
            ->orderBy('idVisitor', 'desc')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->withTrashed()->get();

        $deliveries = Deliver::where('organization_id', $orgId)
            ->orderBy('idDeliver', 'desc')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->withTrashed()->get();

        $drops = Drop::where('organization_id', $orgId)
            ->orderBy('idDrop', 'desc')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->withTrashed()->get();

        $users = User::where('organization_id', $orgId)->orderBy('idUser', 'desc');

        if ($request->idchart == 1) {
            return view('charts.bar', compact('drops', 'visitors', 'deliveries', 'meetings', 'lostItems', 'users', 'input'));
        } elseif ($request->idchart == 2) {
            return view('charts.pie', compact('drops', 'visitors', 'deliveries', 'meetings', 'lostItems', 'users', 'input'));
        }
    }

    public function getTables()
    {
        return view('tables.table');
    }

    public function getDropsTable()
    {
        $drops = Drop::where('organization_id', $this->currentOrgId())
            ->orderBy('idDrop', 'desc')
            ->withTrashed()->paginate(10);

        return view('tables.drops', compact('drops'));
    }

    public function getDeliversTable()
    {
        $delivers = Deliver::where('organization_id', $this->currentOrgId())
            ->orderBy('idDeliver', 'desc')
            ->withTrashed()->paginate(10);

        return view('tables.delivers', compact('delivers'));
    }

    public function getLostItemsTable()
    {
        $losts = LostFound::where('organization_id', $this->currentOrgId())
            ->orderBy('idLostFound', 'desc')
            ->withTrashed()->paginate();

        return view('tables.lostItems', compact('losts'));
    }

    public function getMeetingsTable()
    {
        $orgId = $this->currentOrgId();
        $user = User::where('organization_id', $orgId)->get()->load('meetingHost');
        $meetings = Meeting::where('organization_id', $orgId)
            ->orderBy('idMeeting', 'desc')
            ->withTrashed()->paginate();

        return view('tables.meetings', compact('meetings', 'user'));
    }
}
