@include('header')
<main>
    <div class="text-center">
        <h1 class="display-5 fw-bold">History</h1>
        <table class="table">
            <thead>
            <tr class="table-primary">
                <th scope="col">ip:port</th>
                <th scope="col">type</th>
                <th scope="col">location</th>
                <th scope="col">check time</th>
                <th scope="col">ip</th>
                <th scope="col">check date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($proxyList as $proxy)
                <tr>
                    <th scope="row">{{ $proxy['ip_port'] }}</th>
                    <th scope="row">{{ $proxy['proxy_type'] }}</th>
                    <th scope="row">{{ $proxy['location'] }}</th>
                    <th scope="row">{{ $proxy['check_time'] }}</th>
                    <th scope="row">{{ $proxy['ip'] }}</th>
                    <td>{{ date('d.m.Y H:i:s', strtotime($proxy['created_at'])) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</main>
@include('footer')


