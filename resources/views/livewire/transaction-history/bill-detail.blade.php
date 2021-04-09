<div>
    <div class="accordion mt-4" id="accordionDetailTagihan">
        <div class="card my-3">
            <div class="card-header" data-toggle="collapse" data-target="#detail-{{$detail->id}}" style="cursor: pointer">
                Detail Tagihan {{$detail->bill->month_name . ' ' . $detail->bill->tahun}}
            </div>

            <div class="collapse" id="detail-{{$detail->id}}" data-parent="#accordionDetailTagihan">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-md-4">Jumlah KwH</dt>
                        <dd class="col-md-8">
                            {{$detail->bill->jumlah_kwh}}
                        </dd>
                        <dt class="col-md-4">PPJ</dt>
                        <dd class="col-md-8">
                            @rupiah($detail->ppj)
                        </dd>
                        <dt class="col-md-4">PPN</dt>
                        <dd class="col-md-8">
                            @rupiah($detail->ppn)
                        </dd>
                        <dt class="col-md-4">Denda</dt>
                        <dd class="col-md-8">
                            @rupiah($detail->denda)
                        </dd>

                        <dt class="col-md-4">Total Tagihan</dt>
                        <dd class="col-md-8">
                            @rupiah($detail->total_tagihan)
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
