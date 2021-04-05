<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TaxTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MassDestroyTaxTypeRequest;
use App\Models\TaxType;
use Illuminate\Http\Request;

class TaxTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaxTypeDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.tax.tax-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxType  $taxType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxType $taxType)
    {
        if($taxType->taxRates->count() > 0) {
            alert()->error('Tipe pajak ini tidak dapat dihapus, karena mempunyai relasi dengan data presentase pajak');
            return redirect()->back();
        }
        $taxType->delete();
        return redirect()->route('admin.tax-types.index')->withSuccess('Data tipe pajak berhasil dihapus!');
    }

    public function massDestroy(MassDestroyTaxTypeRequest $request)
    {
        $taxTypes = TaxType::whereIn('id', request('ids'))->get();
        foreach($taxTypes as $taxType) {
            if($taxType->taxRates->count() > 0) {
                alert()->error('Salah satu tipe pajak ini tidak dapat dihapus, karena mempunyai relasi dengan data presentase pajak');
                return;
            }
            $taxType->delete();
        }

        return redirect()->route('admin.tax-types.index')->withSuccess('Data tax type(s) berhasil dihapus!');
    }
}
