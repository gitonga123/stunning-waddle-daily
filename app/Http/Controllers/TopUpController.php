<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ToppedUp;
use App\TopUpNumbers;
use AfricasTalking\SDK\AfricasTalking;


class TopUpController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function topUp()
    {
        $users = $this->getUsersToTupFor();
        foreach ($users as $user) {
            $transaction = $this->callTopUpApi($user->phone_number, $user->amount);
            $transaction['user_id'] = $user->id;
            $this->createToppedUpRecord($transaction);
        }
    }

    private function callTopUpApi($phone_number, $amount)
    {
        $user_name = 'entry_results_daniel';
        $api_key = '21fbbe3be81ea08870bf873f0a1f0215ba986e5ab27d8391d00090f9380ad658';
        
        // $api_key = '';
        $AT = new AfricasTalking($user_name, $api_key);
        // buy airtime
        $airtime = $AT->airtime();
        $parameters = array(
            'recipients' => [[
                'phoneNumber' => $phone_number,
                'currencyCode' => 'KES',
                'amount' => $amount
            ]]
        );
        $transaction = $airtime->send($parameters);
        dump($transaction);
        dump($transaction['data']);
        die;
        return ;
    }

    private function getUsersToTupFor()
    {
        return TopUpNumbers::where('published', true)->get();
    }

    private function createToppedUpRecord($transaction)
    {
        ToppedUp::create(
            [
                'user_id' => $transaction['user_id'],
                'amount' => $transaction['amount'],
                'balance' => $transaction['balance']
            ]
        );
    }
}
