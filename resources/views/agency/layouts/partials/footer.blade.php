<footer class="footer px-4">
    <div>
        <a href="#">{{ auth()->user()->agency->agency_name ?? 'Agency' }}</a> &copy;
        {{ date('Y') }}.
    </div>
    <div class="ms-auto">Powered by&nbsp;<a href="#">Aqar Vision</a></div>
</footer>
