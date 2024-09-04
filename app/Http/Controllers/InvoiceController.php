<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //
    public function showUserInvoices()
    {
        $user_id = Auth::id();
        $invoices = Invoice::where('user_id', $user_id)->with('invoiceItems')->get();
        
        return view('invoices', compact('invoices'));
    }
}
