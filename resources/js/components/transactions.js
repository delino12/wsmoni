import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'

export default class TransactionComponent extends Component {
	render(){
		return (
            <div className="container py-4">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header bg-gradient-primary-to-secondary text-white p-4">My Transactions</div>
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-md-12">
                                        <table className="table">
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
		);
	}
}


if(document.getElementById('transaction-component')){
    ReactDOM.render(<TransactionComponent />, document.getElementById('transaction-component'));
}