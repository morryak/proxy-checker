@include('header')
<main>
    <div class="px-4 my-5 text-center">
        <h1 class="display-5 fw-bold">Proxy checker</h1>
        <div class="col-lg-6 mx-auto">
            <form method="post" action="{{ route('addForm') }}">
                <!-- CROSS Site Request Forgery Protection -->
                @csrf
                <div class="form-group">
                    <label>Put your proxy/proxy list</label>
                    <label for="Proxy"></label><textarea class="form-control" name="proxy" id="Proxy"
                                                           rows="4"></textarea>
                </div>
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
            </form>
        </div>
    </div>
</main>

