<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DB;
use Redirect,Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['pending']= DB::table('books')->sum(DB::raw('amount - amount_received'));
        $data['profit']= DB::table('books')->sum(DB::raw('amount_received'));
        $data['Withdrawal']= DB::table('_account_statement')->where('type', 'Withdraw')->sum(DB::raw('amount'));
        $data['deposit']= DB::table('_account_statement')->where('type', 'Credit')->sum(DB::raw('amount'));
        // print_r($data['Withdrawal']);
        return view('home')->with($data);
    }
    public function books()
    {
        $data['books']= DB::table('books')->get()->all();
        // echo '<pre>';
        // print_r($data['books']);
        // exit;
        return view('books')->with($data);
    }
    public function createbook()
    {
        return view('createbook');
    }
    public function createbookpost()
    {
        // print_r(request()->all());
        // exit;
       $cdate = date("Y-m-d"). date("h:i:s");
        $this->validate(request(), [
            "name" => "required",
            "number" => "required",
            "days" => "required|numeric",
            "date" => "required|date",
            "emi" => "required|numeric",
            "amount" => "required|numeric",
        ]);
            $days = request()->days; 
            $date = request()->date; 
        $book_id = DB::table('books')->insertGetId([
            'name' => request()->name,
            'number' => request()->number,
            'day' => $days,
            'date' => $date,
            'emi' => request()->emi,
            'amount' => request()->amount,
            'created_at' => $cdate,
            'updated_at' => $cdate,
        ]);
        for ($i=0; $i < $days; $i++) { 
           $dt = Carbon::create($date);
            $date= $dt->addDay();  
            $createDate = new DateTime($date);
            $date = $createDate->format('d-m-Y');
            
            DB::table('books_emi')->insert([
            'book_id' => $book_id,
            'date' => $date,
            'amount' => $days,
            'date' => $date,
            'amount' => request()->emi,
            'ststus' => 'not',
            ]);
        }
        return redirect('/')->with('status', 'Book Created Successfully .');
    }
   
    public function book()
    {
        $id=$_GET['id'];
        // print_r($id);
        $data['book'] = DB::table('books')->where('id', $id)->first();
        $data['emi'] = DB::table('books_emi')->where('book_id', $id)->get();
        // echo '<pre>';
        // print_r($data['emi']);
        return view('book')->with($data);
    }
    public function book_emi_update($emi,$book,$amount)
    {
        $cdate = date("Y-m-d"). date("h:i:s");
        DB::table('books_emi')->where('id', $emi)->update([
            'ststus' => 'received',
            'created_at' =>  $cdate,
            'updated_at' =>  $cdate,
            ]);

        $data = DB::table('books')->where('id', $book)->get()->first();
        $new_am=$data->amount_received+$amount;  
        DB::table('books')->where('id', $book)->update([
            'amount_received' => $new_am,
            ]);
        $main_ac = Auth()->user()->account + $amount;
        DB::table('users')->where('id', Auth()->user()->id)->update([
            'account' => $main_ac,
            ]);
        DB::table('_account_statement')->insert([
            'type' => 'EMI',
            'amount' => $amount,
            'book_id' => $book,
            'created_at' => $cdate,
            'updated_at' => $cdate,
            ]);
        echo 'success'; 
    }

    public function account()
    {
        $payment = DB::table('_account_statement')->orderBy('created_at', 'DESC')->get();
        $data= [];
        foreach ($payment as $key => $value) {
                $date=$value->created_at;
                $createDate = new DateTime($date);
                $date = $createDate->format('d-m-Y');
            if (!empty($value->book_id)) {
                
                $book = DB::table('books')->where('id', $value->book_id)->get()->first();
                
                $data[$key]= array(
                    'id' => $value->id, 
                    'type' => $value->type.'('.$book->name.','.$book->number.')', 
                    'amount' => $value->amount, 
                    'book_id' => $value->id, 
                    'created_at' => $date, 
                );
               
                
            }else{
                $data[$key]= array(
                    'id' => $value->id, 
                    'type' => $value->type, 
                    'amount' => $value->amount, 
                    'book_id' => $value->id, 
                    'created_at' => $date, 
                );
            }
        }
        // print_r($data);
        $pay['payment']=$data;
        return view('account')->with($pay);
    }
    public function update_fund($amount,$type)
    {
        $cdate = date("Y-m-d"). date("h:i:s");
        $cfund= Auth()->user()->account;
        if($type == 'deposit'){
            DB::table('users')->where('id', Auth()->user()->id)->update([
                'account' => $cfund+$amount,
                ]);
                DB::table('_account_statement')->insert([
                    'type' => 'Credit',
                    'amount' => $amount,
                    'created_at' => $cdate,
                    'updated_at' => $cdate,
                    ]);
            return response()->json([
                'success' => 'You amount '.$amount.' is Credited.',
            ]);
        }else{
            if ($cfund>=$amount) {
                
                DB::table('users')->where('id', Auth()->user()->id)->update([
                    'account' => $cfund-$amount,
                    ]);
                DB::table('_account_statement')->insert([
                    'type' => 'Withdraw',
                    'amount' => $amount,
                    'created_at' => $cdate,
                    'updated_at' => $cdate,
                    ]);
                    return response()->json([
                        'success' => 'You amount '.$amount.' is Withdrawal.',
                    ]);
            }else{
                return response()->json([
                    'error' => 'Do Not Have a Sufficient Balance.',
                ]);
            }
        }
    }
    
}
