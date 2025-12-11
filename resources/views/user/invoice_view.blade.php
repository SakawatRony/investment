@extends('layouts.user.app2')

@section('title', 'Invoice')

@section('content')
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content" id="divToPrint">
    <div class="container-fluid">
    <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <small class="float-right">Date: {{ timeZoneformatDate($transaction->created_at) }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{ $setting->company_name }}.</strong><br>
                    {{ $setting->address }}<br>
                    {{ $setting->phone }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $transaction->user->full_name }}</strong><br>
                    NID: {{ $transaction->user->nid  }}
                    Phone: {{ $transaction->user->phone  }}<br>
                    Email: {{ $transaction->user->email  }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{ $transaction->id }}</b><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Commission %</th>
                      <th>Unit</th>
                      <th>Point Value</th>
                      <th>Commission</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{ $transaction->userCommission?->commission }}</td>
                      <td>{{ $transaction->unitUser?->unit_name }}</td>
                      <td>{{  $transaction->price }}</td>
                      <td>{{ $transaction->commission }}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    <button onclick="printDiv('divToPrint')" class="btn btn-primary">Print</button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div>
    <!-- /.container-fluid -->
</div>
<!--end::App Content-->
@endsection

@section('js')
<script>
    function printDiv(divId) {
    var divToPrint = document.getElementById(divId);
    var newWin = window.open('', 'Print-Window');
    // Include the head content (styles) for proper formatting
    newWin.document.open();
    newWin.document.write('<html><head>' + document.head.innerHTML + '</head><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
    newWin.document.close();
    // Use setTimeout to ensure the print dialog opens and the window closes properly
    setTimeout(function(){newWin.close();}, 10);
}
</script>
@endsection
