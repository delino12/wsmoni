@extends('layouts.app')

@section('title')
    Transfer
@endsection

@section('contents')
<div style="height: 100px;"></div>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-primary-to-secondary text-white p-4">{{ __('Easy Transfer') }}</div>
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
                            <form method="POST" onsubmit="return postTransfer()">
                                <div class="row py-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="wallet_code">Wallet ID:</label>
                                            <input type="text" id="wallet_code" onblur="fetchWalletInfo()" name="wallet_code" class="form-control" placeholder="Eg, 9000" required>
                                            <div id="wallet_owner"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row py-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount">Amount:</label>
                                            <input type="number" step="any" min="0" id="amount" name="amount" class="form-control" placeholder="Eg, XXXX" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row py-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="narration">Narration (optional):</label>
                                            <textarea id="narration" name="narration" class="form-control" placeholder="Eg, Cash from business" style="resize:none;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                        <td>${val.user.name}</td>
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

    function fetchWalletInfo() {
        var _token = '{{ csrf_token() }}';
        var wallet_code = $("#wallet_code").val();

        var query = {_token, wallet_code}

        fetch(`{{url('wallet/resolve')}}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(query)
        }).then(r => {
            return r.json();
        }).then(results => {
            // console.log(results);
            $("#wallet_owner").html(`
                <div class="form-control mt-2">${results.message}</div>
            `);

            setTimeout(function(){
                $("#wallet_owner").fadeOut();
            }, 1000 * 20);
        }).catch(err => {
            console.log(err);
        });
    }

    function postTransfer() {
        var _token = '{{ csrf_token() }}';
        var wallet_code = $("#wallet_code").val();
        var amount      = $("#amount").val();
        var narration   = $("#narration").val();

        var query = {_token, wallet_code, amount, narration}

        fetch(`{{url('transactions/transfer')}}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(query)
        }).then(r => {
            return r.json();
        }).then(results => {
            // console.log(results);
            swal(
                results.status,
                results.message,
                results.status
            );

            if(results.status == "success"){
                fetchAccountBalance();
                setTimeout(function(){
                    window.location.href = "{{url('home')}}";
                }, 1000 * 3);
            }
        }).catch(err => {
            console.log(err);
        });

        // void
        return false;
    }

</script>
@endsection
