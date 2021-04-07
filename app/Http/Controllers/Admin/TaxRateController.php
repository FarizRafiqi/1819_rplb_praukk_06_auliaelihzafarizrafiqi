<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TaxRateDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyTaxRateRequest;
use App\Models\TaxRate;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TaxRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaxRateDataTable $dataTable)
    {
        abort_if(Gate::denies("tax_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        return $dataTable->render('pages.admin.tax.tax-rate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxRate  $taxRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxRate $taxRate)
    {
        $taxRate->delete();
        return redirect()->route('admin.tax-rates.index')->withSuccess('Data presentase pajak berhasil dihapus!');
    }

    public function massDestroy(MassDestroyTaxRateRequest $request)
    {
        $taxRates = TaxRate::whereIn('id', request('ids'))->get();
        foreach($taxRates as $taxRate) {
            $taxRate->delete();
        }

        return redirect()->route('admin.tax-rates.index')->withSuccess('Data tax rate(s) berhasil dihapus!');
    }
}
