@include('header')
<main>
    <div class="my-5 text-center">
        <h1 class="display-5 fw-bold">History</h1>
        <table class="table">
            <thead>
            <tr class="table-primary">
                <th scope="col">Proxy</th>
                <th scope="col">Check date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($proxyList as $proxy)
                <tr>
                    <th scope="row">{{ $proxy['proxy'] }}</th>
                    <td>{{ date('d-m-Y H:i:s', strtotime($proxy['created_at'])) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</main>


