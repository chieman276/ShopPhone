<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDO;

class CustomerCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::select('*')->paginate(5);
        $params = [
            'customers' => $customers,
        ];
        return view('backend.customers.index',$params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->birthday = $request->birthday;
        $customer->password = $request->password;
        try {
            $customer->save();
            return redirect()->route('customers.index')->with('success','Thêm'.$request->name.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error','Thêm'.$request->name.  'không thành công');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $params = [
            'customer' => $customer,
        ];
        return view('backend.customers.edit',$params);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->birthday = $request->birthday;
        $customer->password = $request->password;
        try {
            $customer->save();
            return redirect()->route('customers.index')->with('success','Sửa'.$request->name.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error','Sửa'.$request->name.  'không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        try {
            $customer->delete();
            return redirect()->route('customers.index')->with('success','Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error','Xóa'. 'không thành công');
        }
    }


    
    public function trashedItems()
    {
        $customers = Customer::onlyTrashed()->select('*')->paginate(5);
        $params = [
            'customers' => $customers,
        ];
        return view('backend.customers.trash',$params);
    }

    public function force_destroy($id)
    {

        $customer = Customer::withTrashed()->find($id);
        try {
            $customer->forceDelete();
            return redirect()->route('customers.trash')->with('success', 'Xóa' . ' ' . $customer->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.trash')->with('error', 'Xóa' . ' ' . $customer->name . ' ' .  'không thành công');
        }
    }


    public function restore($id)
    {
        $customer = Customer::withTrashed()->find($id);

        try {
            $customer->restore();
            return redirect()->route('customers.trash')->with('success', 'Khôi phục' . ' ' . $customer->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.trash')->with('error', 'Khôi phục' . ' ' . $customer->name . ' ' .  'không thành công');
        }
    }

}
