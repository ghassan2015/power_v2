<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    use GeneralTrait;

    public function index()
    {

        $imvoices=Invoice::get();
        return $this -> returnData('invoices',$imvoices);

    }
}
