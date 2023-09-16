@include('mail.parts.header')
<tr>
    <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0">
        <table>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em">
                        <h4 class="heading">
                            {{ $request->fromDistributor->name }} has submitted a request for GIN :
                            {{ $request->product->product->GIN }}
                        </h4>
                        <p>
                            From distributor: {{ $request->fromDistributor->name }}
                        </p>
                        <p>
                            From distributor code: {{ $request->fromDistributor->distributor->distributer_code }}
                        </p>
                        <p>
                            GIN: {{ $request->product->product->GIN }}
                        </p>
                        <p>
                            Lot no: {{ $request->lot_number }}
                        </p>
                        <p>
                            Requested quantity: {{ $request->quantity }}
                        </p>
                        <p>
                            To distributor: {{ $request->toDistributor->name }}
                        </p>
                        <p>
                            To distributor code: {{ $request->toDistributor->distributor->distributer_code }}
                        </p>
                        <p>
                            Tracking Number: {{ $request->tracking_number }}
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
@include('mail.parts.footer')
