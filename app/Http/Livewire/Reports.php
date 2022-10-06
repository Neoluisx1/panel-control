<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Order;
use App\Traits\PrinterTrait;
use Carbon\Carbon;
use Livewire\WithPagination;

class Reports extends Component
{

    use WithPagination;
    use PrinterTrait;

    public $usersearch, $startDate, $endDate, $userId = 'TODOS', $details = [];
    private $pagionation = 6;

    public function render()
    {
        return view('livewire.reports.component',[
            'users' => $this->loadUsers(),
            'orders' => $this->getReport()
        ])->layout('layouts.theme.app');
    }

    public function getReport(){
        if($this->startDate == '' || $this->endDate == ''){
            $from = Carbon::now()->format('Y-m-d');
            $to = Carbon::now()->format('Y-m-d');
        }else{
            $from = Carbon::parse($this->startDate)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->endDate)->format('Y-m-d') . ' 23:59:59';
        }

        if($this->userId != 'TODOS'){
            $uid = trim(explode("|", $this->userId)[1]);

            $orders = Order::whereBetween('created_at',[$from, $to])
                    ->where('user_id', $uid)
                    ->orderBy('id','desc')
                    ->paginate($this->pagionation);
        }else{
            $orders = Order::whereBetween('created_at',[$from, $to])
                    ->orderBy('id','desc')
                    ->paginate($this->pagionation);
        }
        return $orders;
    }

    public function loadUsers(){
        if(strlen($this->usersearch) > 0 ){
            $users = User::where('name','like',"%{$this->usersearch}%")
            ->orderBy('name','asc')
            ->get()->take(5);
        }else{
            $users = User::orderBy('name','asc')
            ->get()->take(5);
        }
        return $users;
    }
    public function viewDetails(Order $order){
        $this->details = $order->details;
        $this->dispatchBrowserEvent('open-modal-detail');
    }
    public function rePrint($orderId){
        $this->PrintTicket($orderId);
        $this->dispatchBrowserEvent('noty',['msg' => 'Se envio a reimprimir el ticket de Venta', 'type' => 'success']);
    }

    public function updatedUserId(){
        $this->search = '';
        $this->dispatchBrowserEvent('close-modal-user');
    }
}
