@extends('layouts.app')

@section('title')
    Transactions
@endsection

@section('contents')
<div style="height: 100px;"></div>
<div id="transaction-component"></div>

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
