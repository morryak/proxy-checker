<?php
use Carbon\Carbon;
$date = Carbon::now()->format('Y');
?>
<footer class="bg-light text-center text-lg-start mt-auto" style="background-color: #f1f1f1;">
    <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ©  {{ date('Y') }} Copyright:
        <a class="text-dark" href="https://twitter.com/garaaj">Ilin Michael</a>
    </div>
</footer>
</body>