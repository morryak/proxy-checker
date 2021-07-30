@include('header')
<main class="flex-shrink-0">
    <div class="px-4 text-center">
        <h1 class="display-5 fw-bold">Proxy checker</h1>
        <div class="col-lg-6 mx-auto">
            <form method="post" action="{{ route('addForm') }}">
                <!-- CROSS Site Request Forgery Protection -->
                @if(isset($error))
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endif
                @csrf
                <div class="form-group">
                    <label>Put your proxy/proxy list</label>
                    <label for="Proxy"></label><textarea class="form-control" name="proxy" id="proxy"
                                                         rows="4"></textarea>
                </div>
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block js-submit-btn mt-2" disabled>
            </form>
        </div>
        @if(isset($result['notPassTest']) && $result['passTest'] == 0)
            <div class="alert alert-success mt-4" role="alert">
                Test passed successfully! IP without proxy - {{ $result['notPassTest'] }}
                @if(isset($result['notIp']))
                    Not IP - {{ $result['notIp'] }}
                @endif
            </div>
        @endif
        @if(isset($result['checkedIps']))
            <div class="alert alert-success mt-4" role="alert">
                Test passed successfully! IP with proxy - {{ $result['passTest'] }}. IP without proxy
                - {{ $result['notPassTest'] }}.
                @if(isset($result['notIp']))
                    Not IP - {{ $result['notIp'] }}
                @endif
            </div>
            <table class="table">
                <thead>
                <tr class="table-primary">
                    <th scope="col">ip:port</th>
                    <th scope="col">type</th>
                    <th scope="col">location</th>
                    <th scope="col">check time</th>
                    <th scope="col">ip</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($result['checkedIps'] as $item)
                        <th scope="row">{{ $item }}</th>
                    @endforeach
                </tr>
                </tbody>
            </table>
        @endif
    </div>
</main>
@include('footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#proxy').addEventListener('input', function (event) {
            const pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/m
            if (event.target.value.length > 0 && pattern.test(event.target.value)) {
                document.querySelector('.js-submit-btn').disabled = false
            } else {
                document.querySelector('.js-submit-btn').disabled = true
            }
        })
    })
</script>
