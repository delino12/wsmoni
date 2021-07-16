@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('contents')
<div style="height: 100px;"></div>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-primary-to-secondary text-white p-4">

                    <span class="pull-right">
                        Wallet ID: {{ walletId(auth()->user()->id) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 mt-4">
                            <a href="{{url('deposit')}}" class="btn btn-primary mt-4 mb-2">
                                Deposit
                            </a>
                            <br />
                            <a href="{{url('transfer')}}"  class="btn btn-primary mb-2">
                                Transfer
                            </a>
                        </div>
                        <div class="col-md-10">
                            My Transactions
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Narration</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="load-transaction-history"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    loadTransctionHistory();

    function loadTransctionHistory() {
        fetch(`{{url('transactions/history')}}`, {
            method: "GET",
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(r => {
            return r.json();
        }).then(results => {
            // console.log(results);
            $("#load-transaction-history").html("");
            $.each(results, function(index, val) {
                var status = ``;
                if(val.transaction_type_id == 2){
                    status = `<span class="text-success">${val.transaction_type.name}</span>`;
                }else{
                    status = `<span class="text-danger">${val.transaction_type.name} </span>`;
                }
                $("#load-transaction-history").append(`
                    <tr>
                        <td>${val.reference}</td>
                        <td>&#8358;${val.amount}</td>
                        <td>${status}</td>
                        <td>${val.narration}</td>
                        <td>${val.date}</td>
                    </tr>
                `);
            });
        }).catch(err => {
            console.log(err);
        });
    }

    function showTransferModal() {
        $("#show-transfer-modal").modal();
    }

    function postTransfer() {
        
    }

    function showDepositModal() {
        $("#show-deposit-modal").modal();
    }

    function postDeposit() {
        
    }
</script>
@endsection
