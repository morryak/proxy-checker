@include('header')
<main class="flex-shrink-0">
    <div class="px-4 text-center">
        <h1 class="display-5 fw-bold">Proxy checker</h1>
        <div class="col-lg-6 mx-auto">
            <form method="post" action="{{ route('addForm') }}">
                <!-- CROSS Site Request Forgery Protection -->
                @csrf
                <div class="form-group">
                    <label>Put your proxy/proxy list</label>
                    <label for="Proxy"></label><textarea class="form-control" name="proxy" id="proxy"
                                                         rows="4"></textarea>
                </div>
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block js-submit-btn">
{{--                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block js-submit-btn" disabled>--}}
            </form>
        </div>
    </div>
</main>
@include('footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#proxy').addEventListener('input', function (event) {
            // const pattern = /(([1-9][0-9]{2}|[1-9][0-9]|[1-9])\.([1-9][0-9]|[1-9][0-9]{2}|[0-9]))\.([0-9]|[1-9][0-9]|[1-9][0-9]{2})\.([0-9]|[1-9][0-9]|[1-9][0-9]{2})\:([1-9][0-9]{4}|[1-9][0-9]{3}|[1-9][0-9]{2}|[1-9][0-9]|[1-9])/g
            // if (event.target.value.length > 0 && pattern.test(event.target.value)) {
            //     document.querySelector('.js-submit-btn').disabled = false
            // } else {
            //     document.querySelector('.js-submit-btn').disabled = true
            // }
        })
    })
</script>
